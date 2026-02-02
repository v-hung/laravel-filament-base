import i18n from 'i18next';
import { initReactI18next } from 'react-i18next';
import languageDetector from 'i18next-browser-languagedetector';
import chainedBackend from 'i18next-chained-backend';
import httpBackend from 'i18next-http-backend';
import localStorageBackend from 'i18next-localstorage-backend';
import { localeManager } from './manager';

export type AppLocale = 'en' | 'vi';

export const SUPPORTED_LANGUAGES: AppLocale[] = ['en', 'vi'];
export const CURRENT_LANGUAGE: AppLocale =
	import.meta.env.VITE_APP_LOCALE || 'en';

i18n.use(languageDetector)
	.use(chainedBackend)
	.use(initReactI18next)
	.init({
		fallbackLng: CURRENT_LANGUAGE,

		// load: "languageOnly",
		supportedLngs: SUPPORTED_LANGUAGES,
		// nonExplicitSupportedLngs: true,
		// keySeparator: false,

		interpolation: {
			escapeValue: false,
		},

		detection: {
			order: [
				'querystring',
				'cookie',
				'sessionStorage',
				'localStorage',
				'htmlTag',
			],
		},

		backend: {
			backends: [localStorageBackend, httpBackend],
			backendOptions: [
				{
					expirationTime: import.meta.env.DEV
						? 0
						: 7 * 24 * 60 * 60 * 1000, // 7 days
				},
				{
					loadPath: '/locale/{{lng}}.json',
				},
			],
		},

		react: {
			useSuspense: false, // disable if you want self control
		},
	});

i18n.on('languageChanged', async (lng: AppLocale) => {
	await localeManager.setLocale(lng);
});

export default i18n;
