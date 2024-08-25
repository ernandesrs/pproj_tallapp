@props(['seo' => null])

<meta name="description" content="{{ $seo?->description ?? 'Some description' }}">
<meta name="keywords" content="{{ $seo?->keywords ?? 'lorem,dolor,sit' }}">
<meta name="robots" content="{{ $seo?->index ?? null ? 'index,follow' : 'noindex,nofollow' }}">
