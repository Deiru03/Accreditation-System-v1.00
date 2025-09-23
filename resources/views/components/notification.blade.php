@props(['type' => 'info', 'message'])

@php
    $colors = [
        'success' => 'bg-green-100 border-green-400 text-green-700',
        'error' => 'bg-red-100 border-red-400 text-red-700',
        'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-700',
        'info' => 'bg-blue-100 border-blue-400 text-blue-700',
        'deleted' => 'bg-gray-100 border-gray-400 text-gray-700',
    ];

    $classes = $colors[$type] ?? $colors['info'];
@endphp

@if($message)
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-init="setTimeout(() => show = false, 5000)" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="{{ $classes }} border px-4 py-3 rounded shadow-lg fixed top-5 right-5 z-50"
    >
        {{ $message }}
    </div>
@endif