import React from 'react';

export type BrandLogoProps = React.HTMLAttributes<HTMLDivElement>;

const BrandLogo: React.FC<BrandLogoProps> = (props) => {
    const { ...rest } = props;

    return (
        <div className="text-duyang-white" {...rest}>
            logo
        </div>
    );
};

export default BrandLogo;
