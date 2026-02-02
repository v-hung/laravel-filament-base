import type { ShowcaseType, Status } from '../enums';

export type Showcase = {
	id: number;
	type: ShowcaseType;
	title?: string | null;
	description?: string | null;
	content?: string | null;
	image?: string | null;
	link?: string | null;
	order?: number;
	status?: Status | null;
	created_at?: string;
	updated_at?: string;
	[key: string]: unknown;
};
