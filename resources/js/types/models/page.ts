import type { ContentStatus, CategoryStatus } from '../enums';
import type { Media } from './media';
import type { Translatable } from '@/lib/utils/trans-value';

export type Page = {
    id: number;
    title: Translatable;
    slug: Translatable;
    description?: Translatable;
    content?: Translatable;
    images?: Media[];
    image?: Media;
    status?: ContentStatus;
    created_at: string;
    updated_at: string;
    [key: string]: unknown;
};
