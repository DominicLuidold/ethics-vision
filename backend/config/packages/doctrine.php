<?php

declare(strict_types=1);

use App\Common\Infrastructure\Type\ElementEntryIdType;
use App\Common\Infrastructure\Type\ElementIdType;
use App\Common\Infrastructure\Type\EntryIdType;
use App\Common\Infrastructure\Type\FormIdType;
use App\Common\Infrastructure\Type\ScreenIdType;
use App\Common\Infrastructure\Type\SectionIdType;
use Symfony\Config\DoctrineConfig;

return static function (DoctrineConfig $doctrine): void {
    $doctrine->dbal([
        'connections' => [
            'default' => [
                'url' => '%env(resolve:DATABASE_URL)%',
                'charset' => 'utf-8',
                'driver' => 'pro_pqsl',
            ],
        ],
        'types' => [
            ElementEntryIdType::NAME => ['class' => ElementEntryIdType::class],
            ElementIdType::NAME => ['class' => ElementIdType::class],
            EntryIdType::NAME => ['class' => EntryIdType::class],
            FormIdType::NAME => ['class' => FormIdType::class],
            ScreenIdType::NAME => ['class' => ScreenIdType::class],
            SectionIdType::NAME => ['class' => SectionIdType::class],
        ],
    ]);

    $doctrine->orm()
        ->autoGenerateProxyClasses(true)
        ->enableLazyGhostObjects(true)
        ->defaultEntityManager('default');

    $em = $doctrine->orm()->entityManager('default')
        ->reportFieldsWhereDeclared(true)
        ->validateXmlMapping(true)
        ->autoMapping(true)
        ->namingStrategy('doctrine.orm.naming_strategy.underscore_number_aware');

    foreach (
        [
            'Form',
        ] as $entity
    ) {
        $em->mapping($entity)
            ->isBundle(false)
            ->type('xml')
            ->dir('%kernel.project_dir%/src/App/'.$entity.'/Infrastructure/Resources/config')
            ->prefix('App\\'.$entity.'\Domain\Model')
            ->alias($entity);
    }

    $em->resultCacheDriver()->type(null);
    $em->metadataCacheDriver()->type('pool')->pool('cache.system');
    $em->queryCacheDriver()->type('pool')->pool('cache.system');
};
