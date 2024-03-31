{{-- {{ $body['tutor']}} is assigned to {{$body['student'] }} --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Etutor</title>
</head>
<body>
    <div>
        <div class="bg-blue-500 text-white">
            <h2 class="main-title">LOGO</h2>
        </div>

        <div class="my-4 flex items-center justify-between">
            <h6 class="text-lg font-semibold">Allocating to {{ $body['tutor'] }}</h6>
        </div>

        <div class="mb-4 text-sm text-gray-600">
            After careful consideration of various factors including your preferences and our assessment of tutor expertise, we are pleased to inform you that you have been allocated to {{ $body['tutor'] }} as your tutor for the duration of the course.
        </div>

        <div class="mb-4 text-sm text-gray-600">
            Please feel free to reach out to {{ $body['tutor'] }} if you have any questions related to the course or if you require assistance with any aspect of your studies. They are here to help you succeed and are committed to providing you with the support you need to excel in the course.
        </div>

        <div class="mb-4 text-sm text-gray-600">
            We believe that you will benefit greatly from working with {{ $body['tutor'] }} and we are confident that this allocation will contribute positively to your learning experience. If you have any questions or concerngs regarding your allocated tutor, please do not hesitate to contact us.
        </div>

        <div class="mt-4 flex items-center justify-between">

        </div>
    </div>
</body>
</html>
