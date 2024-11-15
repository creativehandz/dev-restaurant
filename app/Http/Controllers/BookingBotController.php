<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;
use App\Models\Book;
use App\Models\Settings;
use DateTime;
use Carbon\Carbon;

class BookingBotController extends Controller
{
    protected $twilio;

    public function __construct()
    {
        Log::debug('Whatsapp::BookingBotController|__construct|Initializing Twilio Client');
        $this->twilio = new Client(
            "ACbd7e764023873bc031f326cd39d47099",
            "5a057ff35ffdd1ec2332d660f4b27bcf"
        );
    }

    public function handleIncomingMessage(Request $request)
    {
        // $request->validate([
        //     'From' => 'required|string',
        //     'Body' => 'required|string',
        // ]);

        // if ($request->fails()) {
        //     Log::error('Whatsapp::BookingBotController|handleIncomingMessage|Validation Error', [
        //         'errors' => $request->errors(),
        //     ]);
        //     return response()->json(['error' => $request->errors()], 400);
        // }

        $from = $request->input('From');
        $body = trim($request->input('Body'));
        Log::debug('Whatsapp::BookingBotController|handleIncomingMessage|State|', [
            'session' => $request->session()->all(),
            'message' => $body,
        ]);

        // Determine the current step based on session
        $currentStep = $request->session()->get('current_step', 'start');

        if (strtolower($body) === 'hi') {
            $this->sendWelcomeMessage($from);
            $request->session()->put('current_step', 'welcome');
        } elseif ($currentStep === 'welcome' && $body === '1') {
            $this->sendMenuOptions($from);
            $request->session()->put('current_step', 'menu');
        } elseif ($currentStep === 'menu' && $body === '0') {
            $this->sendCancelMessage($from);
            $request->session()->forget('current_step');
        } elseif ($currentStep === 'welcome' && $body === '2' || $currentStep === 'menu' && $body === '2') {
            $this->sendPeopleOptions($from);
            $request->session()->put('current_step', value: 'people');
        } elseif ($currentStep === 'people' && $this->isPeopleOption($body)) {
            $request->session()->put('people', $this->parsePeopleOption($body));
            $this->sendDateOptions($from);
            $request->session()->put('current_step', 'date');
        } elseif ($currentStep === 'date' && $this->isDateOption($body)) {
            $request->session()->put('date', $this->parseDateOption($body));
            $this->sendTimeOptions($request, $from);
            $request->session()->put('current_step', 'time');
        } elseif ($currentStep === 'time' && $this->isTimeOption($body, $request->session()->get('selectedDay'))) {
            $request->session()->put('time', $this->parseTimeOption($body, $request->session()->get('selectedDay')));
            $this->askPromoCode($from); // Ask for the user's name
            $request->session()->put('current_step', 'promoCode');
        } elseif ($currentStep === 'promoCode' && $body === '1') {
            $request->session()->put('promoCode', $this->parsePromoCode($body));
            $this->askForPromo($from); // Ask for the user's name
            $request->session()->put('current_step', 'promo');
        } elseif ($currentStep === 'promoCode' && $body === '2') {
            $request->session()->put('promoCode', $this->parsePromoCode($body));
            $this->askForName($from); // Ask for the user's name
            $request->session()->put('current_step', 'name');
        } elseif ($currentStep === 'promo') {
            $request->session()->put('promo', $body);
            $this->askForName($from); // Ask for the user's name
            $request->session()->put('current_step', 'name');
        } elseif ($currentStep === 'name') {
            $request->session()->put('firstname', $body);
            $this->askForEmail($from); // Ask for the user's email (optional)
            $request->session()->put('current_step', 'email');
        }  elseif ($currentStep === 'email') {
            if (!empty($body) && filter_var($body, FILTER_VALIDATE_EMAIL)) {
                $request->session()->put('email', $body);
            }
            $this->finalizeBooking($request, $from);
            $request->session()->forget('current_step'); // Clear the session step after finalizing
        } else {
            $this->sendMessage($from, "Sorry, I didn't understand that. Please start again by saying 'Hi'.");
            $request->session()->forget('current_step'); // Reset if there's an error
        }
        return response()->json([
            'success' => true,
            'message' => 'WhatsApp message sent successfully!',
        ]);
    }

    private function sendWelcomeMessage($to)
    {
        $message = "Welcome to Restaurant.\n";
        $this->sendMessage($to, $message);

        $message = "Please choose an option:\n";
        $options = $this->getWelcomeOptions();
        foreach ($options as $key => $option) {
            $message .= "$key. $option\n"; 
        }
        $this->sendMessage($to, $message);
    }

    private function sendMenuOptions($to)
    {
        // Set the Menu PDF URL and send it to the user
        $menuLink = asset('pdf/menu.pdf'); // Replace your menu PDF file
    
        // Send media and check if it was successful
        if ($this->sendMedia($to, $menuLink)) {
            // Only send the next message after the media is sent successfully
            $message = "Press 2 for reservation. Press 0 to end\n";
    
            $options = $this->getMenuOptions();
            foreach ($options as $key => $option) {
                $message .= "$key. $option\n"; 
            }
    
            sleep(2);
            // Send the text message
            $this->sendMessage($to, $message);
        } else {
            // Handle the failure to send media, if needed
            Log::error("Failed to send media to $to");
        }
    }

    private function sendCancelMessage($to)
    {
        $message = "Thank you very much, We hope to hear from you again.\n";
        $this->sendMessage($to, $message);
    }

    private function sendPeopleOptions($to)
    {
        $message = "Thank you for sharing your interest. Restaurant warmly welcomes you!";
        //$this->sendMessage($to, "Test message.");
        $this->sendMessage($to, $message);
        // $message = "How many guests are you planning to have at your party?\n1. 2 pax\n2. 3 pax\n3. 4 pax";
        // $this->sendMessage($to, $message);
        $options = $this->getPeopleOptions();
        $message = "How many guests are you planning to have at your party? Please choose an option:\n";
        foreach ($options as $key => $option) {
            $message .= "$key. $option\n"; 
        }
        $this->sendMessage($to, $message);
    }

    private function parsePeopleOption($option)
    {
        $peopleOptions = $this->getPeopleOptions();
        return $peopleOptions[$option] ?? null;
    }

    private function sendDateOptions($to)
    {
        $options = $this->getDateOptions();
        $message = "Great! Please choose a date for your booking:\n";
        foreach ($options as $key => $option) {
            $message .= "$key. $option\n";
        }
        $this->sendMessage($to, $message);
    }

    private function sendTimeOptions(Request $request, $to)
    {
        
        $date = null;
        $day = $request->session()->get('date');
        // Determine the date based on the selected value
           // Determine the date based on the selected value
        if ($day === "Today") {
            $date = Carbon::now(); // Today's date
        } elseif ($day === "Tomorrow") {
            $date = Carbon::now()->addDay(); // Tomorrow's date
        } else {
            $date = Carbon::createFromFormat('l, F j', $day); // Specific date from dropdown
        }

        // Get the day of the week
        $selectedDay = $date->format('l'); // 'l' returns full textual representation of the day of the week

        $request->session()->put('selectedDay', $selectedDay);

        $options = $this->getTimeOptions($selectedDay);
        $message = "Thank you! What time would you like to book? Please choose an option:\n";
        foreach ($options as $key => $option) {
            $message .= "$key. $option\n";
        }
        $this->sendMessage($to, $message);
    }

    private function finalizeBooking(Request $request, $to)
    {
        $people = $request->session()->get('people');
        $date = $request->session()->get('date');
        $time = $request->session()->get('time');
        $promoCode = $request->session()->get('promoCode');
        $promo = $request->session()->get('promo');
        $name = $request->session()->get('firstname');
        $email = $request->session()->get('email');

         // Split name into firstname and lastname
        $nameParts = explode(' ', $name, 2); // Split into at most 2 parts
        $firstname = $nameParts[0];
        $lastname = isset($nameParts[1]) ? $nameParts[1] : null;

        //log all session values
        Log::debug('Whatsapp::BookingBotController|finalizeBooking|Session|', [
            'session' => $request->session()->all(),
        ]);

        $message = "Booking received! Here are your details:\n- Name: $name\n- People: $people\n- Date: $date\n- Time: $time\n";
        if (!empty($email)) {
            $message .= "- Email: $email\n";
        }
        $message .= "Thank you for booking with us!";
        $this->sendMessage($to, $message);

        // Here, you could save the booking to the database if needed.
        $to = str_replace('whatsapp:', '', $to);
        $formattedDate = $this->convertDateString($date);
        $booking = new Book();
        $booking->person = $people;
        $booking->date = $formattedDate ?? NULL;
        $booking->time = date('H:i:s', strtotime($time));
        $booking->phone = $to;
        $booking->promoCode = $promoCode;
        $booking->promo = $promo;
        $booking->firstname = $firstname;
        $booking->lastname = $lastname; // Save lastname if available
        $booking->email = $email;
        $booking->source = 'whatsapp';
        $booking->save();
    }

    private function getWelcomeOptions()
    {
        $datas = [];
        $datas['1'] = 'For Menu';
        $datas['2'] = 'For Reservation';

        return $datas;
    }

    private function getMenuOptions()
    {
        $datas = [];
        $datas['2'] = 'For Reservation';
        $datas['0'] = 'to end';

        return $datas;
    }
    
    private function getPeopleOptions()
    {
        return [
            '1' => '2 pax',
            '2' => '3 pax',
            '3' => '4 pax',
            '4' => '5 pax',
            '5' => '6 pax',
            '6' => '7 pax',
            '7' => '8 pax',
            '8' => '9 pax',
            '9'=> '10 pax',
            '10'=> 'more than 10 pax',
        ];
    }

    private function parsePromoCode($option)
    {
        $promoCode = $this->getPromoCodeOptions();
        return $promoCode[$option] ?? null;
    }

    private function getDateOptions()
    {
        $dates = [];
        $today = Carbon::now();
        $dates['1'] = 'Today';
        $dates['2'] = 'Tomorrow';

        for ($i = 2; $i < 7; $i++) {
            $date = $today->copy()->addDays($i);
            $dates[$i + 1] = $date->format('l, F j');
        }

        return $dates;
    }

    private function getTimeOptions($day)
    {
        // Fetch the time schedule data from the API
        $url = "https://tfcmockup.com/admin/api/settings";
        $response = file_get_contents($url); // or use cURL for more options
        $data = json_decode($response, true); // Decode the JSON response
    
        // Find the time schedule
        $time_schedule = null;
        foreach ($data['data'] as $item) {
            if ($item['key'] === 'time_schedule') {
                $time_schedule = json_decode($item['value'], true);
                break;
            }
        }
    
        // Return an empty array if no time schedule is found
        if ($time_schedule === null) {
            return [];
        }
    
        // Get time slots for the specified day
        $dayKey = strtolower(string: $day);
        $timeSlots = $time_schedule[$dayKey] ?? null;
        if (!$timeSlots) {
            return [];
        }
    
        // Extract start and end time
        $startTime = explode(":", $timeSlots['start_time']);
        $endTime = explode(":", $timeSlots['end_time']);
    
        // Generate time slots (30-minute intervals)
        $startDateTime = new DateTime();
        $startDateTime->setTime((int)$startTime[0], (int)$startTime[1]);
        
        $endDateTime = new DateTime();
        $endDateTime->setTime((int)$endTime[0], (int)$endTime[1]);
    
        $times = $this->generateTimeSlots($startDateTime, $endDateTime, 30);
    
        return $times;
    }
    
    private function generateTimeSlots($start, $end, $interval)
    {
        $timeSlots = [];
        $current = clone $start; // Clone to avoid modifying the original start time
        $index = 1; // Start index from 1
    
        while ($current <= $end) {
            $timeString = $current->format('g:i A'); // Format time as "1:00 PM"
            $timeSlots[$index] = $timeString; // Assign to associative array
            $current->modify("+{$interval} minutes");
            $index++; // Increment index
        }
    
        return $timeSlots;
    }

    private function getPromoCodeOptions()
    {
        return 
        [
            "1"=> "Yes",
            "2"=> "No",
        ];
    }

    private function getTimeScheduleFromSettings()
    {
        $timeSchedule = [];
        $settings = $this->getSettings('time_schedule');

        foreach ($settings as $setting) {
            $timeSchedule[] = json_decode($setting->value);
        }

        return $timeSchedule;
    }

    private function askPromoCode($to)
    {
        $options = $this->getPromoCodeOptions();
        $message = "Do you have promo code?\n";
        foreach ($options as $key => $option) {
            $message .= "$key. $option\n";
        }
        $this->sendMessage($to, $message);
    }

    private function askForPromo($to)
    {
        $message = "Please provide your promoCode";
        $this->sendMessage($to, $message);
    }

    private function askForName($to)
    {
        $message = "Please provide your name to complete the booking.";
        $this->sendMessage($to, $message);
    }
    
    private function askForEmail($to)
    {
        $message = "If you'd like to receive a confirmation email, please provide your email address. Otherwise, just type 'no' or leave it blank.";
        $this->sendMessage($to, $message);
    }

    private function parseDateOption($option)
    {
        $options = $this->getDateOptions();
        return $options[$option] ?? null;
    }

    private function isPeopleOption($option)
    {
        return array_key_exists($option, $this->getPeopleOptions());
    }

    private function isDateOption($option)
    {
        return in_array($option, range(1, 7));
    }

    private function isTimeOption($option, $day)
    {
        return array_key_exists($option, $this->getTimeOptions($day));
    }

    private function isPromoCode($option)
    {
        return array_key_exists($option, $this->getPromoCodeOptions());
    }

    private function parseTimeOption($option, $day)
    {
        $options = $this->getTimeOptions($day);
        return $options[$option] ?? null;
    }

    private function convertDateString($dateString)
    {
        if ($dateString === 'Today') {
            return Carbon::now()->format('Y-m-d');
        } elseif ($dateString === 'Tomorrow') {
            return Carbon::now()->addDay()->format('Y-m-d');
        } else {
            // Create a DateTime object from the date string
            $dateObject = DateTime::createFromFormat('l, F j', $dateString);

            // Get the current year
            $currentYear = (int)date('Y');

            // Set the year to the current year
            $dateObject->setDate($currentYear, $dateObject->format('m'), $dateObject->format('d'));

            // Check if the date has already passed this year
            if ($dateObject < new DateTime()) {
                // If the date has passed, set the year to the next year
                $dateObject->modify('+1 year');
            }

            // Convert the date to the desired format
            return $dateObject->format('Y-m-d');
        }
    }

    private function sendMessage($to, $message, $content_sid = '')
    {
        // Ensure the 'to' number is correctly formatted
        if (strpos($to, 'whatsapp:') !== 0) {
            $to = 'whatsapp:' . $to;
        }
        try {
            $this->twilio->messages->create($to, [
                'from' => 'whatsapp:+12086035451',
                'MessagingServiceSid' => 'MG9ee5a5006166cfad39ca7adf8a59a481',
                'ContentSid' => $content_sid, //'HXd84dec9a4b999580495d65b5a195cd75',
                'body' => $message,
            ]);
            //Log::debug('Whatsapp::BookingBotController|sendMessage|Success|' . $to, ['message' => $message]);
        } catch (\Exception $e) {
            Log::error('Whatsapp::BookingBotController|sendMessage|Failure|' . $to, [
                'error' => $e->getMessage(),
                'code' => $e->getCode(), // Log error code
                'response' => $e->getTraceAsString() // Optional: more detailed stack trace
            ]);
        }
    }

    private function sendMedia($to, $url, $content_sid = '')
    {
        // Ensure the 'to' number is correctly formatted
        if (strpos($to, 'whatsapp:') !== 0) {
            $to = 'whatsapp:' . $to;
        }
        try {
            $this->twilio->messages->create($to, [
                'from' => 'whatsapp:+12086035451',
                'MessagingServiceSid' => 'MG9ee5a5006166cfad39ca7adf8a59a481',
                'ContentSid' => $content_sid,
                'body' => 'Please check this file',
                'mediaUrl' => [$url]
            ]);
            return true; // Return true on success
        } catch (\Exception $e) {
            Log::error('Whatsapp::BookingBotController|sendMedia|Failure|' . $to, [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'response' => $e->getTraceAsString()
            ]);
            return false; // Return false on failure
        }
    }

    private function getSettings($key = null)
    {
        if ($key) {
            $keys = explode(',', $key);
            $settings = Settings::select('key', 'value')->whereIn('key', $keys)->get();
        }
        $settings = Settings::select('key', 'value')->get();
        return $settings;
    }
}
