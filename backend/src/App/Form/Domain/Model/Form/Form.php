<?php

declare(strict_types=1);

namespace App\Form\Domain\Model\Form;

use App\Common\Domain\Id\ElementId;
use App\Common\Domain\Id\FormId;
use App\Form\Domain\Exception\SectionNotRelatedToFormException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Fusonic\DDDExtensions\Domain\Model\AggregateRoot;

class Form extends AggregateRoot
{
    private Screen $welcomeScreen;
    private Screen $submitScreen;

    /**
     * @var Collection<array-key, Section>
     */
    private Collection $sections;

    private function __construct(
        private FormId $id,
        private string $title,
        private ?string $description,
    ) {
        $this->sections = new ArrayCollection();
    }

    public static function create(
        string $title,
        ?string $description,
        string $welcomeScreenTitle,
        string $welcomeScreenContent,
        string $submitScreenTitle,
        string $submitScreenContent,
    ): self {
        $form = new self(
            id: new FormId(null),
            title: $title,
            description: $description
        );

        $form->welcomeScreen = Screen::create(
            title: $welcomeScreenTitle,
            content: $welcomeScreenContent
        );

        $form->submitScreen = Screen::create(
            title: $submitScreenTitle,
            content: $submitScreenContent,
        );

        return $form;
    }

    public function addSection(string $title, string $description, int $position): Section
    {
        $section = Section::create(
            form: $this,
            title: $title,
            description: $description,
            position: $position
        );
        $this->sections->add($section);

        return $section;
    }

    public function addElementToSection(
        Section $section,
        ElementType $type,
        string $title,
        ?string $description,
        int $position,
        string $placeholder = null
    ): Element {
        if (!$this->sections->contains($section)) {
            throw new SectionNotRelatedToFormException($section->getId(), $this->id);
        }

        $element = Element::create(
            section: $section,
            type: $type,
            title: $title,
            description: $description,
            position: $position,
            placeholder: $placeholder
        );

        $section->getElementCollection()->add($element);

        return $element;
    }

    public function hasElement(Element $element): bool
    {
        foreach ($this->sections as $section) {
            if ($section->hasElement($element)) {
                return true;
            }
        }

        return false;
    }

    public function getElement(ElementId $elementId): Element
    {
        foreach ($this->sections as $section) {
            foreach ($section->getElements() as $element) {
                if ($element->getId()->equals($elementId)) {
                    return $element;
                }
            }
        }

        throw new \LogicException(); // TODO - Custom exception
    }

    public function getId(): FormId
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getWelcomeScreen(): Screen
    {
        return $this->welcomeScreen;
    }

    public function getSubmitScreen(): Screen
    {
        return $this->submitScreen;
    }

    /**
     * @return Section[]
     */
    public function getSections(): array
    {
        return $this->sections->getValues();
    }
}
