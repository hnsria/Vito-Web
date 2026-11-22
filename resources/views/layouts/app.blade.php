<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $profile['nama'])</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

    {{-- Terapkan tema tersimpan sebelum halaman tampil agar tidak berkedip --}}
    <script>
        try { document.documentElement.dataset.theme = localStorage.getItem('theme') || 'light'; } catch (e) {}
    </script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="@yield('body-class')">

    @include('partials.icons')

    {{-- Not dan alat musik (piano, gitar, mic, saxophone) melayang di latar belakang --}}
    <div class="bg-notes" aria-hidden="true">
        @foreach (['♪', 'i-piano', '♫', 'i-guitar', '♩', 'i-mic', '♬', 'i-sax', '♪', 'i-guitar', '♫', 'i-piano'] as $i => $item)
            <span style="--left: {{ 4 + $i * 8 }}%; --delay: {{ $i * 1.3 }}s; --dur: {{ 13 + ($i % 4) * 2 }}s">
                @if (str_starts_with($item, 'i-'))
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><use href="#{{ $item }}"/></svg>
                @else
                    {{ $item }}
                @endif
            </span>
        @endforeach
    </div>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @yield('floating')

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
