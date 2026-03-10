<?php

namespace App\Filament\Admin\Resources\Posts\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Post Details')
                    ->description('Fill in the details of the post')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Group::make([
                            TextInput::make('title')
                                ->required()
                                ->minLength(5)
                                ->validationMessages([
                                    'required' => 'Title wajib diisi.',
                                    'minLength' => 'Title minimal 5 karakter.',
                                ]),

                            TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->minLength(3)
                                ->validationMessages([
                                    'required' => 'Slug wajib diisi.',
                                    'unique' => 'Slug harus unik dan tidak boleh sama.',
                                    'minLength' => 'Slug minimal 3 karakter.',
                                ]),

                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->preload()
                                ->searchable()
                                ->required()
                                ->validationMessages([
                                    'required' => 'Category wajib dipilih.',
                                ]),

                            ColorPicker::make('color'),
                        ])->columns(2),

                        MarkdownEditor::make('body')
                            ->label('Content'),
                    ])
                    ->columnSpan(2),

                Group::make([
                    Section::make('Image Upload')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('posts')
                                ->image()
                                ->required()
                                ->validationMessages([
                                    'required' => 'Image wajib diupload.',
                                ]),
                        ]),

                    Section::make('Meta Information')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            TagsInput::make('tags'),

                            Checkbox::make('published'),

                            DateTimePicker::make('published_at'),
                        ]),
                ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }
}