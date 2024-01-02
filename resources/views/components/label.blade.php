@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => 'block mb-2 font-medium text-sm text-gray-800 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
    @if ($required)
        <span class="text-red-500">*</span>
    @endif
</label>
