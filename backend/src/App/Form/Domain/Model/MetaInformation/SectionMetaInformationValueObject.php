<?php

declare(strict_types=1);

namespace App\Form\Domain\Model\MetaInformation;

use Fusonic\DDDExtensions\Domain\Model\ValueObject;

final class SectionMetaInformationValueObject extends ValueObject
{
    public function __construct(
        public readonly MetaCategoryValueObject $category,
    ) {
    }

    public function equals(ValueObject $object): bool
    {
        return $object instanceof self
            && $this->category === $object->category;
    }
}
