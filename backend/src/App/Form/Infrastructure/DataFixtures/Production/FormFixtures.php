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
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Antragssteller:in',
                                'description' => 'Verantwortliche Person des Vorhabens',
                                'position' => 3,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'E-Mail',
                                'description' => null,
                                'position' => 4,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Telefon',
                                'description' => null,
                                'position' => 5,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Organisationseinheit',
                                'description' => null,
                                'position' => 6,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Einfordernde Stelle',
                                'description' => 'Stelle, die ein Ehtikvotum für das Vorhaben einfordert',
                                'position' => 7,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Bestehende Voten',
                                'description' => 'Ergebnis bereits gestellter Ethikanträge ähnlichen Inhalts',
                                'position' => 8,
                                'placeholder' => null,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Rahmenbedingungen',
                        'description' => '',
                        'position' => 2,
                        'elements' => [],
                    ],
                    [
                        'title' => 'Zielsetzung des Forschungs- oder Entwicklungsvorhabens',
                        'description' => '',
                        'position' => 3,
                        'elements' => [
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Relevanter Stand der Forschung',
                                'description' => null,
                                'position' => 1,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Zielsetzung des Vorhabens',
                                'description' => null,
                                'position' => 2,
                                'placeholder' => null,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Wissenschaftliche Studie an oder Mit Menschen',
                        'description' => '',
                        'position' => 4,
                        'elements' => [
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wie ist das Forschungsdesign geplant?',
                                'description' => 'Maßnahmen, Hypothesen sowie Datenerhebungsverfahren genauer beleuchten',
                                'position' => 1,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Welche Personen sollen untersucht werden?',
                                'description' => 'Einschluss- und Ausschlusskriterien genauer beleuchten',
                                'position' => 2,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wie erfolgt die Vergütung von teilnehmenden Personen?',
                                'description' => 'Zum Beispiel Schenkung',
                                'position' => 3,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Welche Anzahl an Teilnehmenden ist geplant?',
                                'description' => null,
                                'position' => 4,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Welche Welche Fall- und Gruppenvergleiche sind geplant?',
                                'description' => null,
                                'position' => 5,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wie wird mit Personen umgegangen, welche die Studienteilnahme beendet haben?',
                                'description' => null,
                                'position' => 6,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Was ist der voraussichtliche Vorteil oder der mögliche Nutzen für die Teilnehmenden?',
                                'description' => null,
                                'position' => 7,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Ist die Teilnahme mit Belastungen oder Risiken verbunden, die potenziell auftreten könnten?',
                                'description' => null,
                                'position' => 8,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wie werden unerwünschte Effekte festgestellt und dokumentiert?',
                                'description' => 'Zum Beispiel ein Beinahe-Schaden',
                                'position' => 9,
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
