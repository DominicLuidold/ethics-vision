<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Framework\Application\Messenger\CommandHandlerInterface;
use Framework\Application\Messenger\EventHandlerInterface;
use Framework\Application\Messenger\QueryHandlerInterface;
use Fusonic\DDDExtensions\Doctrine\EventSubscriber\DomainEventSubscriber;
use Fusonic\DDDExtensions\ModelDescriber\EntityIdDescriber;
use Fusonic\DDDExtensions\Normalizer\EntityIdNormalizer;
use Fusonic\HttpKernelExtensions\Controller\RequestDtoResolver;
use Fusonic\HttpKernelExtensions\Normalizer\ConstraintViolationExceptionNormalizer;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->instanceof(CommandHandlerInterface::class)
        ->tag('messenger.message_handler', ['bus' => 'command.bus']);

    $services->instanceof(QueryHandlerInterface::class)
        ->tag('messenger.message_handler', ['bus' => 'query.bus']);

    $services->instanceof(EventHandlerInterface::class)
        ->tag('messenger.message_handler', ['bus' => 'event.bus']);

    $services->load('App\\', '../src/App/*')
        ->exclude([
            '../src/App/Common/Domain/Id/*',
            '../src/App/Common/Infrastructure/Types/*',

            '../src/App/**/Domain/Model/*',
            '../src/App/**/Domain/Exception/*',
            '../src/App/**/Domain/Event/*',

            // Do not autowire the actual messages and responses
            '../src/App/**/Application/*/Query/*Query.php',
            '../src/App/**/Application/*/Command/*Command.php',
            '../src/App/**/Application/*/Event/*Event.php',
            '../src/App/**/Application/*/Response/*',
        ]);

    $services->load('Framework\\', '../src/Framework/*');

    $services->set(RequestDtoResolver::class)
        ->tag('controller.argument_value_resolver', [
            'priority' => 50,
        ]);

    $services->set(ConstraintViolationExceptionNormalizer::class)
        ->arg('$normalizer', service('serializer.normalizer.constraint_violation_list'));

    $services->set(DomainEventSubscriber::class)
        ->arg('$bus', service('event.bus'))
        ->tag('doctrine.event_subscriber');

    $services->set(EntityIdDescriber::class)
        ->tag('nelmio_api_doc.model_describer');

    $services->set(EntityIdNormalizer::class)
        ->tag('serializer.normalizer');
};
