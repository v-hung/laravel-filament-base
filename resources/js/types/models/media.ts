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
    url: string;
    width?: number;
    height?: number;
    [key: string]: unknown;
};

export type MediaCustomProperties = {
    alt_text?: string | null;
    caption?: string | null;
    original_name?: string | null;
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
    name: string;
    file_name: string;
    url: string;
    mime_type?: string;
    size: number;
    width: number | null;
    height: number | null;
    dimensions: [number, number] | null;
    custom_properties: MediaCustomProperties | null;
    conversions: Record<string, MediaConversion>;
    pivot: MediaPivot;
    mediables: MediaMediable[];
    created_at: string;
    updated_at: string;
    [key: string]: unknown;
};
