import {ElementEntry} from "./element-entry";
import {EntryMetaInformation} from "./entry-meta-information";

export interface Entry {
    id?: number;
    status: 'WORK_IN_PROGRESS' | 'SUBMITTED';
    elementEntries?: ElementEntry[];
    createdAt: Date;
    updatedAt: Date;
    submittedAt?: Date;
    metaInformation: EntryMetaInformation;
}
