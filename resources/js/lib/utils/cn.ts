import { type ClassValue, clsx } from 'clsx';
import { extendTailwindMerge } from 'tailwind-merge';

const twMerge = extendTailwindMerge({
    extend: {
        classGroups: {
            /**
             * Duyang typography classes — put in 'font-size' group so they conflict
             * with each other (last wins) but NOT with text-color utilities.
             */
            'font-size': [
                'text-h-80-bold',
                'text-h-56-semibold',
                'text-h-56-bold',
                'text-h-40-semibold',
                'text-h-40-bold',
                'text-h-32-bold',
                'text-h-32-semibold',
                'text-h-24-bold',
                'text-h-24-medium',
                'text-h-22-bold',
                'text-h-20-bold',
                'text-h-20-semibold',
                'text-p-18-semibold',
                'text-p-18-medium',
                'text-p-18-regular',
                'text-p-16-bold',
                'text-p-16-semibold',
                'text-p-16-medium',
                'text-p-16-regular',
                'text-p-14-semibold',
                'text-p-14-bold',
                'text-p-14-medium',
                'text-p-14-regular',
                'text-btn-18',
                'text-btn-16',
                'text-btn-14',
            ],
        },
    },
});

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}
