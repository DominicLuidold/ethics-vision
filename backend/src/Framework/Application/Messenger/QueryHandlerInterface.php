<?php

declare(strict_types=1);

namespace Framework\Application\Messenger;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'query.bus')]
interface QueryHandlerInterface
{
}
