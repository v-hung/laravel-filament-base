<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\StoreContactRequest;
use App\Mail\Contact\ContactConfirmationMail;
use App\Mail\Contact\ContactNotificationMail;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    public function index(): \Inertia\Response
    {
        return $this->render('site/contact');
    }

    public function store(StoreContactRequest $request): RedirectResponse
    {
        try {
            $contact = Contact::create([
                ...$request->validated(),
                'locale' => app()->getLocale(),
            ]);

            // Uncomment to enable email notifications:

            Mail::to($contact->email)->send(new ContactConfirmationMail($contact));

            Mail::to(config('mail.from.address'))->send(new ContactNotificationMail($contact));

            $this->flash('toast', ['type' => 'success', 'message' => __('messages.contact.success')]);

            return back();
        } catch (Throwable $e) {
            $this->flash('toast', ['type' => 'error', 'message' => __('messages.contact.error')]);

            return back();
        }
    }
}
