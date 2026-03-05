import type { Translatable } from '@/lib/utils/trans-value';
import type { Auth } from './auth';
import type { CartItem, ShopSettings } from './models';

declare module '@inertiajs/core' {
    export interface InertiaConfig {
        sharedPageProps: {
            auth: Auth;
            name: Translatable;
            cart: CartItem[];
            settings: ShopSettings;
        };
        flashDataType: {
            toast?: { type: 'success' | 'error'; message: string };
        };
        errorValueType: string[];
    }
}
