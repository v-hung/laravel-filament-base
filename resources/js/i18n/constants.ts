export type AppLocale = 'en' | 'vi' | 'zh-CN';

export const SUPPORTED_LANGUAGES: AppLocale[] = (
    import.meta.env.VITE_APP_AVAILABLE_LOCALES || 'en,vi'
)
    .split(',')
    .map((locale: string) => locale.trim().replace(/_/g, '-')) as AppLocale[];

export const CURRENT_LANGUAGE: AppLocale =
    (import.meta.env.VITE_APP_LOCALE as AppLocale) || 'vi';
