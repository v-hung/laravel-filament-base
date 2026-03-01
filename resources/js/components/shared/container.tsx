import type { FC, HTMLAttributes } from 'react';

import { cn } from '@/lib/utils/cn';

export type ContainerProps = HTMLAttributes<HTMLDivElement>;

const Container: FC<ContainerProps> = ({ className, children, ...props }) => {
    return (
        <div
            className={cn('mx-auto max-w-310 px-6 md:px-12', className)}
            {...props}
        >
            {children}
        </div>
    );
};

export default Container;
