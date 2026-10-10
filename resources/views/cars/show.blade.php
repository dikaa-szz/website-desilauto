@php
    $images = $car->getMedia('photos')->map(function ($m) {
        return [
            'large' => $m->hasGeneratedConversion('large') ? $m->getUrl('large') : $m->getUrl(),
            'thumb' => $m->hasGeneratedConversion('thumb') ? $m->getUrl('thumb') : $m->getUrl(),
        ];
    })->values();

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

    <div class="mx-auto max-w-6xl px-4 pb-28 pt-6 lg:pb-12 lg:pt-8"
         x-data="{
            lightbox: false,
            current: 0,
            total: {{ $images->count() }},
            open(i) { this.current = i; this.lightbox = true; document.body.classList.add('overflow-hidden'); },
            close() { this.lightbox = false; document.body.classList.remove('overflow-hidden'); },
            next() { this.current = (this.current + 1) % this.total; },
            prev() { this.current = (this.current - 1 + this.total) % this.total; }
         }"
         @keydown.escape.window="close()"
         @keydown.right.window="if (lightbox) next()"
         @keydown.left.window="if (lightbox) prev()">

        {{-- Judul --}}
        <div class="mb-5">
            <a href="{{ route('cars.index') }}" class="mb-3 inline-flex items-center gap-1 text-sm text-gray-500 transition hover:text-brand-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke katalog
            </a>
            <div class="flex flex-wrap items-center gap-2">
                <x-status-badge :status="$car->status" />
                @if ($car->is_featured)
                    <span class="inline-flex items-center rounded-full bg-brand-600 px-2.5 py-1 text-xs font-semibold text-white">Unggulan</span>
                @endif
            </div>
            <h1 class="mt-2 text-2xl font-bold leading-tight tracking-tight lg:text-3xl">{{ $car->title }}</h1>
            <p class="mt-1 text-sm text-gray-500">{{ $meta->implode(' · ') }}</p>
        </div>

        {{-- Galeri utama (layout seperti gambar 1) --}}
        <div class="grid gap-3 lg:grid-cols-5">
            {{-- Foto utama --}}
            <div class="relative lg:col-span-3">
                @if ($images->isNotEmpty())
                    <button type="button" @click="open(0)" class="group relative block w-full overflow-hidden rounded-2xl bg-gray-100">
                        <img src="{{ $images[0]['large'] }}"
                             alt="{{ $car->title }}"
                             class="aspect-[4/3] w-full object-cover transition duration-300 group-hover:scale-[1.02]">
                        {{-- Harga overlay --}}
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent px-5 pb-4 pt-16">
                            <p class="text-2xl font-bold text-white lg:text-3xl">{{ $car->price_formatted }}</p>
                        </div>
                    </button>
                @else
                    <div class="flex aspect-[4/3] items-center justify-center rounded-2xl bg-gray-100 text-gray-400">
                        Belum ada foto
                    </div>
                @endif
            </div>

            {{-- Grid thumbnail kanan --}}
            <div class="grid grid-cols-2 gap-3 lg:col-span-2">
                @foreach ($images->slice(1, 4) as $index => $image)
                    @php $realIndex = $index + 1; @endphp
                    <button type="button" @click="open({{ $realIndex }})"
                            class="group relative overflow-hidden rounded-xl bg-gray-100">
                        <img src="{{ $image['thumb'] }}"
                             alt=""
                             loading="lazy"
                             class="aspect-[4/3] w-full object-cover transition duration-300 group-hover:scale-105">
                        {{-- Overlay +N jika foto terakhir & masih ada sisa --}}
                        @if ($loop->last && $images->count() > 5)
                            <span class="absolute inset-0 flex items-center justify-center bg-black/50 text-lg font-bold text-white">
                                +{{ $images->count() - 5 }}
                            </span>
                        @endif
                    </button>
                @endforeach

                {{-- Isi kosong jika foto < 5 --}}
                @for ($i = $images->count() - 1; $i < 4; $i++)
                    <div class="aspect-[4/3] rounded-xl bg-gray-50 ring-1 ring-dashed ring-gray-200"></div>
                @endfor
            </div>
        </div>

        {{-- Info + aksi --}}
        <div class="mt-6 grid gap-6 lg:grid-cols-5">
            <div class="lg:col-span-3">
                {{-- Spesifikasi --}}
                <section>
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
            </div>

            {{-- Sidebar aksi (desktop) --}}
            <div class="lg:col-span-2">
                <div class="sticky top-24 rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100">
                    <p class="text-sm text-gray-500">Harga</p>
                    <p class="mt-1 text-3xl font-bold text-brand-600">{{ $car->price_formatted }}</p>

                    @if ($isSold)
                        <div class="mt-5 rounded-xl bg-red-50 p-4 text-sm text-red-700">
                            Mobil ini sudah terjual. Lihat pilihan lain di
                            <a href="{{ route('cars.index') }}" class="font-semibold underline">katalog</a>.
                        </div>
                    @else
                        <div class="mt-5 space-y-3">
                            <a href="{{ $waLink }}" target="_blank" rel="noopener"
                               class="flex w-full items-center justify-center gap-2 rounded-xl bg-green-600 px-4 py-3.5 font-semibold text-white transition hover:bg-green-700">
                                <x-icon.whatsapp class="h-5 w-5" />
                                Chat WhatsApp
                            </a>
                            <a href="{{ $tradeInLink }}" target="_blank" rel="noopener"
                               class="flex w-full items-center justify-center rounded-xl border-2 border-brand-600 px-4 py-3 font-semibold text-brand-700 transition hover:bg-brand-50">
                                Tukar Tambah
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Mobil terkait --}}
        @if ($related->isNotEmpty())
            <section class="mt-12">
                <h2 class="text-lg font-bold">Mobil {{ $car->brand->name }} Lainnya</h2>
                <div class="mt-4 grid grid-cols-2 gap-3 lg:grid-cols-4 lg:gap-4">
                    @foreach ($related as $item)
                        <x-car-card :car="$item" />
                    @endforeach
                </div>
            </section>
        @endif

        {{-- ========== LIGHTBOX (gambar 2) ========== --}}
        <div x-show="lightbox"
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 p-3 backdrop-blur-sm sm:p-6"
             @click.self="close()">

            <div class="relative flex max-h-[92vh] w-full max-w-5xl flex-col overflow-hidden rounded-2xl bg-white shadow-2xl lg:flex-row"
                 @click.stop>

                {{-- Tombol tutup --}}
                <button type="button" @click="close()" aria-label="Tutup"
                        class="absolute right-3 top-3 z-10 flex h-9 w-9 items-center justify-center rounded-full bg-black/50 text-white transition hover:bg-black/70 lg:bg-gray-100 lg:text-gray-600 lg:hover:bg-gray-200">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                {{-- Foto besar + navigasi --}}
                <div class="relative flex flex-1 items-center justify-center bg-gray-900 lg:min-h-[28rem]">
                    <template x-for="(img, i) in {{ $images->toJson() }}" :key="i">
                        <img x-show="current === i"
                             :src="img.large"
                             :alt="'Foto ' + (i + 1)"
                             class="max-h-[55vh] w-full object-contain lg:max-h-[80vh]">
                    </template>

                    {{-- Prev / Next --}}
                    <template x-if="total > 1">
                        <div>
                            <button type="button" @click="prev()" aria-label="Sebelumnya"
                                    class="absolute left-2 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-gray-800 shadow transition hover:bg-white">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <button type="button" @click="next()" aria-label="Berikutnya"
                                    class="absolute right-2 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-gray-800 shadow transition hover:bg-white">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </template>

                    {{-- Counter --}}
                    <span class="absolute bottom-3 left-1/2 -translate-x-1/2 rounded-full bg-black/60 px-3 py-1 text-xs font-medium text-white"
                          x-text="(current + 1) + ' / ' + total"></span>
                </div>

                {{-- Panel info kanan --}}
                <div class="flex w-full flex-col p-5 lg:w-80 lg:shrink-0 lg:p-6">
                    <h2 class="text-base font-bold leading-snug lg:text-lg">{{ $car->title }}</h2>
                    <p class="mt-1 text-xs text-gray-500">{{ $meta->implode(' · ') }}</p>
                    <p class="mt-4 text-2xl font-bold text-brand-600">{{ $car->price_formatted }}</p>

                    @unless ($isSold)
                        <div class="mt-5 space-y-2.5">
                            <a href="{{ $waLink }}" target="_blank" rel="noopener"
                               class="flex w-full items-center justify-center gap-2 rounded-xl bg-green-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-green-700">
                                <x-icon.whatsapp class="h-5 w-5" />
                                WhatsApp
                            </a>
                            <a href="{{ $tradeInLink }}" target="_blank" rel="noopener"
                               class="flex w-full items-center justify-center rounded-xl border border-brand-600 px-4 py-2.5 text-sm font-semibold text-brand-700 transition hover:bg-brand-50">
                                Tukar Tambah
                            </a>
                        </div>
                    @endunless

                    {{-- Thumbnail strip --}}
                    @if ($images->count() > 1)
                        <div class="mt-5 flex gap-2 overflow-x-auto pb-1 scrollbar-hide">
                            @foreach ($images as $i => $image)
                                <button type="button" @click="current = {{ $i }}"
                                        :class="current === {{ $i }} ? 'ring-2 ring-brand-500 opacity-100' : 'opacity-60 hover:opacity-100'"
                                        class="h-14 w-14 shrink-0 overflow-hidden rounded-lg bg-gray-100 transition">
                                    <img src="{{ $image['thumb'] }}" alt="" class="h-full w-full object-cover" loading="lazy">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Bar bawah HP --}}
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