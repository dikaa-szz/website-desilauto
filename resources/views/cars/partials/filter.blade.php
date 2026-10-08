<form method="GET" action="{{ route('cars.index') }}" class="space-y-4">
    @if (request('sort'))
        <input type="hidden" name="sort" value="{{ request('sort') }}">
    @endif

    <div>
        <label class="mb-1 block text-sm font-medium">Merek</label>
        <select name="brand" class="field">
            <option value="">Semua merek</option>
            @foreach ($brands as $brand)
                <option value="{{ $brand->slug }}" @selected(($filters['brand'] ?? '') === $brand->slug)>{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="mb-1 block text-sm font-medium">Tipe bodi</label>
        <select name="body_type" class="field">
            <option value="">Semua</option>
            @foreach ($bodyTypes as $item)
                <option value="{{ $item->value }}" @selected(($filters['body_type'] ?? '') === $item->value)>{{ $item->getLabel() }}</option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-cols-2 gap-3">
        <div>
            <label class="mb-1 block text-sm font-medium">Transmisi</label>
            <select name="transmission" class="field">
                <option value="">Semua</option>
                @foreach ($transmissions as $item)
                    <option value="{{ $item->value }}" @selected(($filters['transmission'] ?? '') === $item->value)>{{ $item->getLabel() }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium">Bahan bakar</label>
            <select name="fuel_type" class="field">
                <option value="">Semua</option>
                @foreach ($fuelTypes as $item)
                    <option value="{{ $item->value }}" @selected(($filters['fuel_type'] ?? '') === $item->value)>{{ $item->getLabel() }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div>
        <label class="mb-1 block text-sm font-medium">Tahun</label>
        <div class="flex gap-2">
            <input type="number" name="year_min" value="{{ $filters['year_min'] ?? '' }}" placeholder="Dari" class="field">
            <input type="number" name="year_max" value="{{ $filters['year_max'] ?? '' }}" placeholder="Sampai" class="field">
        </div>
    </div>

    <div>
        <label class="mb-1 block text-sm font-medium">Harga (Rp)</label>
        <div class="flex gap-2">
            <input type="number" name="price_min" value="{{ $filters['price_min'] ?? '' }}" placeholder="Min" class="field">
            <input type="number" name="price_max" value="{{ $filters['price_max'] ?? '' }}" placeholder="Maks" class="field">
        </div>
    </div>

    <div class="flex gap-2 pt-2">
        <button type="submit" class="flex-1 rounded-xl bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-700">
            Terapkan
        </button>
        <a href="{{ route('cars.index') }}" class="rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-medium hover:bg-gray-50">
            Reset
        </a>
    </div>
</form>