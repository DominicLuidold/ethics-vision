<?php

declare(strict_types=1);

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routes): void {
    $routes->import(resource: '../src/App/*/Port/Http/**', type: 'attribute')
        ->namePrefix('api_')
        ->prefix('/api/v1');
};
