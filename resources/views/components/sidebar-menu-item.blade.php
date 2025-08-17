<!-- filepath: resources/views/components/sidebar-menu-item.blade.php -->
<li class="px-4 py-2 hover:{{ $hoverColor }} rounded transition-all flex items-center justify-center" :class="{ 'justify-start': open }">
    <a href="{{ $href }}" class="flex items-center w-full">
        <span class="material-icons mr-2" :class="{ 'mx-auto': !open, 'mr-2': open }">{{ $icon }}</span>
        <span x-show="open">{{ $slot }}</span>
    </a>
</li>