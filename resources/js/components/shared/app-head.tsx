import { Head } from '@inertiajs/react';
import { useSettingStore } from '@/stores/setting';

type AppHeadProps = {
    title?: string;
};

export default function AppHead({ title }: AppHeadProps) {
    const siteName =
        useSettingStore((state) => state.shopSettings.site_name) ||
        import.meta.env.VITE_APP_NAME ||
        'Laravel';

    const fullTitle = title ? `${title} - ${siteName}` : siteName;

    return <Head title={fullTitle} />;
}
