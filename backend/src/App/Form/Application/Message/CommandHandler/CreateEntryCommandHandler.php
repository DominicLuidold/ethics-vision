<?php

declare(strict_types=1);

namespace App\Form\Application\Message\CommandHandler;

use App\Form\Application\Dto\Response\MinimalEntryDto;
use App\Form\Application\Message\Command\CreateEntryCommand;
use App\Form\Domain\Model\Entry\Entry;
use App\Form\Domain\Repository\EntryRepositoryInterface;
use App\Form\Domain\Repository\FormRepositoryInterface;
use Framework\Application\Messenger\CommandHandlerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class CreateEntryCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private FormRepositoryInterface $formRepository,
        private EntryRepositoryInterface $entryRepository,
    ) {
    }

    public function __invoke(CreateEntryCommand $command): MinimalEntryDto
    {
        $form = $this->formRepository->findOneById($command->id);
        if (null === $form) {
            throw new NotFoundHttpException();
        }

        $entry = Entry::create($form);
        $this->entryRepository->saveEntity($entry);

        return MinimalEntryDto::fromEntry($entry);
    }
}
