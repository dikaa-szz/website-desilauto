@props(['status'])

@php
    $classes = match ($status->value) {
        'available' => 'bg-green-100 text-green-800',
        'booked' => 'bg-yellow-100 text-yellow-800',
        default => 'bg-red-100 text-red-800',
    };
@endphp

<span {{ $attributes->class(['rounded-full px-2.5 py-0.5 text-xs font-medium', $classes]) }}>
    {{ $status->getLabel() }}
</span>