<!-- resources/views/emails/customer.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Customer Email</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <p>Name: {{ $details['name'] }}</p>
    <p>Phone: {{ $details['phone'] }}</p>
    <p>Email: {{ $details['email'] }}</p>
    <p>Schedule at: {{ $details['schedule_at'] }}</p>
</body>
</html>
