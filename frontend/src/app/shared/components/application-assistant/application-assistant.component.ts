import {Component, Inject, OnInit} from '@angular/core';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';
import {MAT_DIALOG_DATA, MatDialogRef} from '@angular/material/dialog';
import {ApplicationAssistantInput} from './application-assistant-input.model';

@Component({
    selector: 'app-application-assistant',
    templateUrl: './application-assistant.component.html',
    styleUrls: ['./application-assistant.component.scss']
})
export class ApplicationAssistantComponent implements OnInit {
    title!: string;
    content!: string;

    assistMode = false;
    rethinkMode = false;
    assistForm: FormGroup;

    constructor(
        @Inject(MAT_DIALOG_DATA)
        private readonly data: ApplicationAssistantInput,
        private readonly formBuilder: FormBuilder,
        private readonly dialogRef: MatDialogRef<ApplicationAssistantComponent>,
    ) {
        this.assistForm = this.formBuilder.group({
            funding: ['', Validators.required],
            humans: ['', Validators.required],
            prototype: ['', Validators.required],
        });
    }

    ngOnInit(): void {
        this.title = this.data.title;
        this.content = this.data.content;
    }

    toggleAssistMode(): void {
        this.assistMode = !this.assistMode;
    }

    submit(): void {
        if (this.assistForm.get('humans')!.value === false && this.assistForm.get('prototype')!.value === false) {
            this.rethinkMode = true;

            return;
        }

        this.dialogRef.close(this.assistForm.value);
    }
}
