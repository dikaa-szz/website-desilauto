<header x-data="{ open: false, scrolled: false }"
        x-init="scrolled = window.scrollY > 20; window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
        :class="scrolled ? 'border-b border-white/10 bg-gray-950/80 shadow-lg shadow-black/10' : 'border-b border-transparent bg-gray-950/40'"
        class="sticky top-0 z-40 backdrop-blur-xl transition-all duration-300">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
            <img src="{{ asset('logo-web.png') }}"
                 alt="Logo {{ config('showroom.name') }}"
                 class="h-9 w-auto brightness-0 invert md:h-10">
            <span class="hidden text-lg font-bold tracking-tight text-white sm:inline">
                {{ config('showroom.name') }}
            </span>
        </a>

        {{-- Menu desktop --}}
        <nav class="hidden items-center gap-1.5 text-sm font-medium md:flex">
            <a href="{{ route('home') }}"
               class="rounded-full px-4 py-2 transition
                      {{ request()->routeIs('home')
                          ? 'bg-white/15 text-white'
                          : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                Beranda
            </a>
            <a href="{{ route('cars.index') }}"
               class="rounded-full px-4 py-2 transition
                      {{ request()->routeIs('cars.*')
                          ? 'bg-white/15 text-white'
                          : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                Katalog
            </a>
            <a href="{{ \App\Support\WhatsApp::link('Halo, saya ingin bertanya tentang mobil di showroom.') }}"
               target="_blank" rel="noopener"
               class="ml-2 inline-flex items-center gap-2 rounded-full bg-green-600/90 px-5 py-2.5 text-white shadow-sm transition hover:bg-green-500 active:scale-[0.98]">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2a10 10 0 00-8.6 15.1L2 22l5-1.3A10 10 0 1012 2z"/>
                </svg>
                Hubungi Kami
            </a>
        </nav>

        {{-- Tombol mobile --}}
        <button type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-full text-white/80 transition hover:bg-white/10 md:hidden"
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
         class="border-t border-white/10 bg-gray-950/95 px-4 py-3 backdrop-blur-xl md:hidden">
        <div class="space-y-1.5">
            <a href="{{ route('home') }}"
               class="block rounded-full px-4 py-2.5 text-sm font-medium
                      {{ request()->routeIs('home') ? 'bg-white/15 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                Beranda
            </a>
            <a href="{{ route('cars.index') }}"
               class="block rounded-full px-4 py-2.5 text-sm font-medium
                      {{ request()->routeIs('cars.*') ? 'bg-white/15 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                Katalog
            </a>
            <a href="{{ \App\Support\WhatsApp::link('Halo, saya ingin bertanya tentang mobil di showroom.') }}"
               target="_blank" rel="noopener"
               class="mt-2 flex items-center justify-center gap-2 rounded-full bg-green-600 px-4 py-2.5 text-sm font-semibold text-white">
                Hubungi Kami
            </a>
        </div>
    </nav>
</header>