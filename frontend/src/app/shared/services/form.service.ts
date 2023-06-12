import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from '@environments/environment';
import { Observable } from 'rxjs';
import { Entry } from '../models/entry';
import { PaginatedResponse } from '../models/paginated-response';

@Injectable({
  providedIn: 'root'
})
export class FormService {
  constructor(private readonly httpClient: HttpClient) { }

  getAllEntriesForFormWithStatus(formId: number, status: 'WORK_IN_PROGRESS' | 'SUBMITTED'): Observable<PaginatedResponse<Entry>> {
    return this.httpClient.get<PaginatedResponse<Entry>>(`${environment.apiUrl}/forms/${formId}/entries?status=${status}`);
  }
}
