<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Schedule Notification</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <table class="w-full max-w-sm mx-auto mt-10 bg-white shadow-md rounded-lg overflow-hidden">
        <tr>
            <td class="px-6 py-4">
                <div>
                    <h2 class="main-title text-center text-blue-500">LOGO</h2>
                </div>
                <h2 class="mt-6 text-2xl font-semibold text-center">Schedule Details for Upcoming Meeting</h2>
                &nbsp;
                <p class="mt-4 text-sm text-gray-700">Dear student,<br>Your tutor has scheduled a meeting. Please respond in the ETUTOR system.</p>
                &nbsp;

                <div class="w-80 mx-auto bg-gray-200 p-6 rounded-lg">
                    <ul class="text-left">
                        <li class="py-2"><p class="fond-bold">Title: {{ $body->title }}</p></li>
                        <li class="py-2"><p class="fond-bold">Mode: {{ $body->mode }}</p></li>
                        <li class="py-2"><p class="fond-bold">Location/Link: {{$body->location }}{{$body->invitation_link }}</p></li>
                        <li class="py-2"><p class="fond-bold">Time: {{ $body->formattedTime}}</p></li>
                    </ul>
                </div>
                &nbsp;


                <p class="mt-2 text-sm text-gray-700">Thanks,<br>{{ config('app.name') }}</p>
            </td>
        </tr>
    </table>
</body>
</html>
