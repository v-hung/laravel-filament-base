import { useSettingStore } from '@/stores/setting';
import { cn } from '@/lib/utils/cn';
import React from 'react';

export type BrandLogoProps = React.HTMLAttributes<HTMLDivElement> & {
    white?: boolean;
};

const BrandLogo: React.FC<BrandLogoProps> = (props) => {
    const { white = false, className, ...rest } = props;

    const logo = useSettingStore((state) => state.shopSettings.site_logo);
    const media = Array.isArray(logo) ? logo[0] : logo;

    return (
        <div className={cn('h-5 lg:h-7', className)} {...rest}>
            {media && (
                <img
                    className={cn(
                        'h-full w-auto',
                        white && 'brightness-0 invert',
                    )}
                    src={media.original_url ?? media.url ?? ''}
                    alt={media.custom_properties?.alt_text ?? media.name}
                />
            )}
        </div>
    );
};

export default BrandLogo;
