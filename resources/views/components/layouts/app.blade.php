<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <link rel="icon" href="{{ $favicon ?? __('seo.favicon') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ $favicon ?? __('seo.favicon') }}">
    <title>{{ $title ?? __('seo.title') }}</title>
    <meta name="description" content="{{ $description ?? __('seo.description') }}">
    <meta name="keywords" content="{{ $keywords ?? __('seo.keywords') }}">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="{{ $title ?? __('seo.title') }}">
    <meta property="og:description" content="{{ $description ?? __('seo.description') }}">
    <meta property="og:image" content="{{ $banner ?? __('seo.banner') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    {{-- ASSETS --}}
    @foreach (config('app.available_locales') as $locale => $language)
        <link rel="alternate" hreflang="{{ $locale }}" href="{{ route('lang.switch', ['locale' => $locale]) }}">
    @endforeach

    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- DEPENDENCIES --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    {{ $slot }}

    @livewireScripts
</body>

</html>
