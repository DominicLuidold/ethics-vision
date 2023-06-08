<?php

declare(strict_types=1);

namespace App\Form\Domain\Model\Form;

enum ElementType: string
{
    case CHECKBOX = 'CHECKBOX';
    case RADIO = 'RADIO';

    case DROPDOWN = 'DROPDOWN';

    case TEXT_SHORT = 'TEXT_SHORT';
    case TEXT_LONG = 'TEXT_LONG';
}
