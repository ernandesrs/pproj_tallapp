<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $seo?->title ?? 'Page Title' }} | {{ config('app.name') }}</title>
    <meta name="description" content="{{ $seo?->description ?? 'Some description' }}">
    <meta name="keywords" content="{{ $seo?->keywords ?? 'lorem,dolor,sit' }}">
    <meta name="robots" content="{{ $seo?->index ?? null ? 'index,follow' : 'noindex,nofollow' }}">

    @vite('resources/css/front/app.css')
</head>

<body class="bg-zinc-950 text-zinc-300 w-full min-h-screen flex justify-center items-center">
    <div class="bg-zinc-900 w-full max-w-[625px] p-5 rounded-lg text-center">
        <a href="{{ route('front.home') }}">
            <h1 class="text-5xl font-semibold uppercase mb-5">
                {{ config('app.name') }}
            </h1>
        </a>
        <div>
            {{ $slot }}
        </div>
    </div>
</body>

</html>
