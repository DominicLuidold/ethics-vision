<?php

declare(strict_types=1);

namespace App\Form\Application\Message\CommandHandler;

use App\Form\Application\Message\Command\SubmitFormEntryCommand;
use App\Form\Domain\Repository\EntryRepositoryInterface;
use Framework\Application\Messenger\CommandHandlerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class SubmitFormEntryCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private EntryRepositoryInterface $entryRepository,
    ) {
    }

    public function __invoke(SubmitFormEntryCommand $command): void
    {
        $entry = $this->entryRepository->findOneByFormAndId($command->id, $command->entryId);
        if (null === $entry) {
            throw new NotFoundHttpException();
        }

        $entry->submit();
    }
}
