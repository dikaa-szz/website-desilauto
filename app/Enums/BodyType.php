<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum BodyType: string implements HasLabel
{
    case Hatchback = 'hatchback';
    case Sedan = 'sedan';
    case Suv = 'suv';
    case Mpv = 'mpv';
    case Pickup = 'pickup';
    case Van = 'van';

    public function getLabel(): string
    {
        return match ($this) {
            self::Suv => 'SUV',
            self::Mpv => 'MPV',
            default => ucfirst($this->value),
        };
    }
}