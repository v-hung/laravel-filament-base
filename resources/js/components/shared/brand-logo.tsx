import { useSettingStore } from '@/stores/setting';
import { cn } from '@/lib/utils/cn';
import React from 'react';
import { transValue } from '@/lib/utils/trans-value';

export type BrandLogoProps = React.HTMLAttributes<HTMLDivElement> & {
    white?: boolean;
};

const BrandLogo: React.FC<BrandLogoProps> = (props) => {
    const { white = false, className, ...rest } = props;

    const logo = useSettingStore((state) => state.shopSettings.site_logo);
    const media = transValue(logo);

    return (
        <div className={cn('h-5 lg:h-7', className)} {...rest}>
            {media && (
                <img
                    className={cn(
                        'h-full w-auto',
                        white && 'brightness-0 invert',
                    )}
                    src={media.url}
                    alt={media.custom_properties?.alt_text ?? media.name}
                />
            )}
        </div>
    );
};

export default BrandLogo;
