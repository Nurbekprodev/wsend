@props(['href' => null])

@if ($href)
<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' => 'inline-flex items-center justify-center 
                    px-5 py-2.5 
                    text-sm font-semibold 
                    text-white 
                    bg-blue-600 
                    hover:bg-blue-700 
                    focus:ring-4 focus:ring-blue-300 focus:outline-none
                    rounded-xl 
                    shadow-sm shadow-blue-600/20
                    transition duration-200
                    dark:bg-blue-600 dark:hover:bg-blue-700 
                    dark:focus:ring-blue-800'
    ]) }}>
    {{ $slot }}
</a>
@else
<button 
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'inline-flex items-center justify-center 
                    px-5 py-2.5 
                    text-sm font-semibold 
                    text-white 
                    bg-blue-600 
                    hover:bg-blue-700 
                    focus:ring-4 focus:ring-blue-300 focus:outline-none
                    rounded-xl 
                    shadow-sm shadow-blue-600/20
                    transition duration-200
                    dark:bg-blue-600 dark:hover:bg-blue-700 
                    dark:focus:ring-blue-800
                    disabled:opacity-50 disabled:cursor-not-allowed'
    ]) }}>
    {{ $slot }}
</button>
@endif