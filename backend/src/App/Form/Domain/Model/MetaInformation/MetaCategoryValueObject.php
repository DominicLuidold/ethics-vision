<?php

declare(strict_types=1);

namespace App\Form\Domain\Model\MetaInformation;

use Fusonic\DDDExtensions\Domain\Model\ValueObject;

final class MetaCategoryValueObject extends ValueObject
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $value = null,
    ) {
    }

    public function equals(ValueObject $object): bool
    {
        return $object instanceof self
            && $this->name === $object->name
            && $this->value === $object->value;
    }
}
