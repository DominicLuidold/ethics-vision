<?php

declare(strict_types=1);

namespace App\Form\Application\Message\QueryHandler;

use App\Form\Application\Dto\Response\EntryDto;
use App\Form\Application\Message\Query\GetFormEntriesQuery;
use App\Form\Domain\Repository\EntryRepositoryInterface;
use Framework\Application\Messenger\QueryHandlerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class GetFormEntriesQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private EntryRepositoryInterface $entryRepository,
    ) {
    }

    public function __invoke(GetFormEntriesQuery $query): EntryDto
    {
        $entry = $this->entryRepository->findOneByFormAndId($query->id, $query->entryId);
        if (null === $entry) {
            throw new NotFoundHttpException();
        }

        return EntryDto::fromEntry($entry);
    }
}
