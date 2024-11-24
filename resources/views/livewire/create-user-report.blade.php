<div class="h-svh flex w-full flex-col items-center justify-center dark:bg-gray-900 gap-5">
    <x-slot name="title">
        User Report
    </x-slot>
    <h1 class="text-3xl font-extrabold dark:text-white">
        Laporan Permasalahan
    </h1>

    <form wire:submit="create" class="w-full max-w-screen-lg">
        <!-- Notifikasi -->
        @if (session()->has('success'))
            <div id="success-alert" class="mx-auto flex w-full max-w-lg justify-center py-2">
                <div class="p-4 mb-4 w-full text-sm text-white bg-green-500 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Menghilangkan notifikasi setelah 3 detik
                    setTimeout(() => {
                        const alert = document.getElementById('success-alert');
                        console.log('Alert element found:', alert); // Debugging: pastikan elemen ditemukan
                        if (alert) {
                            alert.style.transition = 'opacity 0.5s ease';
                            alert.style.opacity = '0';

                            // Hapus elemen setelah animasi selesai
                            setTimeout(() => {
                                console.log('Alert removed');
                                alert.remove();
                            }, 500);
                        }
                    }, 3000);
                });
            </script>
        @endif



        {{ $this->form }}


        <div class="mx-auto flex w-full max-w-lg justify-center pt-2">
            <button type="submit" class="w-full rounded-lg bg-orange-500 p-2 font-semibold text-white">
                Submit
            </button>
        </div>
    </form>

    <x-filament-actions::modals />
</div>
