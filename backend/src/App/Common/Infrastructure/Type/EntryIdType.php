<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Type;

use App\Common\Domain\Id\EntryId;
use Framework\Infrastructure\Types\EntityIntegerIdType;

final class EntryIdType extends EntityIntegerIdType
{
    public const NAME = 'entry_id';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getTypeClass(): string
    {
        return EntryId::class;
    }
}
