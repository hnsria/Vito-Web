/* =====================================================================
   app.js - dipakai semua halaman: ganti tema + efek klik bernuansa musik
   ===================================================================== */
(function () {
    'use strict';

    /* ---------- Mode terang / gelap ---------- */
    var root = document.documentElement;
    var toggle = document.getElementById('themeToggle');

    if (toggle) {
        toggle.addEventListener('click', function () {
            var next = root.dataset.theme === 'dark' ? 'light' : 'dark';
            root.dataset.theme = next;
            try { localStorage.setItem('theme', next); } catch (e) { /* abaikan */ }
        });
    }

    /* ---------- Efek klik: simbol di awal not balok ----------
       Clef (kunci G/F), tanda mol/kres/pugar, birama 4/4, dan not */
    var symbols = ['𝄞', '𝄢', '♯', '♭', '♮', 'TS', '♪', '♫', '♩', '♬',
                   'i-piano', 'i-guitar', 'i-mic', 'i-sax'];
    var colors = ['#1f6bff', '#00a8e8', '#5b6cff', '#3d8bff', '#4fc3ff'];

    function rand(min, max) { return Math.random() * (max - min) + min; }

    function spawnNote(x, y) {
        var el = document.createElement('span');
        var pick = symbols[Math.floor(Math.random() * symbols.length)];

        if (pick === 'TS') {
            el.className = 'click-note ts';
            el.innerHTML = '<b>4</b><b>4</b>';
        } else if (pick.indexOf('i-') === 0) {
            // alat musik: piano, gitar, mic, saxophone
            el.className = 'click-note icon';
            el.innerHTML = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" ' +
                'stroke-linecap="round" stroke-linejoin="round"><use href="#' + pick + '"/></svg>';
        } else {
            el.className = 'click-note';
            el.textContent = pick;
        }

        el.style.setProperty('--x', x + rand(-26, 26) + 'px');
        el.style.setProperty('--y', y + rand(-10, 10) + 'px');
        el.style.setProperty('--dx', rand(-70, 70) + 'px');
        el.style.setProperty('--rot', rand(-35, 35) + 'deg');
        el.style.setProperty('--size', rand(1.6, 2.6) + 'rem');
        el.style.setProperty('--c', colors[Math.floor(Math.random() * colors.length)]);

        document.body.appendChild(el);
        setTimeout(function () { el.remove(); }, 1500);
    }

    /* ---------- Header: hilang saat scroll, muncul lagi dari kunci G hanya saat mentok atas ----------
       Saat kartu dibuka (body.no-scroll) CSS juga menyembunyikannya. */
    var header = document.getElementById('siteHeader');

    if (header) {
        var syncHeader = function () {
            // tampil hanya saat scroll mentok di paling atas
            header.classList.toggle('is-hidden', window.scrollY > 10);
        };
        window.addEventListener('scroll', syncHeader, { passive: true });
        syncHeader();
    }

    document.addEventListener('click', function (e) {
        var count = 2 + Math.floor(Math.random() * 2); // 2-3 simbol per klik
        for (var i = 0; i < count; i++) {
            setTimeout(spawnNote, i * 90, e.clientX, e.clientY);
        }
    });
})();
