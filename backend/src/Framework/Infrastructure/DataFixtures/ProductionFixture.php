<?php

declare(strict_types=1);

namespace Framework\Infrastructure\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

/**
 * Intended as a base class for all production fixtures.
 */
abstract class ProductionFixture extends Fixture implements FixtureGroupInterface
{
    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return [
            'production',
            static::class,
        ];
    }
}
