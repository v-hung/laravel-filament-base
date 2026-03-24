import { router } from '@inertiajs/react';
import { useEffect } from 'react';
import { useSettingStore } from '@/stores/setting';
import type { ShopSettings } from '@/types';

type SettingListenerProps = {
    initialSettings?: ShopSettings | null;
};

export default function SettingListener({
    initialSettings = null,
}: SettingListenerProps) {
    const setShopSettings = useSettingStore((state) => state.setShopSettings);

    useEffect(() => {
        setShopSettings(initialSettings);

        // const unlisten = router.on('success', (event) => {
        //     const pageProps = event.detail.page.props as {
        //         settings?: ShopSettings | null;
        //     };

        //     if (pageProps.settings !== undefined) {
        //         const current = useSettingStore.getState().shopSettings;
        //         if (JSON.stringify(current) !== JSON.stringify(pageProps.settings)) {
        //             setShopSettings(pageProps.settings);
        //         }
        //     }
        // });

        // return () => {
        //     unlisten();
        // };
    }, [initialSettings, setShopSettings]);

    return null;
}
