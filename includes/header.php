<?php

/**
 * GP COACHING — header.php
 * Inclure en haut de chaque page : <?php include 'includes/header.php'; ?>
 */

// BASE_URL fallback si non défini par la page appelante
if (!defined('BASE_URL')) {
  define('BASE_URL', '/');
}

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
    'title' => 'Contact — GP Coaching | Béthune et Hauts-de-France',
    'desc'  => 'Contactez GP Coaching — Gilles. Coaching à Béthune et en visioconférence. Premier échange gratuit.',
  ],
];

$meta  = $pages_meta[$current] ?? $pages_meta['index.php'];
$title = $meta['title'];
$desc  = $meta['desc'];

// Helper : classe active
function nav_active(string $file): string
{
  return basename($_SERVER['PHP_SELF']) === $file ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?= htmlspecialchars($desc) ?>" />
  <meta property="og:title" content="<?= htmlspecialchars($title) ?>" />
  <meta property="og:description" content="<?= htmlspecialchars($desc) ?>" />
  <meta property="og:type" content="website" />
  <title><?= htmlspecialchars($title) ?></title>
  <!-- Google Fonts — préchargement direct -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@300;400;500;600&display=swap" />
  <link rel="stylesheet" href="/assets/css/style.css?v=<?= @filemtime($_SERVER['DOCUMENT_ROOT'] . '/assets/css/style.css') ?: time() ?>" />
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js" defer></script>
</head>

<body class="page-<?= str_replace('.php', '', $current) ?>">

  <!-- ══ NAV ══ -->
  <nav id="main-nav">
    <a class="nav-brand" href="<?= BASE_URL ?>index.php">
      <div class="nav-brand-logo">
        <img
          src="<?= BASE_URL ?>assets/images/LogoBleu.png"
          alt="GP Coaching logo"
          style="width:40px;height:40px;object-fit:contain;display:block"
          onerror="this.style.display='none'" />
      </div>
      <div class="nav-brand-text">
        <span class="nav-brand-name">GP Coaching</span>
        <span class="nav-brand-sub"><span class="brand-initial">G</span>randir avec <span class="brand-initial">P</span>erspective</span>
      </div>
    </a>

    <div class="nav-links">
      <a href="index.php" class="<?= nav_active('index.php') ?>">Accueil</a>
      <a href="approche.php" class="<?= nav_active('approche.php') ?>">Mon Approche du coaching et ma Méthode GPACE</a>
      <a href="accompagnement.php" class="<?= nav_active('accompagnement.php') ?>">Comment je peux vous accompagner</a>
      <a href="contact.php" class="<?= nav_active('contact.php') ?>">Contact</a>
    </div>


    <button class="nav-hamburger" id="nav-hamburger" aria-label="Ouvrir le menu">
      <span></span><span></span><span></span>
    </button>
  </nav>

  <!-- Menu mobile -->
  <div class="mobile-nav" id="mobile-nav">
    <button class="mobile-nav-close" id="mobile-nav-close">Fermer ✕</button>
    <a href="index.php">Accueil</a>
    <a href="approche.php">Mon Approche du coaching et ma Méthode GPACE</a>
    <a href="accompagnement.php">Comment je peux vous accompagner</a>
    <a href="contact.php">Contact</a>
    <button onclick="openBooking()">Prendre rendez-vous</button>

  </div>