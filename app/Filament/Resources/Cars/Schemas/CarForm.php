<?php

namespace App\Filament\Resources\Cars\Schemas;

use App\Enums\BodyType;
use App\Enums\CarStatus;
use App\Enums\FuelType;
use App\Enums\Transmission;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Data Mobil')
                ->columns(2)
                ->schema([
                    Select::make('brand_id')
                        ->label('Merek')
                        ->relationship('brand', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->label('Nama Merek')
                                ->required()
                                ->unique('brands', 'name'),
                        ]),
                    TextInput::make('model')
                        ->label('Model')
                        ->placeholder('Contoh: Avanza')
                        ->required()
                        ->maxLength(100),
                    TextInput::make('variant')
                        ->label('Varian (opsional)')
                        ->placeholder('Contoh: 1.3 G')
                        ->maxLength(100),
                    TextInput::make('year')
                        ->label('Tahun')
                        ->numeric()
                        ->required()
                        ->minValue(1980)
                        ->maxValue(now()->year + 1),
                    TextInput::make('price')
                        ->label('Harga')
                        ->numeric()
                        ->prefix('Rp')
                        ->required()
                        ->minValue(0),
                    TextInput::make('mileage')
                        ->label('Kilometer')
                        ->numeric()
                        ->suffix('km')
                        ->minValue(0),
                    Select::make('transmission')
                        ->label('Transmisi')
                        ->options(Transmission::class)
                        ->required(),
                    Select::make('fuel_type')
                        ->label('Bahan Bakar')
                        ->options(FuelType::class)
                        ->required(),
                    Select::make('body_type')
                        ->label('Tipe Bodi')
                        ->options(BodyType::class),
                    TextInput::make('color')
                        ->label('Warna')
                        ->placeholder('Contoh: Hitam')
                        ->maxLength(50),
                ]),

            Section::make('Deskripsi dan Foto')
                ->schema([
                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(6)
                        ->columnSpanFull(),
                    SpatieMediaLibraryFileUpload::make('photos')
                        ->label('Foto Mobil (foto pertama menjadi sampul)')
                        ->collection('photos')
                        ->multiple()
                        ->reorderable()
                        ->image()
                        ->imageEditor()
                        ->maxFiles(15)
                        ->maxSize(5120)
                        ->panelLayout('grid')
                        ->required()
                        ->columnSpanFull(),
                ]),

            Section::make('Status')
                ->columns(3)
                ->schema([
                    Select::make('status')
                        ->options(CarStatus::class)
                        ->default(CarStatus::Available)
                        ->required(),
                    Toggle::make('is_published')
                        ->label('Tampilkan di website')
                        ->default(true),
                    Toggle::make('is_featured')
                        ->label('Mobil unggulan'),
                ]),
        ]);
    }
}