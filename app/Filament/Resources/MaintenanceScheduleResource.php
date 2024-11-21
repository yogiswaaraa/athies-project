<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaintenanceScheduleResource\Pages;
use App\Filament\Resources\MaintenanceScheduleResource\RelationManagers;
use App\Models\MaintenanceSchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaintenanceScheduleResource extends Resource
{
    protected static ?string $model = MaintenanceSchedule::class;
    protected static ?string $navigationIcon = 'heroicon-c-calendar-days';
    protected static ?string $navigationGroup = 'Perawatan';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Jadwal Perawatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ac_unit_id')
                    ->relationship('acUnit', 'id')
                    ->required(),
                Forms\Components\DatePicker::make('scheduled_date')
                    ->required(),
                Forms\Components\TextInput::make('type')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\DatePicker::make('completed_date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('acUnit.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('scheduled_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->sortable(),
                Tables\Columns\TextColumn::make('completed_date')
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
            'index' => Pages\ListMaintenanceSchedules::route('/'),
            'create' => Pages\CreateMaintenanceSchedule::route('/create'),
            'edit' => Pages\EditMaintenanceSchedule::route('/{record}/edit'),
        ];
    }
}
