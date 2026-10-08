@php
    $outlet = config('showroom.outlet');
    $outlets = config('showroom.outlets', [$outlet]);
    $main = $outlets[0] ?? $outlet;
    $second = $outlets[1] ?? null;

    $points = [
        [
            'title' => 'Lulus Inspeksi OTOSPECTOR',
            'text' => 'Setiap unit melewati inspeksi dan sertifikasi OTOSPECTOR, terdokumentasi jelas, serta bebas tabrakan dan banjir.',
            'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
        ],
        [
            'title' => 'Garansi Mesin dan Transmisi 2 Tahun',
            'text' => 'Perlindungan untuk dua komponen terpenting mobil Anda, agar tenang setelah serah terima kunci.',
            'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
        ],
        [
            'title' => 'Kredit yang Transparan',
            'text' => 'Kami bantu hitung kredit secara terbuka, agar angsuran sesuai perhitungan di awal tanpa kejutan.',
            'icon' => 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z',
        ],
        [
            'title' => 'Tukar Tambah dan Titip Jual',
            'text' => 'Terima tukar tambah dan titip jual beli mobil dengan surat lengkap. Kami juga membeli mobil berkualitas istimewa.',
            'icon' => 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4',
        ],
    ];
@endphp

<section class="relative overflow-hidden border-y bg-white py-16 md:py-24">
    {{-- Dekorasi latar --}}
    <div class="pointer-events-none absolute -left-24 top-0 h-72 w-72 rounded-full bg-brand-100/70 blur-3xl"></div>
    <div class="pointer-events-none absolute -right-24 bottom-0 h-72 w-72 rounded-full bg-brand-100/70 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-4">

        {{-- Judul --}}
        <div class="mx-auto max-w-3xl text-center">
            <span class="inline-flex items-center gap-2 rounded-full bg-brand-50 px-4 py-1.5 text-sm font-semibold text-brand-700 ring-1 ring-brand-100">
                <span class="h-1.5 w-1.5 rounded-full bg-brand-600"></span>
                Tentang Kami
            </span>

            <h2 class="mt-5 text-3xl font-bold tracking-tight md:text-5xl">
                Mobil Premium Pilihan,
                <span class="bg-linear-to-r from-brand-600 to-brand-500 bg-clip-text text-transparent">
                    Terawat dan Bergaransi
                </span>
            </h2>

            <p class="mx-auto mt-5 max-w-2xl text-base leading-relaxed text-gray-600 md:text-lg">
                Membeli mobil premium seharusnya memberi rasa tenang, bukan rasa was-was. Di {{ $main['name'] }},
                setiap unit dipilih satu per satu, diperiksa menyeluruh, dan baru kami tawarkan jika benar-benar layak.
            </p>
        </div>

        {{-- Keunggulan --}}
        <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($points as $point)
                <div class="group rounded-3xl bg-white p-6 text-center shadow-sm ring-1 ring-gray-100 transition duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:ring-brand-500/40">
                    <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-linear-to-br from-brand-500 to-brand-600 text-white shadow-lg shadow-brand-500/30 transition duration-300 group-hover:scale-110">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $point['icon'] }}" />
                        </svg>
                    </span>
                    <h3 class="mt-5 font-semibold leading-snug text-gray-900">{{ $point['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-gray-600">{{ $point['text'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- Dua outlet berdampingan (tanpa peta) --}}
        <div class="mx-auto mt-12 grid max-w-5xl gap-5 md:grid-cols-2">

            {{-- Outlet 1: Serpong --}}
            <div class="relative flex flex-col overflow-hidden rounded-3xl bg-gray-900 p-8 text-center text-white shadow-xl md:p-10">
                <div class="pointer-events-none absolute -right-16 -top-16 h-56 w-56 rounded-full bg-brand-500/25 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-20 -left-16 h-56 w-56 rounded-full bg-brand-600/25 blur-3xl"></div>

                <div class="relative flex flex-1 flex-col">
                    <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-white/10 ring-1 ring-white/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </span>

                    <p class="mt-4 text-sm font-semibold uppercase tracking-wider text-brand-500">Outlet 1</p>
                    <h3 class="mt-1 text-xl font-bold md:text-2xl">{{ $main['name'] }}</h3>

                    <address class="mt-3 flex-1 text-sm text-gray-300 not-italic leading-relaxed">
                        @foreach ($main['address'] as $line)
                            <span class="block">{{ $line }}</span>
                        @endforeach
                    </address>

                    @if (! empty($main['plus_code']))
                        <p class="mt-3 text-xs text-gray-500">Kode Plus: {{ $main['plus_code'] }}</p>
                    @endif

                    <div class="mt-6 flex flex-col gap-3">
                        <a href="{{ \App\Support\WhatsApp::link('Halo, saya ingin bertanya tentang mobil di outlet Serpong.') }}"
                           target="_blank" rel="noopener"
                           class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-green-600 px-5 py-3 text-sm font-semibold transition hover:bg-green-700">
                            <x-icon.whatsapp class="h-5 w-5" />
                            Chat WhatsApp
                        </a>
                        <a href="{{ \App\Support\Maps::directionsUrl() }}"
                           target="_blank" rel="noopener"
                           class="inline-flex w-full items-center justify-center rounded-xl border border-white/30 px-5 py-3 text-sm font-semibold transition hover:bg-white/10">
                            Petunjuk Arah
                        </a>
                    </div>
                </div>
            </div>

            {{-- Outlet 2: Mangga Dua --}}
            @if ($second)
                <div class="relative flex flex-col overflow-hidden rounded-3xl bg-gray-900 p-8 text-center text-white shadow-xl md:p-10">
                    <div class="pointer-events-none absolute -right-16 -top-16 h-56 w-56 rounded-full bg-brand-500/25 blur-3xl"></div>
                    <div class="pointer-events-none absolute -bottom-20 -left-16 h-56 w-56 rounded-full bg-brand-600/25 blur-3xl"></div>

                    <div class="relative flex flex-1 flex-col">
                        <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-white/10 ring-1 ring-white/20">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>

                        <p class="mt-4 text-sm font-semibold uppercase tracking-wider text-brand-500">Outlet 2</p>
                        <h3 class="mt-1 text-xl font-bold md:text-2xl">{{ $second['name'] }}</h3>

                        <address class="mt-3 flex-1 text-sm text-gray-300 not-italic leading-relaxed">
                            @foreach ($second['address'] as $line)
                                <span class="block">{{ $line }}</span>
                            @endforeach
                        </address>

                        <div class="mt-6 flex flex-col gap-3">
                            <a href="{{ \App\Support\WhatsApp::link('Halo, saya ingin bertanya tentang mobil di outlet Mangga Dua.') }}"
                               target="_blank" rel="noopener"
                               class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-green-600 px-5 py-3 text-sm font-semibold transition hover:bg-green-700">
                                <x-icon.whatsapp class="h-5 w-5" />
                                Chat WhatsApp
                            </a>
                            @if (! empty($second['place_url']))
                                <a href="{{ $second['place_url'] }}"
                                   target="_blank" rel="noopener"
                                   class="inline-flex w-full items-center justify-center rounded-xl border border-white/30 px-5 py-3 text-sm font-semibold transition hover:bg-white/10">
                                    Petunjuk Arah
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>