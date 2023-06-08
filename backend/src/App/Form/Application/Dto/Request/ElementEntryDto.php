<?php

declare(strict_types=1);

namespace App\Form\Application\Dto\Request;

use App\Common\Domain\Id\ElementEntryId;
use App\Common\Domain\Id\ElementId;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class ElementEntryDto
{
    public function __construct(
        #[Assert\NotNull]
        public ElementId $elementId,

        #[Assert\NotBlank(allowNull: true)]
        public ?string $value,

        public ?ElementEntryId $id = null,
    ) {
    }
}
