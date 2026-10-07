<x-layouts.app :title="config('showroom.name') . ' | Showroom Mobil'">
    {{-- Hero (sementara, disesuaikan dengan desain nanti) --}}
    <section class="bg-gradient-to-br from-amber-500 to-amber-700 text-white">
        <div class="mx-auto max-w-7xl px-4 py-16 md:py-24">
            <h1 class="max-w-2xl text-3xl font-bold md:text-5xl">Temukan mobil impian Anda</h1>
            <p class="mt-4 max-w-xl text-amber-50">Mobil pilihan dengan kondisi terjamin. Lihat katalog dan hubungi kami langsung via WhatsApp.</p>
            <a href="{{ route('cars.index') }}"
               class="mt-8 inline-block rounded-lg bg-white px-6 py-3 font-semibold text-amber-700 hover:bg-amber-50">
                Lihat Katalog
            </a>
        </div>
    </section>

    @if ($featured->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 py-12">
            <h2 class="text-2xl font-bold">Mobil Unggulan</h2>
            <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($featured as $car)
                    <x-car-card :car="$car" />
                @endforeach
            </div>
        </section>
    @endif

    <section class="mx-auto max-w-7xl px-4 pb-12">
        <div class="flex items-end justify-between">
            <h2 class="text-2xl font-bold">Baru Masuk</h2>
            <a href="{{ route('cars.index') }}" class="text-sm font-medium text-amber-600 hover:underline">Lihat semua</a>
        </div>
        <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($latest as $car)
                <x-car-card :car="$car" />
            @empty
                <p class="text-gray-500">Belum ada mobil yang ditampilkan.</p>
            @endforelse
        </div>
    </section>
</x-layouts.app>