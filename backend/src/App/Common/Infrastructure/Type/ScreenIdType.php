<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Type;

use App\Common\Domain\Id\ScreenId;
use Framework\Infrastructure\Types\EntityIntegerIdType;

final class ScreenIdType extends EntityIntegerIdType
{
    public const NAME = 'screen_id';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getTypeClass(): string
    {
        return ScreenId::class;
    }
}
