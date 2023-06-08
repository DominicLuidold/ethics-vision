<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Type;

use App\Common\Domain\Id\ElementId;
use Framework\Infrastructure\Types\EntityIntegerIdType;

final class ElementIdType extends EntityIntegerIdType
{
    public const NAME = 'element_id';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getTypeClass(): string
    {
        return ElementId::class;
    }
}
