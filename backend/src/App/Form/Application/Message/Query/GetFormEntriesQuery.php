<?php

declare(strict_types=1);

namespace App\Form\Application\Message\Query;

use App\Common\Domain\Id\EntryId;
use App\Common\Domain\Id\FormId;
use Symfony\Component\Validator\Constraints as Assert;

final class GetFormEntriesQuery
{
    public function __construct(
        #[Assert\NotNull]
        public FormId $id,

        #[Assert\NotNull]
        public EntryId $entryId,
    ) {
    }
}
