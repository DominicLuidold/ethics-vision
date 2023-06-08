<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Type;

use App\Common\Domain\Id\SectionId;
use Framework\Infrastructure\Types\EntityIntegerIdType;

final class SectionIdType extends EntityIntegerIdType
{
    public const NAME = 'section_id';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getTypeClass(): string
    {
        return SectionId::class;
    }
}
