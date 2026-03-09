import { localeManager } from '@/i18n/manager';
import {
    type Duration,
    format as formatDate,
    formatDistance as formatDistanceDate,
    formatDuration as formatDurationDate,
    formatDistanceStrict as formatDistanceStrictDate,
    type FormatDurationOptions,
    type DateArg,
    type FormatOptions,
    type FormatDistanceOptions,
    type FormatDistanceStrictOptions,
} from 'date-fns';

export function format(
    date: DateArg<Date> & {},
    formatStr: string = 'HH:mm:ss',
    options: FormatOptions = {},
): string {
    return formatDate(date, formatStr, {
        locale: localeManager.locale.dateFnsLocale,
        ...options,
    });
}

export function formatDistance(
    laterDate: DateArg<Date> & {},
    earlierDate: DateArg<Date> & {},
    options: FormatDistanceOptions = {},
) {
    return formatDistanceDate(laterDate, earlierDate, {
        locale: localeManager.locale.dateFnsLocale,
        ...options,
    });
}

export function formatDistanceStrict(
    laterDate: DateArg<Date> & {},
    earlierDate: DateArg<Date> & {},
    options: FormatDistanceStrictOptions = {},
) {
    return formatDistanceStrictDate(laterDate, earlierDate, {
        locale: localeManager.locale.dateFnsLocale,
        ...options,
    });
}

export function formatDuration(
    duration: Duration,
    options: FormatDurationOptions = {},
) {
    return formatDurationDate(duration, {
        locale: localeManager.locale.dateFnsLocale,
        ...options,
    });
}
export function formatSystem(
    date: Date | string,
    options: {
        format?: 'date-time' | 'date' | 'time';
        locale?: Intl.LocalesArgument;
        hour12?: boolean;
    },
): string {
    const { format = 'date', locale = undefined, hour12 } = options;

    const d = typeof date === 'string' ? new Date(date) : date;

    const baseOptions: Intl.DateTimeFormatOptions = {
        ...(format === 'date' || format === 'date-time'
            ? {
                  year: 'numeric',
                  month: '2-digit',
                  day: '2-digit',
              }
            : {}),
        ...(format === 'time' || format === 'date-time'
            ? {
                  hour: '2-digit',
                  minute: '2-digit',
                  second: '2-digit',
              }
            : {}),
        ...(hour12 !== undefined && { hour12 }),
    };

    return new Intl.DateTimeFormat(locale, baseOptions).format(d);
}

export function localTimeToDate(localTime: string) {
    const [hours, minutes, seconds] = localTime.split(':').map(Number);
    return new Date(1970, 0, 1, hours, minutes, seconds);
}

export function setTimeToDate(time: Date): Date {
    return new Date(
        1970,
        0,
        1,
        time.getHours(),
        time.getMinutes(),
        time.getSeconds(),
    );
}
