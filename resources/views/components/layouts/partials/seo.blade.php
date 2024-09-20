@props([
    'page' => null,
    'appendTitle' => null,
])

@php
    throw_if(empty($page), 'Requires a "\App\Builders\Page\Page" instance to "page" prop.');
    throw_if(empty($appendTitle), 'Requires a value to "appendTitle" prop.');
@endphp

<title>{{ $page?->getTitleFromBreadcrumb() ?? 'Page Title' }} | {{ $appendTitle }}</title>

@if (!empty($page->getDescription()))
    <meta name="description" content="{{ $page->getDescription() }}">
@endif

@if (!empty($page->getKeywords()))
    <meta name="keywords" content="{{ $page->getKeywords() }}">
@endif

@if (!empty($page->getIndex()))
    <meta name="robots" content="{{ $page->getIndex() }}">
@endif
