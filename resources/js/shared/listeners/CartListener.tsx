import { usePage } from '@inertiajs/react';
import { useEffect } from 'react';
import { useCartStore } from '@/stores/cart';

export default function CartListener() {
    const { cart } = usePage().props;
    const setItems = useCartStore((s) => s.setItems);

    useEffect(() => {
        setItems(cart ?? null);
    }, [cart, setItems]);

    return null;
}
