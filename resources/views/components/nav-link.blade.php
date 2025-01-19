@props(['url' => '/', 'active' => false, 'icon' => null, 'mobile' => null])

@if ($mobile)
    <a href="{{ $url }}"
        class="{{ $active ? 'text-yellow-500 font-bold' : '' }} block px-4 py-2 hover:bg-blue-700">
        @if ($icon)
            <i class="fa fa-{{ $icon }} mr-1"></i>
        @endif
        {{ $slot }}
    </a>
@else
    <a href="{{ $url }}"
        class="{{ $active ? 'text-yellow-500 font-bold' : '' }} py-2 text-white hover:underline">
        @if ($icon)
            <i class="fa fa-{{ $icon }} mr-1"></i>
        @endif
        {{ $slot }}
    </a>
@endif
