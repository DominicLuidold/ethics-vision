<?php

declare(strict_types=1);

namespace App\Form\Application\Message\Response;

use App\Form\Application\Dto\Response\MinimalEntryDto;
use App\Form\Domain\Model\Entry\Entry;
use Framework\Application\Response\CollectionResponse;

/**
 * @extends CollectionResponse<MinimalEntryDto>
 */
final readonly class GetAllFormEntriesResponse extends CollectionResponse
{
    /**
     * @param Entry[] $entries
     */
    public function __construct(array $entries, int $total, int $page, int $limit)
    {
        $dtos = [];
        foreach ($entries as $entry) {
            $dtos[] = MinimalEntryDto::fromEntry($entry);
        }

        parent::__construct($dtos, $total, $page, $limit);
    }

    /**
     * @return MinimalEntryDto[]
     */
    public function getItems(): array
    {
        return parent::getItems();
    }
}
