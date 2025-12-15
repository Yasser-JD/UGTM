<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('content')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image(),
                FileUpload::make('attachment')
                    ->directory('attachments')
                    ->acceptedFileTypes(['application/pdf'])
                    ->downloadable()
                    ->openable(),
                Toggle::make('is_published')
                    ->required(),
                Toggle::make('is_urgent')
                    ->required(),
                Toggle::make('is_featured')
                    ->label('Feature on Homepage')
                    ->required(),
            ]);
    }
}
