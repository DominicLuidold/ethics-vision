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
    ) {
        $this->elementEntries = new ArrayCollection();
    }

    public static function create(Form $form, EntryStatus $status = EntryStatus::WORK_IN_PROGRESS): self
    {
        return new self(
            id: new EntryId(null),
            form: $form,
            status: $status
        );
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
    }

    public function updateElementEntryValue(ElementId $elementId, string $value): void
    {
        foreach ($this->elementEntries as $elementEntry) {
            if ($elementEntry->getElement()->getId() === $elementId) {
                $elementEntry->updateValue($value);

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
            }
        }
    }
}
