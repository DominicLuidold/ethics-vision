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
                                'title' => 'Name Antragssteller:in',
                                'description' => 'Verantwortliche Person des Vorhabens; mit Titel',
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
                                'title' => 'Fachbereich',
                                'description' => null,
                                'position' => 7,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Stelle, die ein Ethikvotum für das Vorhaben einfordert',
                                'description' => null,
                                'position' => 8,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Ergebnis bereits gestellter Ethikanträge ähnlichen Inhalts',
                                'description' => null,
                                'position' => 9,
                                'placeholder' => null,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Rahmenbedingungen im Falle einer Forschungs- und Entwicklungs-Kooperation',
                        'description' => 'Der/Die Antragsteller:in nimmt zur Kenntnis, dass die Forschungsethik-Kommission das Forschungsvorhaben im Wesentlichen in ethischer Hinsicht prüft und andere rechtliche Belange, wie z.B. Datenschutz oder Urheberrecht nur insoweit thematisiert, als dies für die ethische Bewertung erforderlich ist. Der/Die Antragsteller:in verpflichtet sich, bei der Durchführung des Forschungsvorhabens die erforderlichen personenbezogenen Daten unter Beachtung der datenschutzrechtlichen Vorschriften, insbesondere der EU-Datenschutzgrundverordnung (DSGVO) sowie der darauf basierenden Datenschutzgesetze zu verarbeiten sowie die sonstigen, geltenden Rechtsvorschriften einzuhalten.',
                        'position' => 2,
                        'elements' => [
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Beteiligte Organisationseinheit',
                                'description' => null,
                                'position' => 1,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Ansprechperson an der FH Vorarlberg',
                                'description' => null,
                                'position' => 2,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Datum der Kooperationsvereinbarung',
                                'description' => null,
                                'position' => 3,
                                'placeholder' => null,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Rahmenbedingungen im Falle eines drittmittelfinanzierten Forschungs- und Entwicklungsprojektes',
                        'description' => 'Der/Die Antragsteller:in nimmt zur Kenntnis, dass die Forschungsethik-Kommission das Forschungsvorhaben im Wesentlichen in ethischer Hinsicht prüft und andere rechtliche Belange, wie z.B. Datenschutz oder Urheberrecht nur insoweit thematisiert, als dies für die ethische Bewertung erforderlich ist. Der/Die Antragsteller:in verpflichtet sich, bei der Durchführung des Forschungsvorhabens die erforderlichen personenbezogenen Daten unter Beachtung der datenschutzrechtlichen Vorschriften, insbesondere der EU-Datenschutzgrundverordnung (DSGVO) sowie der darauf basierenden Datenschutzgesetze zu verarbeiten sowie die sonstigen, geltenden Rechtsvorschriften einzuhalten.',
                        'position' => 3,
                        'elements' => [
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Drittmittelgeber',
                                'description' => null,
                                'position' => 1,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Drittmittelsumme',
                                'description' => null,
                                'position' => 2,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Drittmittelquote',
                                'description' => null,
                                'position' => 3,
                                'placeholder' => null,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Rahmenbedingungen im Falle eines ausschließlich eigenmittelfinanzierten Forschungs- und Entwicklungsprojektes',
                        'description' => 'Der/Die Antragsteller:in nimmt zur Kenntnis, dass die Forschungsethik-Kommission das Forschungsvorhaben im Wesentlichen in ethischer Hinsicht prüft und andere rechtliche Belange, wie z.B. Datenschutz oder Urheberrecht nur insoweit thematisiert, als dies für die ethische Bewertung erforderlich ist. Der/Die Antragsteller:in verpflichtet sich, bei der Durchführung des Forschungsvorhabens die erforderlichen personenbezogenen Daten unter Beachtung der datenschutzrechtlichen Vorschriften, insbesondere der EU-Datenschutzgrundverordnung (DSGVO) sowie der darauf basierenden Datenschutzgesetze zu verarbeiten sowie die sonstigen, geltenden Rechtsvorschriften einzuhalten.',
                        'position' => 4,
                        'elements' => [
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Eigenmittelsumme',
                                'description' => null,
                                'position' => 1,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Freigabe erfolgt durch',
                                'description' => null,
                                'position' => 2,
                                'placeholder' => null,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Rahmenbedingungen im Falle einer F&E-Arbeit von Studierenden',
                        'description' => 'Der/Die Antragsteller:in nimmt zur Kenntnis, dass die Forschungsethik-Kommission das Forschungsvorhaben im Wesentlichen in ethischer Hinsicht prüft und andere rechtliche Belange, wie z.B. Datenschutz oder Urheberrecht nur insoweit thematisiert, als dies für die ethische Bewertung erforderlich ist. Der/Die Antragsteller:in verpflichtet sich, bei der Durchführung des Forschungsvorhabens die erforderlichen personenbezogenen Daten unter Beachtung der datenschutzrechtlichen Vorschriften, insbesondere der EU-Datenschutzgrundverordnung (DSGVO) sowie der darauf basierenden Datenschutzgesetze zu verarbeiten sowie die sonstigen, geltenden Rechtsvorschriften einzuhalten.',
                        'position' => 5,
                        'elements' => [
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Name Betreuer:in',
                                'description' => null,
                                'position' => 1,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Studiengang',
                                'description' => null,
                                'position' => 2,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_SHORT,
                                'title' => 'Art der Forschungsarbeit',
                                'description' => 'z.B. Masterarbeit, Kontextstudium',
                                'position' => 3,
                                'placeholder' => null,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Zielsetzung des Forschungs- oder Entwicklungsvorhabens',
                        'description' => '',
                        'position' => 6,
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
                        'title' => 'Im Falle von wissenschaftlichen Studien an oder mit Menschen',
                        'description' => '',
                        'position' => 7,
                        'elements' => [
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wie ist das Forschungsdesign geplant?',
                                'description' => 'inkl. Maßnahmen, Hypothesen, Datenerhebungsverfahren',
                                'position' => 1,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Welche Personen sollen untersucht werden?',
                                'description' => 'inkl. Einschluss- und Ausschlusskriterien',
                                'position' => 2,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wie werden Personen rekrutiert?',
                                'description' => 'inkl. Aufklärung von möglichen Belastungen und Risiken',
                                'position' => 3,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wie erfolgt die Vergütung von teilnehmenden Personen?',
                                'description' => 'z.B. Schenkung',
                                'position' => 4,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Welche Anzahl an Teilnehmenden ist geplant?',
                                'description' => null,
                                'position' => 5,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Welche Fall- und Gruppenvergleiche sind geplant?',
                                'description' => null,
                                'position' => 6,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wie gehen Sie mit Personen um, welche die Studienteilnahme beendet haben?',
                                'description' => null,
                                'position' => 7,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Was ist der voraussichtliche Vorteil oder der mögliche Nutzen für die Teilnehmenden?',
                                'description' => null,
                                'position' => 8,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Ist die Teilnahme mit Belastungen oder Risiken verbunden, die potenziell auftreten könnten?',
                                'description' => null,
                                'position' => 9,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wie werden unerwünschte Effekte festgestellt und dokumentiert?',
                                'description' => 'z.B. Beinahe-Schaden',
                                'position' => 10,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Was sind die Kriterien für einen (vorzeitigen) Abbruch der Studie?',
                                'description' => null,
                                'position' => 11,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Sind bezogen auf die Belastungen oder Risiken Vorsichtsmaßnahmen geplant? Welche Vorsichtsmaßnahmen sind geplant? Warum sind keine Vorsichtsmaßnahmen geplant??',
                                'description' => null,
                                'position' => 12,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Ist eine Versicherung erforderlich?',
                                'description' => null,
                                'position' => 13,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wie ist der Plan für die Veröffentlichung der Forschungsergebnisse?',
                                'description' => 'inkl. Umgang mit personenbezogenen Daten',
                                'position' => 14,
                                'placeholder' => null,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Im Falle einer Entwicklung eines Produkts (oder Prototypen)',
                        'description' => '',
                        'position' => 8,
                        'elements' => [
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Beschreiben Sie kurz das Produkt oder den Prototypen, das/der entwickelt werden soll.',
                                'description' => null,
                                'position' => 1,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Was ist das Ziel der Entwicklungsarbeit?',
                                'description' => 'inkl. Technologie Readiness Level',
                                'position' => 2,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Welche Personen zählen zur Zielgruppe des Produkts?',
                                'description' => null,
                                'position' => 3,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wie gelangen die Zielgruppen voraussichtlich an das Produkt?',
                                'description' => null,
                                'position' => 4,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wie hoch sind die Kosten für das Produkt im Falle einer Verwertung?',
                                'description' => 'geschätzt',
                                'position' => 5,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wie groß ist die potentielle Zielgruppe für das Produkt?',
                                'description' => null,
                                'position' => 6,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wie gehen Sie vor, wenn Personen das Produkts nicht mehr nutzen möchten?',
                                'description' => 'Datenlöschung etc',
                                'position' => 7,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Was sind die Vorteile/Nutzen für den Menschen bei der Nutzung des Produkts?',
                                'description' => null,
                                'position' => 8,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Welche potentiellen Risiken für den Menschen entstehen bei der Nutzung des Produkts?',
                                'description' => null,
                                'position' => 9,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wie werden unerwünschte Effekte ausfindig gemacht, aufgezeichnet und berichtet?',
                                'description' => null,
                                'position' => 10,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Sind bezogen auf die Risiken Vorsichtsmaßnahmen geplant?',
                                'description' => null,
                                'position' => 11,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Sind Haftungsfragen erörtert worden?',
                                'description' => 'inkl. Haftungsrisiken',
                                'position' => 12,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Welche Maßnahmen zum Schutz des geistigen Eigentums sind geplant?',
                                'description' => null,
                                'position' => 13,
                                'placeholder' => null,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Zum Datenschutz in Studien oder der Produktanwendung',
                        'description' => '',
                        'position' => 9,
                        'elements' => [
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Welche Personengruppen sind betroffen?',
                                'description' => 'Kinder, Erwachsene, Geschäftsunfähige',
                                'position' => 1,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Welche Datenarten werden erhoben?',
                                'description' => 'wer, wo, womit',
                                'position' => 2,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Welche Maßnahmen werden getroffen, dass diese Daten keiner Person zugeordnet werden können?',
                                'description' => null,
                                'position' => 3,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Begründen Sie gegebenenfalls eine personenbezogene Datenverarbeitung.',
                                'description' => null,
                                'position' => 4,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Gibt es Ton- oder Videoaufzeichnungen von Personen?',
                                'description' => null,
                                'position' => 5,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wer hat Zugang zu den Daten und wie ist dieser Zugang geregelt?',
                                'description' => 'inkl. Weitergabe an Dritte',
                                'position' => 6,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Welche Rechte haben die Betroffenen in Bezug der von/an ihnen erhobenen Daten?',
                                'description' => null,
                                'position' => 7,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wie werden die erhobenen Daten aufbewahrt? Werden sie später vernichtet (zusätzliche Garantien)?',
                                'description' => null,
                                'position' => 8,
                                'placeholder' => null,
                            ],
                            [
                                'elementType' => ElementType::TEXT_LONG,
                                'title' => 'Wie kann die betroffene Person in die beschriebene Verarbeitung der Daten einwilligen?',
                                'description' => null,
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
