<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum FuelType: string implements HasLabel
{
    case Bensin = 'bensin';
    case Diesel = 'diesel';
    case Hybrid = 'hybrid';
    case Listrik = 'listrik';

    public function getLabel(): string
    {
        return $this->name;
    }
}