export interface Element {
    id: number;
    type: 'TEXT_SHORT' | 'TEXT_LONG';
    title: string;
    description?: string;
    position: number;
    placeholder?: string;
}
