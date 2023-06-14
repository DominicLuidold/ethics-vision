<?php

declare(strict_types=1);

namespace App\Form\Infrastructure\Types;

use App\Form\Domain\Model\MetaInformation\SectionMetaInformationValueObject;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Fusonic\DDDExtensions\Doctrine\Types\ValueObjectType;
use Fusonic\DDDExtensions\Domain\Model\ValueObject;

/**
 * @extends ValueObjectType<SectionMetaInformationValueObject>
 */
final class SectionMetaInformationValueObjectType extends ValueObjectType
{
    public const NAME = 'section_meta_information_vo';

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
        return self::serialize($value, static fn (SectionMetaInformationValueObject $object) => self::fromObject($object));
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function toObject(array $data): SectionMetaInformationValueObject
    {
        return new SectionMetaInformationValueObject(
            category: MetaCategoryValueObjectType::toObject($data['category']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public static function fromObject(SectionMetaInformationValueObject $object): array
    {
        return [
            'category' => MetaCategoryValueObjectType::fromObject($object->category),
        ];
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        // Add comment to prevent doctrine from always detecting changes that need to be applied to the schema.
        return true;
    }
}
