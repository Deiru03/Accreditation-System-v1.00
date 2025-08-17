<!-- filepath: c:\xampp\htdocs\clients-project\Accreditation-Web-v1\resources\views\layouts\app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <!-- Default Navigation -->
        @include('layouts.navigation', [
            'navClass' => 'bg-white border-b border-gray-100',
            'logoClass' => 'text-gray-800',
            'buttonClass' => 'text-gray-500 bg-white hover:text-gray-700',
            'hamburgerClass' => 'text-gray-400 hover:text-gray-500 hover:bg-gray-100',
            'responsiveBorderClass' => 'border-gray-200',
            'responsiveTextClass' => 'text-gray-800',
            'responsiveSubTextClass' => 'text-gray-500',
            'portalTitle' => 'Default Portal',
            'portalTitleClass' => 'text-gray-800 font-semibold text-lg border-l border-gray-300 pl-6',
            'roleBadge' => strtoupper(Auth::user()->user_type),
            'roleBadgeClass' => 'bg-gray-500 text-white text-xs font-bold px-3 py-1 rounded-md',
            'linkClass' => 'text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 border-b-2 border-transparent',
            'responsiveLinkClass' => 'text-gray-600 hover:text-gray-800 hover:bg-gray-50'
        ])

        <div class="min-h-screen bg-gray-100 flex">
            <!-- Sidebar -->
            <x-sidebar 
                bgColor="bg-white"
                borderColor="border-gray-200"
                textColor="text-gray-800"
                hoverColor="bg-gray-100"
                title="Navigation">
                
                <x-sidebar-menu-item icon="dashboard" href="{{ route('dashboard') }}">
                    Dashboard
                </x-sidebar-menu-item>
                
                <x-sidebar-menu-item icon="account_circle" href="#">
                    Profile
                </x-sidebar-menu-item>
                
                <x-sidebar-menu-item icon="settings" href="#">
                    Settings
                </x-sidebar-menu-item>
                
                <x-sidebar-menu-item icon="help_outline" href="#">
                    Help
                </x-sidebar-menu-item>
            </x-sidebar>

            <!-- Main Content Area -->
            <div class="flex-1">
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="p-4">
                    {{ $slot }}
                </main>
            </div>
        </div>

        <!-- Alpine.js for sidebar toggle -->
        <script src="//unpkg.com/alpinejs" defer></script>
        <!-- Material Icons (optional, for icons in sidebar) -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </body>
</html>
