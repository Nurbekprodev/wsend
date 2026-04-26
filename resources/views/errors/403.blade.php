@extends('errors.layout')

@section('content')
    @php
        $title = 'Access Denied';
        $message = 'You don’t have permission to access this resource.';
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            <path d="M4 4l16 16"/>
        </svg>';

        $hint = 'If you think this is a mistake, contact support.';
        $action = ['url' => url('/'), 'text' => 'Go Home'];
    @endphp
@endsection