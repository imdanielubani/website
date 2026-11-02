<?php

use App\Mail\InquiryAcknowledgement;
use App\Mail\InquiryReceived;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

/*
| Sends a sample notification (to INQUIRY_RECIPIENT) and a sample visitor
| confirmation (to the given address, or the recipient) so mail settings can
| be verified after deployment:  php artisan inquiries:test-mail you@example.com
*/
Artisan::command('inquiries:test-mail {email? : Address that receives the sample visitor confirmation} {--locale=en : Language of the confirmation (en or sq)}', function () {
    $recipient = config('site.inquiry_recipient');
    $visitor = $this->argument('email') ?: $recipient;
    $locale = in_array($this->option('locale'), array_keys(config('site.locales')), true) ? $this->option('locale') : 'en';

    $this->line('Mailer:   ' . config('mail.default') . ' (' . config('mail.mailers.' . config('mail.default') . '.host', 'n/a') . ')');
    $this->line('From:     ' . config('mail.from.address'));

    $ok = true;

    try {
        Mail::to($recipient)->send(new InquiryReceived('Contact inquiry (test)', 'Website test', $visitor, [
            'Inquiry type' => 'General inquiry',
            'Full name' => 'Website test',
            'Email' => $visitor,
            'Message' => 'This is a test message sent with php artisan inquiries:test-mail.',
            'Submitted' => now()->toDayDateTimeString(),
        ]));
        $this->info("Notification sent to {$recipient}");
    } catch (Throwable $e) {
        $ok = false;
        $this->error("Notification failed: {$e->getMessage()}");
    }

    try {
        app()->setLocale($locale);
        Mail::to($visitor)->locale($locale)->send(new InquiryAcknowledgement(
            form: 'Contact inquiry',
            name: 'Website test',
            inquiryType: 'General inquiry',
            receivedAt: now()->translatedFormat('j F Y, H:i'),
        ));
        $this->info("Confirmation ({$locale}) sent to {$visitor}");
    } catch (Throwable $e) {
        $ok = false;
        $this->error("Confirmation failed: {$e->getMessage()}");
    }

    if (config('mail.default') === 'log') {
        $this->warn('MAIL_MAILER is "log": messages were written to storage/logs/laravel.log, not delivered.');
    }

    return $ok ? 0 : 1;
})->purpose('Send test emails to verify the contact form mail settings');
