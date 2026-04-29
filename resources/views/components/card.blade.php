@props(['class' => ''])

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-800 rounded-xl shadow ' . $class]) }}>
    {{ $slot }}
</div>