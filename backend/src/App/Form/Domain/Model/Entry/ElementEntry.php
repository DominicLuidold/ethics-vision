<?php

declare(strict_types=1);

namespace App\Form\Domain\Model\Entry;

use App\Common\Domain\Id\ElementEntryId;
use App\Form\Domain\Model\Form\Element;
use Fusonic\DDDExtensions\Domain\Model\EntityInterface;

class ElementEntry implements EntityInterface
{
    private function __construct(
        private ElementEntryId $id,
        private readonly Entry $entry,
        private readonly Element $element,
        private string $value,
    ) {
    }

    public static function create(Entry $entry, Element $element, string $value): self
    {
        return new self(
            id: new ElementEntryId(null),
            entry: $entry,
            element: $element,
            value: $value,
        );
    }

    public function updateValue(string $value): void
    {
        $this->value = $value;
    }

    public function getId(): ElementEntryId
    {
        return $this->id;
    }

    public function getEntry(): Entry
    {
        return $this->entry;
    }

    public function getElement(): Element
    {
        return $this->element;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
