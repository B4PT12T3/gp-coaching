/* ============================================================
   GP COACHING V3 — MAIN.JS
   ============================================================ */
document.addEventListener('DOMContentLoaded', () => {

  /* ── NAV SCROLL ── */
  const nav = document.getElementById('main-nav');
  window.addEventListener('scroll', () => {
    nav?.classList.toggle('scrolled', window.scrollY > 30);
  }, { passive: true });

  /* ── ACTIVE NAV LINK ── */
  const page = window.location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.nav-links a').forEach(a => {
    if (a.getAttribute('href') === page) a.classList.add('active');
  });

  /* ── MOBILE NAV ── */
  const hamburger = document.getElementById('nav-hamburger');
  const mobileNav = document.getElementById('mobile-nav');
  const mobileClose = document.getElementById('mobile-nav-close');
  hamburger?.addEventListener('click', () => {
    mobileNav?.classList.toggle('open');
    document.body.style.overflow = mobileNav?.classList.contains('open') ? 'hidden' : '';
  });
  mobileClose?.addEventListener('click', () => {
    mobileNav?.classList.remove('open');
    document.body.style.overflow = '';
  });

  /* ── SCROLL ANIMATIONS ── */
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
  document.querySelectorAll('.fade-up').forEach(el => io.observe(el));

  /* ── COUNTER ANIMATION ── */
  const countIO = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (!e.isIntersecting) return;
      const el = e.target;
      const end = parseFloat(el.dataset.count);
      const suffix = el.dataset.suffix || '';
      const prefix = el.dataset.prefix || '';
      const dur = 1600;
      const start = performance.now();
      const tick = (now) => {
        const p = Math.min((now - start) / dur, 1);
        const v = end * (1 - Math.pow(1 - p, 3));
        el.textContent = prefix + (Number.isInteger(end) ? Math.round(v) : v.toFixed(1)) + suffix;
        if (p < 1) requestAnimationFrame(tick);
      };
      requestAnimationFrame(tick);
      countIO.unobserve(el);
    });
  }, { threshold: 0.5 });
  document.querySelectorAll('[data-count]').forEach(el => countIO.observe(el));

  /* ── CONTACT FORM ── */
  const form = document.getElementById('contact-form');
  form?.addEventListener('submit', e => {
    e.preventDefault();
    const btn = form.querySelector('[type="submit"]');
    btn.textContent = 'Message envoyé ✓';
    btn.disabled = true;
    btn.style.background = '#4A6741';
    btn.style.color = '#fff';
  });

  /* ── BOOKING ── */
  window.openBooking = () => {
    // 👉 Remplacer par ton vrai lien Calendly
    window.open('https://calendly.com/', '_blank');
  };

});
