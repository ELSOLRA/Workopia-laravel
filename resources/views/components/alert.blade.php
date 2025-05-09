@props(['type', 'message'])


@if (session()->has($type))
    <div class="{{ $type == 'success' ? 'bg-green-500' : 'bg-red-500' }} mb-4 rounded p-4 text-sm text-white">
        {{ $message }}
    </div>
@endif
