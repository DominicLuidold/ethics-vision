import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { MatSnackBar } from '@angular/material/snack-bar';
import { ActivatedRoute, Router } from '@angular/router';
import { Element } from '@app/shared/models/element';
import { ElementEntry } from '@app/shared/models/element-entry';
import { Entry } from '@app/shared/models/entry';
import { Form } from '@app/shared/models/form';
import { Section } from '@app/shared/models/section';
import { FormService } from '@app/shared/services/form.service';

@Component({
  selector: 'app-edit-form',
  templateUrl: './form.component.html',
  styleUrls: ['./form.component.scss']
})
export class FormComponent implements OnInit {
  private formId!: number;
  private entryId!: number;

  formData!: Form;
  entryData!: Entry;
  mode!: 'EDIT' | 'READ_ONLY';

  form: FormGroup = new FormGroup({});
  steps: Step[] = [];

  constructor(
    private readonly route: ActivatedRoute,
    private readonly router: Router,
    private readonly formService: FormService,
    private readonly snackBar: MatSnackBar
  ) {
  }

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      this.formId = +params['formId'];
      this.entryId = +params['entryId'];
      this.mode = params['mode'] === 'edit' ? 'EDIT' : 'READ_ONLY';

      this.formService.getFormEntry(this.formId, this.entryId).subscribe((entry: Entry) => {
        this.entryData = entry;

        this.formService.getForm(this.formId).subscribe((form: Form) => {
          this.formData = form;
          this.createSections();
        }, error => this.dataErrorSnackBar(error));
      }, error => this.dataErrorSnackBar(error));
    });
  }

  createSections(): void {
    this.steps = this.formData.sections.map((section: Section) => {
      return {
        id: section.id,
        title: section.title,
        description: section.description,
        position: section.position,
        formGroup: this.createElements(section.elements)
      };
    });

    this.steps = this.steps.filter((step) => {
      return step.formGroup && step.formGroup.controls && Object.keys(step.formGroup.controls).length > 0;
    });

    this.steps.sort((a: Step, b: Step) => a.position - b.position);

    this.steps.forEach((step, index) => {
      this.form.addControl(`step${index}`, step.formGroup)
    });
  }

  createElements(elements: Element[]): FormGroup {
    const formGroup = new FormGroup({});

    elements.sort((a: Element, b: Element) => a.position - b.position);

    elements.forEach((element: Element) => {
      formGroup.addControl(
        `${element.id}_${element.title}`,
        new FormControl(this.getElementEntryByElementId(element.id)?.value)
      )
    });

    return formGroup;
  }

  getElementEntryByElementId(elementId: number | string): ElementEntry | null {
    const elementEntries = this.entryData.elementEntries ?? [];
    const element = elementEntries.find((elementEntry: ElementEntry) => elementEntry.elementId == elementId);

    if (undefined === element) {
      return null;
    }

    return element;
  }

  getElementDetailsByTitle(propertyName: keyof Element, title: string): string {
    let element: Element | undefined;

    title = title.replace(/^\d+\_/, "");

    for (const section of this.formData.sections) {
      if (element = section.elements.find((element: Element) => element.title === title)) {
        break;
      }
    }

    if (!element) {
      throw new Error('Element not found!');
    }

    return String(element[propertyName]);
  }

  onInputBlur(controlName: string, formGroup: FormGroup) {
    const value = formGroup.get(controlName)?.value;

    const elementId = this.getElementDetailsByTitle('id', controlName);
    const elementEntry = this.getElementEntryByElementId(elementId);

    if (!elementEntry) {
      if (!this.entryData.elementEntries) {
        this.entryData.elementEntries = [];
      }

      if (null === value) {
        return;
      }

      this.entryData.elementEntries.push({
        id: null,
        elementId: parseInt(elementId),
        value: value,
      });
    } else {
      elementEntry.value = value !== '' ? value : null;
    }

    this.formService.updateFormEntry(this.formId, this.entryId, this.entryData).subscribe({
      next: (entry: Entry) => this.entryData = entry,
      error: (error: string) => this.dataErrorSnackBar(error),
    });
  }

  submit(): void {
    this.form.markAllAsTouched();

    if (this.form.invalid) {
      this.submitError();
      return;
    }

    this.formService.submitFormEntry(this.formId, this.entryId).subscribe(() => {
      this.submitSuccess();
      this.router.navigate(['/dashboard']);
    }, error => this.dataErrorSnackBar(error));
  }

  dataErrorSnackBar(message: string, action: string = 'Schließen'): void {
    this.snackBar.open(`Fehler beim Laden/Übertagen der Daten: ${message}`, action, {
      horizontalPosition: 'left',
      duration: 3000,
    });
  }

  submitSuccess(action: string = 'Schließen'): void {
    this.snackBar.open('Antrag erfolgreich eingereicht', action, {
      horizontalPosition: 'left',
      duration: 3000,
    });
  }

  submitError(action: string = 'Schließen'): void {
    this.snackBar.open('Antrag kann nicht abgesendet werden - nicht alle Felder sind ausgefüllt!', action, {
      horizontalPosition: 'left',
      duration: 3000,
    });
  }
}

export interface Step {
  id: number;
  title: string;
  description: string;
  position: number;
  formGroup: FormGroup;
}
