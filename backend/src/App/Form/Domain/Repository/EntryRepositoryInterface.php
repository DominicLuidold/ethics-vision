<?php

declare(strict_types=1);

namespace App\Form\Domain\Repository;

use App\Common\Domain\Id\EntryId;
use App\Common\Domain\Id\FormId;
use App\Form\Domain\Model\Entry\Entry;
use App\Form\Domain\Model\Entry\EntryStatus;

interface EntryRepositoryInterface
{
    public function findOneById(EntryId $id): ?Entry;

    /**
     * @return Entry[]
     */
    public function findAll(): array;

    /**
     * @return Entry[]
     */
    public function findAllByFormAndStatus(FormId $formId, EntryStatus $status): array;

    public function saveEntity(Entry $entry): void;
}
