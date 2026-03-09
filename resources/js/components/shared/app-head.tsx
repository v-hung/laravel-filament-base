import { Head } from '@inertiajs/react';
import { useMemo } from 'react';
import { useSettingStore } from '@/stores/setting';
import { useTransValue } from '@/lib/utils/trans-value';

type AppHeadProps = {
    title?: string;
};

export default function AppHead({ title }: AppHeadProps) {
    const tv = useTransValue();

    const siteName = useSettingStore((state) => state.shopSettings.site_name);

    const resolvedSiteName =
        siteName || import.meta.env.VITE_APP_NAME || 'Laravel';

    const translatedSiteName = tv(resolvedSiteName);

    const fullTitle = useMemo(() => {
        return title ? `${title} - ${translatedSiteName}` : translatedSiteName;
    }, [title, translatedSiteName]);

    return <Head title={fullTitle} />;
}
