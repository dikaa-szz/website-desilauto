@props(['status'])

@php
    $classes = match ($status->value) {
        'available' => 'bg-green-500 text-white',
        'booked' => 'bg-yellow-400 text-yellow-950',
        default => 'bg-red-500 text-white',
    };
@endphp

<span {{ $attributes->class(['inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold shadow-sm', $classes]) }}>
    {{ $status->getLabel() }}
</span>