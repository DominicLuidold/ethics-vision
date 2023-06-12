import { ElementEntry } from "./element-entry";
import { PaginatedResponse } from "./paginated-response";

export interface Entry {
    id: number;
    status: 'WORK_IN_PROGRESS' | 'SUBMITTED';
    elementEntries: PaginatedResponse<ElementEntry>
}
