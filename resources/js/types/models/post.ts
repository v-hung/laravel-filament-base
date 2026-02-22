import type { ContentStatus, CategoryStatus } from '../enums';

export type Post = {
    id: number;
    title: string;
    slug: string;
    description?: string | null;
    content?: string | null;
    images?: string[] | null;
    status?: ContentStatus | null;
    created_at?: string;
    updated_at?: string;
    categories?: Blog[];
    [key: string]: unknown;
};

export type Blog = {
    id: number;
    title: string;
    slug: string;
    description?: string | null;
    image?: string | null;
    status?: CategoryStatus | null;
    created_at?: string;
    updated_at?: string;
    posts?: Post[];
    [key: string]: unknown;
};

export type Page = {
    id: number;
    title: string;
    slug: string;
    description?: string | null;
    content?: string | null;
    images?: string[] | null;
    status?: ContentStatus | null;
    created_at?: string;
    updated_at?: string;
    [key: string]: unknown;
};
