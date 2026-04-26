@extends('errors.layout')

@section('content')
    @php
        $title = 'Server Error';
        $message = 'Something went wrong on our side. Please try again later.';
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M12 2v4"/>
            <path d="M12 18v4"/>
            <path d="M4.93 4.93l2.83 2.83"/>
            <path d="M16.24 16.24l2.83 2.83"/>
            <path d="M2 12h4"/>
            <path d="M18 12h4"/>
        </svg>';

        $hint = 'We are already working on it.';
        $action = ['url' => url('/'), 'text' => 'Go Home'];
    @endphp
@endsection