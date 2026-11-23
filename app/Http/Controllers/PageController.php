<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /** Halaman 1 - Welcome */
    public function home()
    {
        // Foto untuk kartu putar di halaman 1 (diambil dari galeri, maksimal 5)
        $slides = collect($this->albums())
            ->flatMap(fn ($album) => $album['foto'])
            ->take(5)
            ->values()
            ->all();

        return view('welcome', [
            'profile' => $this->profile(),
            'slides'  => $slides,
        ]);
    }

    /** Halaman 2 - Tentang saya */
    public function about()
    {
        $profile = $this->profile();

        // Baris biodata pada lembar partitur (ditampilkan dengan @foreach)
        $biodata = [
            ['label' => 'Nama lengkap',   'nilai' => $profile['nama'],           'simbol' => '𝄞'],
            ['label' => 'Tanggal lahir',  'nilai' => $profile['tanggal_lahir'],  'simbol' => '♩'],
            ['label' => 'Tempat tinggal', 'nilai' => $profile['tempat_tinggal'], 'simbol' => '♪'],
        ];

        return view('about', [
            'profile'   => $profile,
            'biodata'   => $biodata,
            'interests' => $this->interests(),
        ]);
    }

    /** Halaman 3 - Galeri */
    public function gallery()
    {
        return view('gallery', [
            'profile' => $this->profile(),
            'albums'  => $this->albums(),
        ]);
    }

    /* ------------------------------------------------------------------
     |  DATA  (ubah di sini, semua tampilan akan ikut berubah)
     * ------------------------------------------------------------------ */

    private function profile(): array
    {
        return [
            'nama'      => 'Vito Riano Hans',
            'panggilan' => 'Hans',
            // GANTI dengan data asli Anda
            'tanggal_lahir'  => '11 Mei 2007',
            'tempat_tinggal' => 'Bakbakan, Gianyar',
            // taruh foto profil di public/images/profil.jpg lalu ubah nama file di sini
            'foto'      => 'images/galeri/foto7.jpg',
            'hobi'      =>['musik', 'fotografi', 'masak', 'game'],
            'instagram' => 'vito_r_hans',
            // GANTI dengan nomor WhatsApp Anda: format internasional, tanpa + dan tanpa 0 di depan
            'whatsapp'  => '6281234567890',
            'tentang'   => [
                'Saya Hans, seseorang yang menikmati hidup dengan irama yang santai. Hari-hari saya biasanya ditemani musik, kamera, dan rasa ingin tahu pada hal-hal baru.',
                'Di sini saya merangkum Empat hal yang paling saya sukai. Klik salah satu kartu di bawah untuk melihat cerita dan kemampuan saya lebih detail.',
            ],
        ];
    }

    private function interests(): array
    {
        return [
            [
                'slug'    => 'musik',
                'ikon'    => '🎹',
                'judul'   => 'Musik',
                'ringkas' => 'Nada adalah cara saya menenangkan pikiran.',
                'detail'  => 'Musik selalu menemani saya, mulai dari mendengarkan lagu santai sampai bermain piano di waktu luang.',
                'skill'   => [
                    ['nama' => 'Piano', 'persen' => 80],
                    ['nama' => 'Mendengarkan & mengeksplorasi lagu', 'persen' => 95],
                    ['nama' => 'Aransemen sederhana', 'persen' => 55],
                ],
            ],
            [
                'slug'    => 'fotografi',
                'ikon'    => '📷',
                'judul'   => 'Fotografi',
                'ringkas' => 'Menangkap momen kecil yang sering terlewat.',
                'detail'  => 'Lewat kamera saya belajar memperhatikan cahaya, warna, dan suasana di sekitar.',
                'skill'   => [
                    ['nama' => 'Komposisi', 'persen' => 75],
                    ['nama' => 'Editing foto', 'persen' => 70],
                    ['nama' => 'Fotografi lanskap', 'persen' => 65],
                ],
            ],
            [
                'slug'    => 'teknologi',
                'ikon'    => '💻',
                'judul'   => 'Teknologi',
                'ringkas' => 'Selalu penasaran dengan hal baru dan cara kerjanya.',
                'detail'  => 'Saya suka mengutak-atik gadget, belajar pemrograman, dan membangun hal kecil yang berguna.',
                'skill'   => [
                    ['nama' => 'Pemrograman web (Laravel)', 'persen' => 70],
                    ['nama' => 'Desain tampilan (UI)', 'persen' => 60],
                    ['nama' => 'Gadget & perangkat keras', 'persen' => 80],
                ],
            ],
            [
                'slug'    => 'fashion',
                'ikon'    => '👕',
                'judul'   => 'Fashion',
                'ringkas' => 'Gaya santai yang tetap punya karakter.',
                'detail'  => 'Bagi saya berpakaian adalah cara lain untuk berekspresi: nyaman, rapi, dan tetap terasa seperti diri sendiri.',
                'skill'   => [
                    ['nama' => 'Gaya kasual', 'persen' => 85],
                    ['nama' => 'Padu padan outfit', 'persen' => 70],
                    ['nama' => 'Eksplorasi tren & thrifting', 'persen' => 60],
                ],
            ],
        ];
    }

    private function albums(): array
    {
        return [
            [
                'slug'      => 'momen-musik',
                'judul'     => 'Momen Musik',
                'deskripsi' => 'Saat bermain dan menikmati nada.',
                'foto'      => [
                    ['src' => 'images/galeri/foto1.jpg', 'caption' => 'Christmas'],
                    ['src' => 'images/galeri/foto2.jpg', 'caption' => 'Piano & Keyboard'],
                    ['src' => 'images/galeri/foto3.jpg', 'caption' => 'My band'],
                ],
            ],
            [
                'slug'      => 'Picture of moments',
                'judul'     => 'Picture of moments',
                'deskripsi' => 'Hasil tangan pemula.',
                'foto'      => [
                    ['src' => 'images/galeri/foto4.jpg', 'caption' => 'Melukat'],
                    ['src' => 'images/galeri/foto5.jpg', 'caption' => 'Batur'],
                    ['src' => 'images/galeri/foto6.jpg', 'caption' => 'Hometown'],
                ],
            ],
            [
                'slug'      => 'fashion-style',
                'judul'     => 'My Fashion Style',
                'deskripsi' => 'Little of my style things.',
                'foto'      => [
                    ['src' => 'images/galeri/foto7.jpg', 'caption' => 'Best outfit'],
                    ['src' => 'images/galeri/foto8.jpg', 'caption' => 'Closer look'],
                    ['src' => 'images/galeri/foto9.jpg', 'caption' => 'My boots'],
                ],
            ],
            [
                'slug'      => 'Random Pic',
                'judul'     => 'Random Pic',
                'deskripsi' => 'Just random.',
                'foto'      => [
                    ['src' => 'images/galeri/foto10.jpg', 'caption' => 'Mac & Cheese'],
                    ['src' => 'images/galeri/foto11.jpg', 'caption' => 'Hometown'],
                    ['src' => 'images/galeri/foto12.jpg', 'caption' => 'My dog'],
                ],
            ],
        ];
    }
}
