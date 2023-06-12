<?php

declare(strict_types=1);

namespace App\Form\Application\Dto\Response;

use App\Common\Domain\Id\EntryId;
use App\Form\Domain\Model\Entry\ElementEntry;
use App\Form\Domain\Model\Entry\Entry;
use App\Form\Domain\Model\Entry\EntryStatus;

final readonly class EntryDto
{
    /**
     * @param ElementEntryDto[] $elementEntries
     */
    private function __construct(
        public EntryId $id,
        public EntryStatus $status,
        public array $elementEntries,
        public \DateTimeInterface $createdAt,
        public \DateTimeInterface $updatedAt,
    ) {
    }

    public static function fromEntry(Entry $entry): self
    {
        return new self(
            id: $entry->getId(),
            status: $entry->getStatus(),
            elementEntries: array_map(
                callback: static fn (ElementEntry $entry) => ElementEntryDto::fromElementEntry($entry),
                array: $entry->getElementEntries()
            ),
            createdAt: $entry->getCreatedAt(),
            updatedAt: $entry->getUpdatedAt()
        );
    }
}
