@extends('errors.layout')

@section('content')
@php
    $title = 'Link Expired';
    $message = 'This file link has expired and is no longer available.';
    $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <circle cx="12" cy="12" r="10"/>
        <path d="M12 6v6l4 2"/>
    </svg>';

    $hint = 'Ask the sender to generate a new link.';
    $action = ['url' => url('/'), 'text' => 'Go Home'];
@endphp
@endsection