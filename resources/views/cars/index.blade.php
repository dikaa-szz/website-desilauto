@php
    $activeFilters = collect($filters)->except('sort')->filter()->count();
@endphp

<x-layouts.app :title="'Katalog Mobil | ' . config('showroom.name')"
               description="Daftar mobil tersedia lengkap dengan filter merek, tahun, harga, dan transmisi."
               :float-wa="false">
    <div x-data="{ filterOpen: false }"
         x-effect="document.body.classList.toggle('overflow-hidden', filterOpen)"
         class="mx-auto max-w-7xl px-4 pb-28 pt-6 lg:pb-12">

        {{-- Judul dan pencarian --}}
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight lg:text-3xl">Katalog Mobil</h1>
                <p class="mt-1 text-sm text-gray-500">{{ $cars->total() }} mobil ditemukan</p>
            </div>

            <div class="flex gap-3">
                <form method="GET" action="{{ route('cars.index') }}" class="relative flex-1 lg:w-80">
                    @foreach (request()->except(['q', 'page']) as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                         fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M11 18a7 7 0 1 1 0-14 7 7 0 0 1 0 14Z"/>
                    </svg>
                    <input type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="Cari merek atau model..." class="field pl-10">
                </form>

                <div class="hidden w-48 lg:block">
                    @include('cars.partials.sort')
                </div>
            </div>
        </div>

        {{-- Chip filter cepat --}}
        <div class="mt-4">
            <x-filter-chips />
        </div>

        <div class="mt-6 lg:grid lg:grid-cols-4 lg:gap-8">
            {{-- Filter laptop --}}
            <aside class="hidden lg:block">
                <div class="sticky top-24 rounded-2xl bg-white p-5 ring-1 ring-gray-100">
                    <h2 class="mb-4 font-semibold">Filter</h2>
                    @include('cars.partials.filter')
                </div>
            </aside>

            {{-- Daftar mobil --}}
            <div class="lg:col-span-3">
                @if ($cars->isEmpty())
                    <div class="rounded-2xl border border-dashed border-gray-300 bg-white p-10 text-center">
                        <p class="font-semibold">Tidak ada mobil yang cocok.</p>
                        <p class="mt-1 text-sm text-gray-500">Coba ubah atau reset filter Anda.</p>
                        <a href="{{ route('cars.index') }}"
                           class="mt-4 inline-block rounded-xl bg-brand-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-brand-700">
                            Reset filter
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($cars as $car)
                            <x-car-card :car="$car" />
                        @endforeach
                    </div>
                @endif

                <div class="mt-8">{{ $cars->links() }}</div>
            </div>
        </div>

        {{-- Bar bawah (HP) --}}
        <div class="fixed inset-x-0 bottom-0 z-40 border-t bg-white/95 backdrop-blur lg:hidden"
             style="padding-bottom: env(safe-area-inset-bottom)">
            <div class="mx-auto grid max-w-7xl grid-cols-2 gap-3 p-3">
                <button type="button" @click="filterOpen = true"
                        class="flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" d="M3 6h18M6 12h12M10 18h4"/>
                    </svg>
                    Filter
                    @if ($activeFilters > 0)
                        <span class="rounded-full bg-brand-600 px-2 text-xs text-white">{{ $activeFilters }}</span>
                    @endif
                </button>
                @include('cars.partials.sort')
            </div>
        </div>

        {{-- Bottom sheet filter (HP) --}}
        <div class="fixed inset-0 z-50 lg:hidden"
             :class="{ 'pointer-events-none': ! filterOpen }"
             @keydown.escape.window="filterOpen = false">
            <div x-show="filterOpen" x-cloak x-transition.opacity
                 class="absolute inset-0 bg-black/40" @click="filterOpen = false"></div>

            <div x-show="filterOpen" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="translate-y-full"
                 x-transition:enter-end="translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="translate-y-0"
                 x-transition:leave-end="translate-y-full"
                 class="absolute inset-x-0 bottom-0 max-h-[88vh] overflow-y-auto rounded-t-3xl bg-white p-5 pb-8">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold">Filter</h2>
                    <button type="button" @click="filterOpen = false" aria-label="Tutup" class="text-3xl leading-none text-gray-400">&times;</button>
                </div>
                @include('cars.partials.filter')
            </div>
        </div>
    </div>
        {{-- Teks tentang showroom: hanya di halaman pertama tanpa filter --}}
    @if ($cars->onFirstPage() && $activeFilters === 0)
        <x-about-showroom />
    @endif

    {{-- Ruang agar bar Filter/Urutkan di HP tidak menutupi footer --}}
    <div class="h-20 lg:hidden"></div>
</x-layouts.app>