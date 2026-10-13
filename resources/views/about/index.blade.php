<x-layouts.app :title="'Tentang Kami | ' . config('showroom.name')">

    {{-- Hero --}}
    <section class="relative overflow-hidden bg-[#0a1628] pb-20 pt-28 text-white md:pb-28 md:pt-36">
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute -left-40 -top-40 h-[28rem] w-[28rem] rounded-full bg-sky-500/20 blur-[100px]"></div>
            <div class="absolute -right-32 top-1/3 h-80 w-80 rounded-full bg-indigo-500/15 blur-[90px]"></div>
            <div class="absolute bottom-0 left-1/2 h-64 w-64 -translate-x-1/2 rounded-full bg-blue-600/10 blur-[80px]"></div>
            <div class="absolute inset-0 opacity-[0.04]"
                 style="background-image: linear-gradient(rgba(255,255,255,.15) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.15) 1px, transparent 1px); background-size: 48px 48px;"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-4 text-center">
            {{-- <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-1.5 text-xs font-semibold uppercase tracking-widest text-sky-300 backdrop-blur-sm">
                <span class="relative flex h-2 w-2"></span>
            </span> --}}

            <h1 class="mx-auto mt-6 max-w-3xl text-4xl font-bold leading-tight tracking-tight md:text-6xl">
                Lebih dari sekadar
                <span class="bg-gradient-to-r from-sky-400 via-blue-400 to-indigo-400 bg-clip-text text-transparent">
                    showroom mobil
                </span>
            </h1>

            <p class="mx-auto mt-6 max-w-2xl text-base leading-relaxed text-slate-300 md:text-lg">
                <strong class="text-white">Denis Mobilindo</strong> menghadirkan mobil premium pilihan
                dengan standar inspeksi ketat, garansi nyata, dan proses yang transparan.
            </p>

            <div class="mt-10 flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('cars.index') }}"
                   class="inline-flex items-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-semibold text-[#0a1628] transition hover:bg-sky-50">
                    Lihat Katalog
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="{{ \App\Support\WhatsApp::link('Halo, saya ingin tahu lebih tentang Denis Mobilindo.') }}"
                   target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/5 px-6 py-3 text-sm font-semibold text-white backdrop-blur-sm transition hover:bg-white/10">
                    <x-icon.whatsapp class="h-5 w-5" />
                    Chat WhatsApp
                </a>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="border-y border-white/5 bg-[#06101f] py-12 text-white">
        <div class="mx-auto grid max-w-7xl grid-cols-2 gap-8 px-4 text-center md:grid-cols-4">
            @foreach ([
                ['value' => 'Premium', 'label' => 'Kualitas terkurasi'],
                ['value' => '2 Tahun', 'label' => 'Garansi mesin & transmisi'],
                ['value' => '2 Outlet', 'label' => 'Serpong & Mangga Dua'],
                ['value' => '100%', 'label' => 'Transparansi data mobil'],
            ] as $stat)
                <div>
                    <p class="text-2xl font-bold tracking-tight text-sky-400 md:text-3xl">{{ $stat['value'] }}</p>
                    <p class="mt-1 text-sm text-slate-400">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Siapa Kami --}}
    <section class="relative overflow-hidden bg-[#0a1628] py-16 text-white md:py-24">
        <div class="pointer-events-none absolute right-0 top-0 h-96 w-96 rounded-full bg-sky-500/10 blur-[100px]"></div>

        <div class="relative mx-auto max-w-7xl px-4">
            <div class="grid items-start gap-12 lg:grid-cols-2 lg:gap-16">
                <div>
                    <h2 class="mt-3 text-3xl font-bold tracking-tight md:text-4xl">
                        Denis Mobilindo
                    </h2>

                    <div class="mt-6 space-y-4 text-base leading-relaxed text-slate-300">
                        <p>
                            Denis Mobilindo adalah showroom mobil bekas premium yang berdiri di atas komitmen
                            terhadap kualitas, kejujuran, dan rasa aman setiap pelanggan. Bagi kami, transaksi
                            mobil bekas seharusnya memberikan ketenangan pikiran, bukan kekhawatiran.
                        </p>
                        <p>
                            Kami percaya bahwa kualitas ada pada detail. Karena itu, setiap unit tidak sekadar
                            dipajang sebagai stok, melainkan melewati proses kurasi dan seleksi yang ketat.
                            Seluruh armada kami dijamin <strong class="text-white">100% lolos inspeksi</strong>,
                            bebas bekas tabrak besar, dan bebas banjir, serta didukung oleh legalitas dokumen
                            yang transparan dan layanan purna jual yang dapat diandalkan.
                        </p>
                        <p>
                            Tidak hanya menjual, kami juga siap membeli mobil bekas premium Anda dengan proses
                            taksasi yang jujur, transparan, dan penawaran harga yang kompetitif. Baik Anda ingin
                            menjual langsung maupun melakukan tukar tambah (trade-in), kami hadir memberikan
                            kemudahan transaksi tanpa kendala.
                        </p>
                        <p>
                            Nikmati pengalaman bertransaksi mobil premium yang nyaman dan terpercaya dengan
                            mengunjungi dua lokasi strategis kami:
                        </p>
                        <ul class="space-y-2 pl-1">
                            <li class="flex items-start gap-2.5">
                                <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-sky-400"></span>
                                <span class="font-medium text-white">Bez AutoCenter, Gading Serpong</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-sky-400"></span>
                                <span class="font-medium text-white">Mall Mangga Dua Square</span>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Feature cards --}}
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach ([
                        ['title' => 'Inspeksi Ketat', 'text' => 'Pemeriksaan menyeluruh, riwayat tabrakan & banjir terdokumentasi.', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['title' => 'Garansi Nyata', 'text' => 'Perlindungan mesin & transmisi hingga 2 tahun.', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                        ['title' => 'Kredit Jelas', 'text' => 'Angsuran dihitung terbuka tanpa biaya tersembunyi.', 'icon' => 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z'],
                        ['title' => 'Tukar Tambah', 'text' => 'Proses tukar tambah & titip jual dengan surat lengkap.', 'icon' => 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4'],
                    ] as $item)
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur-sm transition hover:border-sky-400/30 hover:bg-white/10">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-500/15 text-sky-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                                </svg>
                            </span>
                            <h3 class="mt-4 font-semibold text-white">{{ $item['title'] }}</h3>
                            <p class="mt-1.5 text-sm leading-relaxed text-slate-400">{{ $item['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Outlet --}}
    @php
        $outlets = config('showroom.outlets', [config('showroom.outlet')]);
    @endphp
    <section class="bg-[#06101f] py-16 text-white md:py-24">
        <div class="mx-auto max-w-7xl px-4">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-sm font-semibold uppercase tracking-wider text-sky-400">Lokasi</p>
                <h2 class="mt-3 text-3xl font-bold tracking-tight md:text-4xl">Outlet Kami</h2>
                <p class="mt-3 text-slate-400">Kunjungi showroom atau hubungi via WhatsApp sebelum datang.</p>
            </div>

            <div class="mt-12 grid gap-6 md:grid-cols-2">
                @foreach ($outlets as $i => $outlet)
                    <div class="group relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-white/10 to-white/[0.02] p-8 transition hover:border-sky-400/30 md:p-10">
                        <div class="pointer-events-none absolute -right-20 -top-20 h-48 w-48 rounded-full bg-sky-500/10 blur-3xl transition group-hover:bg-sky-500/20"></div>

                        <div class="relative">
                            <div class="flex items-center gap-3">
                                <span class="flex h-11 w-11 items-center justify-center rounded-full bg-sky-500/15 text-sky-400 ring-1 ring-sky-400/20">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-sky-400">Outlet {{ $i + 1 }}</p>
                                    <h3 class="text-xl font-bold">{{ $outlet['name'] }}</h3>
                                </div>
                            </div>

                            <address class="mt-5 text-sm not-italic leading-relaxed text-slate-300">
                                @foreach ($outlet['address'] as $line)
                                    <span class="block">{{ $line }}</span>
                                @endforeach
                            </address>

                            <div class="mt-6 flex flex-wrap gap-3">
                                <a href="{{ \App\Support\WhatsApp::link('Halo, saya ingin bertanya tentang outlet ' . $outlet['name']) }}"
                                   target="_blank" rel="noopener"
                                   class="inline-flex items-center gap-2 rounded-full bg-green-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-green-500">
                                    <x-icon.whatsapp class="h-4 w-4" />
                                    WhatsApp
                                </a>
                                @if (! empty($outlet['place_url']))
                                    <a href="{{ $outlet['place_url'] }}"
                                       target="_blank" rel="noopener"
                                       class="inline-flex items-center rounded-full border border-white/20 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-white/10">
                                        Petunjuk Arah
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="relative overflow-hidden bg-[#0a1628] py-16 md:py-20">
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute left-1/2 top-1/2 h-72 w-72 -translate-x-1/2 -translate-y-1/2 rounded-full bg-sky-500/15 blur-[100px]"></div>
        </div>

        <div class="relative mx-auto max-w-3xl px-4 text-center text-white">
            <h2 class="text-3xl font-bold tracking-tight md:text-4xl">
                Siap menemukan mobil impian?
            </h2>
            <p class="mx-auto mt-4 max-w-lg text-slate-300">
                Jelajahi katalog lengkap atau chat tim kami — kami siap membantu.
            </p>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('cars.index') }}"
                   class="inline-flex rounded-full bg-white px-7 py-3.5 text-sm font-semibold text-[#0a1628] transition hover:bg-sky-50">
                    Lihat Katalog
                </a>
                <a href="{{ \App\Support\WhatsApp::link('Halo, saya ingin bertanya tentang mobil di showroom.') }}"
                   target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2 rounded-full bg-green-600 px-7 py-3.5 text-sm font-semibold text-white transition hover:bg-green-500">
                    <x-icon.whatsapp class="h-5 w-5" />
                    Chat WhatsApp
                </a>
            </div>
        </div>
    </section>
</x-layouts.app>