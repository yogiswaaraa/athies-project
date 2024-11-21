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
                    ->relationship('acUnit', 'unit_code')
                    ->required()
                    ->label('AC Unit'),
                Forms\Components\DatePicker::make('scheduled_date')
                    ->required()
                    ->label('Tanggal Terjadwal'),
                Forms\Components\Select::make('type')
                    ->options([
                        'routine' => 'Routine',
                        'repair' => 'Repair',
                        'inspection' => 'Inspection',
                    ])
                    ->required()
                    ->label('Tipe'),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi'),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->required()
                    ->label('Status'),
                Forms\Components\DatePicker::make('completed_date')
                    ->label('Tanggal Selesai'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('acUnit.unit_code')
                    ->label('AC Unit'),
                Tables\Columns\TextColumn::make('scheduled_date')
                    ->label('Tanggal Terjadwal')
                    ->date(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('completed_date')
                    ->label('Tanggal Selesai')
                    ->date(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                ->options([
                    'pending' => 'Pending',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ])
                ->label('Status'),
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
