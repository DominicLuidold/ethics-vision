<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Type;

use App\Common\Domain\Id\FormId;
use Framework\Infrastructure\Types\EntityIntegerIdType;

final class FormIdType extends EntityIntegerIdType
{
    public const NAME = 'form_id';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getTypeClass(): string
    {
        return FormId::class;
    }
}
