<?php

/**
 * GP COACHING — footer.php
 * Réseaux sociaux et copyright lus depuis la BDD
 */

// Charger content() si pas encore chargé
if (!function_exists('content')) {
  require_once __DIR__ . '/content.php';
}

// Réseaux sociaux — on n'affiche que ceux qui ont une URL renseignée
$socials = [
  'linkedin'  => ['url' => content('global', 'social_linkedin', ''),  'label' => 'LinkedIn',  'icon' => 'in'],
  'facebook'  => ['url' => content('global', 'social_facebook', ''),  'label' => 'Facebook',  'icon' => 'f'],
  'instagram' => ['url' => content('global', 'social_instagram', ''), 'label' => 'Instagram', 'icon' => 'ig'],
  'youtube'   => ['url' => content('global', 'social_youtube', ''),   'label' => 'YouTube',   'icon' => 'yt'],
];
$socials_actifs = array_filter($socials, fn($s) => !empty($s['url']));

// Fallback si aucun réseau configuré : afficher # pour que ce ne soit pas vide
// Copyright conditionnel selon la page
$current_page = basename($_SERVER['PHP_SELF']);
$copyright_long = "GP Coaching · Basé à Béthune, j'accompagne les particuliers, entrepreneurs, dirigeants et entreprises dans le Nord et Pas-de-Calais et plus largement dans les Hauts-de-France, en présentiel ou en visioconférence";
$copyright_short = content('global', 'footer_copyright', 'GP Coaching · Béthune et sa région · Tous droits réservés');
$copyright = in_array($current_page, ['index.php', 'accompagnement.php']) ? $copyright_long : $copyright_short;
?>

<!-- ══ FOOTER ══ -->
<footer>
  <div class="footer-inner">

    <div class="footer-brand">
      <div class="footer-brand-logo">
        <img
          src="<?= BASE_URL ?>assets/images/LogoBleu.png"
          alt="GP Coaching logo"
          style="width:36px;height:36px;object-fit:contain;display:block" />
      </div>
      <div>
        <div class="footer-brand-name">GP Coaching</div>
        <div class="footer-brand-sub"><span class="brand-initial">G</span>randir avec <span class="brand-initial">P</span>erspective</div>
      </div>
    </div>

    <div class="footer-nav">
      <a href="index.php">Accueil</a>
      <a href="approche.php"> Mon approche du coaching et ma Méthode GPACE</a>
      <a href="accompagnement.php">Accompagnement</a>
      <a href="contact.php">Contact</a>
    </div>

    <div class="footer-right">
      <?php if (!empty($socials_actifs)): ?>
        <div class="footer-social">
          <?php foreach ($socials_actifs as $s): ?>
            <a href="<?= htmlspecialchars($s['url']) ?>"
              aria-label="<?= $s['label'] ?>"
              target="_blank" rel="noopener noreferrer">
              <?= $s['icon'] ?>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

  </div>
  <p class="footer-copy">© <?= date('Y') ?> <?= htmlspecialchars($copyright) ?></p>
  <p class="footer-copy" style="margin-top:.5rem">
    <a href="<?= BASE_URL ?>rgpd.php"
      style="color:rgba(255,255,255,.3);text-decoration:none;transition:color .2s"
      onmouseover="this.style.color='rgba(255,255,255,.6)'"
      onmouseout="this.style.color='rgba(255,255,255,.3)'">
      Politique de confidentialité & RGPD
    </a>
  </p>
</footer>

<script>
  // Lien Calendly depuis la BDD
  window._calendlyUrl = <?= json_encode(content('global', 'calendly_url', 'https://calendly.com/')) ?>;
</script>
<script src="/assets/js/main.js"></script>
<script>
  // Initialiser les icônes Lucide après le chargement du DOM
  document.addEventListener('DOMContentLoaded', () => {
    if (typeof lucide !== 'undefined') lucide.createIcons();
  });
</script>

<!-- ══ BANNIÈRE COOKIES ══ -->
<?php if (basename($_SERVER['PHP_SELF']) !== 'rgpd.php'): ?>
<div id="cookie-banner" style="
  display:none;
  position:fixed; bottom:0; left:0; right:0; z-index:9998;
  background:#1B2B4B;
  border-top:1px solid rgba(255,255,255,.1);
  padding:1rem 2rem;
  flex-direction:row;
  align-items:center; justify-content:space-between;
  gap:1.5rem; flex-wrap:wrap;
  font-family:var(--sans); font-size:.82rem;
  box-shadow:0 -4px 24px rgba(0,0,0,.2);">
  <p style="color:rgba(255,255,255,.75);margin:0;flex:1;min-width:200px">
    Ce site utilise Google Analytics pour mesurer son audience.
    <a href="<?= BASE_URL ?>rgpd.php" style="color:var(--gold);text-decoration:underline">En savoir plus</a>
  </p>
  <div style="display:flex;gap:.75rem;flex-shrink:0">
    <button onclick="acceptCookies()" style="background:var(--gold);color:#fff;border:none;padding:.5rem 1.25rem;border-radius:4px;font-family:var(--sans);font-size:.78rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;cursor:pointer;">Accepter</button>
    <button onclick="refuseCookies()" style="background:transparent;color:rgba(255,255,255,.5);border:1px solid rgba(255,255,255,.2);padding:.5rem 1.25rem;border-radius:4px;font-family:var(--sans);font-size:.78rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;cursor:pointer;">Refuser</button>
  </div>
</div>
<script>
(function() {
  var consent = localStorage.getItem('cookies_consent');
  if (!consent) {
    var banner = document.getElementById('cookie-banner');
    if (banner) banner.style.display = 'flex';
  }
})();
function acceptCookies() {
  localStorage.setItem('cookies_consent', 'accepted');
  document.getElementById('cookie-banner').style.display = 'none';
  location.reload();
}
function refuseCookies() {
  localStorage.setItem('cookies_consent', 'refused');
  document.getElementById('cookie-banner').style.display = 'none';
}
</script>
<?php endif; ?>
</body>

</html>