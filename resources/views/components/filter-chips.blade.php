@php
    $chipKeys = ['transmission', 'body_type'];

    $chips = [
        'Semua' => [],
        'Matic' => ['transmission' => 'automatic'],
        'Manual' => ['transmission' => 'manual'],
        'SUV' => ['body_type' => 'suv'],
        'MPV' => ['body_type' => 'mpv'],
    ];

    $base = request()->except(array_merge($chipKeys, ['page']));
@endphp

<div class="-mx-4 flex gap-2 overflow-x-auto px-4 pb-1 scrollbar-hide lg:mx-0 lg:px-0">
    @foreach ($chips as $label => $params)
        @php
            $active = $params === []
                ? ! request()->hasAny($chipKeys)
                : collect($params)->every(fn ($value, $key) => (string) request($key) === (string) $value);
        @endphp

        <a href="{{ route('cars.index', array_merge($base, $params)) }}"
           @class([
               'shrink-0 whitespace-nowrap rounded-full border px-4 py-2 text-sm font-medium transition',
               'border-brand-600 bg-brand-600 text-white shadow-sm' => $active,
               'border-gray-200 bg-white text-gray-700 hover:border-brand-500 hover:text-brand-700' => ! $active,
           ])>
            {{ $label }}
        </a>
    @endforeach
</div>