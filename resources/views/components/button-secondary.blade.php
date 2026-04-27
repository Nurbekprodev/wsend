@props(['href' => null])

@if ($href)
<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' => 'inline-flex items-center justify-center 
                    px-5 py-2.5 text-sm font-medium 
                    text-gray-900 bg-white 
                    border border-gray-300 
                    hover:bg-gray-100 
                    rounded-lg transition
                    dark:bg-gray-800 dark:text-white 
                    dark:border-gray-600 
                    dark:hover:bg-gray-700'
    ]) }}>
    {{ $slot }}
</a>
@else
<button 
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'inline-flex items-center justify-center 
                    px-5 py-2.5 text-sm font-medium 
                    text-gray-900 bg-white 
                    border border-gray-300 
                    hover:bg-gray-100 
                    rounded-lg transition
                    dark:bg-gray-800 dark:text-white 
                    dark:border-gray-600 
                    dark:hover:bg-gray-700'
    ]) }}>
    {{ $slot }}
</button>
@endif