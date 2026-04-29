@props(['class' => ''])

<section {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</section>