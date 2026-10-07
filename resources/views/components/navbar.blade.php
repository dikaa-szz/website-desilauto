<header x-data="{ open: false }" class="sticky top-0 z-40 border-b bg-white/90 backdrop-blur">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="{{ asset('logo-web.png') }}"
                 alt="Logo {{ config('showroom.name') }}"
                 class="h-9 w-auto md:h-10">
            {{-- Hapus <span> ini jika logo sudah memuat tulisan nama showroom --}}
            <span class="hidden text-lg font-bold text-amber-600 sm:inline">
                {{ config('showroom.name') }}
            </span>
        </a>

        <nav class="hidden items-center gap-6 text-sm font-medium md:flex">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-amber-600' : 'text-gray-700 hover:text-amber-600' }}">Beranda</a>
            <a href="{{ route('cars.index') }}" class="{{ request()->routeIs('cars.*') ? 'text-amber-600' : 'text-gray-700 hover:text-amber-600' }}">Katalog</a>
            <a href="{{ \App\Support\WhatsApp::link('Halo, saya ingin bertanya tentang mobil di showroom.') }}"
               target="_blank" rel="noopener"
               class="rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700">
                Hubungi Kami
            </a>
        </nav>

        <button type="button" class="md:hidden" @click="open = !open" :aria-expanded="open" aria-label="Buka menu">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <nav x-show="open" x-cloak class="space-y-1 border-t px-4 py-3 text-sm font-medium md:hidden">
        <a href="{{ route('home') }}" class="block rounded-lg px-3 py-2 hover:bg-gray-100">Beranda</a>
        <a href="{{ route('cars.index') }}" class="block rounded-lg px-3 py-2 hover:bg-gray-100">Katalog</a>
    </nav>
</header>