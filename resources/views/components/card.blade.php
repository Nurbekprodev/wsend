<div {{ $attributes->merge([
    'class' => 'bg-white dark:bg-gray-800 
                border border-gray-200 dark:border-gray-700 
                rounded-2xl shadow-sm'
]) }}>
    {{ $slot }}
</div>