<footer class="site-footer">
    <div class="footer-staff" aria-hidden="true"></div>
    <div class="footer-inner">
        <p class="footer-title">
            <span aria-hidden="true">𝄞</span> {{ $profile['nama'] }}
        </p>
        <p class="footer-sub">Musik &bull; Fotografi &bull; Teknologi</p>
        <p class="footer-links">
            <a href="https://instagram.com/{{ $profile['instagram'] }}" target="_blank" rel="noopener">&#64;{{ $profile['instagram'] }}</a>
            <span aria-hidden="true">♪</span>
            <a href="https://wa.me/{{ $profile['whatsapp'] }}" target="_blank" rel="noopener">WhatsApp</a>
        </p>
        <p class="footer-copy">&copy; {{ date('Y') }} {{ $profile['nama'] }}. Dibuat dengan Laravel.</p>
    </div>
</footer>
