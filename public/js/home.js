/* =====================================================================
   home.js - Halaman 1: kartu foto berputar + tombol kontak
   ===================================================================== */
(function () {
    'use strict';

    /* ---------- Kartu foto yang berputar ---------- */
    var stack = document.getElementById('photoStack');

    if (stack) {
        var cards = Array.prototype.slice.call(stack.querySelectorAll('.photo-card'));
        var total = cards.length;
        var counter = document.getElementById('stackCounter');
        var current = 0;
        var busy = false;

        var place = function (card, index) {
            var pos = (index - current + total) % total;
            card.dataset.pos = pos < 4 ? pos : 'x';
        };

        var render = function (skip) {
            cards.forEach(function (card, i) {
                if (card !== skip) { place(card, i); }
            });
            if (counter) { counter.textContent = (current + 1) + ' / ' + total; }
        };

        var next = function () {
            if (busy || total < 2) { return; }
            busy = true;

            var top = cards[current];
            top.classList.add('fly');          // kartu depan terbang keluar
            current = (current + 1) % total;
            render(top);                        // kartu lain maju

            setTimeout(function () {            // lalu masuk ke tumpukan paling belakang
                top.classList.remove('fly');
                place(top, cards.indexOf(top));
                busy = false;
            }, 430);
        };

        stack.addEventListener('click', next);
        stack.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                next();
            }
        });

        render();
    }

    /* ---------- Tombol kontak bulat ---------- */
    var fab = document.getElementById('fab');
    var fabToggle = document.getElementById('fabToggle');

    if (fab && fabToggle) {
        fabToggle.addEventListener('click', function () {
            var open = fab.classList.toggle('open');
            fabToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });

        document.addEventListener('click', function (e) {
            if (!fab.contains(e.target)) {
                fab.classList.remove('open');
                fabToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }
})();
