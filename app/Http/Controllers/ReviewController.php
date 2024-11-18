<?php

namespace App\Http\Controllers;

use App\Services\GoogleReviewsService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ReviewController extends Controller
{
    protected $googleMyBusinessService;

    public function __construct(GoogleReviewsService $googleMyBusinessService)
    {
        $this->googleMyBusinessService = $googleMyBusinessService;
    }

    public function fetchReviews(Request $request)
    {
        $accountId = '103539474850317255437';
        $locationId = '15960930434339830847'; // Your location ID
        $reviews = $this->googleMyBusinessService->getReviews($accountId, $locationId);

        // Convert reviews to a Laravel collection for sorting
        $reviews = collect($reviews);

        // Format the review time
        foreach ($reviews as $review) {
            $review->humanReadableUpdateTime = Carbon::parse($review->updateTime)->diffForHumans();
        }

        // Get the filter type from the request
        $filter = $request->input('filter');

        // Sort reviews based on the selected filter
        switch ($filter) {
            case 'highest':
                // Sort by highest rating (5 to 1)
                $reviews = $reviews->sortByDesc(function ($review) {
                    return $this->convertRating($review->starRating);
                });
                break;

            case 'lowest':
                // Sort by lowest rating (1 to 5)
                $reviews = $reviews->sortBy(function ($review) {
                    return $this->convertRating($review->starRating);
                });
                break;

            case 'latest':
                // Sort by latest update time
                $reviews = $reviews->sortByDesc('updateTime');
                break;
        }

        // Get total reviews count
        $totalReviews = $reviews->count();

        // Pass the reviews and total reviews to the view
        return view('reviews.index', compact('reviews', 'totalReviews'));
    }

    //dummy google review
    public function index(Request $request)
    {
        //  22 dummy reviews
        $dummyReviews = collect(range(1, 22))->map(function ($i) {

            $names = ['Alice', 'Bob', 'Charlie', 'David', 'Eva', 'Frank', 'Grace', 'Hannah', 'Ivy', 'Jack', 'Liam', 'Mia', 'Noah', 'Olivia', 'Paul', 'Quinn', 'Ruby', 'Sam', 'Tina', 'Uma', 'Vince', 'Will'];
            $comments = [
                "Amazing experience! Will definitely visit again.",
                "Good service, but the food could be better.",
                "Loved the ambiance and the staff was very friendly.",
                "Not worth the price. Expected more.",
                "A hidden gem! Highly recommend.",
                "The service was a bit slow, but overall good.",
                "Food was delicious and the atmosphere was perfect.",
                "Not my cup of tea. Could improve on cleanliness.",
                "Perfect place for a family dinner!",
                "Absolutely loved it. Will come back for sure.",
                "The portions were a bit small, but the quality was excellent.",
                "Great place to hang out with friends. Very cozy!",
                "The music was a bit loud, but the food made up for it.",
                "Service was excellent! The waiter was very attentive.",
                "The decor is beautiful, a very relaxing atmosphere.",
                "Had a wonderful birthday celebration here!",
                "They have an amazing dessert selection.",
                "It was okay, nothing too special.",
                "Highly overpriced for what they offer.",
                "The seafood options are fantastic!",
                "Would recommend trying their pasta dishes!",
                "A decent experience, but I've had better elsewhere."
            ];

             // Create a random timestamp and calculate the human-readable time
        $createdAt = Carbon::now()->subDays(rand(1, 30));
        $humanReadableUpdateTime = $createdAt->diffForHumans();
            
            return (object) [
                'reviewId' => $i,
                'reviewer' => (object) ['displayName' => $names[array_rand($names)]],
                'starRating' => ['FIVE', 'FOUR', 'THREE', 'TWO', 'ONE'][array_rand(['FIVE', 'FOUR', 'THREE', 'TWO', 'ONE'])],
                'comment' => $comments[array_rand($comments)],
                'reviewReply' => rand(0, 1) ? (object) ['comment' => "Thank you for your feedback!"] : null,
                'createdAt' => $createdAt,
                'humanReadableUpdateTime' => $humanReadableUpdateTime,
            ];
        });

        // Get the filter type from the request
        $filter = $request->input('filter');

        // Sort reviews based on the selected filter
        switch ($filter) {
            case 'highest':
                // Sort by highest rating (5 to 1)
                $dummyReviews = $dummyReviews->sortByDesc(function ($review) {
                    return $this->convertRating($review->starRating);
                });
                break;

            case 'lowest':
                // Sort by lowest rating (1 to 5)
                $dummyReviews = $dummyReviews->sortBy(function ($review) {
                    return $this->convertRating($review->starRating);
                });
                break;

            case 'latest':
                // Sort by latest update time (use createdAt for sorting)
                $dummyReviews = $dummyReviews->sortByDesc(function ($review) {
                    return $review->createdAt; // Ensure you're referencing the 'createdAt' property correctly
                });
                break;
        }
        
        // Pass the sorted dummy reviews to the view
        return view('reviews.index', [
            'reviews' => $dummyReviews->values(), // Use `values()` to reset the keys after sorting
            'totalReviews' => $dummyReviews->count(),
        ]);
    }

    //dummy trip advisor
    public function tripAdvisor(Request $request)
    {
        //  22 dummy reviews
        $dummyReviews = collect(range(1, 22))->map(function ($i) {

            $names = ['Alice', 'Bob', 'Charlie', 'David', 'Eva', 'Frank', 'Grace', 'Hannah', 'Ivy', 'Jack', 'Liam', 'Mia', 'Noah', 'Olivia', 'Paul', 'Quinn', 'Ruby', 'Sam', 'Tina', 'Uma', 'Vince', 'Will'];
            $comments = [
                "Amazing experience! Will definitely visit again.",
                "Good service, but the food could be better.",
                "Loved the ambiance and the staff was very friendly.",
                "Not worth the price. Expected more.",
                "A hidden gem! Highly recommend.",
                "The service was a bit slow, but overall good.",
                "Food was delicious and the atmosphere was perfect.",
                "Not my cup of tea. Could improve on cleanliness.",
                "Perfect place for a family dinner!",
                "Absolutely loved it. Will come back for sure.",
                "The portions were a bit small, but the quality was excellent.",
                "Great place to hang out with friends. Very cozy!",
                "The music was a bit loud, but the food made up for it.",
                "Service was excellent! The waiter was very attentive.",
                "The decor is beautiful, a very relaxing atmosphere.",
                "Had a wonderful birthday celebration here!",
                "They have an amazing dessert selection.",
                "It was okay, nothing too special.",
                "Highly overpriced for what they offer.",
                "The seafood options are fantastic!",
                "Would recommend trying their pasta dishes!",
                "A decent experience, but I've had better elsewhere."
            ];

             // Create a random timestamp and calculate the human-readable time
        $createdAt = Carbon::now()->subDays(rand(1, 30));
        $humanReadableUpdateTime = $createdAt->diffForHumans();
            
            return (object) [
                'reviewId' => $i,
                'reviewer' => (object) ['displayName' => $names[array_rand($names)]],
                'starRating' => ['FIVE', 'FOUR', 'THREE', 'TWO', 'ONE'][array_rand(['FIVE', 'FOUR', 'THREE', 'TWO', 'ONE'])],
                'comment' => $comments[array_rand($comments)],
                'reviewReply' => rand(0, 1) ? (object) ['comment' => "Thank you for your feedback!"] : null,
                'createdAt' => $createdAt,
                'humanReadableUpdateTime' => $humanReadableUpdateTime,
            ];
        });

        // Get the filter type from the request
        $filter = $request->input('filter');

        // Sort reviews based on the selected filter
        switch ($filter) {
            case 'highest':
                // Sort by highest rating (5 to 1)
                $dummyReviews = $dummyReviews->sortByDesc(function ($review) {
                    return $this->convertRating($review->starRating);
                });
                break;

            case 'lowest':
                // Sort by lowest rating (1 to 5)
                $dummyReviews = $dummyReviews->sortBy(function ($review) {
                    return $this->convertRating($review->starRating);
                });
                break;

            case 'latest':
                // Sort by latest update time (use createdAt for sorting)
                $dummyReviews = $dummyReviews->sortByDesc(function ($review) {
                    return $review->createdAt; // Ensure you're referencing the 'createdAt' property correctly
                });
                break;
        }
        
        // Pass the sorted dummy reviews to the view
        return view('trip-advisor', [
            'reviews' => $dummyReviews->values(), // Use `values()` to reset the keys after sorting
            'totalReviews' => $dummyReviews->count(),
        ]);
    }


    // Convert rating from text to numeric values for sorting
    private function convertRating($starRating)
    {
        return match($starRating) {
            'FIVE' => 5,
            'FOUR' => 4,
            'THREE' => 3,
            'TWO' => 2,
            default => 1,
        };
    }

    public function updateReply(Request $request, $id)
    {
        // Validate reply
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        // Handle the reply submission
        $accountId = '103539474850317255437';
        $locationId = '15960930434339830847'; // Your location ID

        $response = $this->googleMyBusinessService->updateReply($accountId, $locationId, $id, $request->input('comment'), $request->input('updateTime'));

        return redirect()->back()->with('success', 'Reply submitted successfully.');
    }
} 
