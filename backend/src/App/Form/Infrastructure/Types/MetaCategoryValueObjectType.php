<?php

declare(strict_types=1);

namespace App\Form\Infrastructure\Types;

use App\Form\Domain\Model\MetaInformation\MetaCategoryValueObject;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Fusonic\DDDExtensions\Doctrine\Types\ValueObjectType;
use Fusonic\DDDExtensions\Domain\Model\ValueObject;

/**
 * @extends ValueObjectType<MetaCategoryValueObject>
 */
final class MetaCategoryValueObjectType extends ValueObjectType
{
    public const NAME = 'meta_category_vo';

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
        return self::serialize($value, static fn (MetaCategoryValueObject $object) => self::fromObject($object));
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function toObject(array $data): MetaCategoryValueObject
    {
        return new MetaCategoryValueObject(
            name: $data['name'],
            value: $data['value'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public static function fromObject(MetaCategoryValueObject $object): array
    {
        return [
            'name' => $object->name,
            'value' => $object->value,
        ];
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        // Add comment to prevent doctrine from always detecting changes that need to be applied to the schema.
        return true;
    }
}
