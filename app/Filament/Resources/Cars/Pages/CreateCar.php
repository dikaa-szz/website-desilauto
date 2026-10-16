<?php

namespace App\Filament\Resources\Cars\Pages;

use App\Filament\Resources\Cars\CarResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCar extends CreateRecord
{
    protected static string $resource = CarResource::class;

    protected function beforeCreate(): void
    {
        // Konversi foto berjalan langsung saat simpan, beri waktu cukup untuk banyak foto
        set_time_limit(300);
    }
}