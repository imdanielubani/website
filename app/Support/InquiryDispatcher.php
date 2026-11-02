<?php

namespace App\Support;

use App\Mail\InquiryAcknowledgement;
use App\Mail\InquiryReceived;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

/**
 * Delivers form submissions.
 *
 * 1. Every submission is written to the "inquiries" log channel first, so
 *    nothing is lost if the mail server is unavailable.
 * 2. A notification is emailed to INQUIRY_RECIPIENT, with reply-to set to
 *    the visitor.
 * 3. A confirmation is emailed to the visitor in their language (can be
 *    turned off with INQUIRY_SEND_ACKNOWLEDGEMENT=false).
 *
 * Mail failures are reported but never shown to the visitor: the inquiry is
 * already safely recorded in the log.
 */
class InquiryDispatcher
{
    /**
     * @param  array<string, string|null>  $fields  label => value
     */
    public function dispatch(string $form, string $name, string $email, array $fields, string $inquiryType): void
    {
        Log::channel('inquiries')->info($form, $fields);

        try {
            Mail::to(config('site.inquiry_recipient'))
                ->locale(config('site.default_locale'))
                ->send(new InquiryReceived($form, $name, $email, $fields));
        } catch (Throwable $e) {
            report($e);
        }

        if (! config('site.send_acknowledgement')) {
            return;
        }

        try {
            Mail::to($email, $name)
                ->locale(app()->getLocale())
                ->send(new InquiryAcknowledgement(
                    form: $form,
                    name: $name,
                    inquiryType: $inquiryType,
                    receivedAt: now()->translatedFormat('j F Y, H:i'),
                ));
        } catch (Throwable $e) {
            report($e);
        }
    }
}
