<div class="">
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="w-full bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mr-3 font-semibold dark:text-white">
                    Form Data Buku
                </h5>
                <div class="pt-4">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                            <x-label for="title" required :value="__('Judul Buku')" />
                            <x-input id="title" class="block mt-1 w-full" type="text" wire:model="title" required
                                autofocus placeholder="Judul Buku" />

                            <x-input-error for="title" class="mt-2" />
                        </div>
                        <div class="w-full px-3 mb-6 md:w-1/2">
                            <x-label for="category" required :value="__('Kategori Buku')" />
                            <x-select wire:model="category" id="category" class="block mt-1 w-full">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </x-select>

                            <x-input-error for="category" class="mt-2" />
                        </div>

                        <div class="w-full px-3 mb-6">
                            <x-label for="jumlah" required :value="__('Jumlah')" />
                            <x-input id="jumlah" class="block mt-1 w-full" type="number" wire:model="jumlah"
                                min="0" required placeholder="0" />

                            <x-input-error for="jumlah" class="mt-2" />
                        </div>

                        <div class="w-full px-3 mb-6 ">
                            <x-label for="description" required :value="__('Deskripsi')" />
                            <x-textarea id="description" class="block mt-1 w-full" wire:model="description" required />

                            <x-input-error for="description" class="mt-2" />
                        </div>
                        <div class="w-full px-3 mb-6  md:w-1/2">
                            <x-label for="cover" required :value="__('Upload Cover Buku (jpeg/jpg/png)')" />
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="cover" type="file" accept=".jpg, .jpeg, .png" wire:model="cover">
                            <small class="text-gray-600">*Ukuran maksimal 2MB</small>
                            <small class="text-gray-600">*Format file jpeg/jpg/png</small>
                            <x-input-error for="cover" class="mt-2" />

                            @if (isset($book))
                                <div class="flex items-start gap-2.5">
                                    <div class="flex flex-col gap-1">
                                        <div
                                            class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                                            <div class="group relative my-2.5">
                                                <div
                                                    class="absolute w-full h-full bg-gray-900/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                                                    <button data-tooltip-target="download-image"
                                                        wire:click="downloadImage"
                                                        class="inline-flex items-center justify-center rounded-full h-10 w-10 bg-white/30 hover:bg-white/50 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50">
                                                        <svg class="w-5 h-5 text-white" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 16 18">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3" />
                                                        </svg>
                                                    </button>
                                                    <div id="download-image" role="tooltip"
                                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                        Download image
                                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                                    </div>
                                                </div>
                                                <img src="{{ $book->cover_url }}" class="rounded-lg" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif

                        </div>
                        <div class="w-full px-3 mb-6  md:w-1/2">
                            <x-label for="filepdf" required :value="__('Upload File Buku (PDF) ')" />
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="filepdf" type="file" accept="application/pdf" wire:model="filepdf">
                            <small class="text-gray-600">*Ukuran maksimal 10MB</small>
                            <small class="text-gray-600">*Format file PDF</small>
                            <x-input-error for="filepdf" class="mt-2" />

                            @if (isset($book))
                                <a href="javascript:;" wire:click="downloadFilePdf">
                                    <div class="flex items-start gap-2.5">
                                        <div class="flex flex-col gap-1">
                                            <div
                                                class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                                                <div
                                                    class="flex items-start bg-gray-50 dark:bg-gray-600 rounded-xl p-2">
                                                    <div class="me-2">
                                                        <span
                                                            class="flex items-center gap-2 text-sm font-medium text-gray-900 dark:text-white pb-2">
                                                            <svg fill="none" aria-hidden="true"
                                                                class="w-5 h-5 flex-shrink-0" viewBox="0 0 20 21">
                                                                <g clip-path="url(#clip0_3173_1381)">
                                                                    <path fill="#E2E5E7"
                                                                        d="M5.024.5c-.688 0-1.25.563-1.25 1.25v17.5c0 .688.562 1.25 1.25 1.25h12.5c.687 0 1.25-.563 1.25-1.25V5.5l-5-5h-8.75z" />
                                                                    <path fill="#B0B7BD"
                                                                        d="M15.024 5.5h3.75l-5-5v3.75c0 .688.562 1.25 1.25 1.25z" />
                                                                    <path fill="#CAD1D8"
                                                                        d="M18.774 9.25l-3.75-3.75h3.75v3.75z" />
                                                                    <path fill="#F15642"
                                                                        d="M16.274 16.75a.627.627 0 01-.625.625H1.899a.627.627 0 01-.625-.625V10.5c0-.344.281-.625.625-.625h13.75c.344 0 .625.281.625.625v6.25z" />
                                                                    <path fill="#fff"
                                                                        d="M3.998 12.342c0-.165.13-.345.34-.345h1.154c.65 0 1.235.435 1.235 1.269 0 .79-.585 1.23-1.235 1.23h-.834v.66c0 .22-.14.344-.32.344a.337.337 0 01-.34-.344v-2.814zm.66.284v1.245h.834c.335 0 .6-.295.6-.605 0-.35-.265-.64-.6-.64h-.834zM7.706 15.5c-.165 0-.345-.09-.345-.31v-2.838c0-.18.18-.31.345-.31H8.85c2.284 0 2.234 3.458.045 3.458h-1.19zm.315-2.848v2.239h.83c1.349 0 1.409-2.24 0-2.24h-.83zM11.894 13.486h1.274c.18 0 .36.18.36.355 0 .165-.18.3-.36.3h-1.274v1.049c0 .175-.124.31-.3.31-.22 0-.354-.135-.354-.31v-2.839c0-.18.135-.31.355-.31h1.754c.22 0 .35.13.35.31 0 .16-.13.34-.35.34h-1.455v.795z" />
                                                                    <path fill="#CAD1D8"
                                                                        d="M15.649 17.375H3.774V18h11.875a.627.627 0 00.625-.625v-.625a.627.627 0 01-.625.625z" />
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_3173_1381">
                                                                        <path fill="#fff" d="M0 0h20v20H0z"
                                                                            transform="translate(0 .5)" />
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                            {{ $book->media_pdf->file_name }}
                                                        </span>
                                                        <span
                                                            class="flex text-xs font-normal text-gray-500 dark:text-gray-400 gap-2">
                                                            {{ $book->media_pdf->mime_type }}
                                                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                                                class="self-center" width="3" height="4"
                                                                viewBox="0 0 3 4" fill="none">
                                                                <circle cx="1.5" cy="2" r="1.5"
                                                                    fill="#6B7280" />
                                                            </svg>
                                                            {{ $book->media_pdf_size }} MB
                                                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                                                class="self-center" width="3" height="4"
                                                                viewBox="0 0 3 4" fill="none">
                                                                <circle cx="1.5" cy="2" r="1.5"
                                                                    fill="#6B7280" />
                                                            </svg>
                                                            PDF
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <x-secondary-button wire:click="backToIndex" target="backToIndex" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-button class="ms-3" wire:click="submit" target="submit">
                        {{ __('Save') }}
                    </x-button>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    @endpush
    @push('scripts')
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    @endpush
</div>
