<div>
    <form wire:submit="create">
        {{ $this->form }}

        {{-- <button type="submit" class="bg-slate-300">
            Submit
        </button> --}}
    </form>
    <x-filament-actions::modals />

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const buttons = document.querySelectorAll('[wire:loading]');
            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    setTimeout(() => {
                        const spinner = button.querySelector('.filament-button-spinner');
                        if (spinner) {
                            spinner.style.display = 'none';
                        }
                    }, 100);
                });
            });
        });
    </script>



</div>
