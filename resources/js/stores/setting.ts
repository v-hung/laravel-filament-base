import { create } from 'zustand';
import type { ShopSettings } from '@/types';

type SettingState = {
    shopSettings: ShopSettings;
    setShopSettings: (settings?: ShopSettings | null) => void;
    resetShopSettings: () => void;
};

const defaultShopSettings: ShopSettings = {
    site_name: null,
    site_logo: null,
    site_email: null,
    site_phone: null,
    site_address: null,
};

export const useSettingStore = create<SettingState>((set) => ({
    shopSettings: defaultShopSettings,

    setShopSettings: (settings) =>
        set({
            shopSettings: {
                ...defaultShopSettings,
                ...(settings ?? {}),
            },
        }),

    resetShopSettings: () => set({ shopSettings: defaultShopSettings }),
}));
