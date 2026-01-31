import type { Auth } from './auth';
import type { CartItem } from './models';

declare module '@inertiajs/core' {
    export interface InertiaConfig {
        sharedPageProps: {
            auth: Auth;
            name: string;
            cart: CartItem[];
        };
        flashDataType: {
            toast?: { type: 'success' | 'error'; message: string };
        };
        errorValueType: string[];
    }
}
