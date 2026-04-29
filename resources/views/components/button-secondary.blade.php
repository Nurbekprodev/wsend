@props(['href' => null])

@if ($href)
<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' => 'inline-flex items-center justify-center 
                    px-5 py-2.5 
                    text-sm font-medium 
                    text-gray-700 
                    bg-white 
                    border border-gray-200 
                    hover:bg-gray-50 hover:text-gray-900
                    focus:ring-4 focus:ring-gray-100 focus:outline-none
                    rounded-xl 
                    transition duration-200
                    dark:bg-gray-800 dark:text-gray-300 
                    dark:border-gray-600 
                    dark:hover:bg-gray-700 dark:hover:text-white
                    dark:focus:ring-gray-700'
    ]) }}>
    {{ $slot }}
</a>
@else
<button 
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'inline-flex items-center justify-center 
                    px-5 py-2.5 
                    text-sm font-medium 
                    text-gray-700 
                    bg-white 
                    border border-gray-200 
                    hover:bg-gray-50 hover:text-gray-900
                    focus:ring-4 focus:ring-gray-100 focus:outline-none
                    rounded-xl 
                    transition duration-200
                    dark:bg-gray-800 dark:text-gray-300 
                    dark:border-gray-600 
                    dark:hover:bg-gray-700 dark:hover:text-white
                    dark:focus:ring-gray-700
                    disabled:opacity-50 disabled:cursor-not-allowed'
    ]) }}>
    {{ $slot }}
</button>
@endif