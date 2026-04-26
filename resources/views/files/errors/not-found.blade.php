@extends('errors.layout')

@section('content')
@php
    $title = 'File Not Found';
    $message = 'This file does not exist or has been removed.';
    $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
        <path d="M14 2v6h6"/>
        <line x1="9" y1="15" x2="15" y2="9"/>
        <line x1="15" y1="15" x2="9" y2="9"/>
    </svg>';

    $hint = 'The link may be invalid or deleted.';
    $action = ['url' => url('/'), 'text' => 'Go Home'];
@endphp
@endsection