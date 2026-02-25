import { Input } from '@/components/ui/input';
import { cn } from '@/lib/utils/cn';
import {
    type ComponentPropsWithoutRef,
    forwardRef,
    useId,
    type JSX,
} from 'react';

type DuInputColor = 'black' | 'white';

export type DuInputProps = Omit<ComponentPropsWithoutRef<'input'>, 'color'> & {
    label?: string;
    color?: DuInputColor;
    wrapperClassName?: string;
    inputClassName?: string;
};

const labelColorClasses: Record<DuInputColor, string> = {
    black: 'text-duyang-grey text-p-16-regular',
    white: 'text-duyang-grey-light text-p-16-regular',
};

const inputColorClasses: Record<DuInputColor, string> = {
    black: 'border-duyang-grey-light text-duyang-black placeholder:text-duyang-grey-mid focus-visible:border-duyang-grey',
    white: 'border-duyang-grey-light text-duyang-white placeholder:text-duyang-grey-light focus-visible:border-duyang-white',
};

const DuInput = forwardRef<HTMLInputElement, DuInputProps>(
    (
        {
            label,
            color = 'black',
            id,
            className,
            wrapperClassName,
            inputClassName,
            ...props
        },
        ref,
    ): JSX.Element => {
        const generatedId = useId();
        const inputId = id ?? generatedId;

        return (
            <div className={cn('flex w-full flex-col gap-2', wrapperClassName)}>
                {label && (
                    <label
                        htmlFor={inputId}
                        className={cn(labelColorClasses[color])}
                    >
                        {label}
                    </label>
                )}

                <Input
                    ref={ref}
                    id={inputId}
                    className={cn(
                        'text-p-16-regular h-auto rounded-none border-0 border-b bg-transparent px-0 pt-0 pb-2 shadow-none focus-visible:ring-0',
                        inputColorClasses[color],
                        inputClassName,
                        className,
                    )}
                    {...props}
                />
            </div>
        );
    },
);

DuInput.displayName = 'DuInput';

export default DuInput;
