<div class="h-svh flex w-full flex-col items-center justify-center dark:bg-gray-900 gap-5">
    <h1 class="text-3xl font-extrabold dark:text-white">
        Laporan Permasalahan
    </h1>

    <form wire:submit="create" class="w-full max-w-screen-lg">
        {{ $this->form }}

        <div class="mx-auto flex w-full max-w-lg justify-center pt-2">
            <button type="submit" class="w-full rounded-lg bg-orange-500 p-2 font-semibold text-white">
                Submit
            </button>
        </div>
    </form>

    <x-filament-actions::modals />
</div>
