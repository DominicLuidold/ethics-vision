<?php

declare(strict_types=1);

namespace App\Form\Domain\Model\Entry;

use App\Common\Domain\Id\ElementEntryId;
use App\Common\Domain\Id\ElementId;
use App\Common\Domain\Id\EntryId;
use App\Form\Domain\Exception\ElementEntryNotFoundException;
use App\Form\Domain\Exception\ElementNotRelatedToFormException;
use App\Form\Domain\Model\Form\Element;
use App\Form\Domain\Model\Form\Form;
use App\Form\Domain\Model\MetaInformation\EntryMetaInformationValueObject;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Fusonic\DDDExtensions\Domain\Model\AggregateRoot;

class Entry extends AggregateRoot
{
    /** @var Collection<array-key, ElementEntry> */
    private Collection $elementEntries;

    private function __construct(
        private EntryId $id,
        private readonly Form $form,
        private EntryStatus $status,
        private readonly \DateTimeInterface $createdAt,
        private \DateTimeInterface $updatedAt,
        private readonly EntryMetaInformationValueObject $metaInformation,
        private ?\DateTimeInterface $submittedAt = null,
    ) {
        $this->elementEntries = new ArrayCollection();
    }

    public static function create(
        Form $form,
        EntryMetaInformationValueObject $metaInformation,
    ): self {
        return new self(
            id: new EntryId(null),
            form: $form,
            status: EntryStatus::WORK_IN_PROGRESS,
            createdAt: new \DateTimeImmutable(),
            updatedAt: new \DateTimeImmutable(),
            metaInformation: $metaInformation,
        );
    }

    public function submit(): void
    {
        $this->status = EntryStatus::SUBMITTED;
        $this->updatedAt = new \DateTimeImmutable();
        $this->submittedAt = new \DateTimeImmutable();

        // TODO - Emit event and send email
        // $this->raise(new EntrySubmittedEvent($this->id));
    }

    public function getId(): EntryId
    {
        return $this->id;
    }

    public function getForm(): Form
    {
        return $this->form;
    }

    public function getStatus(): EntryStatus
    {
        return $this->status;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function getSubmittedAt(): ?\DateTimeInterface
    {
        return $this->submittedAt;
    }

    public function getMetaInformation(): EntryMetaInformationValueObject
    {
        return $this->metaInformation;
    }

    /**
     * @return ElementEntry[]
     */
    public function getElementEntries(): array
    {
        return $this->elementEntries->getValues();
    }

    public function getElementEntry(ElementEntryId $id): ElementEntry
    {
        foreach ($this->elementEntries as $elementEntry) {
            if ($elementEntry->getId()->equals($id)) {
                return $elementEntry;
            }
        }

        throw new \LogicException(); // TODO - Custom exception
    }

    public function addElementEntry(Element $element, string $value): void
    {
        if (!$this->form->hasElement($element)) {
            throw new ElementNotRelatedToFormException($element->getId(), $this->form->getId());
        }

        $this->elementEntries->add(ElementEntry::create($this, $element, $value));
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function updateElementEntryValue(ElementId $elementId, string $value): void
    {
        foreach ($this->elementEntries as $elementEntry) {
            if ($elementEntry->getElement()->getId()->equals($elementId)) {
                $elementEntry->updateValue($value);
                $this->updatedAt = new \DateTimeImmutable();

                return;
            }
        }

        throw new ElementEntryNotFoundException($elementId, $this->id);
    }

    public function removeElementEntry(ElementId $elementId): void
    {
        foreach ($this->elementEntries as $elementEntry) {
            if ($elementEntry->getElement()->getId() === $elementId) {
                $this->elementEntries->removeElement($elementEntry);
                $this->updatedAt = new \DateTimeImmutable();
            }
        }
    }
}
