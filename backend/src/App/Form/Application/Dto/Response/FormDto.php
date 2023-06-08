<?php

declare(strict_types=1);

namespace App\Form\Application\Dto\Response;

use App\Common\Domain\Id\FormId;
use App\Form\Domain\Model\Form\Form;
use App\Form\Domain\Model\Form\Section;

final readonly class FormDto
{
    /**
     * @param SectionDto[] $sections
     */
    private function __construct(
        public FormId $id,
        public string $title,
        public ?string $description,
        public ScreenDto $welcomeScreen,
        public ScreenDto $submitScreen,
        public array $sections,
    ) {
    }

    public static function fromForm(Form $form): self
    {
        return new self(
            id: $form->getId(),
            title: $form->getTitle(),
            description: $form->getDescription(),
            welcomeScreen: ScreenDto::fromScreen($form->getWelcomeScreen()),
            submitScreen: ScreenDto::fromScreen($form->getSubmitScreen()),
            sections: array_map(
                callback: static fn (Section $section) => SectionDto::fromSection($section),
                array: $form->getSections()
            )
        );
    }
}
