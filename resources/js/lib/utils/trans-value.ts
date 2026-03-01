import { getLocale } from '@/i18n/manager';
import { CURRENT_LANGUAGE, type AppLocale } from '@/i18n/constants';

/**
 * Represents a translatable field from Laravel's spatie/laravel-translatable.
 * Stored as JSON: { vi: "...", en: "..." }
 */
export type Translatable = Partial<Record<AppLocale, string>>;

/**
 * Extracts the correct locale string from a translatable field.
 * Safe to call anywhere — in React components, plain .ts files, or stores.
 *
 * Fallback order:
 * 1. Requested locale (or current app locale)
 * 2. CURRENT_LANGUAGE (env default)
 * 3. First non-empty value in the object
 */
export function transValue(
    value: Translatable | string | null | undefined,
    locale?: AppLocale,
): string {
    if (!value) return '';
    if (typeof value === 'string') return value;

    const currentLocale = locale ?? getLocale();

    if (value[currentLocale]) return value[currentLocale]!;

    if (value[CURRENT_LANGUAGE]) return value[CURRENT_LANGUAGE]!;

    return Object.values(value).find(Boolean) ?? '';
}
