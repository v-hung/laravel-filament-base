import type { Media } from './media';

export type ShopSettings = {
    site_name?: string | null;
    site_logo?: Media | null;
    site_email?: string | null;
    site_phone?: string | null;
    site_address?: string | null;
    [key: string]: unknown;
};
