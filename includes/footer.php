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
$copyright = content('global', 'footer_copyright', 'GP Coaching · Béthune et sa région · Tous droits réservés');
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
      <a href="approche.php">Mon Approche</a>
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
</body>

</html>