import { useEffect } from 'react';
import { useMenuStore } from '@/stores/menu';
import type { MenuNavItem } from '@/types/models';

type MenuListenerProps = {
    initialMenus?: { header: MenuNavItem[]; footer: MenuNavItem[] } | null;
};

export default function MenuListener({ initialMenus = null }: MenuListenerProps) {
    const setMenus = useMenuStore((state) => state.setMenus);

    useEffect(() => {
        setMenus(initialMenus);
    }, []); // eslint-disable-line react-hooks/exhaustive-deps

    return null;
}
