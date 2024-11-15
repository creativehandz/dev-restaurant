<?php

namespace App\Http\Controllers;

use App\Services\GoogleReviewsService;
use Illuminate\Http\Request;

class GoogleReviewsController extends Controller
{
    protected $googleReviewsService;

    public function __construct(GoogleReviewsService $googleReviewsService)
    {
        $this->googleReviewsService = $googleReviewsService;
    }

    public function index()
    {
        $placeId = 'ChIJ_X0tAHFPzDERvOkjWlTuO8s'; // RAFW rest place ID
        $reviews = $this->googleReviewsService->getReviews($placeId);

        return view('google-reviews', ['reviews' => $reviews]);
    }
}
