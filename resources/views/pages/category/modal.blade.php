<x-dialog-modal wire:model.live="showModal">

    <x-slot name="title">
        {{ !$show ? 'Form' : 'Showing' }} Category Books
    </x-slot>

    <x-slot name="content">
        <div class="mb-4">
            <x-label for="name" required :value="__('Name')" />

            <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" :disabled="$show" required
                autofocus />

            <x-input-error for="name" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-label for="description" :value="__('Description')" />

            <x-textarea id="description" class="block mt-1 w-full" :disabled="$show" wire:model="description" />

            <x-input-error for="description" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-label for="status" required :value="__('Status')" />

            <x-select id="status" :disabled="$show" wire:model="status" class="block mt-1 w-full">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </x-select>

            <x-input-error for="status" class="mt-2" />

        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('showModal')" target="$toggle('showModal')"
            wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        @if (!$show)
            <x-button class="ms-3" wire:click="submit" target="submit">
                {{ __('Save') }}
            </x-button>
        @endif
    </x-slot>

</x-dialog-modal>
