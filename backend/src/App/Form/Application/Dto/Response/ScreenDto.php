<?php

declare(strict_types=1);

namespace App\Form\Application\Dto\Response;

use App\Common\Domain\Id\ScreenId;
use App\Form\Domain\Model\Form\Screen;

final readonly class ScreenDto
{
    private function __construct(
        public ScreenId $id,
        public string $title,
        public string $content,
    ) {
    }

    public static function fromScreen(Screen $screen): self
    {
        return new self(
            id: $screen->getId(),
            title: $screen->getTitle(),
            content: $screen->getContent()
        );
    }
}
