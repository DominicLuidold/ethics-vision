<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Type;

use App\Common\Domain\Id\ElementEntryId;
use Framework\Infrastructure\Types\EntityIntegerIdType;

final class ElementEntryIdType extends EntityIntegerIdType
{
    public const NAME = 'element_entry_id';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getTypeClass(): string
    {
        return ElementEntryId::class;
    }
}
