<x-mail::message>
# {{ __('mail.contact.confirmation.title', ['site_name' => setting('shop.site_name')]) }}

{{ __('mail.contact.confirmation.greeting', ['name' => $contact->name]) }}

{{ __('mail.contact.confirmation.intro') }}

{{ __('mail.contact.confirmation.content_label') }}

{{ $contact->content }}

---

{{ __('mail.contact.confirmation.footer', ['email' => setting('shop.site_email'), 'phone' => setting('shop.site_phone')]) }}

{{ __('mail.contact.confirmation.closing') }}
{{ setting('shop.site_name') }}
</x-mail::message>
