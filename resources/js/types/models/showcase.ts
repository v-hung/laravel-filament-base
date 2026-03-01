import type { ShowcaseType, Status } from '../enums';
import type { Media } from './media';
import type { Translatable } from '@/lib/utils/trans-value';

export type Showcase = {
    id: number;
    type: ShowcaseType;
    title?: Translatable | null;
    slug?: Translatable | null;
    description?: Translatable | null;
    content?: string | null;
    image?: Media | null;
    link?: string | null;
    order?: number;
    status?: Status | null;
    created_at?: string;
    updated_at?: string;
    [key: string]: unknown;
};
