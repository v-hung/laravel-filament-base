import { Head } from '@inertiajs/react';
import { Monitor, Moon, Sun, type LucideIcon } from 'lucide-react';
import type { Appearance } from '@/hooks/use-appearance';
import { useAppearance } from '@/hooks/use-appearance';
import AccountLayout from '@/layouts/account-layout';
import { cn } from '@/lib/utils';

export default function Appearance() {
    const { appearance, updateAppearance } = useAppearance();

    const tabs: { value: Appearance; icon: LucideIcon; label: string }[] = [
        { value: 'light', icon: Sun, label: 'Light' },
        { value: 'dark', icon: Moon, label: 'Dark' },
        { value: 'system', icon: Monitor, label: 'System' },
    ];

    return (
        <AccountLayout>
            <Head title="Appearance settings" />

            <div className="space-y-6">
                <h1>Appearance</h1>
                <h2>Choose your preferred appearance</h2>

                <div
                    className={
                        'inline-flex gap-1 rounded-lg bg-neutral-100 p-1 dark:bg-neutral-800'
                    }
                >
                    {tabs.map(({ value, icon: Icon, label }) => (
                        <button
                            key={value}
                            onClick={() => updateAppearance(value)}
                            className={cn(
                                'flex items-center rounded-md px-3.5 py-1.5 transition-colors',
                                appearance === value
                                    ? 'bg-white shadow-xs dark:bg-neutral-700 dark:text-neutral-100'
                                    : 'text-neutral-500 hover:bg-neutral-200/60 hover:text-black dark:text-neutral-400 dark:hover:bg-neutral-700/60',
                            )}
                        >
                            <Icon className="-ml-1 h-4 w-4" />
                            <span className="ml-1.5 text-sm">{label}</span>
                        </button>
                    ))}
                </div>
            </div>
        </AccountLayout>
    );
}
