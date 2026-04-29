@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block px-4 py-2.5 rounded-xl text-sm font-medium text-blue-600 bg-blue-50 dark:text-blue-400 dark:bg-blue-900/20 transition'
            : 'block px-4 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-300 dark:hover:text-white dark:hover:bg-gray-800 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>