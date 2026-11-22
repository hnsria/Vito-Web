@extends('layouts.app')

@section('title', 'Galeri ' . $profile['panggilan'])
@section('body-class', 'page-gallery')

@section('content')
<section class="page">
    <div class="page-head">
        <span class="badge">♬ Galeri</span>
        <h1>Potongan cerita <span class="grad">{{ $profile['panggilan'] }}</span></h1>
        <p class="lead">Klik salah satu kartu untuk melihat fotonya. Geser untuk pindah foto.</p>
    </div>

    <div class="card-grid gallery-grid">
        @foreach ($albums as $album)
            <button type="button" class="card album-card" data-album="{{ $album['slug'] }}" style="--i: {{ $loop->index }}">
                <img src="{{ asset($album['foto'][0]['src']) }}" alt="{{ $album['judul'] }}" draggable="false">
                <span class="album-info">
                    <strong>{{ $album['judul'] }}</strong>
                    <small>{{ count($album['foto']) }} foto</small>
                </span>
            </button>
        @endforeach
    </div>
</section>

{{-- Isi viewer per album --}}
@foreach ($albums as $album)
    <template id="tpl-{{ $album['slug'] }}">
        <div class="slider">
            <div class="slider-track">
                @foreach ($album['foto'] as $foto)
                    <figure class="slide">
                        <img src="{{ asset($foto['src']) }}" alt="{{ $foto['caption'] }}" draggable="false">
                        <figcaption>{{ $foto['caption'] }}</figcaption>
                    </figure>
                @endforeach
            </div>
            <button type="button" class="s-btn prev" aria-label="Foto sebelumnya">&lsaquo;</button>
            <button type="button" class="s-btn next" aria-label="Foto berikutnya">&rsaquo;</button>
        </div>
        <div class="dots">
            @foreach ($album['foto'] as $foto)
                <span class="dot"></span>
            @endforeach
        </div>
        <div class="viewer-info">
            <h2>{{ $album['judul'] }}</h2>
            <p>{{ $album['deskripsi'] }}</p>
        </div>
    </template>
@endforeach

{{-- Latar gelap yang membuat fokus ke kartu --}}
<div class="focus" id="focus" aria-hidden="true">
    <div class="viewer" role="dialog" aria-modal="true" aria-label="Foto galeri">
        <button type="button" class="modal-close" id="focusClose" aria-label="Tutup">&times;</button>
        <div id="viewerBody"></div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/gallery.js') }}"></script>
@endpush
