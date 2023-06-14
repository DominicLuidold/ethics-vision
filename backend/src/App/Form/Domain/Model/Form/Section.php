<?php

declare(strict_types=1);

namespace App\Form\Domain\Model\Form;

use App\Common\Domain\Id\SectionId;
use App\Form\Domain\Model\MetaInformation\MetaCategoryValueObject;
use App\Form\Domain\Model\MetaInformation\SectionMetaInformationValueObject;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Fusonic\DDDExtensions\Domain\Model\EntityInterface;

class Section implements EntityInterface
{
    /**
     * @var Collection<array-key, Element>
     */
    private Collection $elements;

    private function __construct(
        private SectionId $id,
        private readonly Form $form,
        private string $title,
        private ?string $description,
        private int $position,
        private SectionMetaInformationValueObject $metaInformation,
    ) {
        $this->elements = new ArrayCollection();
    }

    public static function create(
        Form $form,
        string $title,
        ?string $description,
        int $position,
        string $metaCategoryName,
        string $metaCategoryValue = null
    ): self {
        return new self(
            id: new SectionId(null),
            form: $form,
            title: $title,
            description: $description,
            position: $position,
            metaInformation: new SectionMetaInformationValueObject(
                category: new MetaCategoryValueObject(
                    name: $metaCategoryName,
                    value: $metaCategoryValue
                )
            ),
        );
    }

    public function getId(): SectionId
    {
        return $this->id;
    }

    public function getForm(): Form
    {
        return $this->form;
    }

    /**
     * @return Collection<array-key, Element>
     */
    public function getElementCollection(): Collection
    {
        return $this->elements;
    }

    /**
     * @return Element[]
     */
    public function getElements(): array
    {
        return $this->elements->getValues();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function getMetaInformation(): SectionMetaInformationValueObject
    {
        return $this->metaInformation;
    }

    public function hasElement(Element $possibleSectionElement): bool
    {
        foreach ($this->elements as $element) {
            if ($element->getId() === $possibleSectionElement->getId()) {
                return true;
            }
        }

        return false;
    }
}
