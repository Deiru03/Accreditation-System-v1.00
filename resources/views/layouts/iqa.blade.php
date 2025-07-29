<!-- filepath: c:\xampp\htdocs\clients-project\Accreditation-Web-v1\resources\views\layouts\iqa.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - IQA Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- IQA Navigation with Blue Theme -->
            @include('layouts.navigation', [
                'navClass' => 'bg-blue-800 border-b border-blue-700',
                'logoClass' => 'text-white',
                'buttonClass' => 'text-blue-100 bg-blue-800 hover:text-white hover:bg-blue-700',
                'hamburgerClass' => 'text-blue-200 hover:text-white hover:bg-blue-700',
                'responsiveBorderClass' => 'border-blue-600',
                'responsiveTextClass' => 'text-white',
                'responsiveSubTextClass' => 'text-blue-200',
                'portalTitle' => 'IQA Admin Panel',
                'roleBadge' => 'IQA ADMIN'
            ])

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-blue-700 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="text-white">{{ $header }}</div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
