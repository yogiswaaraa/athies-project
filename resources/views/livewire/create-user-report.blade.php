<div>
    <form wire:submit="create">
        {{ $this->form }}
        
        <button type="submit" class="bg-slate-300">
            Submit
        </button>
    </form>
    
    <x-filament-actions::modals />
</div>