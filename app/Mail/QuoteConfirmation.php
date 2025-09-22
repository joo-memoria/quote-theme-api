<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Quote;

class QuoteConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public Quote $quote;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Quote $quote)
    {
        $this->quote = $quote;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Quote Request — Confirmation')
                    ->view('emails.quote_confirmation')
                    ->with(['quote' => $this->quote]);
    }
}
