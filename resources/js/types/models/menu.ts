import type { Translatable } from '@/lib/utils/trans-value';

export type MenuNavItem = {
    id: number;
    title: Translatable;
    url: string | null;
    target: '_self' | '_blank';
    icon: string | null;
    type: string;
    children: MenuNavItem[];
};
