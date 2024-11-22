<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MaintenanceHistory;

class PublicFormRiwayatPerawatan extends Component
{
    public $ac_unit_id;
    public $maintenance_date;
    public $technician_name;
    public $actions_taken;
    public $notes;
    public $result;

    // Opsi hasil (result)
    public $result_enum_array = [
    'success' => 'Success',
    'pending' => 'Pending',
    'failed' => 'Failed',
    ];

    protected $rules = [
    'ac_unit_id' => 'required|exists:ac_units,id',
    'maintenance_date' => 'required|date',
    'technician_name' => 'required|string|min:3',
    'actions_taken' => 'required|string|min:10',
    'notes' => 'nullable|string',
    'result' => 'required|string|in:success,pending,failed',
    ];

    public function submit()
    {
    $this->validate();

    MaintenanceHistory::create([
    'ac_unit_id' => $this->ac_unit_id,
    'maintenance_date' => $this->maintenance_date,
    'technician_name' => $this->technician_name,
    'actions_taken' => $this->actions_taken,
    'notes' => $this->notes,
    'result' => $this->result,
    ]);

    session()->flash('success', 'Data berhasil ditambahkan!');
    $this->reset();
    }

    public function render()
    {
    return view('livewire.public-form-riwayat-perawatan');
    }
}
