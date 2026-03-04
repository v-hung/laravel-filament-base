import { Form, Head } from '@inertiajs/react';
import { useTranslation } from 'react-i18next';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/auth-layout';
import { store } from '@/routes/register';

export default function Register() {
    const { t } = useTranslation();

    return (
        <AuthLayout
            title={t('auth.registerTitle')}
            description={t('auth.registerDescription')}
        >
            <Head title={t('auth.registerTitle')} />
            <Form
                {...store.form()}
                resetOnSuccess={['password', 'password_confirmation']}
                disableWhileProcessing
                className="flex flex-col gap-6"
            >
                {({ processing }) => (
                    <>
                        <div className="grid gap-6">
                            <div className="grid gap-2">
                                <Label htmlFor="name">{t('auth.name')}</Label>
                                <Input
                                    id="name"
                                    type="text"
                                    required
                                    autoFocus
                                    tabIndex={1}
                                    autoComplete="name"
                                    name="name"
                                    placeholder={t('auth.fullNamePlaceholder')}
                                />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="email">
                                    {t('auth.emailAddress')}
                                </Label>
                                <Input
                                    id="email"
                                    type="email"
                                    required
                                    tabIndex={2}
                                    autoComplete="email"
                                    name="email"
                                    placeholder="email@example.com"
                                />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="password">
                                    {t('common.password')}
                                </Label>
                                <Input
                                    id="password"
                                    type="password"
                                    required
                                    tabIndex={3}
                                    autoComplete="new-password"
                                    name="password"
                                    placeholder={t('common.password')}
                                />
                            </div>

                            <div className="grid gap-2">
                                <Label htmlFor="password_confirmation">
                                    {t('auth.confirmPassword')}
                                </Label>
                                <Input
                                    id="password_confirmation"
                                    type="password"
                                    required
                                    tabIndex={4}
                                    autoComplete="new-password"
                                    name="password_confirmation"
                                    placeholder={t('auth.confirmPassword')}
                                />
                            </div>

                            <Button
                                type="submit"
                                className="mt-2 w-full"
                                tabIndex={5}
                                data-test="register-user-button"
                            >
                                {processing && <Spinner />}
                                {t('auth.createAccount')}
                            </Button>
                        </div>

                        <div className="text-center text-sm text-muted-foreground">
                            {t('auth.hasAccount')}{' '}
                        </div>
                    </>
                )}
            </Form>
        </AuthLayout>
    );
}
