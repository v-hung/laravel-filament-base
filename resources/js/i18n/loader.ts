import type { Locale as DateFnsLocale } from 'date-fns';
import type { AppLocale } from './config';

const DATE_FNS_LOCALE_MAP: Partial<Record<AppLocale, DateFnsLocale>> = {};

export const loadDateFnsLocale = async (
    lng: AppLocale,
): Promise<DateFnsLocale> => {
    if (DATE_FNS_LOCALE_MAP[lng]) {
        return DATE_FNS_LOCALE_MAP[lng];
    }

    let locale: DateFnsLocale;

    switch (lng) {
        case 'en':
            locale = (await import('date-fns/locale/en-US')).enUS;
            break;
        default:
            locale = (await import('date-fns/locale/vi')).vi;
            break;
    }

    DATE_FNS_LOCALE_MAP[lng] = locale;
    return locale;
};
