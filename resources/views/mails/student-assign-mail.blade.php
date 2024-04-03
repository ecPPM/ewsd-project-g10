<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Allocation Notification</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <table class="w-full max-w-sm mx-auto mt-10 bg-white shadow-md rounded-lg overflow-hidden">
        <tr>
            <td class="px-6 py-4">
                <div>
                    <h2 class="main-title text-center text-blue-500">LOGO</h2>
                </div>
                <h2 class="mt-6 text-2xl font-semibold text-center">Allocated Student: {{ $body['student'] }}</h2>

                <p class="mt-4 text-sm text-gray-700">Congratulations! You have been allocated as the tutor for {{ $body['student'] }} for the duration of the course. Your expertise and willingness to help make you an invaluable resource for {{ $body['student'] }}'s learning journey.</p>

                <p class="mt-6 text-sm text-gray-700">Please reach out to {{ $body['student'] }} to introduce yourself and offer your support. As their tutor, you play a crucial role in their success, and your guidance and assistance will greatly benefit their learning experience.</p>

                <p class="mt-6 text-sm text-gray-700">If you have any questions or need any assistance in your role as a tutor, please do not hesitate to contact us. We are here to support you in your efforts to help {{ $body['student'] }} succeed.</p>


                <p class="mt-2 text-sm text-gray-700">Thanks,<br>{{ config('app.name') }}</p>
            </td>
        </tr>
    </table>
</body>
</html>
