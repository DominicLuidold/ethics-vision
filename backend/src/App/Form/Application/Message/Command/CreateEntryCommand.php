<?php

declare(strict_types=1);

namespace App\Form\Application\Message\Command;

use App\Common\Domain\Id\FormId;
use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class CreateEntryCommand
{
    public function __construct(
        #[OA\Property(readOnly: true)]
        #[Assert\NotNull]
        public FormId $id
    ) {
    }
}
