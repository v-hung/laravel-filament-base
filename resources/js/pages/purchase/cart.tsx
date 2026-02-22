import React from 'react';
import { useCartStore } from '@/stores/cart';

export type CartProps = React.HTMLAttributes<HTMLDivElement>;

const Cart: React.FC<CartProps> = (props) => {
    const { ...rest } = props;

    const items = useCartStore((state) => state.items);

    return <div {...rest}>{items.length} items</div>;
};

export default Cart;
