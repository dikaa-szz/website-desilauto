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

    $meta = collect([
        $car->mileage ? number_format($car->mileage, 0, ',', '.') . ' km' : null,
        $transmissionLabel,
        $fuelLabel,
    ])->filter()->implode(' · ');
@endphp

<a href="{{ route('cars.show', $car) }}"
   class="group flex h-full flex-col overflow-hidden rounded-xl bg-white ring-1 ring-slate-200 transition-colors hover:ring-slate-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-900">

    {{-- Foto --}}
    <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
        @if ($photo)
            <img src="{{ $photo }}"
                 alt="{{ $car->title }}"
                 loading="lazy"
                 class="h-full w-full object-cover {{ $isSold ? 'grayscale opacity-70' : '' }}">
        @else
            <div class="flex h-full items-center justify-center text-sm text-slate-400">
                Belum ada foto
            </div>
        @endif

        {{-- Badge --}}
        <div class="absolute left-2 top-2 flex flex-wrap gap-1.5 sm:left-3 sm:top-3">
            <x-status-badge :status="$car->status" />
            @if ($car->is_featured)
                <span class="inline-flex items-center rounded-full bg-slate-900 px-2.5 py-1 text-xs font-semibold text-white">
                    Unggulan
                </span>
            @endif
        </div>
    </div>

    {{-- Isi --}}
    <div class="flex flex-1 flex-col p-3 sm:p-4">
        <p class="truncate text-xs text-slate-500">
            {{ $car->brand->name }}
        </p>

        <h3 class="mt-0.5 line-clamp-2 min-h-[2.5rem] text-sm font-semibold leading-snug text-slate-900">
            {{ $car->title }}
        </h3>

        @if ($meta !== '')
            <p class="mt-1.5 truncate text-xs text-slate-500" title="{{ $meta }}">
                {{ $meta }}
            </p>
        @endif

        {{-- Harga: satu baris, tidak pecah antara "Rp" dan angkanya --}}
        <p class="mt-auto whitespace-nowrap pt-3 text-sm font-bold text-slate-900 sm:text-base">
            {{ str_replace(' ', "\u{00A0}", $car->price_formatted) }}
        </p>
    </div>
</a>