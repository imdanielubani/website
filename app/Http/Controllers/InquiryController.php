<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessInquiryRequest;
use App\Support\InquiryDispatcher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryController extends Controller
{
    public function show(Request $request): View
    {
        $type = $request->query('type');

        return view('pages.inquiry', [
            'inquiryTypes' => BusinessInquiryRequest::INQUIRY_TYPES,
            'selectedType' => array_key_exists($type, BusinessInquiryRequest::INQUIRY_TYPES) ? $type : 'purchase',
        ]);
    }

    public function submit(BusinessInquiryRequest $request, InquiryDispatcher $dispatcher): RedirectResponse
    {
        $data = $request->validated();

        $dispatcher->dispatch('Business inquiry', $data['contact_person'], $data['email'], [
            'Inquiry type' => BusinessInquiryRequest::INQUIRY_TYPES[$data['inquiry_type']],
            'Company' => $data['company_name'],
            'Contact person' => $data['contact_person'],
            'Email' => $data['email'],
            'Phone' => $data['phone'],
            'Country' => $data['country'],
            'Product requirements' => $data['product_requirements'] ?? null,
            'Estimated quantity' => $data['estimated_quantity'] ?? null,
            'Message' => $data['message'],
            'Language' => config('site.locales.' . app()->getLocale() . '.name'),
            'Submitted' => now()->toDayDateTimeString(),
        ]);

        return redirect()
            ->to(lroute('inquiry') . '#inquiry-form')
            ->with('status', 'Thank you. Your business inquiry has been received and our commercial team will respond shortly.');
    }
}
