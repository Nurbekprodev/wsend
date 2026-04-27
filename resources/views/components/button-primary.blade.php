@props(['href' => null])

@if ($href)
<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' => 'inline-flex items-center justify-center 
                    px-5 py-2.5 
                    text-sm font-medium 
                    text-white 
                    bg-primary-700 
                    hover:bg-primary-800 
                    rounded-lg 
                    transition'
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
                    text-white 
                    bg-primary-700 
                    hover:bg-primary-800 
                    rounded-lg 
                    transition'
    ]) }}>
    {{ $slot }}
</button>
@endif