<?php

declare(strict_types=1);

namespace App\Form\Infrastructure\DataFixtures\Production;

use App\Form\Domain\Model\Form\ElementType;
use App\Form\Domain\Model\Form\Form;
use Doctrine\Persistence\ObjectManager;
use Framework\Infrastructure\DataFixtures\ProductionFixture;
use Framework\Infrastructure\DataFixtures\ReferenceTrait;

/**
 * @phpstan-type FormFixtureData array{
 *     title: string,
 *     description: string,
 *     welcomeScreen: array{
 *         title: string,
 *         content: string,
 *     },
 *     submitScreen: array{
 *         title: string,
 *         content: string,
 *     },
 *     sections: array<array{
 *         title: string,
 *         description: string,
 *         position: int,
 *         elements: array<array{
 *             elementType: ElementType,
 *             title: string,
 *             description: ?string,
 *             position: int,
 *             placeholder: ?string
 *         }>
 *     }>
 * }
 */
final class FormFixtures extends ProductionFixture
{
    use ReferenceTrait;

    public const FORM_1_ETHICS_APPLICATION = 'FORM_1_ETHICS_APPLICATION';

    /**
     * @return array<string, FormFixtureData>
     */
    private static function getFormData(): array
    {
        return [
            self::FORM_1_ETHICS_APPLICATION => [
                'title' => 'Antrag auf Beurteilung eines Forschungs- oder Entwicklungsvorhabens und Stellungnahme durch die Forschungsethik-Kommission der Fachhochschule Vorarlberg',
                'description' => 'Ethikantrag für die Einreichung bei der Forschungsethik-Kommission der Fachhochschule Vorarlberg',
                'welcomeScreen' => [
                    'title' => '',
                    'content' => '',
                ],
                'submitScreen' => [
                    'title' => 'Ethikantrag erfolgreich eingereicht!',
                    'content' => '',
                ],
                'sections' => [
                    [
                        'title' => 'Forschungs- oder Entwicklungsvorhaben',
                        'description' => '',
                        'position' => 1,
                        'elements' => [
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Bezeichnung',
                                'description' => null,
                                'position' => 1,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Laufzeit',
                                'description' => 'von - bis',
                                'position' => 2,
                                'placeholder' => null,
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::getFormData() as $reference => $formData) {
            $form = $this->createForm($formData);

            $manager->persist($form);
            $this->addReference(self::getReferenceName($reference), $form);
        }

        $manager->flush();
    }

    /**
     * @param FormFixtureData $formData
     */
    private function createForm(array $formData): Form
    {
        $form = Form::create(
            title: $formData['title'],
            description: $formData['description'],
            welcomeScreenTitle: $formData['welcomeScreen']['title'],
            welcomeScreenContent: $formData['welcomeScreen']['content'],
            submitScreenTitle: $formData['submitScreen']['title'],
            submitScreenContent: $formData['submitScreen']['content'],
        );

        foreach ($formData['sections'] as $sectionData) {
            $section = $form->addSection(
                title: $sectionData['title'],
                description: $sectionData['description'],
                position: $sectionData['position'],
            );

            foreach ($sectionData['elements'] as $elementData) {
                $form->addElementToSection(
                    section: $section,
                    type: $elementData['elementType'],
                    title: $elementData['title'],
                    description: $elementData['description'],
                    position: $elementData['position'],
                    placeholder: $elementData['placeholder']
                );
            }
        }

        return $form;
    }
}
