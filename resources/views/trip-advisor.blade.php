@extends('layouts.backend')

@section('content')

 <!-- End Breadcrumb -->
 <div class="mb-4">
    <nav aria-label="breadcrumb">
            <h1 class="h3 text-white">Trip Advisor</h1>
            <ol class="breadcrumb bg-transparent small p-0">
                    <li class="breadcrumb-item"><a href="./index.html" class="path-color">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Trip Advisor</li>
            </ol>

            
            {{-- @foreach ($reviews as $review)
                <h3>{{ $review->reviewer->displayName }}</h3>
                <!-- Star rating logic here -->
            @endforeach --}}
    </nav>
</div>
<!-- End Breadcrumb -->

{{-- @if (Session::has('message'))
<div class="alert alert-success" role="alert">
        {{ Session::get('message') }}
</div>
@endif

@if (Session::has('err_message'))
<div class="alert alert-danger" role="alert">
        {{ Session::get('err_message') }}
</div>
@endif --}}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <h1 class="text-golden">Trip Advisor</h1>
    <h2 class="total-review-count">Total Advise: {{ $totalReviews }}</h2>
 

    <form method="GET" action="{{ route('trip-advisor') }}" class="mb-4">
        <div class="form-group">
            <label for="filter" class="text-white">Sort Reviews By</label>
            <select name="filter" id="filter" class="form-control">
                <option value="">Select</option>
                <option value="highest">Highest Rating</option>
                <option value="lowest">Lowest Rating</option>
                <option value="latest">Latest Review</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
    


    <div class="reviews">
    <div class="col-12 col-lg-6">
        @forelse ($reviews as $review)
            <div class="review">
                <div class="mb-4">
                    <div class="card">
                        <div class="card-body-wrap bg-white align-items-center custom-text">
                            <div class="justify-content-between w-100">
                                <div class="col-13 flex-column mr-3">
                                    <h3>{{ $review->reviewer->displayName }}</h3>
                                    <p>
                                        Rating: 
                                        @php
                                            $rating = 0;
                                            if($review->starRating == 'FIVE') {
                                                $rating = 5;
                                            } elseif($review->starRating == 'FOUR') {
                                                $rating = 4;
                                            } elseif($review->starRating == 'THREE') {
                                                $rating = 3;
                                            } elseif($review->starRating == 'TWO') {
                                                $rating = 2;
                                            } else {
                                                $rating = 1;
                                            }
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $rating)
                                                <i class="fas fa-star"></i> <!-- Filled star -->
                                            @else
                                                <i class="far fa-star"></i> <!-- Empty star -->
                                            @endif
                                        @endfor
                                    </p>

                                    <div class="review-text">
                                        <p class="full-text">{{ optional($review)->comment ?: '' }}</p>
                                        <a href="javascript:void(0);" class="show-more" style="display: none;">Show More</a>
                                        <a href="javascript:void(0);" class="show-less" style="display: none;">Show Less</a>
                                    </div>

                                    <!-- Display reply status with checkmark and reply text -->
                                    @if (isset($review->reviewReply))
                                        <div class="reply-status mt-3">
                                            <i class="fas fa-check-circle text-success"></i> <!-- Checkmark icon -->
                                            <strong>Replied:</strong> 
                                            <p class="reply-text">{{ $review->reviewReply->comment }}</p>
                                        </div>
                                    @else
                                        <div class="reply-status mt-3">
                                            <i class="fas fa-times-circle text-danger"></i> <!-- Cross icon if no reply -->
                                            <strong>No Reply Yet</strong>
                                        </div>
                                    @endif

                                    <!-- Reply Button -->
                                    <div class="w-100 d-flex justify-content-end">
                                        <button class="btn btn-primary reply-btn p3" data-review-id="{{ $review->reviewId }}">Reply</button>
                                    </div>

                                    <div class="reply-form" style="display: none;" id="reply-form-{{ $review->reviewId }}">
                                        <form id="reply-form-{{ $review->reviewId }}" data-review-id="{{ $review->reviewId }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="comment">Your Reply:</label>
                                                <textarea name="comment" class="form-control" rows="3" required></textarea>
                                            </div>
                                            <input type="hidden" name="updateTime" class="update-time" value="">
                                            <button type="button" class="btn btn-success submit-reply">Submit Reply</button>
                                            <button type="button" class="btn btn-secondary cancel-reply-btn">Cancel</button>
                                        </form>
                                    </div>
                                    
                                    <p>{{ $review->humanReadableUpdateTime }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>No reviews found.</p>
        @endforelse
    </div>
</div>




@endsection
