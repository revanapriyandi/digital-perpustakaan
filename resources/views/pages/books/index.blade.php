<div>
    <section class="pt-12 mx-auto sm:px-6 lg:px-8">
        <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                    <div>
                        <h5 class="mr-3 font-semibold dark:text-white">
                            Daftar/List Data Buku
                        </h5>
                        <p class="text-gray-500 dark:text-gray-400">
                            Daftar/List Data Buku yang anda miliki saat ini.
                        </p>
                    </div>
                    <x-button wire:click="showForm" target="showForm">
                        Tambah Data
                    </x-button>
                    <x-button wire:click="exportExcel" target="exportExcel">
                        Export Excel
                    </x-button>
                </div>
            </div>
        </div>
    </section>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="w-full text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">

                <div class="pt-4">
                    <livewire:pages.books.tableBooks />
                </div>
            </div>
        </div>
    </div>

    <livewire:pages.books.modal-confirm />
</div>
