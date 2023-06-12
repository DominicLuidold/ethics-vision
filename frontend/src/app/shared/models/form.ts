import { Screen } from "./screen";
import { Section } from "./section";

export interface Form {
    id: number;
    title: string;
    description?: string;
    welcomeScreen: Screen;
    submitScreen: Screen;
    sections: Section[];
}
