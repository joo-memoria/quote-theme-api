<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quote;
use App\Mail\QuoteConfirmation;

class MailPreviewController extends Controller
{
    /**
     * Preview the QuoteConfirmation mailable in the browser.
     * Optional query param `id` to load an existing BusQuote.
     */
    public function busQuote(Request $request)
    {
        $id = $request->query('id');

        if ($id) {
            $quote = Quote::find($id);
            if (!$quote) {
                return response('Quote not found', 404);
            }
        } else {
            // sample placeholder record for preview
            $quote = new Quote([
                'full_name' => 'Jane Example',
                'email' => 'jane@example.com',
                'mobile_number' => '0123456789',
                'additional_info' => 'No special requirements',
            ]);
        }

        return (new QuoteConfirmation($quote))->render();
    }
}
