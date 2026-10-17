<x-layouts.app :title="config('showroom.name') . ' | Showroom Mobil Premium'">

    @php
        $categories = [
            ['label' => 'SUV',       'desc' => 'Tangguh dan lega',        'params' => ['body_type' => 'suv']],
            ['label' => 'MPV',       'desc' => 'Nyaman untuk keluarga',   'params' => ['body_type' => 'mpv']],
            ['label' => 'Sedan',     'desc' => 'Elegan untuk harian',     'params' => ['body_type' => 'sedan']],
            ['label' => 'Hatchback', 'desc' => 'Lincah di dalam kota',    'params' => ['body_type' => 'hatchback']],
            ['label' => 'Matic',     'desc' => 'Praktis dikendarai',      'params' => ['transmission' => 'automatic']],
        ];

        $steps = [
            ['title' => 'Cari unit',      'desc' => 'Pilih dari katalog atau pakai kolom pencarian.',        'icon' => 'M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z'],
            ['title' => 'Hubungi kami',   'desc' => 'Tanyakan kondisi dan harga lewat WhatsApp.',            'icon' => 'M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.8 9.8 0 01-4-.84L3 20l1.4-3.7A7.6 7.6 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
            ['title' => 'Lihat langsung', 'desc' => 'Datang ke outlet, cek unit dan coba berkendara.',        'icon' => 'M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178zM15 12a3 3 0 11-6 0 3 3 0 016 0z'],
            ['title' => 'Pembayaran',     'desc' => 'Tunai atau kredit melalui leasing rekanan kami.',       'icon' => 'M3 10h18M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z'],
            ['title' => 'Serah terima',   'desc' => 'Unit dan dokumen kami serahkan kepada Anda.',           'icon' => 'M5 13l4 4L19 7'],
        ];

        // Pastikan alamat sesuai data terbaru showroom Anda
        $outlets = [
            [
                'name'    => 'Pusat Mobil Serpong',
                'address' => 'Belakang Rumah Sakit Bethsaida, Bursa Mobil Paramount, BEC Auto Centre Blok A No. 7, Gading Serpong, Tangerang',
            ],
            [
                'name'    => 'Pusat Mobil Mangga Dua',
                'address' => 'Mall Mangga Dua Square, Lantai LG Lot M 15 & M 16, Jl. Gunung Sahari Raya No. 1, Ancol, Pademangan, Jakarta Utara 14420',
            ],
        ];
    @endphp

    {{-- ==================== HERO ==================== --}}
    <section class="relative flex min-h-[540px] items-center overflow-hidden bg-[#0a1628] md:min-h-[620px]">
        <img src="{{ asset('images/hero-car.jpg') }}"
             alt="Mobil premium"
             class="absolute inset-0 h-full w-full object-cover object-center"
             loading="eager">
        <div class="absolute inset-0 bg-gradient-to-r from-[#0a1628]/80 via-[#0a1628]/35 to-transparent"></div>

        <div class="relative z-10 mx-auto w-full max-w-7xl px-4 pb-32 pt-28 md:pt-32">
            <h1 class="max-w-xl text-4xl font-bold leading-[1.1] tracking-tight text-white sm:text-5xl md:text-6xl">
                Temukan mobil impian Anda
            </h1>

            <p class="mt-5 max-w-md text-base leading-relaxed text-slate-200 md:text-lg">
                Mobil premium terawat yang sudah lulus inspeksi, dengan garansi mesin dan transmisi.
            </p>

            <dl class="mt-8 flex flex-wrap gap-x-8 gap-y-3 text-sm text-slate-200">
                <div>
                    <dt class="sr-only">Inspeksi</dt>
                    <dd>Inspeksi 150 titik</dd>
                </div>
                <div>
                    <dt class="sr-only">Garansi</dt>
                    <dd>Garansi 2 tahun</dd>
                </div>
                <div>
                    <dt class="sr-only">Outlet</dt>
                    <dd>Outlet Serpong dan Mangga Dua</dd>
                </div>
            </dl>
        </div>
    </section>

    {{-- ==================== PENCARIAN ==================== --}}
    <section class="relative z-20 -mt-24 px-4">
        <div class="mx-auto max-w-6xl">
            <form method="GET" action="{{ route('cars.index') }}"
                  class="grid grid-cols-1 gap-4 rounded-lg bg-white p-5 shadow-lg shadow-slate-900/10 sm:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr_1fr_auto] lg:items-end">
                <div>
                    <label for="q" class="mb-1.5 block text-xs font-medium text-slate-600">Merek atau model</label>
                    <input id="q" type="search" name="q" placeholder="BMW, Lexus, Mercedes"
                           class="w-full rounded-md border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900">
                </div>
                <div>
                    <label for="body_type" class="mb-1.5 block text-xs font-medium text-slate-600">Tipe</label>
                    <select id="body_type" name="body_type"
                            class="w-full rounded-md border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900">
                        <option value="">Semua tipe</option>
                        <option value="suv">SUV</option>
                        <option value="mpv">MPV</option>
                        <option value="sedan">Sedan</option>
                        <option value="hatchback">Hatchback</option>
                    </select>
                </div>
                <div>
                    <label for="transmission" class="mb-1.5 block text-xs font-medium text-slate-600">Transmisi</label>
                    <select id="transmission" name="transmission"
                            class="w-full rounded-md border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900">
                        <option value="">Semua</option>
                        <option value="automatic">Automatic</option>
                        <option value="manual">Manual</option>
                    </select>
                </div>
                <div>
                    {{-- Pastikan controller cars.index menangani max_price, atau hapus field ini --}}
                    <label for="max_price" class="mb-1.5 block text-xs font-medium text-slate-600">Budget maksimal</label>
                    <select id="max_price" name="max_price"
                            class="w-full rounded-md border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 focus:border-slate-900 focus:outline-none focus:ring-1 focus:ring-slate-900">
                        <option value="">Semua harga</option>
                        <option value="300000000">Rp 300 juta</option>
                        <option value="500000000">Rp 500 juta</option>
                        <option value="1000000000">Rp 1 miliar</option>
                        <option value="2000000000">Rp 2 miliar</option>
                    </select>
                </div>
                <button type="submit"
                        class="rounded-md bg-[#f9b700] px-8 py-2.5 text-sm font-semibold text-slate-900 transition hover:bg-[#e8a900] focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2 sm:col-span-2 lg:col-span-1">
                    Cari mobil
                </button>
            </form>
        </div>
    </section>

    {{-- ==================== TIPE MOBIL ==================== --}}
    <section class="bg-white pt-14 md:pt-16">
        <div class="mx-auto max-w-7xl px-4">
            <div class="flex items-baseline justify-between gap-4">
                <h2 class="text-xl font-semibold tracking-tight text-slate-900 md:text-2xl">Cari berdasarkan tipe</h2>
                <a href="{{ route('cars.index') }}" class="text-sm font-medium text-slate-700 underline-offset-4 hover:underline">
                    Semua mobil
                </a>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5">
                @foreach ($categories as $cat)
                    <a href="{{ route('cars.index', $cat['params']) }}"
                       class="rounded-lg border border-slate-200 px-4 py-4 transition hover:border-slate-900">
                        <span class="block text-base font-semibold text-slate-900">{{ $cat['label'] }}</span>
                        <span class="mt-0.5 block text-sm text-slate-500">{{ $cat['desc'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== MOBIL UNGGULAN ==================== --}}
    @if ($featured->isNotEmpty())
        <section class="bg-white pt-14 md:pt-16">
            <div class="mx-auto max-w-7xl px-4">
                <div class="flex items-baseline justify-between gap-4">
                    <h2 class="text-xl font-semibold tracking-tight text-slate-900 md:text-2xl">Mobil unggulan</h2>
                    <a href="{{ route('cars.index', ['featured' => 1]) }}" class="text-sm font-medium text-slate-700 underline-offset-4 hover:underline">
                        Lihat semua
                    </a>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($featured as $car)
                        <x-car-card :car="$car" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ==================== BARU MASUK ==================== --}}
    <section class="bg-white pt-14 md:pt-16">
        <div class="mx-auto max-w-7xl px-4">
            <div class="flex items-baseline justify-between gap-4">
                <h2 class="text-xl font-semibold tracking-tight text-slate-900 md:text-2xl">Baru masuk</h2>
                <a href="{{ route('cars.index') }}" class="text-sm font-medium text-slate-700 underline-offset-4 hover:underline">
                    Lihat semua
                </a>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($latest as $car)
                    <x-car-card :car="$car" />
                @empty
                    <p class="col-span-full rounded-lg border border-dashed border-slate-300 py-16 text-center text-slate-500">
                        Belum ada mobil yang ditampilkan.
                    </p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ==================== CARA MEMBELI ==================== --}}
    <section class="mt-16 bg-slate-50 py-14 md:mt-20 md:py-16">
        <div class="mx-auto max-w-7xl px-4">
            <div class="mx-auto max-w-xl text-center">
                <h2 class="text-xl font-semibold tracking-tight text-slate-900 md:text-2xl">Cara membeli</h2>
                <p class="mt-2 text-sm text-slate-600 md:text-base">Lima langkah dari memilih unit sampai mobil ada di tangan Anda.</p>
            </div>

            <ol class="mt-10 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
                @foreach ($steps as $i => $step)
                    <li class="relative rounded-xl border border-slate-200 bg-white p-5">
                        <div class="flex items-center justify-between">
                            <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-amber-100 text-amber-700">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}"/>
                                </svg>
                            </span>
                            <span class="flex h-7 w-7 items-center justify-center rounded-full bg-slate-900 text-xs font-semibold text-white">{{ $i + 1 }}</span>
                        </div>
                        <h3 class="mt-4 text-base font-semibold text-slate-900">{{ $step['title'] }}</h3>
                        <p class="mt-1.5 text-sm leading-relaxed text-slate-600">{{ $step['desc'] }}</p>

                        @if (! $loop->last)
                            <span class="absolute -right-[11px] top-1/2 z-10 hidden h-[22px] w-[22px] -translate-y-1/2 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-400 lg:flex" aria-hidden="true">
                                <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- ==================== OUTLET ==================== --}}
    <section class="bg-white pt-14 md:pt-16">
        <div class="mx-auto max-w-7xl px-4">
            <div class="mx-auto max-w-xl text-center">
                <h2 class="text-xl font-semibold tracking-tight text-slate-900 md:text-2xl">Kunjungi outlet kami</h2>
                <p class="mt-2 text-sm text-slate-600 md:text-base">Lihat dan coba unitnya langsung di salah satu showroom kami.</p>
            </div>

            <div class="mt-8 grid grid-cols-1 gap-5 md:grid-cols-2">
                @foreach ($outlets as $outlet)
                    <div class="flex flex-col rounded-xl border border-slate-200 bg-white p-6 md:p-7">
                        <div class="flex items-start gap-4">
                            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-slate-900 text-[#f9b700]">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </span>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900">{{ $outlet['name'] }}</h3>
                                <p class="mt-1.5 text-sm leading-relaxed text-slate-600">{{ $outlet['address'] }}</p>
                            </div>
                        </div>

                        <div class="mt-6 flex flex-wrap gap-3 border-t border-slate-100 pt-5">
                            <a href="{{ route('about') }}"
                               class="inline-flex items-center rounded-md bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2">
                                Lihat lokasi
                            </a>
                            <a href="{{ \App\Support\WhatsApp::link('Halo, saya ingin berkunjung ke ' . $outlet['name'] . '.') }}"
                               target="_blank" rel="noopener"
                               class="inline-flex items-center gap-2 rounded-md border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-800 transition hover:border-slate-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-900 focus-visible:ring-offset-2">
                                <x-icon.whatsapp class="h-4 w-4 text-green-600" />
                                Chat WhatsApp
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== CTA ==================== --}}
    <section class="bg-white px-4 py-16 md:py-20">
        <div class="mx-auto flex max-w-7xl flex-col gap-6 rounded-lg bg-slate-900 px-6 py-10 md:flex-row md:items-center md:justify-between md:px-10">
            <div>
                <h2 class="text-xl font-semibold text-white md:text-2xl">Belum menemukan yang Anda cari?</h2>
                <p class="mt-2 max-w-lg text-sm text-slate-300 md:text-base">
                    Sebutkan mobil dan budget Anda, kami bantu carikan unitnya.
                </p>
            </div>
            <a href="{{ \App\Support\WhatsApp::link('Halo, saya sedang mencari mobil. Bisa dibantu?') }}"
               target="_blank" rel="noopener"
               class="inline-flex shrink-0 items-center justify-center gap-2.5 rounded-md bg-green-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-green-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-slate-900">
                <x-icon.whatsapp class="h-5 w-5" />
                Chat via WhatsApp
            </a>
        </div>
    </section>

</x-layouts.app>