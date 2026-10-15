<?php

namespace App\Filament\Resources\Cars\Schemas;

use App\Enums\BodyType;
use App\Enums\CarStatus;
use App\Enums\FuelType;
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
        return $schema
            ->components([
                Section::make('Data Mobil')
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
                                    ->maxLength(255),
                            ])
                            ->columnSpan(1),

                        TextInput::make('model')
                            ->label('Model')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Avanza')
                            ->columnSpan(1),

                        TextInput::make('variant')
                            ->label('Varian (opsional)')
                            ->maxLength(255)
                            ->placeholder('Contoh: 1.3 G')
                            ->columnSpan(1),

                        TextInput::make('year')
                            ->label('Tahun')
                            ->required()
                            ->numeric()
                            ->minValue(1990)
                            ->maxValue((int) date('Y') + 1)
                            ->columnSpan(1),

                        TextInput::make('price')
                            ->label('Harga')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->minValue(0)
                            ->step(1000)
                            ->helperText('Ketik tanpa titik/koma. Contoh: 150000000 untuk Rp 150.000.000')
                            ->dehydrateStateUsing(function ($state) {
                                if ($state === null || $state === '') {
                                    return null;
                                }

                                return (int) preg_replace('/\D/', '', (string) $state);
                            })
                            ->columnSpan(1),

                        TextInput::make('mileage')
                            ->label('Kilometer')
                            ->numeric()
                            ->minValue(0)
                            ->suffix('km')
                            ->columnSpan(1),

                        TextInput::make('transmission')
                            ->label('Transmisi')
                            ->required()
                            ->datalist([
                                'Automatic',
                                'Manual',
                                'CVT',
                                'DCT',
                                'AMT',
                            ])
                            ->placeholder('Pilih atau ketik sendiri')
                            ->maxLength(50)
                            ->helperText('Bisa pilih dari saran, atau ketik sendiri jika tidak ada di daftar.')
                            ->columnSpan(1),

                        Select::make('fuel_type')
                            ->label('Bahan Bakar')
                            ->options(FuelType::class)
                            ->required()
                            ->columnSpan(1),

                        Select::make('body_type')
                            ->label('Tipe Bodi')
                            ->options(BodyType::class)
                            ->columnSpan(1),

                        TextInput::make('color')
                            ->label('Warna')
                            ->maxLength(100)
                            ->placeholder('Contoh: Hitam')
                            ->columnSpan(1),

                        Select::make('status')
                            ->label('Status')
                            ->options(CarStatus::class)
                            ->required()
                            ->default(CarStatus::Available)
                            ->columnSpan(1),

                        Toggle::make('is_featured')
                            ->label('Tampilkan sebagai unggulan')
                            ->default(false)
                            ->columnSpan(1),

                        Toggle::make('is_published')
                            ->label('Publikasikan di website')
                            ->default(true)
                            ->columnSpan(1),
                    ])
                    ->columns(2),

                Section::make('Deskripsi dan Foto')
                    ->schema([
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(5)
                            ->columnSpanFull(),

                        SpatieMediaLibraryFileUpload::make('photos')
                            ->label('Foto Mobil (foto pertama menjadi sampul)')
                            ->collection('photos')
                            ->multiple()
                            ->reorderable()
                            ->image()
                            ->imageEditor()
                            ->maxFiles(50)
                            ->maxSize(10240)
                            ->panelLayout('grid')
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}