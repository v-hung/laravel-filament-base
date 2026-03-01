import type { ProductStatus, CategoryStatus } from '../enums';
import type { Media } from './media';
import type { Translatable } from '@/lib/utils/trans-value';

export type Product = {
    id: number;
    name: Translatable;
    slug: Translatable;
    description?: Translatable | null;
    content?: Translatable | null;
    images?: Media[] | null;
    price: string | number;
    has_variant?: boolean;
    compare_at_price?: string | number | null;
    featured_position?: number;
    stock_quantity?: number;
    sales_count?: number;
    status?: ProductStatus | null;
    is_discounted?: boolean;
    discount_percent?: number;
    created_at?: string;
    updated_at?: string;
    collections?: Collection[];
    options?: ProductOption[];
    variants?: ProductVariant[];
    [key: string]: unknown;
};

export type ProductOption = {
    id: number;
    product_id: number;
    name: string;
    position?: number;
    created_at?: string;
    updated_at?: string;
    product?: Product;
    values?: ProductOptionValue[];
    [key: string]: unknown;
};

export type ProductOptionValue = {
    id: number;
    product_option_id: number;
    label: string;
    position?: number;
    created_at?: string;
    updated_at?: string;
    option?: ProductOption;
    [key: string]: unknown;
};

export type ProductVariant = {
    id: number;
    product_id: number;
    image?: Media | null;
    sku?: string | null;
    price?: string | number | null;
    stock?: number;
    created_at?: string;
    updated_at?: string;
    product?: Product;
    values?: ProductOptionValue[];
    [key: string]: unknown;
};

export type Collection = {
    id: number;
    title: Translatable;
    slug: Translatable;
    description?: Translatable | null;
    image?: Media | null;
    status?: CategoryStatus | null;
    created_at?: string;
    updated_at?: string;
    products?: Product[];
    [key: string]: unknown;
};
