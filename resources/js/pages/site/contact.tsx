import AppHead from '@/components/shared/app-head';
import Container from '@/components/shared/container';
import DuButton from '@/components/shared/du-button';
import DuInput from '@/components/shared/du-input';
import DuTextarea from '@/components/shared/du-textarea';
import Section from '@/components/shared/section';
import {
    Accordion,
    AccordionContent,
    AccordionItem,
} from '@/components/ui/accordion';
import AppLayout from '@/layouts/app-layout';
import { useTransValue } from '@/lib/utils/trans-value';
import { contact } from '@/routes';
import { useSettingStore } from '@/stores/setting';
import { useForm, usePage } from '@inertiajs/react';
import { ChevronDownIcon } from 'lucide-react';
import { Accordion as AccordionPrimitive } from 'radix-ui';
import { useEffect, useId } from 'react';
import { useTranslation } from 'react-i18next';

export default function Contact() {
    const { t } = useTranslation();
    const tv = useTransValue();
    const formId = useId();
    const { flash } = usePage<{ flash: { success?: string } }>().props;
    const { data, setData, post, processing, reset, errors } = useForm({
        name: '',
        email: '',
        content: '',
    });

    useEffect(() => {
        const searchParams = new URLSearchParams(window.location.search);
        const emailParam = searchParams.get('email');
        if (emailParam) {
            setData('email', emailParam);
        }
    }, [setData]);

    const handleSubmit = (e: React.SubmitEvent) => {
        e.preventDefault();
        post(contact().url, {
            onSuccess: () => reset(),
        });
    };

    const shopSettings = useSettingStore((state) => state.shopSettings);
    const mapTrans = tv(shopSettings.site_map);

    return (
        <AppLayout>
            <AppHead title={t('contact.title')} />

            {/* Contact Form Section */}
            <Section className="pt-6 lg:pt-10">
                <Container>
                    <div className="grid min-h-150 grid-cols-1 lg:grid-cols-2">
                        {/* Left — Factory image */}
                        <div className="relative hidden lg:block">
                            <img
                                src={'/assets/images/contact_banner.jpg'}
                                alt={t('contact.factoryAlt')}
                                className="absolute inset-0 h-full w-full object-cover"
                            />
                        </div>
                        {/* Right — Contact form */}
                        <div className="flex flex-col justify-center bg-duyang-cream px-6 py-12 md:px-12 lg:px-16 lg:py-16">
                            <h2 className="text-h-24-bold text-duyang-black lg:text-h-40-bold">
                                {t('contact.title')}
                            </h2>
                            <p className="mt-6 max-w-xl text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                                {tv(shopSettings.site_description)}
                            </p>
                            {flash?.success && (
                                <p className="mt-8 max-w-xl border-l-2 border-duyang-black py-1 pl-4 text-p-14-regular text-duyang-black lg:text-p-16-regular">
                                    {flash.success}
                                </p>
                            )}
                            <form
                                id={formId}
                                onSubmit={handleSubmit}
                                className="mt-10 flex max-w-xl flex-col gap-8"
                            >
                                <div className="flex flex-col gap-1">
                                    <DuInput
                                        label={t('contact.form.fullName')}
                                        placeholder={t(
                                            'contact.form.fullNamePlaceholder',
                                        )}
                                        value={data.name}
                                        onChange={(e) =>
                                            setData('name', e.target.value)
                                        }
                                        required
                                    />
                                    {errors.name && (
                                        <p className="text-p-14-regular text-red-600">
                                            {errors.name}
                                        </p>
                                    )}
                                </div>
                                <div className="flex flex-col gap-1">
                                    <DuInput
                                        label={t('common.email')}
                                        type="email"
                                        placeholder={t(
                                            'contact.form.emailPlaceholder',
                                        )}
                                        value={data.email}
                                        onChange={(e) =>
                                            setData('email', e.target.value)
                                        }
                                        required
                                    />
                                    {errors.email && (
                                        <p className="text-p-14-regular text-red-600">
                                            {errors.email}
                                        </p>
                                    )}
                                </div>
                                {/* Textarea styled like DuInput */}
                                <div className="flex flex-col gap-1">
                                    <DuTextarea
                                        label={t('contact.form.content')}
                                        rows={3}
                                        placeholder={t(
                                            'contact.form.contentPlaceholder',
                                        )}
                                        value={data.content}
                                        onChange={(e) =>
                                            setData('content', e.target.value)
                                        }
                                        required
                                    />
                                    {errors.content && (
                                        <p className="text-p-14-regular text-red-600">
                                            {errors.content}
                                        </p>
                                    )}
                                </div>
                                <div className="mt-2">
                                    <DuButton
                                        type="submit"
                                        color="black"
                                        variant="solid"
                                        size="lg"
                                        disabled={processing}
                                    >
                                        {t('contact.form.submit')}
                                    </DuButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </Container>
            </Section>

            {/* Contact Information Section */}
            <Section>
                <Container>
                    <h2 className="text-h-24-bold text-duyang-black lg:text-h-40-bold">
                        {t('contact.info.title')}
                    </h2>
                    <div className="mt-10 grid grid-cols-1 gap-10 lg:grid-cols-3 lg:gap-12">
                        {/* Column 1 — Address, Tax, Representative */}
                        <div className="flex flex-col gap-8">
                            <div className="flex flex-col gap-2">
                                <h3 className="text-p-18-semibold text-duyang-black lg:text-h-20-semibold">
                                    {t('contact.info.address')}
                                </h3>
                                <p className="text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                                    {tv(shopSettings.site_address)}
                                </p>
                            </div>
                            <div className="flex flex-col gap-2">
                                <h3 className="text-p-18-semibold text-duyang-black lg:text-h-20-semibold">
                                    {t('contact.info.taxCode')}
                                </h3>
                                <p className="text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                                    {tv(shopSettings.tax_code)}
                                </p>
                            </div>
                            <div className="flex flex-col gap-2">
                                <h3 className="text-p-18-semibold text-duyang-black lg:text-h-20-semibold">
                                    {t('contact.info.representative')}
                                </h3>
                                <p className="text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                                    {tv(shopSettings.representative)}
                                </p>
                            </div>
                        </div>
                        {/* Column 2 — Phone, Industry, Email */}
                        <div className="flex flex-col gap-8">
                            <div className="flex flex-col gap-2">
                                <h3 className="text-p-18-semibold text-duyang-black lg:text-h-20-semibold">
                                    {t('contact.info.phone')}
                                </h3>
                                <p className="text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                                    {tv(shopSettings.site_phone)}
                                </p>
                            </div>
                            <div className="flex flex-col gap-2">
                                <h3 className="text-p-18-semibold text-duyang-black lg:text-h-20-semibold">
                                    {t('contact.info.businessField')}
                                </h3>
                                <p className="text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                                    {tv(shopSettings.business_field)}
                                </p>
                            </div>
                            <div className="flex flex-col gap-2">
                                <h3 className="text-p-18-semibold text-duyang-black lg:text-h-20-semibold">
                                    Email
                                </h3>
                                <p className="text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                                    {tv(shopSettings.site_email)}
                                </p>
                            </div>
                        </div>
                        {/* Column 3 — Working Hours card */}
                        <div className="bg-duyang-black px-8 py-10 lg:px-10 lg:py-12">
                            <h3 className="text-h-20-bold text-duyang-white lg:text-h-22-bold">
                                {t('contact.info.workingHours')}
                            </h3>
                            <div className="mt-8 flex flex-col gap-5">
                                {tv(shopSettings.working_hours)?.map(
                                    (item, index) => (
                                        <div
                                            key={index}
                                            className="flex items-baseline justify-between border-b border-white/15 pb-5"
                                        >
                                            <span className="text-p-14-semibold text-duyang-white lg:text-p-16-semibold">
                                                {item.key}
                                            </span>
                                            <span className="text-p-14-regular text-duyang-white lg:text-p-16-regular">
                                                {item.value}
                                            </span>
                                        </div>
                                    ),
                                )}
                            </div>
                        </div>
                    </div>
                </Container>
            </Section>

            {/* Map Section */}
            {mapTrans && (
                <Section>
                    <Container>
                        <div
                            className="h-75 w-full overflow-hidden lg:h-125 [&_iframe]:h-full! [&_iframe]:w-full!"
                            dangerouslySetInnerHTML={{
                                __html: mapTrans,
                            }}
                        />
                    </Container>
                </Section>
            )}

            {/* FAQ Section */}
            <Section className="mb-10 lg:mb-16">
                <Container>
                    <div className="grid grid-cols-1 items-start gap-10 lg:grid-cols-12 lg:gap-16">
                        {/* Left — Title & description */}
                        <div className="lg:col-span-4">
                            <h2 className="text-h-24-bold text-duyang-black lg:text-h-40-bold">
                                {t('contact.faq.title')}
                            </h2>
                            <p className="mt-6 text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                                {t('contact.faq.description')}
                            </p>
                        </div>
                        {/* Right — Accordion */}
                        <div className="lg:col-span-8">
                            <Accordion type="single" collapsible>
                                {(tv(shopSettings?.faq) ?? []).map(
                                    (item, index) => (
                                        <AccordionItem
                                            key={index}
                                            value={item.key}
                                            className="border-b border-duyang-grey-light/20 transition-colors data-[state=open]:bg-duyang-cream"
                                        >
                                            <AccordionPrimitive.Header className="flex">
                                                <AccordionPrimitive.Trigger className="group flex w-full cursor-pointer items-center justify-between px-6 py-6 text-left">
                                                    <div className="flex items-center gap-6">
                                                        <span className="text-p-16-regular text-duyang-grey-light lg:text-p-18-regular">
                                                            {String(
                                                                index + 1,
                                                            ).padStart(2, '0')}
                                                        </span>
                                                        <span className="text-h-20-bold text-duyang-black lg:text-h-24-bold">
                                                            {item.key}
                                                        </span>
                                                    </div>
                                                    <ChevronDownIcon className="size-5 shrink-0 text-duyang-black transition-transform duration-200 group-data-[state=open]:rotate-180" />
                                                </AccordionPrimitive.Trigger>
                                            </AccordionPrimitive.Header>
                                            <AccordionContent className="px-6 pb-6 pl-18">
                                                <p className="text-p-14-regular text-duyang-grey lg:text-p-16-regular">
                                                    {item.value}
                                                </p>
                                            </AccordionContent>
                                        </AccordionItem>
                                    ),
                                )}
                            </Accordion>
                        </div>
                    </div>
                </Container>
            </Section>
        </AppLayout>
    );
}
