<?php

declare(strict_types=1);

namespace App\Form\Application\Message\Command;

use App\Common\Domain\Id\FormId;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class CreateEntryCommand
{
    public function __construct(
        #[Assert\NotNull]
        public FormId $id
    ) {
    }
}
