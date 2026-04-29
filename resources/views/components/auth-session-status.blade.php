@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'p-3 rounded-xl bg-green-50 text-green-600 text-sm font-medium border border-green-100']) }}>
        {{ $status }}
    </div>
@endif