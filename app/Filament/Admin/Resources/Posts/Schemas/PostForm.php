<?php

namespace App\Filament\Admin\Resources\Posts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Validation\Rules\Unique;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->minLength(5),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),

                ColorPicker::make('color'),

                RichEditor::make('body'),

                FileUpload::make('image')
                    ->disk('public')
                    ->directory('posts')
                    ->image(),

                TagsInput::make('tags'),

                Checkbox::make('published'),

                DateTimePicker::make('published_at'),
            ]);
    }
}