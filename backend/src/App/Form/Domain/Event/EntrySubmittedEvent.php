<?php

declare(strict_types=1);

namespace App\Form\Domain\Event;

use App\Common\Domain\Id\EntryId;
use Fusonic\DDDExtensions\Domain\Event\DomainEventInterface;

final readonly class EntrySubmittedEvent implements DomainEventInterface
{
    public function __construct(
        public EntryId $entryId,
    ) {
    }
}
