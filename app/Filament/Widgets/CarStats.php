<?php

namespace App\Filament\Widgets;

use App\Enums\CarStatus;
use App\Models\Brand;
use App\Models\Car;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CarStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Mobil', Car::count()),
            Stat::make('Tersedia', Car::where('status', CarStatus::Available)->count()),
            Stat::make('Terjual', Car::where('status', CarStatus::Sold)->count()),
            Stat::make('Merek', Brand::count()),
        ];
    }
}