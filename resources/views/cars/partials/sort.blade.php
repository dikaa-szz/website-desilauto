<form method="GET" action="{{ route('cars.index') }}">
    @foreach (request()->except(['sort', 'page']) as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach

    <select name="sort" onchange="this.form.submit()" aria-label="Urutkan" class="field">
        <option value="newest" @selected(request('sort', 'newest') === 'newest')>Urutkan: Terbaru</option>
        <option value="price_asc" @selected(request('sort') === 'price_asc')>Harga terendah</option>
        <option value="price_desc" @selected(request('sort') === 'price_desc')>Harga tertinggi</option>
        <option value="year_desc" @selected(request('sort') === 'year_desc')>Tahun terbaru</option>
    </select>
</form>