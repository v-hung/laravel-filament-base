import { Transition } from '@headlessui/react';
import { Form, Head } from '@inertiajs/react';
import { useRef } from 'react';
import { useTranslation } from 'react-i18next';
import PasswordController from '@/actions/App/Http/Controllers/Settings/PasswordController';

import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AccountLayout from '@/layouts/account-layout';

export default function Password() {
    const { t } = useTranslation();
    const passwordInput = useRef<HTMLInputElement>(null);
    const currentPasswordInput = useRef<HTMLInputElement>(null);

    return (
        <AccountLayout>
            <Head title={t('settings.passwordTitle')} />
            <div className="space-y-6">
                <Form
                    {...PasswordController.update.form()}
                    options={{
                        preserveScroll: true,
                    }}
                    resetOnError={[
                        'password',
                        'password_confirmation',
                        'current_password',
                    ]}
                    resetOnSuccess
                    onError={(errors) => {
                        if (errors.password) {
                            passwordInput.current?.focus();
                        }

                        if (errors.current_password) {
                            currentPasswordInput.current?.focus();
                        }
                    }}
                    className="space-y-6"
                >
                    {({ errors, processing, recentlySuccessful }) => (
                        <>
                            <div className="grid gap-2">
                                <Label htmlFor="current_password">
                                    {t('settings.currentPassword')}
                                </Label>

                                <Input
                                    id="current_password"
                                    ref={currentPasswordInput}
                                    name="current_password"
                                    type="password"
                                    className="mt-1 block w-full"
                                    autoComplete="current-password"
                                    placeholder={t('settings.currentPassword')}
                                />

                                <p> {errors.current_password} </p>
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="password">
                                    {t('settings.newPassword')}
                                </Label>

                                <Input
                                    id="password"
                                    ref={passwordInput}
                                    name="password"
                                    type="password"
                                    className="mt-1 block w-full"
                                    autoComplete="new-password"
                                    placeholder={t('settings.newPassword')}
                                />

                                <p> {errors.password} </p>
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="password_confirmation">
                                    {t('auth.confirmPassword')}
                                </Label>

                                <Input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    className="mt-1 block w-full"
                                    autoComplete="new-password"
                                    placeholder={t('auth.confirmPassword')}
                                />

                                <p> {errors.password_confirmation} </p>
                            </div>

                            <div className="flex items-center gap-4">
                                <Button
                                    disabled={processing}
                                    data-test="update-password-button"
                                >
                                    {t('settings.savePassword')}
                                </Button>

                                <Transition
                                    show={recentlySuccessful}
                                    enter="transition ease-in-out"
                                    enterFrom="opacity-0"
                                    leave="transition ease-in-out"
                                    leaveTo="opacity-0"
                                >
                                    <p className="text-sm text-neutral-600">
                                        {t('common.saved')}
                                    </p>
                                </Transition>
                            </div>
                        </>
                    )}
                </Form>
            </div>
        </AccountLayout>
    );
}
