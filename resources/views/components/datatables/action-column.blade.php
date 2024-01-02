<div>
    @if (!isset($download))
        <x-dropdown align="left" width="48">
            <x-slot name="trigger">
                <a href="javascript:;">
                    <svg class="h-4 w-4 dark:text-white text-gray-800 " data-slot="icon" fill="none" stroke-width="1.5"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z">
                        </path>
                    </svg>
                </a>
            </x-slot>

            <x-slot name="content">
                @isset($show)
                    <x-dropdown-link href="javascript:;" wire:click="{{ $show }}">
                        <i class="fas fa-eye"></i> Show
                    </x-dropdown-link>
                @endisset

                @isset($edit)
                    <x-dropdown-link href="javascript:;" wire:click="{{ $edit }}">
                        <i class="fas fa-edit"></i> Edit
                    </x-dropdown-link>
                @endisset

                @isset($delete)
                    <x-dropdown-link href="javascript:;" wire:click="{{ $delete }}">
                        <div class="text-red-500">
                            <i class="fas fa-trash"></i> Delete
                        </div>
                    </x-dropdown-link>
                @endisset
            </x-slot>
        </x-dropdown>
    @endif

    @isset($download)
        <a href="javascript:;" wire:click="{{ $download }}">
            <i class="fas fa-download"></i>
        </a>
    @endisset
</div>
