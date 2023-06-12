import { ElementEntry } from "./element-entry";

export interface Entry {
    id?: number;
    status: 'WORK_IN_PROGRESS' | 'SUBMITTED';
    elementEntries?: ElementEntry[];
    createdAt: Date;
    updatedAt: Date;
}
