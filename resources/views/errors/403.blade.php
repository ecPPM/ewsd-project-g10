
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .bg-gray-100 {
            background-color: #f3f4f6;
        }

        .dark\:bg-gray-900 {
            background-color: #1f2937;
        }

        .flex {
            display: flex;
        }

        .items-top {
            align-items: flex-start;
        }

        .justify-center {
            justify-content: center;
        }

        .min-h-screen {
            min-height: 100vh;
        }

        .sm\:items-center {
            align-items: center;
        }

        .sm\:pt-0 {
            padding-top: 0;
        }

        .max-w-xl {
            max-width: 36rem;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .sm\:px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .lg\:px-8 {
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .pt-8 {
            padding-top: 2rem;
        }

        .sm\:justify-start {
            justify-content: flex-start;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .text-gray-500 {
            color: #6b7280;
        }

        .border-r {
            border-right-width: 1px;
            border-right-color: #d1d5db;
        }

        .tracking-wider {
            letter-spacing: 0.05em;
        }

        .ml-4 {
            margin-left: 1rem;
        }

        .uppercase {
            text-transform: uppercase;
        }

        /* Custom Styles */
        .error-box {
            position: relative;
        }

        .error-box > div {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
            background-color: #ffffff;
            border-radius: 0.375rem;
        }

        .error-number {
            padding: 0.5rem 1rem;
            font-size: 1.5rem;
            border-right: 1px solid #d1d5db;
        }

        .error-message {
            padding: 0.5rem 1rem;
            font-size: 1.5rem;
            text-transform: uppercase;
        }
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    <div class="relative flex items-top justify-center min-h-screen">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider error-number">
                    403
                </div>
                <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider error-message">
                    Forbidden
                </div>
            </div>
        </div>
    </div>
</body>

</html>


