<?php

namespace Tests\Feature;

use App\Mail\InquiryReceived;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class FormsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Mail::fake();
        $this->withoutMiddleware(ValidateCsrfToken::class);
    }

    private function startedSecondsAgo(int $seconds): string
    {
        return Crypt::encryptString((string) (time() - $seconds));
    }

    private function contactData(array $overrides = []): array
    {
        return array_merge([
            'full_name' => 'Arta Hoxha',
            'company_name' => 'Example Logistics',
            'email' => 'arta@example.com',
            'phone' => '+355 68 000 0000',
            'country' => 'Albania',
            'inquiry_type' => 'customer',
            'message' => 'We would like to discuss wholesale fuel supply.',
            'consent' => '1',
            'form_started' => $this->startedSecondsAgo(30),
        ], $overrides);
    }

    private function inquiryData(array $overrides = []): array
    {
        return array_merge([
            'company_name' => 'Example Trading',
            'contact_person' => 'Blerim Krasniqi',
            'email' => 'blerim@example.com',
            'phone' => '+355 69 000 0000',
            'country' => 'Kosovo',
            'inquiry_type' => 'purchase',
            'product_requirements' => 'Diesel',
            'estimated_quantity' => 'Monthly, to be agreed',
            'message' => 'Please share availability and terms.',
            'consent' => '1',
            'form_started' => $this->startedSecondsAgo(30),
        ], $overrides);
    }

    public function test_contact_form_sends_inquiry_to_company(): void
    {
        $this->post(route('contact.submit'), $this->contactData())
            ->assertRedirect(route('contact') . '#contact-form')
            ->assertSessionHas('status');

        Mail::assertSent(InquiryReceived::class, function (InquiryReceived $mail) {
            return $mail->hasTo(config('site.inquiry_recipient'))
                && $mail->hasReplyTo('arta@example.com')
                && $mail->fields['Inquiry type'] === 'Customer inquiry';
        });
    }

    public function test_contact_form_validates_input(): void
    {
        $this->post(route('contact.submit'), $this->contactData([
            'full_name' => '',
            'email' => 'not-an-email',
            'inquiry_type' => 'unknown',
            'consent' => null,
        ]))->assertSessionHasErrors(['full_name', 'email', 'inquiry_type', 'consent']);

        Mail::assertNothingSent();
    }

    public function test_honeypot_blocks_bots(): void
    {
        $this->post(route('contact.submit'), $this->contactData(['website' => 'http://spam.example']))
            ->assertSessionHasErrors('website');

        Mail::assertNothingSent();
    }

    public function test_time_trap_rejects_bots_replays_and_forgeries(): void
    {
        // Too fast, replayed after expiry, and a forged (unencrypted) value.
        foreach ([$this->startedSecondsAgo(1), $this->startedSecondsAgo(7 * 60 * 60), (string) time()] as $value) {
            $this->post(route('contact.submit'), $this->contactData(['form_started' => $value]))
                ->assertSessionHasErrors('form_started');
        }

        Mail::assertNothingSent();
    }

    public function test_forms_render_time_trap_field(): void
    {
        $this->get(route('contact'))->assertSee('name="form_started"', false);
        $this->get(route('inquiry'))->assertSee('name="form_started"', false);
    }

    public function test_business_inquiry_form_sends_inquiry(): void
    {
        $this->post(route('inquiry.submit'), $this->inquiryData())
            ->assertRedirect(route('inquiry') . '#inquiry-form')
            ->assertSessionHas('status');

        Mail::assertSent(InquiryReceived::class, fn (InquiryReceived $mail) => $mail->fields['Company'] === 'Example Trading'
            && $mail->fields['Estimated quantity'] === 'Monthly, to be agreed');
    }

    public function test_business_inquiry_requires_company_and_phone(): void
    {
        $this->post(route('inquiry.submit'), $this->inquiryData(['company_name' => '', 'phone' => 'abc']))
            ->assertSessionHasErrors(['company_name', 'phone']);
    }

    public function test_inquiry_type_can_be_preselected(): void
    {
        $this->get(route('contact', ['type' => 'careers']))
            ->assertOk()
            ->assertSee('value="careers" class="peer sr-only" checked', false);
    }

    public function test_submissions_are_rate_limited(): void
    {
        foreach (range(1, 3) as $i) {
            $this->post(route('contact.submit'), $this->contactData())->assertRedirect();
        }

        $this->post(route('contact.submit'), $this->contactData())->assertTooManyRequests();
    }
}
