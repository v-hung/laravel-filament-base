import { Head, Link, usePage } from '@inertiajs/react';
import { login, register } from '@/routes';
import { edit } from '@/routes/profile';

export default function Home({
    canRegister = true,
}: {
    canRegister?: boolean;
}) {
    const { auth } = usePage().props;

    return (
        <>
            <Head title="Home"></Head>
            <div>
                <header>
                    <nav>
                        {auth.user ? (
                            <Link href={edit()}>Profile</Link>
                        ) : (
                            <>
                                <Link href={login()}>Log in</Link>
                                {canRegister && (
                                    <Link href={register()}>Register</Link>
                                )}
                            </>
                        )}
                    </nav>
                </header>
            </div>
        </>
    );
}
