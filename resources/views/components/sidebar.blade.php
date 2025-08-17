<!-- filepath: resources/views/components/sidebar.blade.php -->
<aside x-data="{ open: true }" class="{{ $bgColor }} {{ $textColor }} w-64 min-h-screen transition-all duration-300" :class="{ 'w-64': open, 'w-16': !open }">
    <div class="flex items-center justify-between mt-1 px-4 py-4 border-b {{ $borderColor }}">
        <span class="font-bold text-lg" x-show="open">{{ $title }}</span>
        <button @click="open = !open" class="focus:outline-none">
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
            </svg>
        </button>
    </div>
    <nav class="mt-4">
        <ul>
            {{ $slot }}
        </ul>
    </nav>
</aside>