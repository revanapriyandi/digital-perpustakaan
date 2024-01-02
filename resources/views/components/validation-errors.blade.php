@if ($errors->any())
    <div
        {{ $attributes->merge(['class' => 'flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400']) }}>
        <div>

            <span class="font-medium">{{ __('Whoops! Something went wrong.') }}</span>
            <ul class="mt-1.5 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
