import type { Translatable } from '@/lib/utils/trans-value';
import type { Auth } from './auth';
import type { CartItem, ShopSettings, MenuNavItem } from './models';

declare module '@inertiajs/core' {
    export interface InertiaConfig {
        sharedPageProps: {
            auth: Auth;
            name: Translatable;
            cart: CartItem[];
            settings: ShopSettings;
            menus: {
                header: MenuNavItem[];
                footer: MenuNavItem[];
            };
        };
        flashDataType: {
            toast?: { type: 'success' | 'error'; message: string };
        };
        errorValueType: string[];
    }
}
