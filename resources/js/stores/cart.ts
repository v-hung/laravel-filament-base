import { router } from '@inertiajs/react';
import { create } from 'zustand';
import type { CartItem } from '@/types';

interface CartState {
    items: CartItem[];
    isLoading: boolean;

    // Đồng bộ từ Server
    setItems: (items: CartItem[]) => void;
    setLoading: (loading: boolean) => void;

    // Các hành động tương tác (Tên hàm chuẩn CRUD)
    addItem: (productId: number, quantity?: number) => void;
    updateQuantity: (itemId: number, quantity: number) => void;
    removeItem: (itemId: number) => void;
    clearCart: () => void;
}

export const useCartStore = create<CartState>((set) => ({
    items: [],
    isLoading: false,

    setItems: (items) => set({ items }),

    setLoading: (loading) => set({ isLoading: loading }),

    // Thêm sản phẩm
    addItem: (productId, quantity = 1) => {
        router.post(
            route('cart.store'),
            { product_id: productId, quantity },
            {
                preserveScroll: true,
                onBefore: () => set({ isLoading: true }),
                onFinish: () => set({ isLoading: false }),
            },
        );
    },

    // Cập nhật số lượng
    updateQuantity: (itemId, quantity) => {
        if (quantity < 1) return;
        router.put(
            route('cart.update', itemId),
            { quantity },
            {
                preserveScroll: true,
                onBefore: () => set({ isLoading: true }),
                onFinish: () => set({ isLoading: false }),
            },
        );
    },

    // Xóa một item
    removeItem: (itemId) => {
        router.delete(route('cart.destroy', itemId), {
            preserveScroll: true,
            onBefore: () => set({ isLoading: true }),
            onFinish: () => set({ isLoading: false }),
        });
    },

    // Xóa sạch giỏ hàng
    clearCart: () => {
        router.delete(route('cart.clear'), {
            onBefore: () => set({ isLoading: true }),
            onFinish: () => set({ isLoading: false }),
        });
    },
}));
