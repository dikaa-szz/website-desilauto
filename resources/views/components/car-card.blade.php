@props(['car'])

@php
    $photo = $car->getFirstMediaUrl('photos', 'thumb');
    $isSold = $car->status === \App\Enums\CarStatus::Sold;

    $transmissionLabel = is_object($car->transmission)
        ? $car->transmission->getLabel()
        : $car->transmission;

    $fuelLabel = is_object($car->fuel_type)
        ? $car->fuel_type->getLabel()
        : $car->fuel_type;
@endphp

<a href="{{ route('cars.show', $car) }}"
   class="group flex flex-col overflow-hidden rounded-2xl bg-white ring-1 ring-slate-200 shadow-sm transition duration-300 hover:-translate-y-1.5 hover:ring-sky-300 hover:shadow-xl hover:shadow-sky-100">
    {{-- Image --}}
    <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
        @if ($photo)
            <img src="{{ $photo }}"
                 alt="{{ $car->title }}"
                 loading="lazy"
                 class="h-full w-full object-cover transition duration-500 group-hover:scale-105 {{ $isSold ? 'grayscale opacity-70' : '' }}">
        @else
            <div class="flex h-full items-center justify-center text-sm text-slate-400">
                Belum ada foto
            </div>
        @endif

        {{-- Badges --}}
        <div class="absolute left-3 top-3 flex flex-wrap gap-1.5">
            <x-status-badge :status="$car->status" />
            @if ($car->is_featured)
                <span class="inline-flex items-center rounded-full bg-sky-500 px-2.5 py-1 text-xs font-semibold text-white shadow-sm">
                    Unggulan
                </span>
            @endif
        </div>
    </div>

    {{-- Content --}}
    <div class="flex flex-1 flex-col p-5">
        <p class="text-xs font-medium uppercase tracking-wider text-slate-400">
            {{ $car->brand->name }}
        </p>
        <h3 class="mt-1 line-clamp-2 text-base font-semibold leading-snug text-slate-900">
            {{ $car->title }}
        </h3>

        <p class="mt-2 text-xs text-slate-500">
            {{ collect([
                $car->mileage ? number_format($car->mileage, 0, ',', '.') . ' km' : null,
                $transmissionLabel,
                $fuelLabel,
            ])->filter()->implode(' · ') }}
        </p>

        <div class="mt-auto flex items-end justify-between pt-4">
            <p class="text-xl font-bold text-sky-600">
                {{ $car->price_formatted }}
            </p>
            <span class="text-xs font-medium text-slate-400 opacity-0 transition group-hover:opacity-100">
                Lihat detail →
            </span>
        </div>
    </div>
</a>