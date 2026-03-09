import { useCallback, useSyncExternalStore } from 'react';
import { getLocale, localeManager } from '@/i18n/manager';
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
 * 4. `undefined` if nothing found
 */
export function transValue<T = string>(
    value: Translatable<T> | T | null | undefined,
    locale?: AppLocale,
): T {
    if (value === null || value === undefined) return value as T;
    if (typeof value !== 'object' || Array.isArray(value)) return value as T;

    const obj = value as Translatable<T>;
    const currentLocale = locale ?? getLocale();

    if (obj[currentLocale] !== undefined) return obj[currentLocale];

    if (obj[CURRENT_LANGUAGE] !== undefined) return obj[CURRENT_LANGUAGE] as T;

    return Object.values(obj).find((v) => v !== undefined && v !== null) as T;
}

/**
 * Reactive version of transValue for use inside React components.
 * Re-renders the component whenever the locale changes.
 */
export function useTransValue() {
    const locale = useSyncExternalStore(
        (callback) => localeManager.subscribe(callback),
        () =>
            localeManager.isInitialized
                ? localeManager.locale.appLocale
                : CURRENT_LANGUAGE,
        () => CURRENT_LANGUAGE,
    );

    return useCallback(
        <T = string>(value: Translatable<T> | T | null | undefined): T => {
            return transValue(value, locale);
        },
        [locale],
    );
}
