import LatestProductCard from '@/components/product/latest-product-card';
import { PopularProductCard } from '@/components/product/popular-product-card';
import AppLayout from '@/layouts/app-layout';
import type { Product } from '@/types';

export default function About() {
    const product: Product = {
        id: 1,
        slug: { en: 'sample-product', vi: 'san-pham-mau' },
        name: { en: 'Product 1', vi: 'Sản Phẩm 1' },
        images: [
            {
                id: 1,
                name: 'Image 1',
                file_name: 'image1.jpg',
                url: 'https://static.vecteezy.com/system/resources/thumbnails/060/843/811/small/close-up-of-raindrops-on-leaves-hd-background-luxury-hd-wallpaper-image-trendy-background-illustration-free-photo.jpg',
                size: 1024,
                width: 300,
                height: 300,
                dimensions: [300, 300],
                custom_properties: null,
                conversions: {
                    thumb: {
                        file_name: 'image1_thumbnail.jpg',
                        url: 'https://static.vecteezy.com/system/resources/thumbnails/060/843/811/small/close-up-of-raindrops-on-leaves-hd-background-luxury-hd-wallpaper-image-trendy-background-illustration-free-photo.jpg',
                        width: 400,
                        height: 400,
                    },
                },
                pivot: {
                    model_type: 'product',
                    model_id: 1,
                },
                mediables: [],
                created_at: new Date().toISOString(),
                updated_at: new Date().toISOString(),
            },
        ],
        description: {
            en: 'This is a sample product description in English.',
            vi: 'Đây là mô tả sản phẩm mẫu bằng tiếng Việt.',
        },
        price: 19.99,
        rating: 4.5,
        review_count: 10,
        collections: [
            {
                id: 1,
                name: { en: 'Collection 1', vi: 'Bộ Sưu Tập 1' },
                slug: { en: 'collection-1', vi: 'bo-suu-tap-1' },
                title: { en: 'Collection 1', vi: 'Bộ Sưu Tập 1' },
            },
            {
                id: 2,
                name: { en: 'Collection 2', vi: 'Bộ Sưu Tập 2' },
                slug: { en: 'collection-2', vi: 'bo-suu-tap-2' },
                title: { en: 'Collection 2', vi: 'Bộ Sưu Tập 2' },
            },
        ],
    };

    return (
        <AppLayout>
            <LatestProductCard product={product} />
        </AppLayout>
    );
}
