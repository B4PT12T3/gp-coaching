<?php
/**
 * GP COACHING — header.php
 * Inclure en haut de chaque page : <?php include 'includes/header.php'; ?>
 */

// Détecter la page active
$current = basename($_SERVER['PHP_SELF']);

// Titre & meta par page
$pages_meta = [
    'index.php'           => [
        'title' => 'GP Coaching — Retrouvez la clarté pour avancer avec confiance',
        'desc'  => 'Coach certifié à Béthune. J\'accompagne particuliers et dirigeants à retrouver clarté, équilibre et performance. Premier échange gratuit.',
    ],
    'approche.php'        => [
        'title' => 'Mon Approche & la Méthode GPACE — GP Coaching',
        'desc'  => 'Découvrez la méthode GPACE de GP Coaching et la conviction qui guide chaque accompagnement : clarté, confiance, action durable.',
    ],
    'accompagnement.php'  => [
        'title' => 'Équilibre, Leadership, Signature — Accompagnements GP Coaching',
        'desc'  => 'Trois univers d\'accompagnement pour particuliers et entreprises. Coaching individuel, leadership et programmes signature sur-mesure.',
    ],
    'contact.php'         => [
        'title' => 'Contact — GP Coaching Béthune | 06 72 72 44 44',
        'desc'  => 'Contactez GP Coaching — Gilles. Coaching à Béthune et en visioconférence. Premier échange gratuit.',
    ],
];

$meta  = $pages_meta[$current] ?? $pages_meta['index.php'];
$title = $meta['title'];
$desc  = $meta['desc'];

// Helper : classe active
function nav_active(string $file): string {
    return basename($_SERVER['PHP_SELF']) === $file ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="<?= htmlspecialchars($desc) ?>"/>
  <meta property="og:title"       content="<?= htmlspecialchars($title) ?>"/>
  <meta property="og:description" content="<?= htmlspecialchars($desc) ?>"/>
  <meta property="og:type"        content="website"/>
  <title><?= htmlspecialchars($title) ?></title>
  <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body class="page-<?= str_replace('.php', '', $current) ?>">

<!-- ══ NAV ══ -->
<nav id="main-nav">
  <a class="nav-brand" href="index.php">
    <div class="nav-brand-logo">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color:var(--gold);width:22px;height:22px">
        <circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>
      </svg>
    </div>
    <div class="nav-brand-text">
      <span class="nav-brand-name">GP Coaching</span>
      <span class="nav-brand-sub">Grandir avec Perspective</span>
    </div>
  </a>

  <div class="nav-links">
    <a href="index.php"          class="<?= nav_active('index.php') ?>">Accueil</a>
    <a href="approche.php"       class="<?= nav_active('approche.php') ?>">Mon Approche</a>
    <a href="accompagnement.php" class="<?= nav_active('accompagnement.php') ?>">Comment je peux vous accompagner</a>
    <a href="contact.php"        class="<?= nav_active('contact.php') ?>">Contact</a>
  </div>

  <div class="nav-social">
    <a href="#" aria-label="LinkedIn" target="_blank" rel="noopener">in</a>
    <a href="#" aria-label="Facebook" target="_blank" rel="noopener">f</a>
  </div>

  <button class="nav-hamburger" id="nav-hamburger" aria-label="Ouvrir le menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<!-- Menu mobile -->
<div class="mobile-nav" id="mobile-nav">
  <button class="mobile-nav-close" id="mobile-nav-close">Fermer ✕</button>
  <a href="index.php">Accueil</a>
  <a href="approche.php">Mon Approche</a>
  <a href="accompagnement.php">Accompagnement</a>
  <a href="contact.php">Contact</a>
  <button onclick="openBooking()">Prendre rendez-vous</button>
</div>
