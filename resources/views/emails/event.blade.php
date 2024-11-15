<!DOCTYPE html>
<html>
<head>
    <title>Event invitation.</title>
</head>
<body>
    <!-- <h1>{{ $details['schedule_at'] }}</h1>
    <p>{{ $details['event_details'] }}</p> -->
    <div style="width:100%; ">
        <div style="background:#000; text-align:center;     border: 1px solid #000;     width: 600px; padding: 16px 0px;"><img src="https://tfcmockup.com/admin/img/main-logo-v9.png" alt="" height="50" /></div>
        <div class="email-body" style="    border: 1px solid #000; width: 600px; padding: 10px 0;">
            <h3 style="text-align:center;">New event invitation received.</h3>
            <table style="width:70%; margin:0 auto;">
                <tr>
                    <td>Scheduled AT</td>
                    <td>{{ $details['schedule_at'] }}</td>
                </tr>
                <tr>
                    <td>Details</td>
                    <td>{{ $details['event_details'] }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
