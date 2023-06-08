<?php

declare(strict_types=1);

namespace App\Form\Application\Message\QueryHandler;

use App\Form\Application\Message\Query\GetAllFormEntriesQuery;
use App\Form\Application\Message\Response\GetAllFormEntriesResponse;
use App\Form\Domain\Model\Entry\EntryStatus;
use App\Form\Domain\Repository\EntryRepositoryInterface;
use App\Form\Domain\Repository\FormRepositoryInterface;
use Framework\Application\Messenger\QueryHandlerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class GetAllFormEntriesQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private FormRepositoryInterface $formRepository,
        private EntryRepositoryInterface $entryRepository,
    ) {
    }

    public function __invoke(GetAllFormEntriesQuery $query): GetAllFormEntriesResponse
    {
        $form = $this->formRepository->findOneById($query->id);
        if (null === $form) {
            throw new NotFoundHttpException();
        }

        $entries = $this->entryRepository->findAllByFormAndStatus($form->getId(), EntryStatus::WORK_IN_PROGRESS);

        return new GetAllFormEntriesResponse($entries, \count($entries), 1, 10);
    }
}
