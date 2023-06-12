<?php

declare(strict_types=1);

namespace App\Form\Application\Message\Query;

use App\Common\Domain\Id\FormId;
use App\Form\Domain\Model\Entry\EntryStatus;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class GetAllFormEntriesQuery
{
    public function __construct(
        #[Assert\NotNull]
        public FormId $id,

        public EntryStatus $status = EntryStatus::WORK_IN_PROGRESS,
    ) {
    }
}
