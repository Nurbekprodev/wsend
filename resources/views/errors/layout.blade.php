<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Error' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center">

    <div class="max-w-md w-full mx-auto px-4">

        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-sm p-8 text-center">

            <!-- Icon -->
            <div class="flex justify-center mb-5 text-gray-500 dark:text-gray-300">
                {!! $icon ?? '' !!}
            </div>

            <!-- Title -->
            <h1 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                {{ $title ?? 'Error' }}
            </h1>

            <!-- Message -->
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                {{ $message ?? '' }}
            </p>

            <!-- Hint -->
            @isset($hint)
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-6">
                    {{ $hint }}
                </p>
            @endisset

            <!-- Actions -->
            <div class="space-y-2">

                @isset($action)
                    <x-button-primary href="{{ $action['url'] }}"
                       class="inline-flex items-center justify-center w-full px-5 py-2.5" >
                        {{ $action['text'] }}
                    </x-button-primary>
                @endisset

                @isset($support)
                    <x-button-primary href="{{ $support }}"
                       class="inline-flex items-center justify-center w-full px-5 py-2.5">
                        Contact support
                    </x-button-primary>
                @endisset

            </div>

        </div>

    </div>

</body>
</html>