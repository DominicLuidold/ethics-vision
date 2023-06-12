import { Element } from "./element";

export interface Section {
    id: number;
    title: string;
    description: string;
    position: number;
    elements: Element[];
}