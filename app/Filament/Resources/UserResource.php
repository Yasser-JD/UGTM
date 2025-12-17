<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use BackedEnum;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationLabel = 'المنخرطين';
    
    protected static ?string $pluralModelLabel = 'المنخرطين';
    
    protected static ?string $modelLabel = 'منخرط';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_active', false)->where('is_admin', false)->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->label('الاسم الكامل')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('rental_number')
                    ->label('رقم التأجير')
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label('الهاتف'),
                Forms\Components\TextInput::make('province')
                    ->label('الإقليم'),
                Forms\Components\TextInput::make('commune')
                    ->label('الجماعة'),
                Forms\Components\TextInput::make('workplace')
                    ->label('مقر العمل'),
                Forms\Components\TextInput::make('job_title')
                    ->label('الإطار'),
                Forms\Components\Toggle::make('is_active')
                    ->label('حالة العضوية (نشط)')
                    ->onColor('success')
                    ->offColor('danger'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rental_number')
                    ->label('رقم التأجير')
                    ->searchable(),
                Tables\Columns\TextColumn::make('commune')
                    ->label('الجماعة')
                    ->searchable(),
                Tables\Columns\TextColumn::make('workplace')
                    ->label('مقر العمل')
                    ->searchable(),
                Tables\Columns\TextColumn::make('job_title')
                    ->label('الإطار')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ التسجيل')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('حالة العضوية')
                    ->placeholder('الكل')
                    ->trueLabel('نشط')
                    ->falseLabel('غير نشط'),
                Tables\Filters\SelectFilter::make('commune')
                    ->label('الجماعة')
                    ->options(function () {
                        $communes = array_keys(config('locations.Larache', []));
                        return array_combine($communes, $communes);
                    }),
                Tables\Filters\SelectFilter::make('job_title')
                    ->label('الإطار')
                    ->options(fn () => \App\Models\User::query()->whereNotNull('job_title')->distinct()->pluck('job_title', 'job_title')->toArray()),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->where('is_admin', false);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
