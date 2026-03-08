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
                            ])
                            ->columnSpanFull(),

                        Tab::make('Pricing & Stock')
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Product Price')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->icon('heroicon-o-currency-dollar')
                                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),

                                TextEntry::make('stock')
                                    ->label('Product Stock')
                                    ->icon('heroicon-o-cube')
                                    ->weight('bold')
                                    ->color('primary'),
                            ])
                            ->columnSpanFull(),

                        Tab::make('Media & Status')
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
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}