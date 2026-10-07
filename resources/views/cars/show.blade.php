@php
    $images = $car->getMedia('photos')->map(fn ($m) => [
        'large' => $m->getUrl('large'),
        'thumb' => $m->getUrl('thumb'),
    ])->values();

    $waMessage = "Halo, saya tertarik dengan {$car->title} ({$car->price_formatted}). Apakah masih tersedia?\n" . route('cars.show', $car);
    $isSold = $car->status === \App\Enums\CarStatus::Sold;
@endphp

<x-layouts.app :title="$car->title . ' | ' . config('showroom.name')"
               :description="\Illuminate\Support\Str::limit($car->title . ' - ' . $car->price_formatted . '. ' . strip_tags((string) $car->description), 155)">
    <div class="mx-auto max-w-7xl px-4 py-8">
        <nav class="mb-4 text-sm text-gray-500">
            <a href="{{ route('cars.index') }}" class="hover:underline">&larr; Kembali ke katalog</a>
        </nav>

        <div class="grid gap-8 lg:grid-cols-5">
            {{-- Galeri --}}
            <div class="lg:col-span-3">
                @if ($images->isNotEmpty())
                    <div x-data="{ active: 0, images: @js($images) }">
                        <div class="aspect-[4/3] overflow-hidden rounded-xl bg-gray-100">
                            <img :src="images[active].large" alt="{{ $car->title }}" class="h-full w-full object-cover">
                        </div>
                        <div class="mt-3 grid grid-cols-5 gap-2">
                            <template x-for="(img, i) in images" :key="i">
                                <button type="button" @click="active = i"
                                        :class="active === i ? 'ring-2 ring-amber-500' : 'opacity-70 hover:opacity-100'"
                                        class="aspect-[4/3] overflow-hidden rounded-lg bg-gray-100">
                                    <img :src="img.thumb" alt="" loading="lazy" class="h-full w-full object-cover">
                                </button>
                            </template>
                        </div>
                    </div>
                @else
                    <div class="flex aspect-[4/3] items-center justify-center rounded-xl bg-gray-100 text-gray-400">
                        Belum ada foto
                    </div>
                @endif
            </div>

            {{-- Info --}}
            <div class="lg:col-span-2">
                <x-status-badge :status="$car->status" />
                <h1 class="mt-2 text-2xl font-bold">{{ $car->title }}</h1>
                <p class="mt-2 text-3xl font-bold text-amber-600">{{ $car->price_formatted }}</p>

                @if ($isSold)
                    <div class="mt-6 rounded-lg bg-red-50 p-4 text-sm text-red-700">
                        Mobil ini sudah terjual. Lihat mobil lain di
                        <a href="{{ route('cars.index') }}" class="font-medium underline">katalog</a>.
                    </div>
                @else
                    <a href="{{ \App\Support\WhatsApp::link($waMessage) }}" target="_blank" rel="noopener"
                       class="mt-6 flex items-center justify-center rounded-lg bg-green-600 px-6 py-3 font-semibold text-white hover:bg-green-700">
                        Hubungi via WhatsApp
                    </a>
                @endif

                <dl class="mt-6 divide-y rounded-xl border bg-white text-sm">
                    @foreach ([
                        'Merek' => $car->brand->name,
                        'Tipe' => $car->model,
                        'Varian' => $car->variant,
                        'Tahun' => $car->year,
                        'Kilometer' => $car->mileage ? number_format($car->mileage, 0, ',', '.') . ' km' : null,
                        'Transmisi' => $car->transmission->getLabel(),
                        'Bahan bakar' => $car->fuel_type->getLabel(),
                        'Warna' => $car->color,
                    ] as $label => $value)
                        @if ($value)
                            <div class="flex justify-between px-4 py-3">
                                <dt class="text-gray-500">{{ $label }}</dt>
                                <dd class="font-medium">{{ $value }}</dd>
                            </div>
                        @endif
                    @endforeach
                </dl>
            </div>
        </div>

        @if ($car->description)
            <section class="mt-8 rounded-xl border bg-white p-6">
                <h2 class="text-lg font-semibold">Deskripsi</h2>
                <div class="mt-3 text-gray-700">{!! nl2br(e($car->description)) !!}</div>
            </section>
        @endif

        @if ($related->isNotEmpty())
            <section class="mt-12">
                <h2 class="text-xl font-bold">Mobil {{ $car->brand->name }} Lainnya</h2>
                <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($related as $item)
                        <x-car-card :car="$item" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-layouts.app>