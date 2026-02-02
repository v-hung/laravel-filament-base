import type { Province, Ward } from './location';
import type { Product } from './product';
import type { OrderStatus, PaymentMethod, PaymentStatus } from '../enums';

export type Order = {
	id: number;
	code: string;
	user_id?: number | null;
	name: string;
	phone: string;
	email?: string | null;
	province_id?: number | null;
	ward_id?: number | null;
	address?: string | null;
	note?: string | null;
	total: string | number;
	status?: OrderStatus | null;
	payment_method?: PaymentMethod | null;
	payment_status?: PaymentStatus | null;
	created_at?: string;
	updated_at?: string;
	province?: Province;
	ward?: Ward;
	items?: OrderItem[];
	[key: string]: unknown;
};

export type OrderItem = {
	id: number;
	order_id: number;
	product_id: number;
	quantity: number;
	price: string | number;
	created_at?: string;
	updated_at?: string;
	order?: Order;
	product?: Product;
	[key: string]: unknown;
};
