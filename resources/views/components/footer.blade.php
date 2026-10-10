@php
    $outlets = config('showroom.outlets', [config('showroom.outlet')]);
@endphp

<footer class="bg-gray-50">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 text-sm text-gray-600 md:grid-cols-3">
        {{-- Brand --}}
        <div>
            <img src="{{ asset('logo-web.png') }}"
                 alt="Logo {{ config('showroom.name') }}"
                 class="h-10 w-auto"
                 loading="lazy">
            <p class="mt-4 max-w-xs leading-relaxed text-gray-500">
                Mobil premium pilihan: lulus inspeksi, bebas tabrakan dan banjir, bergaransi mesin dan transmisi.
            </p>
        </div>

        {{-- Outlet --}}
        <div>
            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-900">Outlet Kami</h3>
            <div class="mt-4 space-y-5">
                @foreach ($outlets as $outlet)
                    <address class="not-italic leading-relaxed">
                        <p class="font-medium text-gray-900">{{ $outlet['name'] }}</p>
                        @foreach ($outlet['address'] as $line)
                            <p class="text-gray-500">{{ $line }}</p>
                        @endforeach
                        @if (! empty($outlet['place_url']))
                            <a href="{{ $outlet['place_url'] }}"
                               target="_blank" rel="noopener"
                               class="mt-1.5 inline-flex items-center gap-1 text-sm font-medium text-brand-600 transition hover:text-brand-700">
                                Lihat di Maps
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        @endif
                    </address>
                @endforeach
            </div>
        </div>

        {{-- Hubungi --}}
        <div>
            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-900">Hubungi Kami</h3>
            <ul class="mt-4 space-y-2.5">
                <li>
                    <a href="{{ \App\Support\WhatsApp::link() }}"
                       target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 font-medium text-green-700 transition hover:text-green-800">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2a10 10 0 00-8.6 15.1L2 22l5-1.3A10 10 0 1012 2z"/>
                        </svg>
                        Chat via WhatsApp
                    </a>
                </li>
                <li>
                    <a href="{{ route('cars.index') }}" class="text-gray-500 transition hover:text-brand-600">
                        Katalog Mobil
                    </a>
                </li>
                <li>
                    <a href="{{ route('home') }}" class="text-gray-500 transition hover:text-brand-600">
                        Beranda
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="py-5 text-center text-xs text-gray-400">
        &copy; {{ date('Y') }} {{ config('showroom.name') }}. Hak cipta dilindungi.
    </div>
</footer>