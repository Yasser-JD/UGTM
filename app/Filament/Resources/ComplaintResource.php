<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComplaintResource\Pages;
use App\Models\Complaint;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Schemas\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

use BackedEnum;

class ComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-exclamation-circle';
    
    protected static ?string $navigationLabel = 'الشكايات';
    
    protected static ?string $pluralModelLabel = 'الشكايات';
    
    protected static ?string $modelLabel = 'شكاية';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('معلومات المنخرط')
                    ->schema([
                        Forms\Components\Placeholder::make('user_name')
                            ->label('الاسم')
                            ->content(fn ($record) => $record?->user->name ?? '-'),
                        Forms\Components\Placeholder::make('user_phone')
                            ->label('الهاتف')
                            ->content(fn ($record) => $record?->user->phone ?? '-'),
                        Forms\Components\Placeholder::make('user_commune')
                            ->label('المدينة/الجماعة')
                            ->content(fn ($record) => $record?->user->commune ?? '-'),
                        Forms\Components\Placeholder::make('user_workplace')
                            ->label('مقر العمل')
                            ->content(fn ($record) => $record?->user->workplace ?? '-'),
                    ])->columns(2),

                Section::make('تفاصيل الشكاية')
                    ->schema([
                        Forms\Components\TextInput::make('type')
                            ->label('نوع المشكلة')
                            ->disabled(),
                        Forms\Components\TextInput::make('subject')
                            ->label('الموضوع')
                            ->disabled(),
                        Forms\Components\Textarea::make('details')
                            ->label('التفاصيل')
                            ->columnSpanFull()
                            ->disabled(),
                        Forms\Components\Placeholder::make('attachment')
                            ->label('المرفقات')
                            ->content(function ($record) {
                                if (empty($record->attachment)) {
                                    return 'لا توجد مرفقات';
                                }
                                $links = collect($record->attachment)->map(function ($path) {
                                    $url = \Illuminate\Support\Facades\Storage::url($path);
                                    $name = basename($path);
                                    return "<a href='{$url}' target='_blank' class='text-primary-600 hover:underline text-ugtm-purple font-bold'>{$name}</a>";
                                })->implode('<br>');
                                return new \Illuminate\Support\HtmlString($links);
                            }),
                        Forms\Components\Select::make('status')
                            ->label('الحالة')
                            ->options([
                                'pending' => 'قيد الانتظار',
                                'resolved' => 'تم الحل',
                                'rejected' => 'مرفوضة',
                            ])
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('المنخرط')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('النوع')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->label('الموضوع')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'resolved' => 'success',
                        'rejected' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ الإرسال')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('الحالة')
                    ->options([
                        'pending' => 'قيد الانتظار',
                        'resolved' => 'تم الحل',
                        'rejected' => 'مرفوضة',
                    ]),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComplaints::route('/'),
            'create' => Pages\CreateComplaint::route('/create'),
            'edit' => Pages\EditComplaint::route('/{record}/edit'),
        ];
    }
}
