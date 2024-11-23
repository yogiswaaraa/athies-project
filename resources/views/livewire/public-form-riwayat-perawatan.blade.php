<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <div>
            <label for="ac_unit_id">AC Unit:</label>
            <select id="ac_unit_id" wire:model="ac_unit_id">
                <option value="">Pilih AC Unit</option>
                @foreach ($all_ac as $unit)
                    <option value="{{ $unit->id }}">{{ $unit->id }}</option>
                @endforeach
            </select>
            @error('ac_unit_id')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="maintenance_date">Tanggal Maintenance:</label>
            <input type="date" id="maintenance_date" wire:model="maintenance_date">
            @error('maintenance_date')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="technician_name">Nama Teknisi:</label>
            <input type="text" id="technician_name" wire:model="technician_name">
            @error('technician_name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="actions_taken">Tindakan yang Dilakukan:</label>
            <textarea id="actions_taken" wire:model="actions_taken"></textarea>
            @error('actions_taken')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="notes">Catatan:</label>
            <textarea id="notes" wire:model="notes"></textarea>
            @error('notes')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="result">Hasil:</label>
            <select id="result" wire:model="result">
                <option value="">Pilih Hasil</option>
                @foreach ($result_enum_array as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
            @error('result')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Tambah</button>
    </form>
</div>
