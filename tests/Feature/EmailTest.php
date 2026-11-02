<?php

namespace Tests\Feature;

use App\Mail\InquiryAcknowledgement;
use App\Mail\InquiryReceived;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmailTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Mail::fake();
        $this->withoutMiddleware(ValidateCsrfToken::class);
    }

    private function contactData(array $overrides = []): array
    {
        return array_merge([
            'full_name' => 'Arta Hoxha',
            'email' => 'arta@example.com',
            'country' => 'Albania',
            'inquiry_type' => 'customer',
            'message' => 'Unique message body that must not be echoed back.',
            'consent' => '1',
            'form_started' => Crypt::encryptString((string) (time() - 30)),
        ], $overrides);
    }

    public function test_visitor_receives_a_confirmation_email(): void
    {
        $this->post(route('contact.submit'), $this->contactData())->assertRedirect();

        Mail::assertSent(InquiryReceived::class, 1);
        Mail::assertSent(InquiryAcknowledgement::class, function (InquiryAcknowledgement $mail) {
            return $mail->hasTo('arta@example.com')
                && $mail->hasReplyTo(config('company.contact.email'))
                && $mail->locale === 'en'
                && $mail->inquiryType === 'Customer inquiry';
        });
    }

    public function test_confirmation_is_sent_in_the_visitors_language(): void
    {
        $this->post('/sq/contact', $this->contactData())->assertRedirect();

        Mail::assertSent(InquiryAcknowledgement::class, fn (InquiryAcknowledgement $mail) => $mail->locale === 'sq');
    }

    public function test_confirmation_can_be_switched_off(): void
    {
        config(['site.send_acknowledgement' => false]);

        $this->post(route('contact.submit'), $this->contactData())->assertRedirect();

        Mail::assertSent(InquiryReceived::class, 1);
        Mail::assertNotSent(InquiryAcknowledgement::class);
    }

    public function test_confirmation_does_not_repeat_the_visitors_message(): void
    {
        $html = (new InquiryAcknowledgement('Contact inquiry', 'Arta', 'Customer inquiry', '2 November 2026, 10:00'))->render();

        $this->assertStringNotContainsString('Unique message body', $html);
        $this->assertStringContainsString('We have received your message', $html);
        $this->assertStringContainsString('Dear Arta,', $html);
    }

    public function test_albanian_confirmation_renders_in_albanian(): void
    {
        app()->setLocale('sq');

        $html = (new InquiryAcknowledgement('Business inquiry', 'Arta', 'Purchasing petroleum products', '2 nëntor 2026, 10:00'))->render();

        $this->assertStringContainsString('E kemi marrë mesazhin tuaj', $html);
        $this->assertStringContainsString('Blerje produktesh nafte', $html);
        $this->assertStringContainsString('lang="sq"', $html);
    }

    public function test_emails_use_the_branded_layout_with_logo(): void
    {
        $html = (new InquiryReceived('Contact inquiry', 'Arta', 'arta@example.com', ['Full name' => 'Arta']))->render();

        // The logo is embedded in the message itself (inline attachment when sent,
        // data URI when rendered), so it shows even when remote images are blocked.
        $this->assertMatchesRegularExpression('/<img src="(cid:|data:image\/png;base64,)[^"]+"[^>]*alt="AL.GLOBAL OIL SH.A"/', $html);
        $this->assertStringContainsString('NUIS ' . config('company.nuis'), $html);
        $this->assertFileExists(public_path('images/brand/email-logo.png'));
    }

    public function test_emails_have_plain_text_versions(): void
    {
        $this->assertSame('emails.inquiry-text', (new InquiryReceived('F', 'N', 'n@example.com', []))->content()->text);
        $this->assertSame('emails.acknowledgement-text', (new InquiryAcknowledgement('F', 'N', 'T', 'D'))->content()->text);
    }

    public function test_mail_test_command_sends_both_emails(): void
    {
        $this->artisan('inquiries:test-mail', ['email' => 'check@example.com'])->assertSuccessful();

        Mail::assertSent(InquiryReceived::class, fn ($mail) => $mail->hasTo(config('site.inquiry_recipient')));
        Mail::assertSent(InquiryAcknowledgement::class, fn ($mail) => $mail->hasTo('check@example.com'));
    }
}
