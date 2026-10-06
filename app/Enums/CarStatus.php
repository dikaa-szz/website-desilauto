<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum CarStatus: string implements HasLabel, HasColor
{
    case Available = 'available';
    case Booked = 'booked';
    case Sold = 'sold';

    public function getLabel(): string
    {
        return match ($this) {
            self::Available => 'Tersedia',
            self::Booked => 'Booking',
            self::Sold => 'Terjual',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Available => 'success',
            self::Booked => 'warning',
            self::Sold => 'danger',
        };
    }
}