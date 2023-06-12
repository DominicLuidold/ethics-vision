<?php

declare(strict_types=1);

namespace App\Form\Port\Http;

use App\Form\Application\Dto\Response\EntryDto;
use App\Form\Application\Dto\Response\FormDto;
use App\Form\Application\Dto\Response\MinimalEntryDto;
use App\Form\Application\Message\Command\CreateEntryCommand;
use App\Form\Application\Message\Command\SubmitFormEntryCommand;
use App\Form\Application\Message\Command\UpdateEntryCommand;
use App\Form\Application\Message\Query\GetAllFormEntriesQuery;
use App\Form\Application\Message\Query\GetFormEntriesQuery;
use App\Form\Application\Message\Query\GetFormQuery;
use App\Form\Application\Message\Response\GetAllFormEntriesResponse;
use Framework\Port\Http\ControllerResponseTrait;
use Fusonic\ApiDocumentationBundle\Attribute\DocumentedRoute;
use Fusonic\HttpKernelExtensions\Attribute\FromRequest;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route(path: '/forms')]
#[OA\Tag(name: 'Form')]
final class FormController extends AbstractController
{
    use ControllerResponseTrait;

    public function __construct(
        private readonly MessageBusInterface $queryBus,
        private readonly MessageBusInterface $commandBus,
        SerializerInterface $serializer
    ) {
        $this->serializer = $serializer;
    }

    #[DocumentedRoute(
        path: '/{id}',
        requirements: ['id' => '\d+'],
        methods: ['GET'],
        input: \stdClass::class,
        output: FormDto::class,
        description: 'Get `Form`'
    )]
    public function getAction(#[FromRequest] GetFormQuery $query): Response
    {
        $envelope = $this->queryBus->dispatch($query);

        return $this->createJsonResponseFromEnvelope($envelope);
    }

    #[DocumentedRoute(
        path: '/{id}/entries',
        requirements: ['id' => '\d+'],
        methods: ['GET'],
        output: GetAllFormEntriesResponse::class,
        description: 'Get all `Entry`s for a `Form`'
    )]
    public function getEntriesAction(#[FromRequest] GetAllFormEntriesQuery $query): Response
    {
        $envelope = $this->queryBus->dispatch($query);

        return $this->createJsonResponseFromEnvelope($envelope);
    }

    #[DocumentedRoute(
        path: '/{id}/entries/{entryId}',
        requirements: ['id' => '\d+', 'entryId' => '\d+'],
        methods: ['GET'],
        input: \stdClass::class,
        output: EntryDto::class,
        description: 'Get an `Entry` for a `Form`'
    )]
    public function getEntryAction(#[FromRequest] GetFormEntriesQuery $query): Response
    {
        $envelope = $this->queryBus->dispatch($query);

        return $this->createJsonResponseFromEnvelope($envelope);
    }

    #[DocumentedRoute(
        path: '/{id}/entries/create',
        requirements: ['id' => '\d+'],
        methods: ['POST'],
        input: \stdClass::class,
        output: MinimalEntryDto::class,
        statusCode: Response::HTTP_CREATED,
        description: 'Create an `Entry` for a `Form`'
    )]
    public function createEntryAction(#[FromRequest] CreateEntryCommand $command): Response
    {
        $envelope = $this->commandBus->dispatch($command);

        return $this->createJsonResponseFromEnvelope($envelope, Response::HTTP_CREATED);
    }

    #[DocumentedRoute(
        path: '/{id}/entries/{entryId}/update',
        requirements: ['id' => '\d+', 'entryId' => '\d+'],
        methods: ['POST'],
        output: EntryDto::class,
        description: 'Update an `Entry` for a `Form`'
    )]
    public function updateEntryAction(#[FromRequest] UpdateEntryCommand $command): Response
    {
        $envelope = $this->commandBus->dispatch($command);

        return $this->createJsonResponseFromEnvelope($envelope);
    }

    #[DocumentedRoute(
        path: '/{id}/entries/{entryId}/submit',
        requirements: ['id' => '\d+', 'entryId' => '\d+'],
        methods: ['POST'],
        input: \stdClass::class,
        statusCode: Response::HTTP_NO_CONTENT,
        description: 'Submit an `Entry` for a `Form`'
    )]
    public function submitEntryAction(#[FromRequest] SubmitFormEntryCommand $command): Response
    {
        $this->commandBus->dispatch($command);

        return new JsonResponse(status: Response::HTTP_NO_CONTENT);
    }
}
