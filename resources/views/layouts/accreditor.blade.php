<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Accreditor</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">

            <!-- Accreditor Navigation with Purple Theme -->
            @include('layouts.navigation', [
                'navClass' => 'bg-purple-800 border-b border-purple-700',
                'logoClass' => 'text-white',
                'buttonClass' => 'text-purple-100 bg-purple-800 hover:text-white hover:bg-purple-700',
                'hamburgerClass' => 'text-purple-200 hover:text-white hover:bg-purple-700',
                'responsiveBorderClass' => 'border-purple-600',
                'responsiveTextClass' => 'text-white',
                'responsiveSubTextClass' => 'text-purple-200',
                'portalTitle' => 'Accreditor Panel',
                'portalTitleClass' => 'text-white font-semibold text-lg border-l border-purple-500 pl-6',
                'roleBadge' => strtoupper(Auth::user()->user_type),
                'roleBadgeClass' => 'bg-purple-500 text-white text-xs font-bold px-3 py-1 rounded-md',
                'linkClass' => 'text-purple-100 hover:text-white hover:border-purple-300 focus:outline-none focus:text-white focus:border-purple-300 border-b-2 border-transparent',
                'responsiveLinkClass' => 'text-purple-100 hover:text-white hover:bg-purple-700',
                'additionalLinks' => [
                    // ['route' => 'accreditor.assignments', 'label' => 'Assignments'],
                    // ['route' => 'accreditor.evaluations', 'label' => 'Evaluations'],
                    // ['route' => 'accreditor.documents', 'label' => 'Documents']
                ]
            ])

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-purple-700 shadow">
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
