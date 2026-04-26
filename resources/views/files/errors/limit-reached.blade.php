@extends('errors.layout')

@section('content')
@php
    $title = 'Download Limit Reached';
    $message = 'This file has reached its maximum number of downloads.';
    $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <path d="M12 2v20"/>
        <path d="M2 12h20"/>
    </svg>';

    $hint = 'The file is no longer available for download.';
    $action = ['url' => url('/'), 'text' => 'Go Home'];
@endphp
@endsection