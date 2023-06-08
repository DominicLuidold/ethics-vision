<?php

declare(strict_types=1);

namespace App\Form\Application\Message\QueryHandler;

use App\Form\Application\Dto\Response\EntryDto;
use App\Form\Application\Message\Query\GetFormEntriesQuery;
use App\Form\Domain\Repository\EntryRepositoryInterface;
use App\Form\Domain\Repository\FormRepositoryInterface;
use Framework\Application\Messenger\QueryHandlerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class GetFormEntriesQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private FormRepositoryInterface $formRepository,
        private EntryRepositoryInterface $entryRepository,
    ) {
    }

    public function __invoke(GetFormEntriesQuery $query): EntryDto
    {
        $form = $this->formRepository->findOneById($query->id);
        if (null === $form) {
            throw new NotFoundHttpException();
        }

        $entry = $this->entryRepository->findOneById($query->entryId);
        if (null === $entry) {
            throw new NotFoundHttpException();
        }

        return EntryDto::fromEntry($entry);
    }
}
