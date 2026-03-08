<?php

namespace App\Filament\Admin\Resources\Products\Schemas;

use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product Tabs')
                    ->vertical()
                    ->tabs([
                        Tab::make('Product Info')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Product Name')
                                    ->weight('bold')
                                    ->color('primary'),

                                TextEntry::make('id')
                                    ->label('Product ID'),

                                TextEntry::make('sku')
                                    ->label('Product SKU')
                                    ->badge()
                                    ->color('success'),

                                TextEntry::make('description')
                                    ->label('Product Description')
                                    ->markdown(),

                                TextEntry::make('created_at')
                                    ->label('Product Creation Date')
                                    ->date('d M Y')
                                    ->color('info'),
                            ]),

                        Tab::make('Pricing & Stock')
                            ->icon('heroicon-o-currency-dollar')
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Product Price')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->icon('heroicon-o-banknotes')
                                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),

                                TextEntry::make('stock')
                                    ->label('Product Stock')
                                    ->badge()
                                    ->icon('heroicon-o-cube')
                                    ->formatStateUsing(function ($state) {
                                        if ($state > 10) {
                                            return 'Banyak (' . $state . ')';
                                        }

                                        if ($state > 0) {
                                            return 'Sedikit (' . $state . ')';
                                        }

                                        return 'Habis';
                                    })
                                    ->color(function ($state) {
                                        if ($state > 10) {
                                            return 'success';
                                        }

                                        if ($state > 0) {
                                            return 'warning';
                                        }

                                        return 'danger';
                                    }),
                            ]),

                        Tab::make('Media & Status')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public'),

                                TextEntry::make('is_active')
                                    ->label('Status Active')
                                    ->badge()
                                    ->formatStateUsing(fn ($state) => $state ? 'Active' : 'Inactive')
                                    ->color(fn ($state) => $state ? 'success' : 'danger'),

                                TextEntry::make('is_featured')
                                    ->label('Featured')
                                    ->badge()
                                    ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No')
                                    ->color(fn ($state) => $state ? 'warning' : 'gray'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}