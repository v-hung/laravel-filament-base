<x-mail::message>
# Cảm ơn bạn đã liên hệ với {{ setting('shop.site_name') }}

Xin chào **{{ $contact->name }}**,

Chúng tôi đã nhận được thông tin liên hệ của bạn và sẽ phản hồi trong thời gian sớm nhất.

**Nội dung bạn đã gửi:**

{{ $contact->content }}

---

Nếu bạn có thêm câu hỏi, vui lòng liên hệ qua email **{{ setting('shop.site_email') }}** hoặc số điện thoại **{{ setting('shop.site_phone') }}**.

Trân trọng,
{{ setting('shop.site_name') }}
</x-mail::message>
