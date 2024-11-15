<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Events;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        //common utilities
    }

    public function dashboard()
    {
        $events = [];

        $appointments = Book::get();

        foreach ($appointments as $appointment) {
            // $color = $appointment->id == '1' ? 'green' : ($appointment->id == '2' ? 'red' : 'orange');
            $events[] = [
                'title' => $appointment->firstname . ' ' . $appointment->lastname,
                'start' => $appointment->date . ' ' . date('h:i', strtotime($appointment->time)),
                'end' => $appointment->date . ' ' . date('h:i', strtotime($appointment->time)),
                'comments' => $appointment->comments,
                'email' => $appointment->email,
                'phone' => $appointment->phone,
                'person' => $appointment->person,
                'promocode' => $appointment->promocode,
                'occasion' => $appointment->occasion,
                // 'color' => $color,
            ];
        }

        $other_events = Events::get();
        foreach ($other_events as $event) {
            $events[] = [
                'title' => "other event",
                'start' => $event->date . ' ' . date('h:i', strtotime($event->time)),
                'end' => $event->date . ' ' . date('h:i', strtotime($event->time)),
                'comments' => $event->description,
                'email' => $event->emails,
                'color' => '#ff0000',
                // 'backgroundColor' => '#f00', // Set background color
                // 'borderColor' => '#000',  // Set border color
                // 'textColor' => '#fff'    // Set text color
            ];
        }
        
        //Analytics
        $groupedAppointments = $appointments->groupBy(function ($appointment) {
            return date('F Y', strtotime($appointment->date));
        });
        //get total booked event data array as above for each month
        $totalBooked = $groupedAppointments->map(function ($appointments) {
            return $appointments->count();
        });
        $labels = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
        $total_bookings = [];
        foreach ($labels as $label) {
            $monthYear = date('F Y', strtotime($label));
            $count = $totalBooked->get($monthYear, 0);
            $total_bookings[] = $count;
        }

        // Count customers by source (Web, WhatsApp, Admin)
        $webCustomers = $appointments->where('source', 'web')->count();
        $whatsappCustomers = $appointments->where('source', 'whatsapp')->count();
        $adminCustomers = $appointments->where('source', 'admin')->count();

        $ordr = Book::orderBy('id', 'desc')->paginate(15);
        //get unseen orders having source as web for Activities
        $unseens = $appointments->where('source', 'web')->where('is_seen', 0);
        
        return view('auth.dashboard', compact('events', 'total_bookings', 'ordr', 'unseens', 'webCustomers', 'whatsappCustomers', 'adminCustomers'));
    }


    public function calendar()
    {
        $events = [];

        $appointments = Book::get();

        foreach ($appointments as $appointment) {
            // $color = $appointment->id == '1' ? 'green' : ($appointment->id == '2' ? 'red' : 'orange');
            $events[] = [
                'title' => $appointment->firstname . ' ' . $appointment->lastname,
                'start' => $appointment->date . ' ' . date('h:i', strtotime($appointment->time)),
                'end' => $appointment->date . ' ' . date('h:i', strtotime($appointment->time)),
                'comments' => $appointment->comments,
                'email' => $appointment->email,
                'phone' => $appointment->phone,
                'person' => $appointment->person,
                'promocode' => $appointment->promocode,
                'occasion' => $appointment->occasion,
                // 'color' => $color,
            ];
        }
        //get unseen orders having source as web for Activities
        $unseens = $appointments->where('source', 'web')->where('is_seen', 0);
        return view('calendar', compact('events','unseens'));
    }


    /* 
    Analytics function
    @return \Illuminate\Http\Response
    @author Nikunj Dhimar
    */
    public function analytics()
    {
        $appointments = Book::get();
        //create grouping of cancelled and accepted appointments month wise
        $groupedAppointments = $appointments->groupBy(function ($appointment) {
            return date('F Y', strtotime($appointment->date));
        });
        //get total booked event data array as above for each month
        $totalBooked = $groupedAppointments->map(function ($appointments) {
            return $appointments->count();
        });
        $labels = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
        $total_bookings = [];
        foreach ($labels as $label) {
            $monthYear = date('F Y', strtotime($label));
            $count = $totalBooked->get($monthYear, 0);
            $total_bookings[] = $count;
        }
        //get unseen orders having source as web for Activities
        $unseens = $appointments->where('source', 'web')->where('is_seen', 0);
        return view('analytics', compact('total_bookings','unseens'));
    }
}
