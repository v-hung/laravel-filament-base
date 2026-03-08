<x-mail::message>
# Liên hệ mới từ website

Bạn vừa nhận được một liên hệ mới từ website {{ setting('shop.site_name') }}.

<x-mail::table>
| Thông tin | Chi tiết |
|:---|:---|
| Họ tên | {{ $contact->name }} |
| Email | {{ $contact->email }} |
| Thời gian | {{ $contact->created_at->format('d/m/Y H:i') }} |
</x-mail::table>

**Nội dung liên hệ:**

{{ $contact->content }}

Trân trọng,
Hệ thống {{ setting('shop.site_name') }}
</x-mail::message>
