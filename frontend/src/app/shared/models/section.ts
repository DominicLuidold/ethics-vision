import {Element} from "./element";
import {SectionMetaInformation} from "./section-meta-information";

export interface Section {
    id: number;
    title: string;
    description?: string;
    position: number;
    elements: Element[];
    metaInformation: SectionMetaInformation;
}
