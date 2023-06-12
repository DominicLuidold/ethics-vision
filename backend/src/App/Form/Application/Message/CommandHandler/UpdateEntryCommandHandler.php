<?php

declare(strict_types=1);

namespace App\Form\Application\Message\CommandHandler;

use App\Form\Application\Dto\Response\EntryDto;
use App\Form\Application\Message\Command\UpdateEntryCommand;
use App\Form\Domain\Repository\EntryRepositoryInterface;
use App\Form\Domain\Repository\FormRepositoryInterface;
use Framework\Application\Messenger\CommandHandlerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class UpdateEntryCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private FormRepositoryInterface $formRepository,
        private EntryRepositoryInterface $entryRepository,
    ) {
    }

    public function __invoke(UpdateEntryCommand $command): EntryDto
    {
        $form = $this->formRepository->findOneById($command->id);
        if (null === $form) {
            throw new NotFoundHttpException();
        }

        $entry = $this->entryRepository->findOneByFormAndId($form->getId(), $command->entryId);
        if (null === $entry) {
            throw new NotFoundHttpException();
        }

        foreach ($command->elementEntries as $updatedElementEntry) {
            if (null !== $updatedElementEntry->id) {
                $existingElementEntry = $entry->getElementEntry($updatedElementEntry->id);

                if (null === $updatedElementEntry->value) {
                    $entry->removeElementEntry($existingElementEntry->getElement()->getId());
                } else {
                    $entry->updateElementEntryValue($updatedElementEntry->elementId, $updatedElementEntry->value);
                }
            } else {
                if (null === $updatedElementEntry->value) {
                    continue;
                }

                $element = $form->getElement($updatedElementEntry->elementId);
                $entry->addElementEntry($element, $updatedElementEntry->value);
            }
        }

        $this->entryRepository->saveEntity($entry);

        return EntryDto::fromEntry($entry);
    }
}
