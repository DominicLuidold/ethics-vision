<?php

declare(strict_types=1);

namespace Framework\Application\Messenger;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'command.bus')]
interface CommandHandlerInterface
{
}
