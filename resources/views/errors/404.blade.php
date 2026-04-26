@extends('errors.layout')

@section('content')
    @php
        $title = 'Page Not Found';
        $message = 'The page you are looking for does not exist or has been moved.';
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <circle cx="11" cy="11" r="8"/>
            <path d="M21 21l-4.3-4.3"/>
            <path d="M8 11h6"/>
        </svg>';

        $hint = 'Check the URL or go back to home.';
        $action = ['url' => url('/'), 'text' => 'Go Home'];
    @endphp
@endsection