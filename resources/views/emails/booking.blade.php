<!DOCTYPE html>
<html>

<head>
    <title>Booking Received.</title>
</head>

<body>
    <div style="width:100%; ">
        <div style="background:#000; text-align:center;     border: 1px solid #000;     width: 100%; padding: 16px 0px;"><img src="https://tfcmockup.com/admin/img/main-logo-v9.png" alt="" height="50" /></div>
        <div class="email-body" style="    border: 1px solid #000; width: 100%; padding: 10px 0;">
            <h3 style="text-align:center;">New Booking Received</h3>
            <table style="width:70%; margin:0 auto;">
                <tr>
                    <td>Name</td>
                    <td>{{ $details['title'] }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>{{ $details['phone'] }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $details['email'] }}</td>
                </tr>
                <tr>
                    <td>Date and Time</td>
                    <td>{{ $details['schedule_at'] }}</td>
                </tr>

            </table>
        </div>
    </div>
</body>

</html>