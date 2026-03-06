<?php

namespace App\Filament\Admin\Resources\Posts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;


class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make("title"),
                TextInput::make("slug"),
                Select::make("category_id")
                ->relationship("category", "name")
                ->preload()
                ->searchable(),
                ColorPicker::make("color"),
                //MarkdownEditor::make("content"),
                RichEditor::make("content"),
                FileUpload::make("Image")
                ->disk("public")
                ->directory("posts"),
            ]);
    }
}
