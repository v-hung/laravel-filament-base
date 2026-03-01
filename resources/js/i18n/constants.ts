export type AppLocale = 'en' | 'vi';

export const SUPPORTED_LANGUAGES: AppLocale[] = ['en', 'vi'];

export const CURRENT_LANGUAGE: AppLocale =
    (import.meta.env.VITE_APP_LOCALE as AppLocale) || 'vi';
