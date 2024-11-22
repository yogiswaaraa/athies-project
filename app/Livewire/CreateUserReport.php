<?php

namespace App\Livewire;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateUserReport extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = []; // State untuk data form

    public function mount(): void
    {
        $this->form->fill($this->data ?? []);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Laporan Permasalahan')
                    ->compact()
                    ->id('main-section')
                    ->schema([
                        TextInput::make('name_user')
                            ->label('Nama Pengguna')
                            ->required()
                            ->placeholder('Masukkan nama pengguna...'),
                        Select::make('damage_type')
                            ->label('Tipe Kerusakan')
                            ->options([
                                'not_turning_on' => 'Tidak nyala',
                                'not_cooling' => 'Tidak dingin',
                                'noisy' => 'Berisik',
                            ])
                            ->required()
                            ->placeholder('Pilih tipe kerusakan...'),
                        TextInput::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->placeholder('Berikan deskripsi singkat masalah...'),
                    ])
                    ->footerActions([
                        Action::make('Submit')
                            ->label('Kirim')
                            ->action(function () {
                                $this->create();
                            })
                            ->button()
                            ->color('primary'),
                    ])
                    ->extraAttributes([
                        'class' => 'max-w-lg mx-auto bg-gray-800 p-6 rounded-lg shadow-md',
                    ]),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        // Validasi data
        $validatedData = $this->validate([
            'data.name_user' => 'required|string|max:255',
            'data.damage_type' => 'required|string',
            'data.description' => 'required|string|max:500',
        ]);

        // Simpan ke database
        \App\Models\UserReport::create([
            'name_user' => $validatedData['data']['name_user'],
            'damage_type' => $validatedData['data']['damage_type'],
            'description' => $validatedData['data']['description'],
        ]);

        // Reset form dan tampilkan pesan sukses
        $this->form->fill([]);
        session()->flash('success', 'Laporan berhasil dikirim.');

        // Debug data hasil validasi
        dd($validatedData);

        // Simpan logika tambahan di sini jika diperlukan, misalnya menyimpan ke database.
    }

    public function render(): View
    {
        return view('livewire.create-user-report');
    }
}
