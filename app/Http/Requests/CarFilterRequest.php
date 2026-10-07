<?php

namespace App\Http\Requests;

use App\Enums\FuelType;
use App\Enums\Transmission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'q' => ['nullable', 'string', 'max:100'],
            'brand' => ['nullable', 'string', 'max:100'],
            'transmission' => ['nullable', Rule::enum(Transmission::class)],
            'fuel_type' => ['nullable', Rule::enum(FuelType::class)],
            'year_min' => ['nullable', 'integer', 'min:1980', 'max:2100'],
            'year_max' => ['nullable', 'integer', 'min:1980', 'max:2100'],
            'price_min' => ['nullable', 'integer', 'min:0'],
            'price_max' => ['nullable', 'integer', 'min:0'],
            'sort' => ['nullable', Rule::in(['newest', 'price_asc', 'price_desc', 'year_desc'])],
        ];
    }
}