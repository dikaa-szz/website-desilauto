<footer class="mt-12 border-t bg-white">
    <div class="mx-auto grid max-w-7xl gap-6 px-4 py-8 text-sm text-gray-600 md:grid-cols-2">
        <div>
            <img src="{{ asset('logo-web.png') }}"
                 alt="Logo {{ config('showroom.name') }}"
                 class="h-10 w-auto"
                 loading="lazy">
            <p class="mt-3">{{ config('showroom.address') }}</p>
        </div>
        <div class="md:text-right">
            <a href="{{ \App\Support\WhatsApp::link() }}" target="_blank" rel="noopener" class="text-green-700 hover:underline">
                Chat via WhatsApp
            </a>
            <p class="mt-1">&copy; {{ date('Y') }} {{ config('showroom.name') }}</p>
        </div>
    </div>
</footer>