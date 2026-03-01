import { Input } from '@/components/ui/input';
import { cn } from '@/lib/utils/cn';
import {
    type ComponentPropsWithoutRef,
    forwardRef,
    useId,
    type JSX,
} from 'react';

export type DuInputProps = Omit<ComponentPropsWithoutRef<'input'>, 'color'> & {
    label?: string;
    wrapperClassName?: string;
    inputClassName?: string;
};

const DuInput = forwardRef<HTMLInputElement, DuInputProps>(
    (
        { label, id, className, wrapperClassName, inputClassName, ...props },
        ref,
    ): JSX.Element => {
        const generatedId = useId();
        const inputId = id ?? generatedId;

        return (
            <div className={cn('flex w-full flex-col', wrapperClassName)}>
                {label && (
                    <label
                        htmlFor={inputId}
                        className={cn(
                            'text-p-14-semibold text-duyang-black lg:text-p-16-semibold',
                        )}
                    >
                        {label}
                    </label>
                )}

                <Input
                    ref={ref}
                    id={inputId}
                    className={cn(
                        'h-auto rounded-none border-0 border-b border-duyang-grey-light bg-transparent px-0 pt-0 pb-2 text-p-14-semibold text-duyang-black shadow-none placeholder:text-duyang-grey-mid focus-visible:border-duyang-grey focus-visible:ring-0 lg:text-p-16-regular',
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
