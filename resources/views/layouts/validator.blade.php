<!-- filepath: c:\xampp\htdocs\clients-project\Accreditation-Web-v1\resources\views\layouts\validator.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - VAL Portal</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- VAL Navigation with Green Theme -->
            @include('layouts.navigation', [
                'navClass' => 'bg-green-700 border-b border-green-600',
                'logoClass' => 'text-white',
                'buttonClass' => 'text-green-100 bg-green-700 hover:text-white hover:bg-green-600',
                'hamburgerClass' => 'text-green-200 hover:text-white hover:bg-green-600',
                'responsiveBorderClass' => 'border-green-500',
                'responsiveTextClass' => 'text-white',
                'responsiveSubTextClass' => 'text-green-200',
                'portalTitle' => 'VAL - Validator Portal',
                'portalTitleClass' => 'text-white font-semibold text-lg border-l border-green-500 pl-6',
                'roleBadge' => strtoupper(Auth::user()->user_type),
                'roleBadgeClass' => 'bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-md',
                'linkClass' => 'text-green-100 hover:text-white hover:border-green-300 focus:outline-none focus:text-white focus:border-green-300 border-b-2 border-transparent',
                'responsiveLinkClass' => 'text-green-100 hover:text-white hover:bg-green-600',
                'additionalLinks' => [
                    // ['route' => 'validator.queue', 'label' => 'Validation Queue'],
                    // ['route' => 'validator.documents', 'label' => 'My Documents'],
                    // ['route' => 'validator.history', 'label' => 'History']
                ]
            ])

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-green-600 shadow">
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
