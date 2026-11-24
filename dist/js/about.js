/* =====================================================================
   about.js - Halaman 2: pop-up kartu + progress bar yang berjalan
   ===================================================================== */
(function () {
    'use strict';

    var modal = document.getElementById('modal');
    var body = document.getElementById('modalBody');
    var closeBtn = document.getElementById('modalClose');
    var lastTrigger = null;

    if (!modal || !body) { return; }

    function animateBars() {
        body.querySelectorAll('.bar i').forEach(function (bar) {
            bar.style.width = bar.dataset.percent + '%';
        });

        // angka persen ikut naik
        body.querySelectorAll('.pct').forEach(function (el) {
            var target = parseInt(el.dataset.target, 10) || 0;
            var start = null;
            var duration = 1500;

            function step(ts) {
                if (start === null) { start = ts; }
                var p = Math.min((ts - start) / duration, 1);
                var eased = 1 - Math.pow(1 - p, 3);
                el.textContent = Math.round(target * eased);
                if (p < 1) { requestAnimationFrame(step); }
            }
            requestAnimationFrame(step);
        });
    }

    function openModal(id, trigger) {
        var tpl = document.getElementById('tpl-' + id);
        if (!tpl) { return; }

        lastTrigger = trigger;
        body.replaceChildren(tpl.content.cloneNode(true));
        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('no-scroll');
        closeBtn.focus();

        // dua frame agar transisi lebar bar dimulai dari 0
        requestAnimationFrame(function () {
            requestAnimationFrame(animateBars);
        });
    }

    function closeModal() {
        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('no-scroll');
        if (lastTrigger) { lastTrigger.focus(); }
    }

    document.querySelectorAll('[data-modal]').forEach(function (card) {
        card.addEventListener('click', function () {
            openModal(card.dataset.modal, card);
        });
    });

    closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', function (e) {
        if (e.target === modal) { closeModal(); }
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal.classList.contains('open')) { closeModal(); }
    });
})();
