<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserReportResource\Pages;
use App\Filament\Resources\UserReportResource\RelationManagers;
use App\Models\UserReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserReportResource extends Resource
{
    protected static ?string $model = UserReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Perawatan';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Laporan Permasalahan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_user')
                    ->required(),
                Forms\Components\Select::make('damage_type')
                    ->options(
                        [
                            'not turning on' => 'Tidak nyala',
                            'not cooling' => 'Tidak dingin',
                            'noisy' => 'Berisik',
                        ]
                    )
                    ->required(),
                Forms\Components\TextInput::make('description')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_user')
                    ->searchable(),
                Tables\Columns\TextColumn::make('damage_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUserReports::route('/'),
            // 'create' => Pages\CreateUserReport::route('/create'),
            // 'edit' => Pages\EditUserReport::route('/{record}/edit'),
        ];
    }
}
