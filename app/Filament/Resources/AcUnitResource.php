<?php

namespace App\Filament\Resources;

use App\Filament\Exports\AcUnitExporter;
use App\Filament\Resources\AcUnitResource\Pages;
use App\Filament\Resources\AcUnitResource\RelationManagers;
use App\Models\AcUnit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Filters\SelectFilter;
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
                Forms\Components\Select::make('model')
                    ->options(AcUnit::$ac_models)
                    ->required(),
                Forms\Components\TextInput::make('serial_number')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'active',
                        'maintenance' => 'maintenance',
                        'inactive' => 'inactive',
                    ])
                    ->native(false)
                    ->required(),
                Forms\Components\DatePicker::make('installation_date')
                    ->native(false)
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
                Tables\Columns\TextColumn::make('current_temperature.temperature')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('efficiency_rating.efficiency_rating')
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
                SelectFilter::make('building_id')
                    ->relationship('building', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('model')
                    ->options(AcUnit::$ac_models)
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(AcUnitExporter::class)
                    ->label('Export Unit'),
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
        ];
    }
}
