<?php

declare(strict_types=1);

namespace Framework\Infrastructure\DataFixtures;

trait ReferenceTrait
{
    public static function getReferenceName(string|int $objectReference): string
    {
        return implode('_', [self::class, $objectReference]);
    }
}
