import type { ContentStatus, CategoryStatus } from '../enums';
import type { Media } from './media';
import type { Translatable } from '@/lib/utils/trans-value';

export type Post = {
    id: number;
    title: Translatable;
    slug: Translatable;
    description?: Translatable | null;
    content?: Translatable | null;
    images?: Media[] | null;
    image?: Media | null;
    status?: ContentStatus | null;
    created_at?: string;
    updated_at?: string;
    categories?: Blog[];
    [key: string]: unknown;
};

export type Blog = {
    id: number;
    title: Translatable;
    slug: Translatable;
    description?: Translatable | null;
    image?: Media | null;
    status?: CategoryStatus | null;
    created_at?: string;
    updated_at?: string;
    posts?: Post[];
    [key: string]: unknown;
};

export type Page = {
    id: number;
    title: Translatable;
    slug: Translatable;
    description?: Translatable | null;
    content?: Translatable | null;
    images?: Media[] | null;
    image?: Media | null;
    status?: ContentStatus | null;
    created_at?: string;
    updated_at?: string;
    [key: string]: unknown;
};
