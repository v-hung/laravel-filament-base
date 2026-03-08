import { router } from '@inertiajs/react';
import { useEffect } from 'react';
import { toast } from 'sonner';

export default function FlashListener() {
    useEffect(() => {
        return router.on('flash', (event) => {
            const flash = event.detail.flash;
            if (!flash?.toast) return;

            if (flash.toast.type === 'success') {
                toast.success(flash.toast.message);
            } else {
                toast.error(flash.toast.message);
            }
        });
    }, []);

    return null;
}
