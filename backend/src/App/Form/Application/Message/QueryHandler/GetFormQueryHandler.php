<?php

declare(strict_types=1);

namespace App\Form\Application\Message\QueryHandler;

use App\Form\Application\Dto\Response\FormDto;
use App\Form\Application\Message\Query\GetFormQuery;
use App\Form\Domain\Repository\FormRepositoryInterface;
use Framework\Application\Messenger\QueryHandlerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class GetFormQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private FormRepositoryInterface $formRepository,
    ) {
    }

    public function __invoke(GetFormQuery $query): FormDto
    {
        $form = $this->formRepository->findOneById($query->id);
        if (null === $form) {
            throw new NotFoundHttpException(sprintf('Form with `id=%d` not found!', $query->id->getValue()));
        }

        return FormDto::fromForm($form);
    }
}
