@php
    // Tiap menu punya ikon dan warna sendiri
    $menu = [
        ['route' => 'home',    'label' => 'Beranda', 'icon' => 'i-home',   'color' => '#1f6bff'],
        ['route' => 'about',   'label' => 'Tentang', 'icon' => 'i-user',   'color' => '#00a8e8'],
        ['route' => 'gallery', 'label' => 'Galeri',  'icon' => 'i-camera', 'color' => '#5b6cff'],
    ];
@endphp

<header class="site-header" id="siteHeader">
    {{-- Garis paranada + not yang berjalan: ciri khas header --}}
    <span class="runner" aria-hidden="true">♪</span>

    <a href="{{ route('home') }}" class="brand">
        <span class="clef" aria-hidden="true">𝄞</span>
        <span class="brand-text">{{ $profile['panggilan'] }}</span>
    </a>

    <nav class="nav" aria-label="Menu utama">
        @foreach ($menu as $item)
            <a href="{{ route($item['route']) }}"
               class="{{ request()->routeIs($item['route']) ? 'active' : '' }}"
               style="--c: {{ $item['color'] }}">
                <svg class="nav-ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><use href="#{{ $item['icon'] }}"/></svg>
                <span class="nav-label">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <button type="button" class="theme-toggle" id="themeToggle" aria-label="Ganti mode terang/gelap" title="Ganti tema">
        <svg class="icon-moon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
        <svg class="icon-sun" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
    </button>
</header>
