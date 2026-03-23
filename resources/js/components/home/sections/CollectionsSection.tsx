import ItemListCategory from '@/components/product/item-list-category';
import Container from '@/components/shared/container';
import Section from '@/components/shared/section';
import type { Collection, Paginator } from '@/types';
import type { FC } from 'react';

type CollectionsSectionProps = {
    data?: { title?: string; description?: string };
    collections: Paginator<Collection>;
};

const CollectionsSection: FC<CollectionsSectionProps> = ({
    data,
    collections,
}) => (
    <Section>
        <Container>
            <div className="flex flex-col gap-6 lg:flex-row lg:gap-20">
                <div className="flex flex-none flex-col items-start gap-6 lg:w-1/4">
                    <h3 className="text-h-32-bold lg:text-h-40-bold">
                        {data?.title}
                    </h3>
                    {data?.description && (
                        <p className="line-clamp-3 text-p-14-regular text-duyang-grey lg:line-clamp-none lg:text-p-16-regular">
                            {data.description}
                        </p>
                    )}
                </div>

                <div className="min-w-0 grow">
                    <div className="flex flex-col gap-8">
                        {collections.data.map((item) => (
                            <ItemListCategory
                                key={item.id}
                                collection={item}
                                reverse={item.id % 2 === 0}
                            />
                        ))}
                    </div>
                </div>
            </div>
        </Container>
    </Section>
);

export default CollectionsSection;
