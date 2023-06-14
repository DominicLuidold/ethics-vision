<?php

declare(strict_types=1);

namespace App\Form\Domain\Model\MetaInformation;

use Fusonic\DDDExtensions\Domain\Model\ValueObject;

final class EntryMetaInformationValueObject extends ValueObject
{
    /**
     * @param MetaCategoryValueObject[] $selectedCategories
     */
    public function __construct(
        public readonly array $selectedCategories = [],
    ) {
    }

    public function equals(ValueObject $object): bool
    {
        return $object instanceof self;
    }
}
