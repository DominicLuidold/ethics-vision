import {Component, OnInit} from '@angular/core';
import {Entry} from '@app/shared/models/entry';
import {PaginatedResponse} from '@app/shared/models/paginated-response';
import {FormService} from '@app/shared/services/form.service';

@Component({
    selector: 'app-dashboard',
    templateUrl: './dashboard.component.html',
    styleUrls: ['./dashboard.component.scss'],
})
export class DashboardComponent implements OnInit {
    wipData!: PaginatedResponse<Entry>;
    submittedData!: PaginatedResponse<Entry>;

    constructor(private readonly formService: FormService) {
    }

    ngOnInit(): void {
        this.formService.getAllEntriesForFormWithStatus(1, 'WORK_IN_PROGRESS').subscribe((response: PaginatedResponse<Entry>) => {
            this.wipData = response;
        });

        this.formService.getAllEntriesForFormWithStatus(1, 'SUBMITTED').subscribe((response: PaginatedResponse<Entry>) => {
            this.submittedData = response;
        });
    }
}
