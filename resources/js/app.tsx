import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { StrictMode } from 'react';
import { createRoot } from 'react-dom/client';
import '../css/app.css';
import './i18n/config';
import { Toaster } from './components/ui/sonner';
import { initializeTheme } from './hooks/use-appearance';
import FlashListener from './shared/listeners/FlashListener';
import MenuListener from './shared/listeners/MenuListener';
import SettingListener from './shared/listeners/SettingListener';
import type { ShopSettings, MenuNavItem } from './types';

// const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    // title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) =>
        resolvePageComponent(
            `./pages/${name}.tsx`,
            import.meta.glob('./pages/**/*.tsx'),
        ),
    setup({ el, App, props }) {
        const root = createRoot(el);
        const initialPage = props.initialPage.props as {
            settings?: ShopSettings | null;
            menus?: { header: MenuNavItem[]; footer: MenuNavItem[] } | null;
        };
        const initialSettings = initialPage.settings ?? null;
        const initialMenus = initialPage.menus ?? null;

        root.render(
            <StrictMode>
                <SettingListener initialSettings={initialSettings} />
                <MenuListener initialMenus={initialMenus} />
                <FlashListener />
                <App {...props} />
                <Toaster position="top-right" />
            </StrictMode>,
        );
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on load...
initializeTheme();
