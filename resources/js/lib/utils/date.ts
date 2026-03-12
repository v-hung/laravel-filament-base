import { CURRENT_LANGUAGE } from '@/i18n/constants';
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
import { useCallback, useSyncExternalStore } from 'react';

export function format(
    date: DateArg<Date> & {},
    formatStr: string = 'HH:mm:ss',
    options: FormatOptions = {},
): string {
    return formatDate(date, formatStr, {
        ...options,
        locale: options.locale ?? localeManager.locale.dateFnsLocale,
    });
}

export function formatDistance(
    laterDate: DateArg<Date> & {},
    earlierDate: DateArg<Date> & {},
    options: FormatDistanceOptions = {},
) {
    return formatDistanceDate(laterDate, earlierDate, {
        ...options,
        locale: options.locale ?? localeManager.locale.dateFnsLocale,
    });
}

export function formatDistanceStrict(
    laterDate: DateArg<Date> & {},
    earlierDate: DateArg<Date> & {},
    options: FormatDistanceStrictOptions = {},
) {
    return formatDistanceStrictDate(laterDate, earlierDate, {
        ...options,
        locale: options.locale ?? localeManager.locale.dateFnsLocale,
    });
}

export function formatDuration(
    duration: Duration,
    options: FormatDurationOptions = {},
) {
    return formatDurationDate(duration, {
        ...options,
        locale: options.locale ?? localeManager.locale.dateFnsLocale,
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

export function useFormat() {
    const locale = useSyncExternalStore(
        (callback) => localeManager.subscribe(callback),
        () =>
            localeManager.isInitialized
                ? localeManager.locale.dateFnsLocale
                : undefined,
        () => undefined,
    );

    const formatCb = useCallback(
        (
            date: DateArg<Date> & {},
            formatStr: string = 'HH:mm:ss',
            options?: FormatOptions,
        ) => formatDate(date, formatStr, { ...options, locale }),
        [locale],
    );
    const formatDistanceCb = useCallback(
        (
            laterDate: DateArg<Date> & {},
            earlierDate: DateArg<Date> & {},
            options?: FormatDistanceOptions,
        ) => formatDistanceDate(laterDate, earlierDate, { ...options, locale }),
        [locale],
    );
    const formatDistanceStrictCb = useCallback(
        (
            laterDate: DateArg<Date> & {},
            earlierDate: DateArg<Date> & {},
            options?: FormatDistanceStrictOptions,
        ) =>
            formatDistanceStrictDate(laterDate, earlierDate, {
                ...options,
                locale,
            }),
        [locale],
    );
    const formatDurationCb = useCallback(
        (duration: Duration, options?: FormatDurationOptions) =>
            formatDurationDate(duration, { ...options, locale }),
        [locale],
    );

    return {
        format: formatCb,
        formatDistance: formatDistanceCb,
        formatDistanceStrict: formatDistanceStrictCb,
        formatDuration: formatDurationCb,
    };
}
