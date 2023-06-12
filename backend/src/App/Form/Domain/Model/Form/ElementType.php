<?php

declare(strict_types=1);

namespace App\Form\Domain\Model\Form;

enum ElementType: string
{
    case TEXT_SHORT = 'TEXT_SHORT';
    case TEXT_LONG = 'TEXT_LONG';
}
