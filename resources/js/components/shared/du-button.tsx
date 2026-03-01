import clsx from 'clsx';
import { type ButtonHTMLAttributes, type FC } from 'react';

import { Icons } from './Icons';

type DuButtonColor = 'white' | 'black';
type DuButtonVariant = 'solid' | 'outline' | 'text';
type DuButtonSize = 'sm' | 'md' | 'lg';

export type DuButtonProps = ButtonHTMLAttributes<HTMLButtonElement> & {
    color?: DuButtonColor;
    variant?: DuButtonVariant;
    size?: DuButtonSize;
    showIcon?: boolean;
};

const colorVariantClasses: Record<
    DuButtonColor,
    Record<DuButtonVariant, string>
> = {
    white: {
        solid: 'bg-duyang-white text-duyang-black hover:bg-duyang-cream',
        outline:
            'border border-duyang-white text-duyang-white hover:bg-duyang-white hover:text-duyang-black',
        text: 'text-duyang-white hover:text-duyang-cream',
    },
    black: {
        solid: 'bg-duyang-black text-duyang-white hover:bg-duyang-grey',
        outline:
            'border border-duyang-black text-duyang-black hover:bg-duyang-black hover:text-duyang-white',
        text: 'text-duyang-black hover:text-duyang-grey',
    },
};

const sizeClasses: Record<DuButtonSize, string> = {
    sm: 'text-btn-14 lg:text-btn-16 px-4 py-2 gap-1.5',
    md: 'text-btn-16 lg:text-btn-18 px-4 py-2.5 gap-2',
    lg: 'text-btn-16 lg:text-btn-18 px-6 py-3 gap-2',
};

const iconSizes: Record<DuButtonSize, number> = {
    sm: 16,
    md: 18,
    lg: 20,
};

const DuButton: FC<DuButtonProps> = ({
    color = 'black',
    variant = 'solid',
    size = 'md',
    showIcon = false,
    className,
    children,
    ...props
}) => {
    return (
        <button
            className={clsx(
                'inline-flex cursor-pointer items-center rounded-sm transition-colors',
                colorVariantClasses[color][variant],
                sizeClasses[size],
                className,
            )}
            {...props}
        >
            {showIcon && <Icons.SquaresFour size={iconSizes[size]} />}
            {children}
        </button>
    );
};

export default DuButton;
