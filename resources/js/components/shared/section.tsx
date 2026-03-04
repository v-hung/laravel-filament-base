import { cn } from '@/lib/utils/cn';
import React from 'react';

export type SectionProps = React.HTMLAttributes<HTMLDivElement>;

const Section: React.FC<SectionProps> = (props) => {
    const { className = '', ...rest } = props;

    return <div {...rest} className={cn('py-10 lg:py-16', className)} />;
};

export default Section;
