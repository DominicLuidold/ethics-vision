import {HttpClient} from '@angular/common/http';
import {Injectable} from '@angular/core';
import {environment} from '@environments/environment';
import {Observable} from 'rxjs';
import {Entry} from '../models/entry';
import {Form} from '../models/form';
import {PaginatedResponse} from '../models/paginated-response';
import {EntryMetaInformation} from '../models/entry-meta-information';

@Injectable({
    providedIn: 'root'
})
export class FormService {
    constructor(private readonly http: HttpClient) {
    }

    getForm(formId: number): Observable<Form> {
        return this.http.get<Form>(`${environment.apiUrl}/forms/${formId}`);
    }

    getFormEntry(formId: number, entryId: number): Observable<Entry> {
        return this.http.get<Entry>(`${environment.apiUrl}/forms/${formId}/entries/${entryId}`);
    }

    createFormEntry(formId: number, metaInformation: EntryMetaInformation): Observable<Entry> {
        return this.http.post<Entry>(`${environment.apiUrl}/forms/${formId}/entries/create`, {metaInformation: metaInformation});
    }

    updateFormEntry(formId: number, entryId: number, entry: Entry): Observable<Entry> {
        entry.id = undefined;
        return this.http.post<Entry>(`${environment.apiUrl}/forms/${formId}/entries/${entryId}/update`, entry);
    }

    submitFormEntry(formId: number, entryId: number): Observable<any> {
        return this.http.post(`${environment.apiUrl}/forms/${formId}/entries/${entryId}/submit`, {});
    }

    getAllEntriesForFormWithStatus(formId: number, status: 'WORK_IN_PROGRESS' | 'SUBMITTED'): Observable<PaginatedResponse<Entry>> {
        return this.http.get<PaginatedResponse<Entry>>(`${environment.apiUrl}/forms/${formId}/entries?status=${status}`);
    }
}
