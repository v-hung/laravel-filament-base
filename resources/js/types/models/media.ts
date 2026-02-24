import type { Collection, Product, ProductVariant } from './product';
import type { Blog, Page, Post } from './post';
import type { Showcase } from './showcase';

export type MediaPivot = {
    collection?: string;
    sort_order?: number;
    model_type?: string;
    model_id?: number;
    [key: string]: unknown;
};

export type MediaConversion = {
    file_name?: string;
    width?: number;
    height?: number;
    [key: string]: unknown;
};

export type MediaMediable =
    | Product
    | ProductVariant
    | Post
    | Blog
    | Page
    | Collection
    | Showcase;

export type Media = {
    id: number;
    file_name?: string;
    mime_type?: string;
    size?: number;
    disk?: string;
    width?: number | null;
    height?: number | null;
    dimensions?: [number, number] | null;
    original_url?: string;
    preview_url?: string;
    custom_properties?: Record<string, unknown> | null;
    conversions?: Record<string, MediaConversion>;
    pivot?: MediaPivot;
    mediables?: MediaMediable[];
    created_at?: string;
    updated_at?: string;
    [key: string]: unknown;
};
