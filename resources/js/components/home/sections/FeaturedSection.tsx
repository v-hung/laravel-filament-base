import LatestProductCard from '@/components/product/latest-product-card';
import Container from '@/components/shared/container';
import DuButton from '@/components/shared/du-button';
import Section from '@/components/shared/section';
import { products as productsRoute } from '@/routes';
import type { Paginator, Product } from '@/types';
import { Link } from '@inertiajs/react';
import type { FC } from 'react';

type FeaturedSectionProps = {
    data?: { title?: string; description?: string };
    products: Paginator<Product>;
};

const FeaturedSection: FC<FeaturedSectionProps> = ({ data, products }) => (
    <Section>
        <Container>
            <div className="flex flex-col gap-6 lg:flex-row lg:gap-10">
                <div className="flex flex-none flex-col items-start gap-6 lg:w-1/4">
                    <h3 className="text-h-32-bold lg:text-h-40-bold">
                        {data?.title}
                    </h3>
                    {data?.description && (
                        <p className="mt-auto line-clamp-3 text-justify text-p-14-regular text-duyang-grey lg:line-clamp-none lg:text-p-16-regular">
                            {data.description}
                        </p>
                    )}
                    <DuButton>
                        <Link href={productsRoute().url}>View All</Link>
                    </DuButton>
                </div>

                <div className="min-w-0 grow">
                    <div className="grid grid-cols-2 gap-4 lg:grid-cols-3">
                        {products.data.map((product) => (
                            <LatestProductCard
                                key={product.id}
                                product={product}
                            />
                        ))}
                    </div>
                </div>
            </div>
        </Container>
    </Section>
);

export default FeaturedSection;
