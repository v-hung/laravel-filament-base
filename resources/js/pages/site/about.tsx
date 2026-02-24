import { PopularProductCard } from '@/components/product/popular-product-card';
import AppLayout from '@/layouts/app-layout';
import type { Product } from '@/types';

export default function About() {
    const product: Product = {
        id: 1,
        slug: 'product-1',
        name: 'Product 1',
        description: 'This is a sample product.',
        price: 19.99,
        rating: 4.5,
        review_count: 10,
        collections: [
            {
                id: 1,
                name: 'Collection 1',
                slug: 'collection-1',
                title: 'Collection 1',
            },
            {
                id: 2,
                name: 'Collection 2',
                slug: 'collection-2',
                title: 'Collection 2',
            },
        ],
    };

    return (
        <AppLayout>
            <PopularProductCard product={product} />
        </AppLayout>
    );
}
