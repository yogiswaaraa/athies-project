<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AcConditionLogResource\Pages;
use App\Filament\Resources\AcConditionLogResource\RelationManagers;
use App\Models\AcConditionLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AcConditionLogResource extends Resource
{
    protected static ?string $model = AcConditionLog::class;

    protected static ?string $navigationIcon = 'lucide-logs';

    protected static ?string $navigationGroup = 'AC';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Riwayat Kondisi';

    public static function schema(): array
    {
        return [
            Forms\Components\Select::make('ac_unit_id')
                ->relationship('acUnit', 'id')
                ->required(),
            Forms\Components\TextInput::make('temperature')
                ->required()
                ->numeric(),
            Forms\Components\TextInput::make('humidity')
                ->numeric(),
            Forms\Components\TextInput::make('power_consumption')
                ->numeric(),
            Forms\Components\TextInput::make('efficiency_rating')
                ->numeric(),
            Forms\Components\DateTimePicker::make('logged_at')
                ->required(),
        ];
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema(AcConditionLogResource::schema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('acUnit.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('temperature')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('humidity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('power_consumption')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('efficiency_rating')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('logged_at')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListAcConditionLogs::route('/'),
            // 'create' => Pages\CreateAcConditionLog::route('/create'),
            // 'edit' => Pages\EditAcConditionLog::route('/{record}/edit'),
        ];
    }
}
