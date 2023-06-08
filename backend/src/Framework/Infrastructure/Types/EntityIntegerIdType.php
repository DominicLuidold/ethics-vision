<?php

declare(strict_types=1);

namespace Framework\Infrastructure\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use Fusonic\DDDExtensions\Domain\Model\EntityIntegerId;

abstract class EntityIntegerIdType extends Type
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getIntegerTypeDeclarationSQL($column);
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): int
    {
        if (!($value instanceof EntityIntegerId)) {
            throw new \InvalidArgumentException(sprintf('Value must be an instance of %s', EntityIntegerId::class));
        }

        return $value->getValue();
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): EntityIntegerId
    {
        $typeClass = $this->getTypeClass();

        if (null === $value) {
            /** @var EntityIntegerId $object */
            $object = new $typeClass($value);

            return $object;
        }

        if (!\is_int($value)) {
            /* @phpstan-ignore-next-line */
            throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', 'int']);
        }

        /** @var EntityIntegerId $object */
        $object = new $typeClass($value);

        return $object;
    }

    /**
     * @return class-string
     */
    abstract protected function getTypeClass(): string;
}
