<?php

use App\Models\Contact;

test('contact page renders', function () {
    $this->get('/contact-us')->assertOk();
});

test('submitting contact form saves to database', function () {
    $this->post('/contact-us', [
        'name' => 'Nguyễn Văn A',
        'email' => 'test@example.com',
        'content' => 'Tôi muốn hỏi về sản phẩm.',
    ])->assertRedirect();

    expect(Contact::count())->toBe(1);

    $this->assertDatabaseHas(Contact::class, [
        'name' => 'Nguyễn Văn A',
        'email' => 'test@example.com',
        'content' => 'Tôi muốn hỏi về sản phẩm.',
        'read_at' => null,
    ]);
});

test('submitting contact form redirects with success message', function () {
    $this->post('/contact-us', [
        'name' => 'Nguyễn Văn A',
        'email' => 'test@example.com',
        'content' => 'Tôi muốn hỏi về sản phẩm.',
    ])->assertSessionHas('success');
});

test('contact form requires name', function () {
    $this->post('/contact-us', [
        'email' => 'test@example.com',
        'content' => 'Nội dung.',
    ])->assertSessionHasErrors(['name']);

    expect(Contact::count())->toBe(0);
});

test('contact form requires valid email', function () {
    $this->post('/contact-us', [
        'name' => 'Test',
        'email' => 'not-an-email',
        'content' => 'Nội dung.',
    ])->assertSessionHasErrors(['email']);
});

test('contact form requires content', function () {
    $this->post('/contact-us', [
        'name' => 'Test',
        'email' => 'test@example.com',
    ])->assertSessionHasErrors(['content']);
});

test('new contact is unread by default', function () {
    $this->post('/contact-us', [
        'name' => 'Test',
        'email' => 'test@example.com',
        'content' => 'Nội dung.',
    ]);

    expect(Contact::first()->isRead())->toBeFalse();
});
