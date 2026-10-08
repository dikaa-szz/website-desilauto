@php
    $images = $car->getMedia('photos')->map(fn ($m) => [
        'large' => $m->getUrl('large'),
        'thumb' => $m->getUrl('thumb'),
    ])->values();

    $isSold = $car->status === \App\Enums\CarStatus::Sold;
    $url = route('cars.show', $car);

    $waLink = \App\Support\WhatsApp::link("Halo, saya tertarik dengan {$car->title} ({$car->price_formatted}). Apakah masih tersedia?\n{$url}");
    $tradeInLink = \App\Support\WhatsApp::link("Halo, saya tertarik dengan {$car->title} dan ingin tanya tukar tambah.\n{$url}");

    $meta = collect([
        $car->mileage ? number_format($car->mileage, 0, ',', '.') . ' km' : null,
        $car->transmission->getLabel(),
        $car->fuel_type->getLabel(),
    ])->filter();

    $specs = [
        'Merek' => $car->brand->name,
        'Model' => $car->model,
        'Varian' => $car->variant,
        'Tahun' => $car->year,
        'Kilometer' => $car->mileage ? number_format($car->mileage, 0, ',', '.') . ' km' : null,
        'Transmisi' => $car->transmission->getLabel(),
        'Bahan Bakar' => $car->fuel_type->getLabel(),
        'Tipe Bodi' => $car->body_type?->getLabel(),
        'Warna' => $car->color,
    ];
@endphp

<x-layouts.app :title="$car->title . ' | ' . config('showroom.name')"
               :description="\Illuminate\Support\Str::limit($car->title . ' - ' . $car->price_formatted . '. ' . (string) $car->description, 155)"
               :float-wa="false">
    <div class="mx-auto max-w-6xl pb-28 lg:px-4 lg:py-8 lg:pb-12">

        <div class="lg:grid lg:grid-cols-5 lg:gap-8">

            {{-- Galeri --}}
            <div class="lg:col-span-3" x-data="{ current: 1, total: {{ $images->count() }} }">
                <div class="relative">
                    <div x-ref="track"
                         @scroll.throttle.50ms="current = Math.round($refs.track.scrollLeft / $refs.track.clientWidth) + 1"
                         class="flex snap-x snap-mandatory overflow-x-auto scrollbar-hide lg:rounded-2xl">
                        @forelse ($images as $image)
                            <img src="{{ $image['large'] }}"
                                 alt="{{ $car->title }} - foto {{ $loop->iteration }}"
                                 class="aspect-[4/3] w-full shrink-0 snap-center object-cover"
                                 @if (! $loop->first) loading="lazy" @endif>
                        @empty
                            <div class="flex aspect-[4/3] w-full items-center justify-center bg-gray-100 text-gray-400">
                                Belum ada foto
                            </div>
                        @endforelse
                    </div>

                    {{-- Tombol kembali dan bagikan (HP) --}}
                    <div class="absolute inset-x-0 top-0 flex items-center justify-between p-3 lg:hidden">
                        <a href="{{ route('cars.index') }}" aria-label="Kembali"
                           class="flex h-10 w-10 items-center justify-center rounded-full bg-white/90 shadow">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </a>
                        <button type="button" aria-label="Bagikan" x-data
                                @click="navigator.share ? navigator.share({ title: @js($car->title), url: @js($url) }).catch(() => {}) : navigator.clipboard.writeText(@js($url))"
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-white/90 shadow">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 12v7a1 1 0 001 1h14a1 1 0 001-1v-7M16 6l-4-4-4 4M12 2v13"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Penghitung foto --}}
                    <span x-show="total > 1" x-cloak x-text="current + '/' + total"
                          class="absolute bottom-3 right-3 rounded-full bg-black/60 px-3 py-1 text-xs font-medium text-white"></span>
                </div>

                {{-- Thumbnail (laptop) --}}
                @if ($images->count() > 1)
                    <div class="mt-3 hidden grid-cols-6 gap-2 lg:grid">
                        @foreach ($images as $image)
                            <button type="button"
                                    @click="$refs.track.scrollTo({ left: {{ $loop->index }} * $refs.track.clientWidth, behavior: 'smooth' })"
                                    :class="current === {{ $loop->iteration }} ? 'ring-2 ring-brand-500' : 'opacity-70 hover:opacity-100'"
                                    class="aspect-[4/3] overflow-hidden rounded-lg bg-gray-100 transition">
                                <img src="{{ $image['thumb'] }}" alt="" loading="lazy" class="h-full w-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Info utama --}}
            <div class="px-4 pt-5 lg:col-span-2 lg:px-0 lg:pt-0">
                <div class="flex items-center gap-2">
                    <x-status-badge :status="$car->status" />
                    @if ($car->is_featured)
                        <span class="inline-flex items-center rounded-full bg-brand-600 px-2.5 py-1 text-xs font-semibold text-white">Unggulan</span>
                    @endif
                </div>

                <h1 class="mt-3 text-2xl font-bold leading-tight tracking-tight lg:text-3xl">{{ $car->title }}</h1>
                <p class="mt-2 text-sm text-gray-500">{{ $meta->implode(' · ') }}</p>

                <div class="mt-5 rounded-2xl bg-brand-50 p-5 ring-1 ring-brand-100">
                    <p class="text-sm text-gray-500">Harga</p>
                    <p class="mt-1 text-3xl font-bold text-brand-600">{{ $car->price_formatted }}</p>
                </div>

                @if ($isSold)
                    <div class="mt-5 rounded-2xl bg-red-50 p-4 text-sm text-red-700">
                        Mobil ini sudah terjual. Lihat pilihan lain di
                        <a href="{{ route('cars.index') }}" class="font-semibold underline">katalog</a>.
                    </div>
                @else
                    {{-- Tombol aksi (laptop) --}}
                    <div class="mt-5 hidden grid-cols-2 gap-3 lg:grid">
                        <a href="{{ $tradeInLink }}" target="_blank" rel="noopener"
                           class="flex items-center justify-center rounded-xl border-2 border-brand-600 px-4 py-3 font-semibold text-brand-700 hover:bg-brand-50">
                            Tukar Tambah
                        </a>
                        <a href="{{ $waLink }}" target="_blank" rel="noopener"
                           class="flex items-center justify-center gap-2 rounded-xl bg-green-600 px-4 py-3 font-semibold text-white hover:bg-green-700">
                            <x-icon.whatsapp class="h-5 w-5" />
                            Chat WhatsApp
                        </a>
                    </div>

                    {{-- Tautan tukar tambah (HP) --}}
                    <a href="{{ $tradeInLink }}" target="_blank" rel="noopener"
                       class="mt-4 block text-center text-sm font-medium text-brand-700 underline lg:hidden">
                        Tanya tukar tambah via WhatsApp
                    </a>
                @endif
            </div>
        </div>

        <div class="px-4 lg:px-0">
            {{-- Detail spesifikasi --}}
            <section class="mt-8">
                <h2 class="text-lg font-bold">Detail Spesifikasi</h2>
                <dl class="mt-4 grid grid-cols-2 gap-x-6 gap-y-5 rounded-2xl bg-white p-5 ring-1 ring-gray-100 sm:grid-cols-3">
                    @foreach ($specs as $label => $value)
                        @if ($value)
                            <div>
                                <dt class="text-xs text-gray-400">{{ $label }}</dt>
                                <dd class="mt-0.5 font-semibold">{{ $value }}</dd>
                            </div>
                        @endif
                    @endforeach
                </dl>
            </section>

            {{-- Deskripsi --}}
            @if ($car->description)
                <section class="mt-8">
                    <h2 class="text-lg font-bold">Deskripsi</h2>
                    <div class="mt-4 rounded-2xl bg-white p-5 ring-1 ring-gray-100">
                        <p class="whitespace-pre-line leading-relaxed text-gray-700">{{ $car->description }}</p>
                    </div>
                </section>
            @endif

            {{-- Cek pilihan lain --}}
            <section class="mt-8">
                <h2 class="text-lg font-bold">Cek Pilihan Lain</h2>
                <div class="mt-3 flex flex-wrap gap-2">
                    @php
                        $chips = [
                            $car->brand->name => ['brand' => $car->brand->slug],
                            $car->model => ['q' => $car->model],
                            (string) $car->year => ['year_min' => $car->year, 'year_max' => $car->year],
                        ];
                    @endphp
                    @foreach ($chips as $label => $params)
                        <a href="{{ route('cars.index', $params) }}"
                           class="rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-brand-700 ring-1 ring-gray-200 transition hover:ring-brand-500">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </section>

            {{-- Mobil terkait --}}
            @if ($related->isNotEmpty())
                <section class="mt-10">
                    <h2 class="text-lg font-bold">Mobil {{ $car->brand->name }} Lainnya</h2>
                    <div class="mt-4 grid grid-cols-2 gap-3 lg:grid-cols-4 lg:gap-4">
                        @foreach ($related as $item)
                            <x-car-card :car="$item" />
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </div>

    {{-- Bar bawah menempel (HP) --}}
    @unless ($isSold)
        <div class="fixed inset-x-0 bottom-0 z-40 border-t bg-white/95 px-4 pt-3 backdrop-blur lg:hidden"
             style="padding-bottom: calc(env(safe-area-inset-bottom) + 0.75rem)">
            <div class="mx-auto flex max-w-6xl items-center justify-between gap-3">
                <div class="min-w-0">
                    <p class="text-xs text-gray-500">Harga</p>
                    <p class="truncate text-lg font-bold text-brand-600">{{ $car->price_formatted }}</p>
                </div>
                <a href="{{ $waLink }}" target="_blank" rel="noopener"
                   class="flex shrink-0 items-center gap-2 rounded-xl bg-green-600 px-5 py-3 font-semibold text-white active:bg-green-700">
                    <x-icon.whatsapp class="h-5 w-5" />
                    Chat WhatsApp
                </a>
            </div>
        </div>
    @endunless
</x-layouts.app>