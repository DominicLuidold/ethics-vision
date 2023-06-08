<?php

declare(strict_types=1);

namespace App\Form\Application\Dto\Response;

use App\Common\Domain\Id\ElementEntryId;
use App\Common\Domain\Id\ElementId;
use App\Form\Domain\Model\Entry\ElementEntry;

final readonly class ElementEntryDto
{
    public function __construct(
        public ElementEntryId $id,
        public ElementId $elementId,
        public string $value,
    ) {
    }

    public static function fromElementEntry(ElementEntry $entry): self
    {
        return new self(
            id: $entry->getId(),
            elementId: $entry->getElement()->getId(),
            value: $entry->getValue(),
        );
    }
}
