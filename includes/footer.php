<?php
/**
 * GP COACHING — footer.php
 * Inclure en bas de chaque page : <?php include 'includes/footer.php'; ?>
 */
?>

<!-- ══ FOOTER ══ -->
<footer>
  <div class="footer-inner">
    <div class="footer-brand">
      <div class="footer-brand-logo">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color:var(--gold);width:18px;height:18px">
          <circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>
        </svg>
      </div>
      <div>
        <div class="footer-brand-name">GP Coaching</div>
        <div class="footer-brand-sub">Grandir avec Perspective</div>
      </div>
    </div>

    <nav class="footer-nav">
      <a href="index.php">Accueil</a>
      <a href="approche.php">Mon Approche</a>
      <a href="accompagnement.php">Accompagnement</a>
      <a href="contact.php">Contact</a>
    </nav>

    <div class="footer-right">
      <div class="footer-social">
        <a href="#" aria-label="LinkedIn" target="_blank" rel="noopener">in</a>
        <a href="#" aria-label="Facebook" target="_blank" rel="noopener">f</a>
      </div>
    </div>
  </div>
  <p class="footer-copy">© <?= date('Y') ?> GP Coaching · Béthune et sa région · Tous droits réservés</p>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
