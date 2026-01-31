import type { Product } from './product';

export type Cart = {
    id: number;
    user_id: number;
    created_at?: string;
    updated_at?: string;
    items?: CartItem[];
    [key: string]: unknown;
};

export type CartItem = {
    id?: number;
    cart_id?: number;
    product_id: number;
    quantity: number;
    price: string | number;
    created_at?: string;
    updated_at?: string;
    product?: Product;
    [key: string]: unknown;
};
