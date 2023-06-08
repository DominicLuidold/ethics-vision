<?php

declare(strict_types=1);

namespace App\Form\Application\Dto\Response;

use App\Common\Domain\Id\ElementId;
use App\Form\Domain\Model\Form\Element;
use App\Form\Domain\Model\Form\ElementType;

final readonly class ElementDto
{
    private function __construct(
        public ElementId $id,
        public ElementType $type,
        public string $title,
        public ?string $description,
        public int $position,
        public ?string $placeholder
    ) {
    }

    public static function fromElement(Element $element): self
    {
        return new self(
            id: $element->getId(),
            type: $element->getType(),
            title: $element->getTitle(),
            description: $element->getDescription(),
            position: $element->getPosition(),
            placeholder: $element->getPlaceholder()
        );
    }
}
