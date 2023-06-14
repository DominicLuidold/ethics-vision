import {CommonModule} from "@angular/common";
import {NgModule} from "@angular/core";
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {RouterModule} from "@angular/router";
import {ApplicationAssistantComponent} from "./components/application-assistant/application-assistant.component";
import {EntryTableComponent} from "./components/entry-table/entry-table.component";
import {ModalComponent} from "./components/modal/modal.component";
import {MaterialModule} from "./material.module";

@NgModule({
    imports: [
        CommonModule,
        FormsModule,
        MaterialModule,
        ReactiveFormsModule,
        RouterModule,
    ],
    declarations: [
        ApplicationAssistantComponent,
        EntryTableComponent,
        ModalComponent,
    ],
    exports: [
        ApplicationAssistantComponent,
        EntryTableComponent,
        ModalComponent,

        MaterialModule,
        ReactiveFormsModule,
    ]
})
export class SharedModule {
}
