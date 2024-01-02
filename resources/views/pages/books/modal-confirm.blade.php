<x-dialog-modal wire:model.live="confirmModal">
    <x-slot name="title">
        Delete Book
    </x-slot>

    <x-slot name="description">
        Permanently delete this book.
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            Are you sure you want to delete this book? All of your data will be permanently removed from our
            database forever. This action cannot be undone.
        </div>

    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('confirmModal')" target="$toggle('confirmModal')">
            Nevermind
        </x-secondary-button>

        <x-danger-button class="ml-2" wire:click="confirmDelete" target="confirmDelete">
            Delete Book
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
