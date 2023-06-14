import {Component, OnInit} from '@angular/core';
import {MatDialog} from '@angular/material/dialog';
import {ActivatedRoute, Router} from '@angular/router';
import {
    ApplicationAssistantResult
} from '@app/shared/components/application-assistant/application-assistant-result.model';
import {
    ApplicationAssistantComponent
} from '@app/shared/components/application-assistant/application-assistant.component';
import {Entry} from '@app/shared/models/entry';
import {EntryMetaInformation} from '@app/shared/models/entry-meta-information';
import {Form} from '@app/shared/models/form';
import {FormService} from '@app/shared/services/form.service';

@Component({
    selector: 'app-form',
    templateUrl: './new-form.component.html',
    styleUrls: ['./new-form.component.scss']
})
export class NewFormComponent implements OnInit {

    constructor(
        private readonly route: ActivatedRoute,
        private readonly router: Router,
        private readonly formService: FormService,
        private readonly dialog: MatDialog,
    ) {
    }

    ngOnInit() {
        const {formId} = this.route.snapshot.params;

        this.formService.getForm(formId)
            .subscribe((form: Form) => this.initializeForm(form));
    }

    private initializeForm(form: Form): void {
        const {title, content} = form.welcomeScreen;

        const dialogRef = this.dialog.open(ApplicationAssistantComponent, {
            data: {title, content},
            disableClose: true
        });

        dialogRef.afterClosed()
            .subscribe((result: ApplicationAssistantResult) => this.processDialogResult(form, result));
    }

    private processDialogResult(form: Form, result: ApplicationAssistantResult): void {
        const metaInformation: EntryMetaInformation = {
            selectedCategories: [
                {name: 'universal'},
                {name: 'funding', value: result.funding}
            ]
        };

        if (result.humans) {
            metaInformation.selectedCategories.push({name: 'humans'});
        }

        if (result.prototype) {
            metaInformation.selectedCategories.push({name: 'prototype'});
        }

        this.formService.createFormEntry(form.id, metaInformation)
            .subscribe((entry: Entry) => this.navigateToEntry(form, entry));
    }

    private navigateToEntry(form: Form, entry: Entry): void {
        this.router.navigate(['forms', form.id, 'edit', entry.id]);
    }
}
