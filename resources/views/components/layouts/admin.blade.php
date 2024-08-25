<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $seo?->title ?? 'Page Title' }} | {{ config('app.name') }} Admin</title>
    <x-layouts.includes.seo :seo="$seo ?? null" />

    <tallstackui:script />
    @vite('resources/css/admin/app.css')
</head>

<body class="w-full min-h-screen flex justify-center items-center p-6">
    {{ $slot }}
</body>

</html>
