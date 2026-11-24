/* =====================================================================
   gallery.js - Halaman 3: kartu galeri, fokus gelap, foto bisa digeser
   ===================================================================== */
(function () {
    'use strict';

    var focus = document.getElementById('focus');
    var body = document.getElementById('viewerBody');
    var closeBtn = document.getElementById('focusClose');
    var lastTrigger = null;
    var keyHandler = null;

    if (!focus || !body) { return; }

    /* ---------- Slider foto: geser dengan mouse / jari, tombol, atau panah keyboard ---------- */
    function initSlider() {
        var slider = body.querySelector('.slider');
        var track = body.querySelector('.slider-track');
        var dots = body.querySelectorAll('.dot');
        var prev = body.querySelector('.s-btn.prev');
        var next = body.querySelector('.s-btn.next');
        var count = track.children.length;
        var index = 0;
        var startX = 0;
        var dx = 0;
        var dragging = false;

        function render() {
            track.style.transform = 'translateX(calc(' + (-index * 100) + '% + ' + dx + 'px))';
            dots.forEach(function (d, i) { d.classList.toggle('active', i === index); });
            prev.hidden = index === 0;
            next.hidden = index === count - 1;
        }

        function go(i) {
            index = Math.max(0, Math.min(count - 1, i));
            dx = 0;
            render();
        }

        slider.addEventListener('pointerdown', function (e) {
            if (e.target.closest('.s-btn')) { return; }
            dragging = true;
            startX = e.clientX;
            dx = 0;
            slider.classList.add('dragging');
            slider.setPointerCapture(e.pointerId);
        });

        slider.addEventListener('pointermove', function (e) {
            if (!dragging) { return; }
            dx = e.clientX - startX;
            // sedikit "tahan" di ujung pertama/terakhir
            if ((index === 0 && dx > 0) || (index === count - 1 && dx < 0)) { dx *= 0.3; }
            render();
        });

        function endDrag() {
            if (!dragging) { return; }
            dragging = false;
            slider.classList.remove('dragging');
            var threshold = slider.clientWidth * 0.18;
            if (dx < -threshold) { index = Math.min(count - 1, index + 1); }
            else if (dx > threshold) { index = Math.max(0, index - 1); }
            dx = 0;
            render();
        }

        slider.addEventListener('pointerup', endDrag);
        slider.addEventListener('pointercancel', endDrag);

        prev.addEventListener('click', function () { go(index - 1); });
        next.addEventListener('click', function () { go(index + 1); });

        keyHandler = function (e) {
            if (e.key === 'ArrowLeft') { go(index - 1); }
            if (e.key === 'ArrowRight') { go(index + 1); }
        };
        document.addEventListener('keydown', keyHandler);

        render();
    }

    function openViewer(slug, trigger) {
        var tpl = document.getElementById('tpl-' + slug);
        if (!tpl) { return; }

        lastTrigger = trigger;
        body.replaceChildren(tpl.content.cloneNode(true));
        initSlider();

        focus.classList.add('open');
        focus.setAttribute('aria-hidden', 'false');
        document.body.classList.add('no-scroll');
        closeBtn.focus();
    }

    function closeViewer() {
        focus.classList.remove('open');
        focus.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('no-scroll');
        if (keyHandler) {
            document.removeEventListener('keydown', keyHandler);
            keyHandler = null;
        }
        if (lastTrigger) { lastTrigger.focus(); }
    }

    document.querySelectorAll('[data-album]').forEach(function (card) {
        card.addEventListener('click', function () {
            openViewer(card.dataset.album, card);
        });
    });

    closeBtn.addEventListener('click', closeViewer);

    // klik area gelap di sekeliling kartu menutup viewer
    focus.addEventListener('click', function (e) {
        if (e.target === focus) { closeViewer(); }
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && focus.classList.contains('open')) { closeViewer(); }
    });
})();
