import type { Locale as DateFnsLocale } from 'date-fns';
import { loadDateFnsLocale } from './loader';
import { CURRENT_LANGUAGE, type AppLocale } from './constants';

type LocaleData = {
    appLocale: AppLocale;
    dateFnsLocale: DateFnsLocale;
};

type Listener = () => void;

export class LocaleManager {
    private localeData: LocaleData | null = null;
    private listeners = new Set<Listener>();
    private isInitializedData = false;
    private initPromise: Promise<void> | null = null;

    constructor(private defaultLocale: AppLocale = CURRENT_LANGUAGE) {}

    async init(locale?: AppLocale) {
        if (this.isInitializedData) return;

        if (!this.initPromise) {
            this.initPromise = (async () => {
                const initLocale = locale || this.defaultLocale;
                const dateFnsLocale = await loadDateFnsLocale(initLocale);
                this.localeData = { appLocale: initLocale, dateFnsLocale };
                this.isInitializedData = true;
                this.notifyListeners();
            })();
        }

        return this.initPromise;
    }

    async setLocale(newLocale: AppLocale) {
        if (!this.isInitializedData) {
            await this.init(newLocale);
            return;
        }
        if (this.localeData?.appLocale === newLocale) return;

        const dateFnsLocale = await loadDateFnsLocale(newLocale);

        this.localeData = { appLocale: newLocale, dateFnsLocale };
        this.notifyListeners();
    }

    get locale(): LocaleData {
        if (!this.localeData) throw new Error('LocaleManager not initialized');
        return this.localeData;
    }

    get isInitialized(): boolean {
        return this.isInitializedData;
    }

    subscribe(listener: Listener): () => void {
        this.listeners.add(listener);
        return () => this.listeners.delete(listener);
    }

    private notifyListeners() {
        for (const listener of this.listeners) {
            listener();
        }
    }
}

export const localeManager = new LocaleManager();

/**
 * Get the current app locale — safe to call anywhere (including plain .ts files).
 * Falls back to CURRENT_LANGUAGE if LocaleManager hasn't been initialized yet.
 */
export function getLocale(): AppLocale {
    return localeManager.isInitialized
        ? localeManager.locale.appLocale
        : CURRENT_LANGUAGE;
}

/**
 * Subscribe to locale changes from plain .ts files (non-React).
 * Returns an unsubscribe function.
 *
 * @example
 * const unsubscribe = onLocaleChange((locale) => { ... });
 * // later: unsubscribe();
 */
export function onLocaleChange(callback: (locale: AppLocale) => void): () => void {
    return localeManager.subscribe(() => {
        if (localeManager.isInitialized) {
            callback(localeManager.locale.appLocale);
        }
    });
}
