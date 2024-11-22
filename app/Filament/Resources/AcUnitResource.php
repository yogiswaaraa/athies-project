<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AcUnitResource\Pages;
use App\Filament\Resources\AcUnitResource\RelationManagers;
use App\Models\AcUnit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AcUnitResource extends Resource
{
    protected static ?string $model = AcUnit::class;

    protected static ?string $navigationIcon = 'tabler-air-conditioning';

    protected static ?string $navigationGroup = 'AC';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Unit';

    public static function getWidgets(): array
{
    return [
    ];
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('building_id')
                    ->relationship('building', 'name')
                    ->searchable(true)
                    ->native(false)
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('unit_code')
                    ->required(),
                Forms\Components\TextInput::make('model')
                    ->required(),
                Forms\Components\TextInput::make('serial_number')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'active',
                        'inactive' => 'inactive',
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('current_condition')
                    ->options([
                        'normal' => 'normal',
                        'broken' => 'broken',
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('current_temperature')
                    ->numeric(),
                Forms\Components\TextInput::make('efficiency_rating')
                    ->numeric(),
                Forms\Components\DatePicker::make('installation_date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('building.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('model')
                    ->searchable(),
                Tables\Columns\TextColumn::make('serial_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('current_condition')
                    ->searchable(),
                Tables\Columns\TextColumn::make('current_temperature')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('efficiency_rating')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('installation_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListAcUnits::route('/'),
            'create' => Pages\CreateAcUnit::route('/create'),
            'edit' => Pages\EditAcUnit::route('/{record}/edit'),
            'test' => Pages\Testing::route('/test'),
        ];
    }
}
