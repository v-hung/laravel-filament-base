import type { Translatable } from '@/lib/utils/trans-value';
import type { Media } from './media';

export type ShopSettings = {
    // Branding
    site_name?: Translatable | null;
    site_logo?: Media | null;

    // Contact
    site_email?: string | null;
    site_phone?: string | null;
    site_address?: Translatable | null;

    // Business info
    tax_code?: Translatable | null;
    representative?: Translatable | null;
    business_field?: Translatable | null;
    working_hours?: Translatable<Record<string, string>> | null;

    // Content
    site_description?: Translatable | null;
    site_map?: string | null;

    // FAQ
    faq?: Translatable<Record<string, string>> | null;
};
