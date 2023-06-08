<?php

declare(strict_types=1);

namespace App\Form\Domain\Exception;

use App\Common\Domain\Id\FormId;
use App\Common\Domain\Id\SectionId;
use Fusonic\DDDExtensions\Domain\Exception\DomainExceptionInterface;

final class SectionNotRelatedToFormException extends \RuntimeException implements DomainExceptionInterface
{
    public function __construct(SectionId $sectionId, FormId $formId)
    {
        parent::__construct(
            sprintf(
                'Section with `id=%d` does not belong to Form with `id=%d`',
                $sectionId,
                $formId
            )
        );
    }
}
