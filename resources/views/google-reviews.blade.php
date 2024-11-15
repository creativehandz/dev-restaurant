<!DOCTYPE html>
<html>
<head>
    <title>Google Reviews</title>
</head>
<body>
    <h1>Google Reviews</h1>
    @if(isset($reviews['result']['reviews']))
        <ul>
            @foreach($reviews['result']['reviews'] as $review)
                <li>
                    <strong>{{ $review['author_name'] }}</strong>: {{ $review['text'] }}
                    <br>
                    <em>Rating: {{ $review['rating'] }}/5</em>
                </li>
            @endforeach
        </ul>
    @else
        <p>No reviews found.</p>
    @endif
</body>
</html>
