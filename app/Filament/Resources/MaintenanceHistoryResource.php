<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaintenanceHistoryResource\Pages;
use App\Filament\Resources\MaintenanceHistoryResource\RelationManagers;
use App\Models\MaintenanceHistory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaintenanceHistoryResource extends Resource
{
    protected static ?string $model = MaintenanceHistory::class;

    protected static ?string $navigationIcon = 'lucide-logs';
    protected static ?string $navigationGroup = 'Perawatan';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Riwayat Perawatan';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('maintenance_schedule_id')
                    ->relationship('maintenanceSchedule', 'id')
                    ->required()
                    ->searchable(true)
                    ->native(false)
                    ->preload(),
                Forms\Components\TextInput::make('technician_name')
                    ->required(),
                Forms\Components\TextInput::make('cost')
                    ->numeric()
                    ->required(),
                Forms\Components\Textarea::make('actions_taken')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
                Forms\Components\Select::make('result')
                    ->options(MaintenanceHistory::$result_enum_array)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('maintenanceSchedule.scheduled_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('technician_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('result')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cost')
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
            'index' => Pages\ListMaintenanceHistories::route('/'),
            'create' => Pages\CreateMaintenanceHistory::route('/create'),
            // 'edit' => Pages\EditMaintenanceHistory::route('/{record}/edit'),
        ];
    }
}
