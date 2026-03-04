import i18n from '@/i18n/config';
import type { AppLocale } from '@/i18n/constants';
import { localeManager } from '@/i18n/manager';

export async function ensureLocaleInitialized() {
    if (!i18n.isInitialized) {
        await i18n.init();
    }
    if (!localeManager.isInitialized) {
        await localeManager.init(i18n.language as AppLocale);
    }
}
