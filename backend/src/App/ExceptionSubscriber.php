<?php

declare(strict_types=1);

namespace App;

use Doctrine\ORM\EntityNotFoundException;
use Fusonic\DDDExtensions\Domain\Exception\DomainExceptionInterface;
use Fusonic\HttpKernelExtensions\Exception\ConstraintViolationException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final readonly class ExceptionSubscriber implements EventSubscriberInterface
{
    private bool $showTrace;

    public function __construct(
        private NormalizerInterface $normalizer,
        #[Autowire('%kernel.debug%')]
        bool $showTrace,
    ) {
        $this->showTrace = $showTrace;
    }

    /**
     * @return array<string, string>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $throwable = $event->getThrowable();

        if ($throwable instanceof HandlerFailedException) {
            $previous = $throwable->getPrevious();

            if (null !== $previous) {
                $throwable = $previous;

                $event->setThrowable($throwable);
            }
        }

        $response = $this->mapExceptions($throwable);

        if (null !== $response) {
            $event->setResponse($response);
        }
    }

    private function mapExceptions(\Throwable $throwable): ?Response
    {
        if ($throwable instanceof ConstraintViolationException) {
            return new JsonResponse($this->normalizer->normalize($throwable), 400);
        }

        if ($throwable instanceof DomainExceptionInterface) {
            return new JsonResponse($this->formatDomainExceptionResponse($throwable), 400);
        }

        if ($throwable instanceof EntityNotFoundException) {
            return new JsonResponse($this->formatResponse($throwable), 404);
        }

        if ($throwable instanceof HttpExceptionInterface) {
            return new JsonResponse($this->formatHttpException($throwable), $throwable->getStatusCode());
        }

        return null;
    }

    /**
     * @return array<string, mixed>
     */
    private function formatHttpException(HttpExceptionInterface $exception): array
    {
        $data = $this->formatResponse($exception);

        $data['code'] = 0 === $exception->getCode() ? $exception->getStatusCode() : $exception->getCode();

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    private function formatResponse(\Throwable $exception): array
    {
        $data = [
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
        ];

        if ($this->showTrace) {
            $data['trace'] = $exception->getTrace();
        }

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    private function formatDomainExceptionResponse(DomainExceptionInterface $exception): array
    {
        $data = $this->formatResponse($exception);

        if (0 === $exception->getCode()) {
            unset($data['code']);
        }

        $data['title'] = self::getExceptionName($exception);

        return $data;
    }

    private static function getExceptionName(\Throwable $throwable): string
    {
        /** @var string $basename */
        $basename = strrchr($throwable::class, '\\');

        return substr($basename, 1);
    }
}
