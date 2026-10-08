<?php

namespace App\Http\Controllers;

use App\Enums\FuelType;
use App\Enums\Transmission;
use App\Http\Requests\CarFilterRequest;
use App\Models\Brand;
use App\Models\Car;
use Illuminate\View\View;
use App\Enums\BodyType;
class CarController extends Controller
{
    public function index(CarFilterRequest $request): View
    {
        $filters = $request->validated();

        // Urutan di-whitelist, input mentah tidak pernah masuk ke orderBy
        [$column, $direction] = match ($filters['sort'] ?? 'newest') {
            'price_asc' => ['price', 'asc'],
            'price_desc' => ['price', 'desc'],
            'year_desc' => ['year', 'desc'],
            default => ['created_at', 'desc'],
        };

        $cars = Car::query()
            ->published()
            ->with(['brand', 'media'])   // eager loading, menghindari N+1
            ->filter($filters)
            ->orderBy($column, $direction)
            ->paginate(12)
            ->withQueryString();

        return view('cars.index', [
            'cars' => $cars,
            'filters' => $filters,
            'brands' => Brand::query()
                ->whereHas('cars', fn ($q) => $q->published())
                ->orderBy('name')
                ->get(),
            'transmissions' => Transmission::cases(),
            'fuelTypes' => FuelType::cases(),
            'bodyTypes' => BodyType::cases(),
        ]);
    }

    public function show(Car $car): View
    {
        abort_unless($car->is_published, 404);

        $car->load(['brand', 'media']);

        $related = Car::query()
            ->published()
            ->with(['brand', 'media'])
            ->where('brand_id', $car->brand_id)
            ->whereKeyNot($car->id)
            ->latest()
            ->limit(4)
            ->get();

        return view('cars.show', compact('car', 'related'));
    }
}