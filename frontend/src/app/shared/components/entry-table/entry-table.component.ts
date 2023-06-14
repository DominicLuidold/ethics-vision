import {Component, Input, OnChanges, OnInit, SimpleChanges, ViewChild} from "@angular/core";
import {MatTableDataSource} from "@angular/material/table";
import {Entry} from "@app/shared/models/entry";
import {EntryTableMode} from "./entry-table-mode.model";
import {MatPaginator} from "@angular/material/paginator";
import {PaginatedResponse} from "@app/shared/models/paginated-response";

@Component({
    selector: 'ev-entry-table',
    templateUrl: './entry-table.component.html',
    styleUrls: ['./entry-table.component.scss'],
})
export class EntryTableComponent implements OnInit, OnChanges {
    @Input({required: true})
    public mode!: EntryTableMode;

    @Input({required: true})
    public data!: PaginatedResponse<Entry>;

    dataSource: MatTableDataSource<Entry> = new MatTableDataSource<Entry>();
    displayedColumns: string[] = [];

    @ViewChild(MatPaginator) paginator!: MatPaginator;

    ngOnInit(): void {
        if (this.mode === 'WORK_IN_PROGRESS') {
            this.displayedColumns = ['id', 'createdAt', 'updatedAt', 'editButton']
        } else {
            this.displayedColumns = ['id', 'status', 'createdAt', 'submittedAt', 'viewButton',]
        }
    }

    ngOnChanges(changes: SimpleChanges) {
        if (changes["data"] && this.data) {
            this.dataSource = new MatTableDataSource<Entry>(this.data._embedded);
            this.dataSource.paginator = this.paginator;
        }
    }
}
