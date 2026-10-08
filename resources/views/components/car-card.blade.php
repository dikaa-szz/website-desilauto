@props(['car'])

@php
    $photo = $car->getFirstMediaUrl('photos', 'thumb');
    $isSold = $car->status === \App\Enums\CarStatus::Sold;
@endphp

<a href="{{ route('cars.show', $car) }}"
   class="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 transition duration-300 hover:-translate-y-1 hover:shadow-xl">
    <div class="relative aspect-[4/3] overflow-hidden bg-gray-100">
        @if ($photo)
            <img src="{{ $photo }}" alt="{{ $car->title }}" loading="lazy"
                 class="h-full w-full object-cover transition duration-500 group-hover:scale-105 {{ $isSold ? 'grayscale' : '' }}">
        @else
            <div class="flex h-full items-center justify-center text-sm text-gray-400">Belum ada foto</div>
        @endif

        <div class="absolute left-3 top-3 flex flex-wrap gap-1.5">
            <x-status-badge :status="$car->status" />
            @if ($car->is_featured)
                <span class="inline-flex items-center rounded-full bg-brand-600 px-2.5 py-1 text-xs font-semibold text-white shadow-sm">
                    Unggulan
                </span>
            @endif
        </div>
    </div>

    <div class="flex flex-1 flex-col p-4">
        <p class="text-xs font-medium uppercase tracking-wide text-gray-400">{{ $car->brand->name }}</p>
        <h3 class="mt-0.5 line-clamp-2 font-semibold leading-snug text-gray-900">{{ $car->title }}</h3>

        <p class="mt-2 text-xs text-gray-500">
            {{ collect([
                $car->mileage ? number_format($car->mileage, 0, ',', '.') . ' km' : null,
                $car->transmission->getLabel(),
                $car->fuel_type->getLabel(),
            ])->filter()->implode(' · ') }}
        </p>

        <p class="mt-auto pt-4 text-xl font-bold text-brand-600">{{ $car->price_formatted }}</p>
    </div>
</a>