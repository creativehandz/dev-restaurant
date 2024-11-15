<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class TwilioController extends Controller
{
    public function sendWhatsApp(Request $request)
    {
        $client = new Client(
            "ACbd7e764023873bc031f326cd39d47099",
            "5a057ff35ffdd1ec2332d660f4b27bcf"
        );

        $recipient = $request->input('recipient');
        $message = $request->input('message');

        try {
            $client->messages->create("whatsapp:$recipient", [
                'from' => 'whatsapp:+12086035451',
                'MessagingServiceSid' => 'MG9ee5a5006166cfad39ca7adf8a59a481',
                'ContentSid' => $message,
                //'body' => $message,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'WhatsApp message sent successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
