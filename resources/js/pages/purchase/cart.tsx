import React from 'react';
import { useTranslation } from 'react-i18next';
import { useCartStore } from '@/stores/cart';

export type CartProps = React.HTMLAttributes<HTMLDivElement>;

const Cart: React.FC<CartProps> = (props) => {
    const { ...rest } = props;
    const { t } = useTranslation();

    const items = useCartStore((state) => state.items);

    return <div {...rest}>{t('cart.items', { count: items.length })}</div>;
};

export default Cart;
