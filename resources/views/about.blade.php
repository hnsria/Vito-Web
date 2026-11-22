@extends('layouts.app')

@section('title', 'Tentang ' . $profile['panggilan'])
@section('body-class', 'page-about')

@section('content')
<section class="page">
    <div class="page-head">
        <span class="badge">♫ Tentang saya</span>
        <h1>Kenalan sama <span class="grad">{{ $profile['panggilan'] }}</span></h1>

        {{-- LOOPING 1: paragraf deskripsi diri --}}
        @foreach ($profile['tentang'] as $paragraf)
            <p class="lead">{{ $paragraf }}</p>
        @endforeach
    </div>

    {{-- LOOPING 2: kartu kesukaan --}}
    <div class="card-grid">
        @foreach ($interests as $item)
            <button type="button" class="card interest-card" data-modal="{{ $item['slug'] }}" style="--i: {{ $loop->index }}">
                <span class="card-icon">{{ $item['ikon'] }}</span>
                <h2>{{ $item['judul'] }}</h2>
                <p>{{ $item['ringkas'] }}</p>
                <span class="card-more">Klik untuk detail &rarr;</span>
            </button>
        @endforeach
    </div>
</section>

{{-- Isi pop-up per kartu (dikloning ke modal oleh JS) --}}
@foreach ($interests as $item)
    <template id="tpl-{{ $item['slug'] }}">
        <div class="modal-icon">{{ $item['ikon'] }}</div>
        <h2 id="modalTitle">{{ $item['judul'] }}</h2>
        <p class="modal-desc">{{ $item['detail'] }}</p>

        <ul class="skills">
            {{-- LOOPING 3: progress bar kemampuan --}}
            @foreach ($item['skill'] as $skill)
                <li>
                    <div class="skill-top">
                        <span>{{ $skill['nama'] }}</span>
                        <b><span class="pct" data-target="{{ $skill['persen'] }}">0</span>%</b>
                    </div>
                    <div class="bar"><i data-percent="{{ $skill['persen'] }}"></i></div>
                </li>
            @endforeach
        </ul>
    </template>
@endforeach

<div class="modal" id="modal" aria-hidden="true">
    <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <button type="button" class="modal-close" id="modalClose" aria-label="Tutup">&times;</button>
        <div id="modalBody"></div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/about.js') }}"></script>
@endpush
