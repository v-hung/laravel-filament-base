import type { Translatable } from '@/lib/utils/trans-value';
import type { Media } from './media';

export type ShopSettings = {
    // Branding
    site_name?: Translatable | null;
    site_logo?: Translatable<Media> | null;
    site_description?: Translatable | null;

    // Contact
    site_email?: Translatable<string> | null;
    site_phone?: Translatable<string> | null;
    site_address?: Translatable | null;
};
