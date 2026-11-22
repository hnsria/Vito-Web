@extends('layouts.app')

@section('title', 'Halo, saya ' . $profile['panggilan'])
@section('body-class', 'page-home')

@section('content')
<section class="hero">
    {{-- KIRI: judul (semua teks berasal dari variabel $profile) --}}
    <div class="hero-text">
        <span class="badge">♪ Selamat datang</span>

        <h1>
            Halo, nama saya
            <span class="grad">{{ $profile['nama'] }}</span>
        </h1>

        <p class="hero-sub">
            Bisa dipanggil <strong>{{ $profile['panggilan'] }}</strong>.
            Suka
            @foreach ($profile['hobi'] as $hobi)
                @if ($loop->last && ! $loop->first) dan @endif
                <em>{{ $hobi }}</em>@if (! $loop->last && $loop->remaining > 1),@endif
            @endforeach.
        </p>

        <div class="hero-actions">
            <a href="{{ route('about') }}" class="btn btn-primary">Kenalan dulu</a>
            <a href="{{ route('gallery') }}" class="btn btn-ghost">Lihat galeri</a>
        </div>
    </div>

    {{-- KANAN: kartu foto yang bisa diputar dengan klik --}}
    <div class="hero-visual">
        <div class="stack-wrap">
            <div class="stack" id="photoStack" tabindex="0" role="button" aria-label="Klik untuk ganti foto">
                @foreach ($slides as $slide)
                    <figure class="photo-card" data-pos="{{ $loop->index < 4 ? $loop->index : 'x' }}">
                        <img src="{{ asset($slide['src']) }}" alt="{{ $slide['caption'] }}" draggable="false">
                        <figcaption>{{ $slide['caption'] }}</figcaption>
                    </figure>
                @endforeach
            </div>
            <p class="stack-hint">
                <span id="stackCounter">1 / {{ count($slides) }}</span>
                &middot; klik kartu untuk ganti foto
            </p>
        </div>
    </div>
</section>
@endsection

{{-- Tombol kontak bulat di kanan bawah --}}
@section('floating')
<div class="fab-wrap" id="fab">
    <div class="fab-menu">
        <a class="fab-item fab-ig" href="https://instagram.com/{{ $profile['instagram'] }}" target="_blank" rel="noopener" aria-label="Instagram {{ $profile['instagram'] }}">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            <span class="fab-label">Instagram</span>
        </a>
        <a class="fab-item fab-wa" href="https://wa.me/{{ $profile['whatsapp'] }}?text={{ urlencode('Halo ' . $profile['panggilan'] . '!') }}" target="_blank" rel="noopener" aria-label="WhatsApp">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <span class="fab-label">WhatsApp</span>
        </a>
    </div>
    <button type="button" class="fab" id="fabToggle" aria-label="Hubungi saya" aria-expanded="false">
        <svg class="fab-open" viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
        <svg class="fab-close" viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
    </button>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
@endpush
