import { create } from 'zustand';
import type { MenuNavItem } from '@/types/models';

type MenuState = {
    headerMenu: MenuNavItem[];
    footerMenu: MenuNavItem[];
    setMenus: (menus: { header: MenuNavItem[]; footer: MenuNavItem[] } | null) => void;
};

export const useMenuStore = create<MenuState>((set) => ({
    headerMenu: [],
    footerMenu: [],

    setMenus: (menus) =>
        set({
            headerMenu: menus?.header ?? [],
            footerMenu: menus?.footer ?? [],
        }),
}));
