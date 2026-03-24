export type PaginatorLink = {
    url: string | null;
    label: string;
    page: number | null;
    active: boolean;
};

export type PaginatorMeta = {
    current_page: number;
    from: number | null;
    last_page: number;
    links: PaginatorLink[];
    path: string;
    per_page: number;
    to: number | null;
    total: number;
};

export type Paginator<T> = {
    data: T[];
    links: {
        first: string;
        last: string;
        prev: string | null;
        next: string | null;
    };
    meta: PaginatorMeta;
};
