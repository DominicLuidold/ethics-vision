<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('App\\', '../src/App/*')
        ->exclude([
            // Do not autowire the actual messages and responses
            '../src/App/**/Application/*/Query/*Query.php',
            '../src/App/**/Application/*/Command/*Command.php',
            '../src/App/**/Application/*/Event/*Event.php',
            '../src/App/**/Application/*/Response/*',
        ]);

    $services->load('Framework\\', '../src/Framework/*');
};
