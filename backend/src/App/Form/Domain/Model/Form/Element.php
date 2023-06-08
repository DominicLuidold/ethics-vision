<?php

declare(strict_types=1);

namespace App\Form\Domain\Model\Form;

use App\Common\Domain\Id\ElementId;
use Fusonic\DDDExtensions\Domain\Model\EntityInterface;

class Element implements EntityInterface
{
    private function __construct(
        private ElementId $id,
        private readonly Section $section,
        private readonly ElementType $type,
        private string $title,
        private ?string $description,
        private int $position,
        private ?string $placeholder = null,
    ) {
    }

    public static function create(
        Section $section,
        ElementType $type,
        string $title,
        ?string $description,
        int $position,
        string $placeholder = null
    ): self {
        return new self(
            id: new ElementId(null),
            section: $section,
            type: $type,
            title: $title,
            description: $description,
            position: $position,
            placeholder: $placeholder,
        );
    }

    public function getId(): ElementId
    {
        return $this->id;
    }

    public function getSection(): Section
    {
        return $this->section;
    }

    public function getType(): ElementType
    {
        return $this->type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function getPlaceholder(): ?string
    {
        return $this->placeholder;
    }
}
