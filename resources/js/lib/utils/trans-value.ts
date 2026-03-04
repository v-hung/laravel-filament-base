import { getLocale } from '@/i18n/manager';
import { CURRENT_LANGUAGE, type AppLocale } from '@/i18n/constants';

/**
 * Represents a translatable field from Laravel's spatie/laravel-translatable.
 * Stored as JSON: { vi: "...", en: "..." }
 *
 * @template T - The type of each locale's value. Defaults to `string`.
 *   Can be an array, object, or any other type.
 */
export type Translatable<T = string> = Partial<Record<AppLocale, T>>;

/**
 * Extracts the correct locale value from a translatable field.
 * Safe to call anywhere — in React components, plain .ts files, or stores.
 *
 * Fallback order:
 * 1. Requested locale (or current app locale)
 * 2. CURRENT_LANGUAGE (env default)
 * 3. First non-empty value in the object
 */
export function transValue<T = string>(
    value: Translatable<T> | T | null | undefined,
    locale?: AppLocale,
): T | string {
    if (value === null || value === undefined) return '';
    if (typeof value !== 'object' || Array.isArray(value)) return value as T;

    const obj = value as Translatable<T>;
    const currentLocale = locale ?? getLocale();

    if (obj[currentLocale] !== undefined) return obj[currentLocale]!;

    if (obj[CURRENT_LANGUAGE] !== undefined) return obj[CURRENT_LANGUAGE]!;

    const first = Object.values(obj).find((v) => v !== undefined && v !== null);
    return first ?? '';
}
