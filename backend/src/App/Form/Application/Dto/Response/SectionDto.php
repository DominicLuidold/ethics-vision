<?php

declare(strict_types=1);

namespace App\Form\Application\Dto\Response;

use App\Common\Domain\Id\SectionId;
use App\Form\Domain\Model\Form\Element;
use App\Form\Domain\Model\Form\Section;
use App\Form\Domain\Model\MetaInformation\SectionMetaInformationValueObject;

final readonly class SectionDto
{
    /**
     * @param ElementDto[] $elements
     */
    private function __construct(
        public SectionId $id,
        public string $title,
        public ?string $description,
        public int $position,
        public array $elements,
        public SectionMetaInformationValueObject $metaInformation,
    ) {
    }

    public static function fromSection(Section $section): self
    {
        return new self(
            id: $section->getId(),
            title: $section->getTitle(),
            description: $section->getDescription(),
            position: $section->getPosition(),
            elements: array_map(
                callback: static fn (Element $element) => ElementDto::fromElement($element),
                array: $section->getElements()
            ),
            metaInformation: $section->getMetaInformation(),
        );
    }
}
