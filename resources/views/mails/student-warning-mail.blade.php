<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inactivity Alert</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <table class="w-full max-w-sm mx-auto mt-10 bg-white shadow-md rounded-lg overflow-hidden">
        <tr>
            <td class="px-6 py-4">
                <div>
                    <h2 class="main-title text-center text-blue-500">LOGO</h2>
                </div>
                <h2 class="mt-6 text-2xl font-semibold text-center">Inactivity Alert</h2>
                &nbsp;
                <p class="mt-4 text-sm text-gray-700">Dear {{ $body['student'] }},<br>you have been inactive over 28 days in the etutoring system.<br> Please let us know if you are facing any problem.</p>
                &nbsp;
                <p class="mt-2 text-sm text-gray-700">Thanks,<br>{{ config('app.name') }}</p>
            </td>
        </tr>
    </table>
</body>
</html>

