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
        <div class="min-h-screen bg-gray-100 flex">
            <!-- Notifications -->
            <div>
                @foreach (['success', 'error', 'warning', 'info', 'deleted'] as $type)
                    @if(session($type))
                        <x-notification :type="$type" :message="session($type)" />
                    @endif
                @endforeach
            </div>

            <!-- Sidebar -->
            <x-sidebar
                bgColor="bg-blue-900"
                borderColor="border-blue-800"
                textColor="text-white"
                hoverColor="bg-blue-800"
                title="IQA Navigation">

                <x-sidebar-menu-item icon="dashboard" href="{{ route('iqa.dashboard') }}">
                    Dashboard
                </x-sidebar-menu-item>

                <x-sidebar-menu-item icon="people" href="{{ route('iqa.users.index') }}">
                    Users
                </x-sidebar-menu-item>

                <x-sidebar-menu-item icon="description" href="#">
                    Documents
                </x-sidebar-menu-item>

                <x-sidebar-menu-item icon="bar_chart" href="#">
                    Reports
                </x-sidebar-menu-item>
            </x-sidebar>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col">
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
                    'portalTitleClass' => 'text-white font-semibold text-lg border-l border-blue-500 pl-6',
                    'roleBadge' => strtoupper(Auth::user()->user_type),
                    'roleBadgeClass' => 'bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-md',
                    'linkClass' => 'text-blue-100 hover:text-white hover:border-blue-300 focus:outline-none focus:text-white focus:border-blue-300 border-b-2 border-transparent',
                    'responsiveLinkClass' => 'text-blue-100 hover:text-white hover:bg-blue-700',
                    'additionalLinks' => [
                        // ['route' => 'iqa.users', 'label' => 'Manage Users'],
                        // ['route' => 'iqa.documents', 'label' => 'Documents'],
                        // ['route' => 'iqa.reports', 'label' => 'Reports']
                    ]
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
                <main class="flex-1">
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
