<form method="GET" action="{{ route('cars.index') }}" class="space-y-4">
    <div>
        <label class="mb-1 block text-sm font-medium">Cari</label>
        <input type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="Avanza, Brio..." class="field">
    </div>

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

    <div>
        <label class="mb-1 block text-sm font-medium">Urutkan</label>
        <select name="sort" class="field">
            <option value="newest" @selected(($filters['sort'] ?? 'newest') === 'newest')>Terbaru</option>
            <option value="price_asc" @selected(($filters['sort'] ?? '') === 'price_asc')>Harga terendah</option>
            <option value="price_desc" @selected(($filters['sort'] ?? '') === 'price_desc')>Harga tertinggi</option>
            <option value="year_desc" @selected(($filters['sort'] ?? '') === 'year_desc')>Tahun terbaru</option>
        </select>
    </div>

    <div class="flex gap-2 pt-2">
        <button type="submit" class="flex-1 rounded-lg bg-amber-600 px-4 py-2 text-sm font-semibold text-white hover:bg-amber-700">Terapkan</button>
        <a href="{{ route('cars.index') }}" class="rounded-lg border px-4 py-2 text-sm hover:bg-gray-50">Reset</a>
    </div>
</form>