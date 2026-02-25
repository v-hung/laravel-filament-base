import type { FC, HTMLAttributes } from 'react';

import { Footer } from '@/components/shared/footer';
import Header from '@/components/shared/header';

export type AppLayoutProps = HTMLAttributes<HTMLDivElement>;

const AppLayout: FC<AppLayoutProps> = (props) => {
    const { className = '', children, ...rest } = props;

    return (
        <div {...rest} className={`${className}`}>
            <Header />
            {children}
            <Footer />
        </div>
    );
};

export default AppLayout;
