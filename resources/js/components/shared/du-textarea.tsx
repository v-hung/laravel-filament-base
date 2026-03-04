import { cn } from '@/lib/utils/cn';
import {
    type ComponentPropsWithoutRef,
    forwardRef,
    useId,
    type JSX,
} from 'react';
import { Textarea } from '../ui/textarea';

export type DuTextareaProps = Omit<
    ComponentPropsWithoutRef<'textarea'>,
    'color'
> & {
    label?: string;
    wrapperClassName?: string;
    textareaClassName?: string;
};

const DuTextarea = forwardRef<HTMLTextAreaElement, DuTextareaProps>(
    (
        { label, id, className, wrapperClassName, textareaClassName, ...props },
        ref,
    ): JSX.Element => {
        const generatedId = useId();
        const textareaId = id ?? generatedId;

        return (
            <div className={cn('flex w-full flex-col', wrapperClassName)}>
                {label && (
                    <label
                        htmlFor={textareaId}
                        className={cn(
                            'text-p-14-semibold text-duyang-black lg:text-p-16-semibold',
                        )}
                    >
                        {label}
                    </label>
                )}

                <Textarea
                    ref={ref}
                    id={textareaId}
                    className={cn(
                        'resize-y rounded-none border-0 border-b border-duyang-grey-light bg-transparent px-0 pt-0 pb-2 text-p-14-regular text-duyang-black shadow-none placeholder:text-duyang-grey-mid focus-visible:border-duyang-grey focus-visible:ring-0 lg:text-p-16-regular',
                        textareaClassName,
                        className,
                    )}
                    {...props}
                />
            </div>
        );
    },
);

DuTextarea.displayName = 'DuTextarea';

export default DuTextarea;
