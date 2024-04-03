<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Allocation Notification</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <table class="w-full max-w-sm mx-auto mt-10 bg-white shadow-md rounded-lg overflow-hidden">
        <tr>
            <td class="px-6 py-4">
                <div>
                    <h2 class="main-title text-center text-blue-500">LOGO</h2>
                </div>
                <h2 class="mt-6 text-2xl font-semibold text-center">Allocating to {{ $body['tutor'] }}</h2>

                <p class="mt-4 text-sm text-gray-700">After careful consideration of various factors including your preferences and our assessment of tutor expertise, we are pleased to inform you that you have been allocated to {{ $body['tutor'] }} as your tutor for the duration of the course.</p>

                <p class="mt-6 text-sm text-gray-700">Please feel free to reach out to {{ $body['tutor'] }} if you have any questions related to the course or if you require assistance with any aspect of your studies. They are here to help you succeed and are committed to providing you with the support you need to excel in the course.</p>

                <p class="mt-6 text-sm text-gray-700">We believe that you will benefit greatly from working with {{ $body['tutor'] }} and we are confident that this allocation will contribute positively to your learning experience. If you have any questions or concerngs regarding your allocated tutor, please do not hesitate to contact us.</p>

                <p class="mt-2 text-sm text-gray-700">Thanks,<br>{{ config('app.name') }}</p>
            </td>
        </tr>
    </table>
</body>
</html>
