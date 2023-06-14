import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {MatDialog} from '@angular/material/dialog';
import {MatSnackBar} from '@angular/material/snack-bar';
import {ActivatedRoute} from '@angular/router';
import {ModalComponent} from '@app/shared/components/modal/modal.component';
import {Element} from '@app/shared/models/element';
import {ElementEntry} from '@app/shared/models/element-entry';
import {Entry} from '@app/shared/models/entry';
import {Form} from '@app/shared/models/form';
import {MetaCategory} from '@app/shared/models/meta-category';
import {Section} from '@app/shared/models/section';
import {FormService} from '@app/shared/services/form.service';
import {map, Observable, switchMap} from 'rxjs';

@Component({
    selector: 'app-edit-form',
    templateUrl: './form.component.html',
    styleUrls: ['./form.component.scss']
})
export class FormComponent implements OnInit {
    private readonly formId: number;
    private readonly entryId: number;
    private readonly shouldOpenWelcomeScreen: boolean;

    formData!: Form;
    entryData!: Entry;
    mode!: 'EDIT' | 'READ_ONLY';

    form: FormGroup = new FormGroup({});
    steps: Step[] = [];

    constructor(
        private readonly route: ActivatedRoute,
        private readonly formService: FormService,
        private readonly snackBar: MatSnackBar,
        private readonly modal: MatDialog
    ) {
        const {formId, entryId, mode} = this.route.snapshot.params;
        this.formId = Number(formId);
        this.entryId = Number(entryId);
        this.mode = mode === 'edit' ? 'EDIT' : 'READ_ONLY';
        this.shouldOpenWelcomeScreen = Boolean(this.route.snapshot.queryParams['openWelcomeScreen']);
    }

    ngOnInit(): void {
        this.fetchData().subscribe(([entry, form]: [Entry, Form]) => {
            this.entryData = entry;
            this.formData = form;
            this.createSections();
        });
    }

    private fetchData(): Observable<[Entry, Form]> {
        return this.formService.getFormEntry(this.formId, this.entryId).pipe(
            switchMap((entry: Entry) => this.formService.getForm(this.formId).pipe(
                map((form) => [entry, form] as [Entry, Form])
            ))
        );
    }

    private createSections(): void {
        this.steps = this.formData.sections
            .filter((section: Section) => {
                return this.entryData.metaInformation.selectedCategories.some((category: MetaCategory) => {
                    const sectionCategoryName = section.metaInformation.category.name;
                    const sectionCategoryValue = section.metaInformation.category.value;

                    return (
                        sectionCategoryName === 'universal' ||
                        (sectionCategoryName === category.name && sectionCategoryValue === (category.value ?? null))
                    );
                });
            })
            .map((section: Section) => ({
                id: section.id,
                title: section.title,
                description: section.description,
                position: section.position,
                formGroup: this.createElements(section.elements)
            }));

        this.steps.sort((a: Step, b: Step) => a.position - b.position);

        this.steps.forEach((step, index) => {
            this.form.addControl(`step${index}`, step.formGroup);
        });
    }

    private createElements(elements: Element[]): FormGroup {
        const formGroup = new FormGroup({}, Validators.required);

        elements.sort((a: Element, b: Element) => a.position - b.position);

        elements.forEach((element: Element) => {
            formGroup.addControl(
                String(element.id),
                new FormControl(this.getElementEntryByElementId(element.id)?.value, Validators.required)
            );
        });

        return formGroup;
    }

    getElementEntryByElementId(elementId: number | string): ElementEntry | null {
        const elementEntries = this.entryData.elementEntries ?? [];
        const element = elementEntries.find((elementEntry: ElementEntry) => elementEntry.elementId == elementId);

        if (element === undefined) {
            return null;
        }

        return element;
    }

    getElementDetailsById(propertyName: keyof Element, id: string): string {
        let element: Element | undefined;

        for (const section of this.formData.sections) {
            if ((element = section.elements.find((element: Element) => String(element.id) === id))) {
                break;
            }
        }

        if (!element) {
            throw new Error('Element not found!');
        }

        return String(element[propertyName]);
    }

    onInputBlur(controlName: string, formGroup: FormGroup): void {
        const value = formGroup.get(controlName)?.value;

        const elementId = parseInt(controlName);
        const elementEntry = this.getElementEntryByElementId(elementId);

        if (!elementEntry) {
            if (!this.entryData.elementEntries) {
                this.entryData.elementEntries = [];
            }

            if (value === null) {
                return;
            }

            this.entryData.elementEntries.push({
                id: null,
                elementId: elementId,
                value: value
            });
        } else {
            elementEntry.value = value !== '' ? value : null;
        }

        this.formService.updateFormEntry(this.formId, this.entryId, this.entryData).subscribe({
            next: (entry: Entry) => (this.entryData = entry)
        });
    }

    submit(): void {
        this.form.markAllAsTouched();

        if (this.form.invalid) {
            this.submitError();
            return;
        }

        this.formService.submitFormEntry(this.formId, this.entryId).subscribe(() => {
            this.modal.open(ModalComponent, {
                data: {
                    title: this.formData.submitScreen.title,
                    content: this.formData.submitScreen.content,
                },
                disableClose: true,
            })
        });
    }

    private submitError(): void {
        this.showSnackBar('Antrag kann nicht abgesendet werden - nicht alle Felder sind ausgefüllt!');
    }

    private showSnackBar(message: string, action: string = 'Schließen'): void {
        this.snackBar.open(message, action, {
            horizontalPosition: 'left',
            duration: 3000
        });
    }
}

export interface Step {
    id: number;
    title: string;
    description?: string;
    position: number;
    formGroup: FormGroup;
}
