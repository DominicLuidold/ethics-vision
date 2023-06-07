<?php

declare(strict_types=1);

use Symfony\Config\DoctrineConfig;

return static function (DoctrineConfig $doctrine): void {
    $doctrine->orm()
        ->autoGenerateProxyClasses(false)
        ->proxyDir('%kernel.build_dir%/doctrine/orm/Proxies');

    $doctrine->orm()->entityManager('default')
        ->metadataCacheDriver()->type('pool')->pool('doctrine.system_cache_pool')
        ->queryCacheDriver()->type('pool')->pool('doctrine.system_cache_pool')
        ->resultCacheDriver()->type('pool')->pool('doctrine.result_cache_pool');
};
