<x-dialog-modal wire:model.live="confirmModal">
    <x-slot name="title">
        Delete Category
    </x-slot>

    <x-slot name="description">
        Permanently delete this category.
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            Once a category is deleted, all of its resources and data will be permanently deleted. Before deleting this
            category, please download any data or information regarding this category that you wish to retain.
        </div>

    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('confirmModal')" target="$toggle('confirmModal')">
            Nevermind
        </x-secondary-button>

        <x-danger-button class="ml-2" wire:click="confirmDelete" target="confirmDelete">
            Delete Category
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
