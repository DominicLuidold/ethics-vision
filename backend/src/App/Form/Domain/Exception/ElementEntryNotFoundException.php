<?php

declare(strict_types=1);

namespace App\Form\Domain\Exception;

use App\Common\Domain\Id\ElementId;
use App\Common\Domain\Id\EntryId;
use Fusonic\DDDExtensions\Domain\Exception\DomainExceptionInterface;

final class ElementEntryNotFoundException extends \RuntimeException implements DomainExceptionInterface
{
    public function __construct(ElementId $elementId, EntryId $entryId)
    {
        parent::__construct(
            sprintf(
                'Cannot find ElementEntry containing Element with `id=%d` for Entry with `id=%d`',
                $elementId,
                $entryId
            )
        );
    }
}
