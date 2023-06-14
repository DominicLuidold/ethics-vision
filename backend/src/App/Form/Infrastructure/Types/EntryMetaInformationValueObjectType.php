<?php

declare(strict_types=1);

namespace App\Form\Infrastructure\Types;

use App\Form\Domain\Model\MetaInformation\EntryMetaInformationValueObject;
use App\Form\Domain\Model\MetaInformation\MetaCategoryValueObject;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Fusonic\DDDExtensions\Doctrine\Types\ValueObjectType;
use Fusonic\DDDExtensions\Domain\Model\ValueObject;

/**
 * @extends ValueObjectType<EntryMetaInformationValueObject>
 */
final class EntryMetaInformationValueObjectType extends ValueObjectType
{
    public const NAME = 'entry_meta_information_vo';

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?ValueObject
    {
        return self::deserialize($value, static fn (array $data) => self::toObject($data));
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        return self::serialize($value, static fn (EntryMetaInformationValueObject $object) => self::fromObject($object));
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function toObject(array $data): EntryMetaInformationValueObject
    {
        return new EntryMetaInformationValueObject(
            selectedCategories: array_map(
                callback: static fn (array $category) => MetaCategoryValueObjectType::toObject($category),
                array: $data['selectedCategories'],
            ),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public static function fromObject(EntryMetaInformationValueObject $object): array
    {
        return [
            'selectedCategories' => array_map(
                callback: static fn (MetaCategoryValueObject $category) => MetaCategoryValueObjectType::fromObject($category),
                array: $object->selectedCategories,
            ),
        ];
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        // Add comment to prevent doctrine from always detecting changes that need to be applied to the schema.
        return true;
    }
}
