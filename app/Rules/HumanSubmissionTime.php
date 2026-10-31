<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Crypt;

/**
 * Anti-spam time trap. Forms carry an encrypted timestamp of when they were
 * rendered; submissions that arrive implausibly fast (bots) or long after
 * the page was loaded (replayed payloads) are rejected. The value cannot be
 * forged without the application key.
 */
class HumanSubmissionTime implements ValidationRule
{
    public function __construct(
        private readonly int $minSeconds = 3,
        private readonly int $maxSeconds = 6 * 60 * 60,
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $renderedAt = (int) Crypt::decryptString((string) $value);
        } catch (DecryptException) {
            $fail('Your session could not be verified. Please reload the page and try again.');

            return;
        }

        $elapsed = time() - $renderedAt;

        if ($elapsed < $this->minSeconds) {
            $fail('The form was submitted too quickly. Please take a moment and try again.');
        } elseif ($elapsed > $this->maxSeconds) {
            $fail('This form has expired. Please reload the page and try again.');
        }
    }
}
