<x-layouts.app title="Katalog Mobil | {{ config('showroom.name') }}" description="Daftar mobil tersedia lengkap dengan filter merek, tahun, harga, dan transmisi.">
    <div x-data="{ filterOpen: false }" class="mx-auto max-w-7xl px-4 py-8">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">Katalog Mobil</h1>
                <p class="text-sm text-gray-500">{{ $cars->total() }} mobil ditemukan</p>
            </div>
            <button type="button" @click="filterOpen = true"
                    class="rounded-lg border bg-white px-4 py-2 text-sm font-medium lg:hidden">
                Filter
            </button>
        </div>

        <div class="lg:grid lg:grid-cols-4 lg:gap-8">
            {{-- Filter desktop --}}
            <aside class="hidden lg:block">
                <div class="sticky top-20 rounded-xl border bg-white p-4">
                    @include('cars.partials.filter')
                </div>
            </aside>

            {{-- Daftar mobil --}}
            <div class="lg:col-span-3">
                @if ($cars->isEmpty())
                    <div class="rounded-xl border border-dashed bg-white p-10 text-center">
                        <p class="font-medium">Tidak ada mobil yang cocok dengan filter.</p>
                        <a href="{{ route('cars.index') }}" class="mt-2 inline-block text-sm text-amber-600 hover:underline">Reset filter</a>
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

        {{-- Filter mobile (drawer) --}}
        <div x-show="filterOpen" x-cloak class="fixed inset-0 z-50 lg:hidden" @keydown.escape.window="filterOpen = false">
            <div class="absolute inset-0 bg-black/40" @click="filterOpen = false"></div>
            <div class="absolute inset-y-0 right-0 w-full max-w-sm overflow-y-auto bg-white p-4">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="font-semibold">Filter</h2>
                    <button type="button" @click="filterOpen = false" aria-label="Tutup" class="text-2xl leading-none">&times;</button>
                </div>
                @include('cars.partials.filter')
            </div>
        </div>
    </div>
</x-layouts.app>