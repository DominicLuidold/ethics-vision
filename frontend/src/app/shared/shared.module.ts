import { CommonModule } from "@angular/common";
import { NgModule } from "@angular/core";
import { FormsModule, ReactiveFormsModule } from "@angular/forms";
import { RouterModule } from "@angular/router";
import { EntryTableComponent } from "./components/entry-table/entry-table.component";
import { MaterialModule } from "./material.module";

@NgModule({
    imports: [
        CommonModule,
        MaterialModule,
        FormsModule,
        ReactiveFormsModule,
        RouterModule,
    ],
    declarations: [
        EntryTableComponent,
    ],
    exports: [
        EntryTableComponent,
        MaterialModule,
        ReactiveFormsModule,
    ]
})
export class SharedModule { }
