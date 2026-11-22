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
        return view('about', [
            'profile'   => $this->profile(),
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
            'hobi'      => ['musik', 'fotografi', 'teknologi'],
            'instagram' => 'vito_r_hans',
            // GANTI dengan nomor WhatsApp Anda: format internasional, tanpa + dan tanpa 0 di depan
            'whatsapp'  => '6281234567890',
            'tentang'   => [
                'Saya Hans, seseorang yang menikmati hidup dengan irama yang santai. Hari-hari saya biasanya ditemani musik, kamera, dan rasa ingin tahu pada hal-hal baru.',
                'Di sini saya merangkum tiga hal yang paling saya sukai. Klik salah satu kartu di bawah untuk melihat cerita dan kemampuan saya lebih detail.',
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
                'slug'      => 'music-moments',
                'judul'     => 'Music Moments',
                'deskripsi' => 'My keys and band.',
                'foto'      => [
                    ['src' => 'images/galeri/foto1.jpg', 'caption' => 'Christmas'],
                    ['src' => 'images/galeri/foto2.jpg', 'caption' => 'Piano & Keyboard'],
                    ['src' => 'images/galeri/foto3.jpg', 'caption' => 'Band SMA'],
                ],
            ],
            [
                'slug'      => 'Fotografi',
                'judul'     => 'Jepretan Asal',
                'deskripsi' => 'Jepretan hasil mood dari hp.',
                'foto'      => [
                    ['src' => 'images/galeri/foto4.jpg', 'caption' => 'Melukat'],
                    ['src' => 'images/galeri/foto5.jpg', 'caption' => 'Batur'],
                    ['src' => 'images/galeri/foto6.jpg', 'caption' => 'Hometown'],
                ],
            ],
            [
                'slug'      => 'fashion-style',
                'judul'     => 'Outfit of the Day',
                'deskripsi' => 'My style daily.',
                'foto'      => [
                    ['src' => 'images/galeri/foto7.jpg', 'caption' => 'Best outfit'],
                    ['src' => 'images/galeri/foto8.jpg', 'caption' => 'Closer look'],
                    ['src' => 'images/galeri/foto9.jpg', 'caption' => 'My boots'],
                ],
            ],
            [
                'slug'      => 'random',
                'judul'     => 'Random Pics',
                'deskripsi' => 'Just random photos.',
                'foto'      => [
                    ['src' => 'images/galeri/foto10.jpg', 'caption' => 'Mac & Cheese'],
                    ['src' => 'images/galeri/foto11.jpg', 'caption' => 'Hometown'],
                    ['src' => 'images/galeri/foto12.jpg', 'caption' => 'My dog'],
                ],
            ],
        ];
    }
}
