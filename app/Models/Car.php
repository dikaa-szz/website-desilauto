<?php

namespace App\Models;

use App\Enums\CarStatus;
use App\Enums\FuelType;
use App\Enums\Transmission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Enums\BodyType;

class Car extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'brand_id', 'title', 'slug', 'model', 'variant', 'year', 'price',
        'mileage', 'transmission', 'fuel_type', 'body_type', 'color',
        'description', 'status', 'is_featured', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'status' => CarStatus::class,
            'transmission' => Transmission::class,
            'fuel_type' => FuelType::class,
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'body_type' => BodyType::class,
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Car $car) {
            $brandName = Brand::query()->whereKey($car->brand_id)->value('name');

            $car->title = collect([$brandName, $car->model, $car->variant, $car->year])
                ->filter()
                ->implode(' ');
        });

        static::creating(function (Car $car) {
            $base = Str::slug($car->title);
            $slug = $base;
            $i = 2;

            while (static::withTrashed()->where('slug', $slug)->exists()) {
                $slug = "{$base}-{$i}";
                $i++;
            }

            $car->slug = $slug;
        });
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photos');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Fit::Crop, 400, 300)
            ->nonQueued();

        $this->addMediaConversion('large')
            ->fit(Fit::Max, 1200, 900)
            ->nonQueued();
    }

    protected function priceFormatted(): Attribute
    {
        return Attribute::get(fn () => 'Rp ' . number_format($this->price, 0, ',', '.'));
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('is_published', true);
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query
            ->when($filters['q'] ?? null, fn ($q, $v) => $q->where('title', 'like', "%{$v}%"))
            ->when($filters['brand'] ?? null, fn ($q, $v) => $q->whereHas('brand', fn ($b) => $b->where('slug', $v)))
            ->when($filters['transmission'] ?? null, fn ($q, $v) => $q->where('transmission', $v))
            ->when($filters['fuel_type'] ?? null, fn ($q, $v) => $q->where('fuel_type', $v))
            ->when($filters['year_min'] ?? null, fn ($q, $v) => $q->where('year', '>=', $v))
            ->when($filters['year_max'] ?? null, fn ($q, $v) => $q->where('year', '<=', $v))
            ->when($filters['price_min'] ?? null, fn ($q, $v) => $q->where('price', '>=', $v))
            ->when($filters['price_max'] ?? null, fn ($q, $v) => $q->where('price', '<=', $v))
            ->when($filters['body_type'] ?? null, fn ($q, $v) => $q->where('body_type', $v));
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}