<?php

declare(strict_types=1);

namespace App\Form\Domain\Exception;

use App\Common\Domain\Id\ElementId;
use App\Common\Domain\Id\FormId;
use Fusonic\DDDExtensions\Domain\Exception\DomainExceptionInterface;

final class ElementNotRelatedToFormException extends \RuntimeException implements DomainExceptionInterface
{
    public function __construct(ElementId $elementId, FormId $formId)
    {
        parent::__construct(sprintf('Element with `id=%d` does not belong to Form with `id=%d`', $elementId, $formId));
    }
}
