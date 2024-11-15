<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use App\Models\Events;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\BookingMail;
use App\Mail\EventMail;
use App\Mail\CustomerMail;
use App\Models\Settings;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class BookingController extends Controller
{

    public function createBooking(Request $request)
    {
        $rules = [
            'firstname' => 'required|max:255',
            // 'lastname' => 'required|max:255',
            'email' => 'required|email',
            'person' => 'required',
            'date' => 'required',
            'time' => 'required',
            'phone' => 'required',
            'occasion' => 'required',
            // ... other rules
        ];

          // Split firstname into firstname and lastname
        $fullName = $request->firstname;
        $nameParts = explode(' ', $fullName);
        $firstname = $nameParts[0];
        $lastname = count($nameParts) > 1 ? implode(' ', array_slice($nameParts, 1)) : '';

        $validator = Validator::make($request->all(), $rules); // For custom messages

        if ($validator->fails()) {
            return $this->validationError($validator);
        }
        $enteredTime = $request->time;
        //check if time has AM or PM
        if (strpos($enteredTime, 'AM') === false && strpos($enteredTime, 'PM') === false) {
            $convertedTime = $enteredTime;
        } else {
            $convertedTime = $this->_convertTo24Hour($enteredTime);
        }

         // Check if 'person' is an integer, if so add 'pax', else use as is
        if (is_numeric($request->person)) {
            $person = $request->person . ' pax';
        } else {
            $person = $request->person; // Use string as is
        }

        $createdBooking   =   Book::create([
            'person' => $person,
            'date' => $request->date,
            'time' => $convertedTime,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phone' => $request->phone,
            'countryCode' => $request->countryCode,
            'email' => $request->email,
            'occasion' => $request->occasion,
            'source' => 'web', //['web','admin']
            'is_seen' => 0, // 0 = unseen, 1 = seen
            'comments' => $request->comments,
            'promoCode' => empty($request->promoCode) ? 'No' : 'Yes', 
            'promo' => empty($request->promoCode) ? 'Not Available' : $request->promoCode,
        ]);
        //check $createdBooking is created or not
        if (!$createdBooking) {
            return response()->json([
                'msg' => 'Booking not created!',
                'data' => null
            ], 500);
        }
        //send email to admin
        try {
            $this->_sendMail($createdBooking);
        } catch (\Exception $e) {
            //log error
            Log::critical('API::BookingController|createBooking|_sendMail', ['error' => $e->getMessage()]);
            return response()->json([
                'msg' => 'Booking created successfully but email not sent!',
                'data' => $createdBooking // or relevant data
            ], 201);
        }

        return response()->json([
            'msg' => 'Booking created successfully!',
            'data' => $createdBooking // or relevant data
        ], 201);
    }

    public function getBookings ($id){
        $booking = Book::find($id);

        if(!$booking){
            return response()->json([
                'msg' => 'Booking not found!',
                'data' => null
            ], 404);
        }
        $details = [
            'title' => $booking->firstname . ' ' . $booking->lastname,
            'name' => $booking->firstname . ' ' . $booking->lastname,
            'phone' => $booking->phone,
            'email' => $booking->email,
            'schedule_at' => $booking->date . ' ' . $booking->time,
        ];
        $viewHtml = view('emails.booking',compact('details'))->render();
        return response()->json([
            'msg' => 'Booking found!',
            'html' => $viewHtml
        ], 200);
    }

    public function createEvent(Request $request)
    {
        $rules = [
            'event_details' => 'required',
            'event_date' => 'required',
            'event_time' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules); // For custom messages

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $createdEvent = Events::create([
            'description' => $request->event_details,
            'date' => $request->event_date,
            'time' => $request->event_time,
            'emails' => $request->guest_emails
        ]);

        try {
            $this->_sendEventMail($request->all());
            Log::info('API::BookingController|createEvent|_sendEventMail', ['success|emails=>' => $request->guest_emails]);
        } catch (\Exception $e) {
            //log error
            Log::critical('API::BookingController|createEvent|_sendEventMail', ['error' => $e->getMessage()]);
            return response()->json([
                'msg' => 'event created successfully but email not sent!',
                'data' => $createdEvent
            ], 201);
        }

        return response()->json([
            'msg' => 'Event created and invitation sent successfully!',
            'data' => $createdEvent
        ], 201);
    }

    public function validationError($validator)
    {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422);
    }

    private function _convertTo24Hour($timeString)
    {
        $timeParts = explode(':', $timeString);
        $hours = (int) $timeParts[0];
        $minutes = (int) $timeParts[1];
        $meridianParts = explode(' ', $timeParts[1]);
        $meridian = strtoupper(trim($meridianParts[1]));

        if ($meridian === 'PM' && $hours !== 12) {
            $hours += 12;
        } else if ($meridian === 'AM' && $hours === 12) {
            $hours = 0;
        }

        return sprintf('%02d:%02d', $hours, $minutes);
    }

    //SendMain private function
    private function _sendMail($createdBooking)
    {
        $details = [
            'title' => 'Booking from ' . $createdBooking->firstname . ' ' . $createdBooking->lastname,
            //'body' => $createdBooking
            'name' => $createdBooking->firstname . ' ' . $createdBooking->lastname,
            'phone' => $createdBooking->phone,
            'email' => $createdBooking->email,
            'schedule_at' => $createdBooking->date . ' ' . $createdBooking->time,
        ];
        $settings = Settings::where('key', 'email')->first();
        $adminEmail = $settings->value ?? 'pranav@thefacecraft.com';
        Mail::to($adminEmail)->send(new BookingMail($details));
    }

    private function _sendEventMail($eventDetails)
    {
        $details = [
            'event_details' => $eventDetails['event_details'],
            'schedule_at' => $eventDetails['event_date'] . ' ' . $eventDetails['event_time'],
        ];
        $guest_emails = explode(',', $eventDetails['guest_emails']);
        foreach ($guest_emails as $email) {
            Mail::to($email)->send(new EventMail($details));
        }
    }
    public function getSettings($key = null)
    {
        if ($key) {
            $keys = explode(',', $key);
            $settings = Settings::select('key', 'value')->whereIn('key', $keys)->get();
            return response()->json([
                'msg' => 'Settings fetched successfully!',
                'data' => $settings
            ], 200);
        }
        $settings = Settings::select('key', 'value')->get();
        return response()->json([
            'msg' => 'Settings fetched successfully!',
            'data' => $settings
        ], 200);
    }

    public function sendEmail(Request $request)
    {
        $emails = $request->input('emails'); // Assuming 'emails' is a comma-separated list

        if (empty($emails)) {
            return response()->json(['error' => 'Please select at least one customer to send an email.'], 400);
        }

        try {
            foreach ($emails as $email) {
                $details = [
                    'title' => 'Test Email',
                    'name' => 'Customer Name', // Replace with actual data if available
                    'phone' => '123-456-7890', // Replace with actual data if available
                    'email' => $email,
                    'schedule_at' => now(), // Replace with actual data if available
                ];
                Mail::to($email)->send(new CustomerMail($details));
            }
            return response()->json(['success' => 'Emails sent successfully!']);
        } catch (\Exception $e) {
            Log::error('Error sending emails: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while sending emails.'], 500);
        }
    }

    //updateBooking
    public function updateBooking(Request $request, $id)
    {
        $booking = Book::find($id);

        if (!$booking) {
            return response()->json([
                'msg' => 'Booking not found!',
                'data' => null
            ], 404);
        }
        //save is_seen as 1
        $booking->is_seen = 1;
        $booking->save();

        return response()->json([
            'msg' => 'Booking updated successfully!',
            'data' => $booking
        ], 200);
    }
}
