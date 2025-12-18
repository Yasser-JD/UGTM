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
                    ->label('التصنيف')
                    ->required(),
                TextInput::make('title')
                    ->label('العنوان')
                    ->required(),
                TextInput::make('slug')
                    ->label('الرابط (Slug)')
                    ->required(),
                Textarea::make('content')
                    ->label('المحتوى')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('الصورة')
                    ->image()
                    ->directory('posts')
                    ->visibility('public')
                    ->multiple()
                    ->reorderable(),
                FileUpload::make('attachment')
                    ->label('المرفقات')
                    ->directory('attachments')
                    ->acceptedFileTypes(['application/pdf'])
                    ->multiple()
                    ->downloadable()
                    ->openable(),
                Toggle::make('is_published')
                    ->label('منشور')
                    ->required(),
                Toggle::make('is_urgent')
                    ->label('عاجل')
                    ->required(),
                Toggle::make('is_featured')
                    ->label('مميز في الصفحة الرئيسية')
                    ->required(),
            ]);
    }
}
