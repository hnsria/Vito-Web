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

    {{-- Lembar partitur yang terbuka: foto di kiri, biodata di kanan --}}
    <div class="score" aria-label="Biodata {{ $profile['panggilan'] }}">
        <article class="score-page score-left">
            <div class="photo-frame">
                <img src="{{ asset($profile['foto']) }}" alt="Foto {{ $profile['nama'] }}" draggable="false">
                <span class="photo-tag">{{ $profile['panggilan'] }}</span>
            </div>
            <p class="page-no">&mdash; 1 &mdash;</p>
        </article>

        <article class="score-page score-right">
            <header class="score-head">
                <span class="tempo">♩ = 80 &middot; Andante</span>
                <h2>Biodata {{ $profile['panggilan'] }}</h2>
            </header>

            <ul class="staff-list">
                {{-- LOOPING: baris biodata --}}
                @foreach ($biodata as $row)
                    <li class="staff-row" style="--i: {{ $loop->index }}">
                        <span class="staff-sym" aria-hidden="true">{{ $row['simbol'] }}</span>
                        <div>
                            <span class="staff-label">{{ $row['label'] }}</span>
                            <strong class="staff-value">{{ $row['nilai'] }}</strong>
                        </div>
                    </li>
                @endforeach

                <li class="staff-row" style="--i: {{ count($biodata) }}">
                    <span class="staff-sym" aria-hidden="true">♬</span>
                    <div>
                        <span class="staff-label">Hobi</span>
                        <span class="chips">
                            @foreach ($interests as $item)
                                <span class="chip">{{ $item['ikon'] }} {{ $item['judul'] }}</span>
                            @endforeach
                        </span>
                    </div>
                </li>
            </ul>
            <p class="page-no">&mdash; 2 &mdash;</p>
        </article>

        <span class="score-spine" aria-hidden="true"></span>
    </div>

    <h2 class="section-title">Kesukaan <span class="grad">{{ $profile['panggilan'] }}</span></h2>

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
