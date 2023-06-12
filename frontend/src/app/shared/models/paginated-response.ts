export interface PaginatedResponse<T> {
    page: number;
    limit: number;
    pages: number;
    total: number;
    _embedded: T[];
}
