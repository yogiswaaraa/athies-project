<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\MaintenanceSchedule;
use App\Models\MaintenanceHistory;
use Livewire\Component;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Filament\Notifications\Notification;


class PublicFormRiwayatPerawatan extends Component implements HasForms
{

    use InteractsWithForms;

    public string $title = 'Form Riwayat Perawatan';

    public ?array $data = []; // State untuk data form

    public function mount(): void
    {
        $this->form->fill($this->data ?? []);
    }

    public function form(Form $form): form
    {
        return $form
            ->schema([
                Section::make('')
                    ->compact()
                    ->id('main section')
                    ->schema([
                        Select::make('maintenance_schedule_id')
                            ->options(MaintenanceSchedule::pluck('scheduled_date', 'id')->toArray())
                            ->required(),
                        TextInput::make('technician_name')
                            ->required(),
                        TextArea::make('actions_taken')
                            ->required(),
                        TextArea::make('notes')
                            ->columnSpanFull(),
                        // Select::make('result')
                        //     ->options(MaintenanceHistory::$result_enum_array)
                        //     ->required(),
                    ])
                    // ->footerActions([
                    //     Action::make('submit')
                    //     ->label('Submit')
                    //     ->action(function () {
                    //          $this->create(); // Memanggil fungsi create()
                    //     }),
                    // ])
                    ->extraAttributes([
                        'class' => 'max-w-lg mx-auto bg-gray-800 p-6 rounded-lg shadow-md text-white font-bold',
                    ]),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        try {
            // Simpan ke database menggunakan data yang sudah ada
            MaintenanceHistory::create([
                'maintenance_schedule_id' => $this->data['maintenance_schedule_id'],
                'technician_name' => $this->data['technician_name'],
                'actions_taken' => $this->data['actions_taken'],
                'notes' => $this->data['notes'],
                'result' => 'partial',
                'maintenance_date' => now(), // tambahkan tanggal maintenance jika diperlukan
            ]);

            // Reset form
            $this->form->fill();

            // Tampilkan notifikasi sukses
            Notification::make()
                ->title('Data berhasil disimpan!')
                ->success()
                ->send();

            session()->flash('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            // Log error
            logger('Error saving maintenance history: ' . $e->getMessage());

            // Tampilkan notifikasi error
            Notification::make()
                ->title('Error!')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function render()
    {
        return view('livewire.public-form-riwayat-perawatan', ['title' => $this->title]);
    }
}
