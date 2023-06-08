<?php

declare(strict_types=1);

namespace App\Form\Domain\Model\Form;

use App\Common\Domain\Id\ScreenId;
use Fusonic\DDDExtensions\Domain\Model\EntityInterface;

class Screen implements EntityInterface
{
    private function __construct(
        private ScreenId $id,
        private string $title,
        private string $content,
    ) {
    }

    public static function create(string $title, string $content): self
    {
        return new self(
            id: new ScreenId(null),
            title: $title,
            content: $content,
        );
    }

    public function getId(): ScreenId
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
