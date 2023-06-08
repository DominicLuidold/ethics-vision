<?php

declare(strict_types=1);

namespace App\Form\Application\Message\Command;

use App\Common\Domain\Id\EntryId;
use App\Common\Domain\Id\FormId;
use App\Form\Application\Dto\Request\ElementEntryDto;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class UpdateEntryCommand
{
    /**
     * @param ElementEntryDto[] $elementEntries
     */
    public function __construct(
        #[Assert\NotNull]
        public FormId $id,

        #[Assert\NotNull]
        public EntryId $entryId,

        #[Assert\Valid]
        public array $elementEntries = [],
    ) {
    }
}
