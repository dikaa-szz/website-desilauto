<header x-data="{ open: false }" class="sticky top-0 z-40 border-b border-gray-200/60 bg-white/80 backdrop-blur-xl">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
            <img src="{{ asset('logo-web.png') }}"
                 alt="Logo {{ config('showroom.name') }}"
                 class="h-9 w-auto md:h-10">
            <span class="hidden text-lg font-bold tracking-tight text-brand-600 sm:inline">
                {{ config('showroom.name') }}
            </span>
        </a>

        <nav class="hidden items-center gap-1 text-sm font-medium md:flex">
            <a href="{{ route('home') }}"
               class="rounded-lg px-3.5 py-2 transition {{ request()->routeIs('home') ? 'bg-brand-50 text-brand-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                Beranda
            </a>
            <a href="{{ route('cars.index') }}"
               class="rounded-lg px-3.5 py-2 transition {{ request()->routeIs('cars.*') ? 'bg-brand-50 text-brand-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                Katalog
            </a>
            <a href="{{ \App\Support\WhatsApp::link('Halo, saya ingin bertanya tentang mobil di showroom.') }}"
               target="_blank" rel="noopener"
               class="ml-2 inline-flex items-center gap-2 rounded-xl bg-gray-900 px-4 py-2 text-white shadow-sm transition hover:bg-gray-900 active:scale-[0.98]">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2a10 10 0 00-8.6 15.1L2 22l5-1.3A10 10 0 1012 2z"/>
                </svg>
                Hubungi Kami
            </a>
        </nav>

        <button type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-gray-600 transition hover:bg-gray-100 md:hidden"
                @click="open = !open"
                :aria-expanded="open"
                aria-label="Buka menu">
            <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg x-show="open" x-cloak class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Mobile menu --}}
    <nav x-show="open"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         class="border-t border-gray-100 bg-white px-4 py-3 md:hidden">
        <div class="space-y-1">
            <a href="{{ route('home') }}"
               class="block rounded-lg px-3 py-2.5 text-sm font-medium {{ request()->routeIs('home') ? 'bg-brand-50 text-brand-700' : 'text-gray-700 hover:bg-gray-50' }}">
                Beranda
            </a>
            <a href="{{ route('cars.index') }}"
               class="block rounded-lg px-3 py-2.5 text-sm font-medium {{ request()->routeIs('cars.*') ? 'bg-brand-50 text-brand-700' : 'text-gray-700 hover:bg-gray-50' }}">
                Katalog
            </a>
            <a href="{{ \App\Support\WhatsApp::link('Halo, saya ingin bertanya tentang mobil di showroom.') }}"
               target="_blank" rel="noopener"
               class="mt-2 flex items-center justify-center gap-2 rounded-xl bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white">
                Hubungi Kami
            </a>
        </div>
    </nav>
</header>