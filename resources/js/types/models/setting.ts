import type { Translatable } from '@/lib/utils/trans-value';
import type { Media } from './media';

export type ShopSettings = {
    // Branding
    site_name?: Translatable | null;
    site_logo?: Translatable<Media> | null;

    // Contact
    site_email?: Translatable<string> | null;
    site_phone?: Translatable<string> | null;
    site_address?: Translatable | null;

    // Business info
    tax_code?: Translatable | null;
    representative?: Translatable | null;
    business_field?: Translatable | null;
    working_hours?: Translatable<{ key: string; value: string }[]> | null;

    // Content
    site_description?: Translatable | null;
    site_map?: Translatable<string> | null;

    // FAQ
    faq?: Translatable<{ key: string; value: string }[]> | null;
};
