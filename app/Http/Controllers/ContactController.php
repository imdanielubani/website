<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Support\InquiryDispatcher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(Request $request): View
    {
        $type = $request->query('type');

        return view('pages.contact', [
            'inquiryTypes' => ContactRequest::INQUIRY_TYPES,
            'selectedType' => array_key_exists($type, ContactRequest::INQUIRY_TYPES) ? $type : 'general',
        ]);
    }

    public function submit(ContactRequest $request, InquiryDispatcher $dispatcher): RedirectResponse
    {
        $data = $request->validated();

        $dispatcher->dispatch('Contact inquiry', $data['full_name'], $data['email'], [
            'Inquiry type' => ContactRequest::INQUIRY_TYPES[$data['inquiry_type']],
            'Full name' => $data['full_name'],
            'Company' => $data['company_name'] ?? null,
            'Email' => $data['email'],
            'Phone' => $data['phone'] ?? null,
            'Country' => $data['country'],
            'Message' => $data['message'],
            'Submitted' => now()->toDayDateTimeString(),
        ]);

        return redirect()
            ->to(route('contact') . '#contact-form')
            ->with('status', 'Thank you. Your message has been received and our team will be in touch.');
    }
}
