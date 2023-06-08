<?php

declare(strict_types=1);

namespace App\Form\Domain\Model\Entry;

enum EntryStatus: string
{
    case WORK_IN_PROGRESS = 'WORK_IN_PROGRESS';
    case SUBMITTED = 'SUBMITTED';
}
