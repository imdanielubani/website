<?php

namespace App\Support;

use App\Mail\InquiryReceived;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

/**
 * Delivers form submissions to the company inbox.
 *
 * Every submission is first written to the "inquiries" log channel so that
 * nothing is lost if the mail server is unavailable, then emailed to the
 * address configured in INQUIRY_RECIPIENT.
 */
class InquiryDispatcher
{
    /**
     * @param  array<string, string|null>  $fields  label => value
     */
    public function dispatch(string $form, string $name, string $email, array $fields): void
    {
        Log::channel('inquiries')->info($form, $fields);

        try {
            Mail::to(config('site.inquiry_recipient'))
                ->send(new InquiryReceived($form, $name, $email, $fields));
        } catch (Throwable $e) {
            // The submission is safely logged; surface the delivery failure to monitoring.
            report($e);
        }
    }
}
