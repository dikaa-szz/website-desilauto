@props(['car'])

@php
    $photo = $car->getFirstMediaUrl('photos', 'thumb');
@endphp

<a href="{{ route('cars.show', $car) }}"
   class="group block overflow-hidden rounded-xl border bg-white shadow-sm transition hover:shadow-md">
    <div class="relative aspect-[4/3] overflow-hidden bg-gray-100">
        @if ($photo)
            <img src="{{ $photo }}" alt="{{ $car->title }}" loading="lazy"
                 class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
        @else
            <div class="flex h-full items-center justify-center text-sm text-gray-400">Belum ada foto</div>
        @endif
        <x-status-badge :status="$car->status" class="absolute left-2 top-2" />
    </div>

    <div class="p-4">
        <h3 class="line-clamp-1 font-semibold">{{ $car->title }}</h3>
        <p class="mt-1 text-lg font-bold text-amber-600">{{ $car->price_formatted }}</p>
        <p class="mt-2 text-sm text-gray-500">
            {{ $car->year }} &middot; {{ $car->transmission->getLabel() }}
            @if ($car->mileage)
                &middot; {{ number_format($car->mileage, 0, ',', '.') }} km
            @endif
        </p>
    </div>
</a>