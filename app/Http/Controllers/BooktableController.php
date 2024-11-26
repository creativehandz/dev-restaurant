<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;

class BooktableController extends Controller
{
    public function index()
    {
        return view('order');
    }

    public function store(Request $request)
    {
        Log::info('Data received in store:', $request->all());
        $valdi = $request->validate([
            'person' => 'required',
            'date' => 'required',
            'time' => 'required',
            'firstname' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'lastname' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'phone' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'occasion' => 'required',
            'promocode' => 'required',
        ]);

        if ($valdi) {
            Book::create([
                'person' => $request->person,
                'date' => $request->date,
                'time' => $request->time,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'fullname' => $request->firstname . ' ' . $request->lastname,
                'phone' => $request->phone,
                'countryCode' => $request->countryCode,
                'email' => $request->email,
                'occasion' => $request->occasion,
                'comments' => $request->comment,
                'promocode' => $request->promocode,
            ]);

            return Response::json([
                'success' => 'true',
                'msg' => "Booking added successfully!!",
            ]);
        } else {
            return Redirect::back()->withErrors('message');
        }
    }

    public function list(Request $request)
    {
        if ($request->method() == 'POST') {
            $search = $request->input('search');
            $fromDate = $request->input('fromdate');
            $toDate = $request->input('todate');
            $promocode = $request->input('promocode');

            $orders = Book::orderBy('id', 'DESC')
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q
                            ->where('firstname', 'like', '%' . $search . '%')
                            ->orWhere('lastname', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%')
                            ->orWhere('phone', 'like', '%' . $search . '%');
                    });
                })
                ->when($fromDate, function ($query) use ($fromDate) {
                    $query->whereDate('date', '>=', $fromDate);
                })
                ->when($toDate, function ($query) use ($toDate) {
                    $query->whereDate('date', '<=', $toDate);
                })
                ->when($promocode, function ($query) use ($promocode) {
                    $query->where('promocode', $promocode);
                })
                ->paginate(15);

            $search_inputs = $request->all();
            return view(
                'book.reservation-list',
                compact('orders', 'search_inputs')
            );
        }
        $orders = Book::orderBy('id', 'DESC')->paginate(15);
        $search_inputs = $request->all();

        $unseens = Book::where('source', 'web')
            ->where('is_seen', 0)
            ->limit(5)
            ->get();
        return view(
            'book.reservation-list',
            compact('orders', 'search_inputs', 'unseens')
        );
    }

    public function show($id)
    {
        $od = Book::where('id', $id)->first();
        return Response::json(['success' => 'true', 'od' => $od]);
    }

    public function editor($id)
    {
        $od = Book::where('id', $id)->first();
        return Response::json(['success' => 'true', 'od' => $od], 200);
    }

    public function update(Request $request)
    {
        $record = Book::where('id', $request->id)->first();
        $ty = $record->update([
            'person' => $request->person,
            'date' => $request->date,
            'time' => $request->time,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'occasion' => $request->occasion,
            'comments' => $request->comment,
            'promocode' => $request->promocode,
        ]);

        if ($ty) {
            return Response::json([
                'success' => 'true',
                'msg' => "Booking updated successfully!!",
            ]);
        } else {
            return false;
        }

        //return view('book.reservation-list',compact('ordr'));
    }

    public function customerlist(Request $request)
    {
        $ordr = Book::orderBy('id', 'desc')->paginate(15);
        //$ordr = $ordr->sortByDesc('id');
        // $formattedDate = [];
        // foreach($ordr as $ord){
        //     $formattedDate['']= Carbon::parse($ordr[0]->created_at)->format('l-d-M');
        // }
        //get unseen orders having source as web for Activities
        $unseens = $ordr->where('source', 'web')->where('is_seen', 0);
        return view('book.customers-list', compact('ordr', 'unseens'));
    }

    public function setting(Request $request)
    {
        $ordr = Book::get();
        return view('book.setting-list', compact('ordr'));
    }

    public function acceptBooking(Request $request)
    {
        $id = $request->id;
        Book::where('id', $id)->update(['status' => '1']);
        return Response::json(['success' => 'true'], 200);
    }

    public function cancelBooking(Request $request)
    {
        $id = $request->id;
        Book::where('id', $id)->update(['status' => '2']);
        return Response::json(['success' => 'true'], 200);
    }

    public function getTodayRecords(Request $request)
    {
        $today = date("Y-m-d");
        $orders = Book::whereDate('date', $today)->paginate(15);
        return view('book.reservation-list', compact('orders'));
    }
}
