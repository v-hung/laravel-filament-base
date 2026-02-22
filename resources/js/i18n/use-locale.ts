import { useSyncExternalStore, useState, useEffect } from 'react';
import { localeManager } from './manager';

export const useAppLocale = () => {
    const [ready, setReady] = useState(false);

    useEffect(() => {
        if (!ready) {
            localeManager.init().then(() => setReady(true));
        }
    }, [ready]);

    const localeData = useSyncExternalStore(
        (callback) => localeManager.subscribe(callback),
        () => localeManager.locale,
        () => localeManager.locale, // server snapshot
    );

    return {
        ...localeData,
        setAppLocale: localeManager.setLocale.bind(localeManager),
        isReady: ready,
    };
};
