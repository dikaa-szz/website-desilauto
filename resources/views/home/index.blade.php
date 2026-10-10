<x-layouts.app :title="config('showroom.name') . ' | Showroom Mobil'">

    {{-- Hero --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-gray-900 via-gray-900 to-gray-800 text-white">
        {{-- Decorative blobs --}}
        <div class="pointer-events-none absolute -left-32 -top-32 h-96 w-96 rounded-full bg-brand-500/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-40 -right-20 h-[28rem] w-[28rem] rounded-full bg-brand-600/15 blur-3xl"></div>

        {{-- Car image DESKTOP (kanan) --}}
        <div class="pointer-events-none absolute inset-y-0 right-0 hidden w-[58%] xl:w-[55%] lg:block">
            <img src="{{ asset('images/hero-car.png') }}"
                 alt="Lexus, BMW, Mercedes"
                 class="absolute bottom-0 right-0 h-full max-h-[480px] w-auto object-contain object-right-bottom opacity-95 drop-shadow-2xl"
                 loading="eager">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/55 to-transparent"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-4 pt-14 pb-8 md:py-24 lg:py-28">
            <div class="max-w-xl lg:max-w-md xl:max-w-lg">
                <h1 class="text-4xl font-bold leading-[1.15] tracking-tight md:text-5xl lg:text-6xl">
                    Temukan mobil<br class="hidden sm:block">
                    <span class="text-brand-400">impian Anda</span>
                </h1>

                <p class="mt-5 max-w-md text-base leading-relaxed text-gray-300 md:text-lg">
                    Pilihan mobil dengan kondisi terawat. Lihat katalog, bandingkan, lalu hubungi kami langsung via WhatsApp.
                </p>
            </div>

            {{-- Search --}}
            <form method="GET" action="{{ route('cars.index') }}"
                  class="mt-8 flex max-w-xl items-center gap-2 rounded-2xl bg-white p-1.5 shadow-2xl shadow-black/30 ring-1 ring-black/5">
                <div class="flex flex-1 items-center gap-2 pl-3">
                    <svg class="h-5 w-5 shrink-0 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z"/>
                    </svg>
                    <input type="search" name="q"
                           placeholder="Cari BMW, Lexus atau lainyaa..."
                           class="min-w-0 flex-1 border-0 bg-transparent py-3 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>
                <button type="submit"
                        class="shrink-0 rounded-xl bg-gray-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-black active:scale-[0.98]">
                    Cari
                </button>
            </form>

            {{-- Quick filters --}}
            <div class="mt-5 flex flex-wrap gap-2.5">
                @foreach ([
                    'SUV'   => ['body_type' => 'suv'],
                    'MPV'   => ['body_type' => 'mpv'],
                    'Matic' => ['transmission' => 'automatic'],
                ] as $label => $params)
                    <a href="{{ route('cars.index', $params) }}"
                       class="group inline-flex items-center gap-1.5 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm font-medium backdrop-blur-sm transition hover:border-white/30 hover:bg-white/15">
                        {{ $label }}
                        <svg class="h-3.5 w-3.5 opacity-60 transition group-hover:translate-x-0.5 group-hover:opacity-100" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @endforeach
            </div>

            {{-- Car image MOBILE --}}
            <div class="mt-8 flex justify-center lg:hidden">
                <img src="{{ asset('images/hero-car.png') }}"
                     alt="Lexus, BMW, Mercedes"
                     class="h-auto w-full max-w-md object-contain drop-shadow-xl opacity-95"
                     loading="eager">
            </div>
        </div>
    </section>

    {{-- Mobil unggulan --}}
    @if ($featured->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 py-14 md:py-16">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wider text-brand-600">Pilihan terbaik</p>
                    <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900 md:text-3xl">Mobil Unggulan</h2>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($featured as $car)
                    <x-car-card :car="$car" />
                @endforeach
            </div>
        </section>
    @endif

    {{-- Baru masuk --}}
    <section class="mx-auto max-w-7xl px-4 pb-14 md:pb-16">
        <div class="flex items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-brand-600">Terbaru</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900 md:text-3xl">Baru Masuk</h2>
            </div>
            <a href="{{ route('cars.index') }}"
               class="group inline-flex items-center gap-1 text-sm font-semibold text-brand-600 transition hover:text-brand-700">
                Lihat semua
                <svg class="h-4 w-4 transition group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($latest as $car)
                <x-car-card :car="$car" />
            @empty
                <p class="col-span-full rounded-2xl border border-dashed border-gray-200 bg-gray-50 py-12 text-center text-gray-500">
                    Belum ada mobil yang ditampilkan.
                </p>
            @endforelse
        </div>
    </section>

    <x-about-showroom />

    {{-- CTA --}}
    <section class="mx-auto max-w-7xl px-4 py-10 md:py-14">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-gray-900 via-gray-900 to-gray-800 px-6 py-14 text-center text-white shadow-xl md:px-10 md:py-16">
            <div class="pointer-events-none absolute -right-16 -top-16 h-64 w-64 rounded-full bg-brand-500/20 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-20 -left-10 h-56 w-56 rounded-full bg-green-500/10 blur-3xl"></div>

            <div class="relative">
                <h2 class="text-2xl font-bold tracking-tight md:text-3xl lg:text-4xl">
                    Belum menemukan yang Anda cari?
                </h2>
                <p class="mx-auto mt-4 max-w-lg text-base text-gray-300 md:text-lg">
                    Sebutkan mobil dan budget Anda, kami bantu carikan.
                </p>
                <a href="{{ \App\Support\WhatsApp::link('Halo, saya sedang mencari mobil. Bisa dibantu?') }}"
                   target="_blank" rel="noopener"
                   class="mt-8 inline-flex items-center gap-2.5 rounded-full bg-green-600 px-7 py-3.5 text-sm font-semibold shadow-lg shadow-green-900/30 transition hover:bg-green-500 hover:shadow-green-900/40 active:scale-[0.98]">
                    <x-icon.whatsapp class="h-5 w-5" />
                    Chat via WhatsApp
                </a>
            </div>
        </div>
    </section>
</x-layouts.app>