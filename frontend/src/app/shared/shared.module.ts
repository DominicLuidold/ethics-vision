import { CommonModule } from "@angular/common";
import { NgModule } from "@angular/core";
import { EntryTableComponent } from "./components/entry-table/entry-table.component";
import { MaterialModule } from "./material.module";

@NgModule({
    imports: [
        CommonModule,
        MaterialModule,
    ],
    declarations: [
        EntryTableComponent,
    ],
    exports: [
        EntryTableComponent,
        MaterialModule,
    ]
})
export class SharedModule { }
