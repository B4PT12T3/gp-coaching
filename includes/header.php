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
  <link rel="stylesheet" href="assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>" />
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js" defer></script>
</head>

<body class="page-<?= str_replace('.php', '', $current) ?>">

  <!-- ══ NAV ══ -->
  <nav id="main-nav">
    <a class="nav-brand" href="index.php">
      <div class="nav-brand-logo">
        <img
          src="/assets/images/LogoBleu.png"
          alt="GP Coaching logo"
          style="width:36px;height:36px;object-fit:contain;display:block" />
      </div>
      <div class="nav-brand-text">
        <span class="nav-brand-name">GP Coaching</span>
        <span class="nav-brand-sub">Grandir avec Perspective</span>
      </div>
    </a>

    <div class="nav-links">
      <a href="index.php" class="<?= nav_active('index.php') ?>">Accueil</a>
      <a href="approche.php" class="<?= nav_active('approche.php') ?>">Mon Approche</a>
      <a href="accompagnement.php" class="<?= nav_active('accompagnement.php') ?>">Comment je peux vous accompagner</a>
      <a href="contact.php" class="<?= nav_active('contact.php') ?>">Contact</a>
    </div>

    <div class="nav-social">
      <?php
      if (!function_exists('content')) require_once __DIR__ . '/content.php';
      $nav_socials = [
        ['url' => content('global', 'social_linkedin', ''),  'label' => 'LinkedIn',  'icon' => 'in'],
        ['url' => content('global', 'social_facebook', ''),  'label' => 'Facebook',  'icon' => 'f'],
        ['url' => content('global', 'social_instagram', ''), 'label' => 'Instagram', 'icon' => 'ig'],
        ['url' => content('global', 'social_youtube', ''),   'label' => 'YouTube',   'icon' => 'yt'],
      ];
      foreach ($nav_socials as $s):
        if (empty($s['url'])) continue;
      ?>
        <a href="<?= htmlspecialchars($s['url']) ?>"
          aria-label="<?= $s['label'] ?>"
          target="_blank" rel="noopener noreferrer"><?= $s['icon'] ?></a>
      <?php endforeach; ?>
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
    <?php foreach ($nav_socials as $s): if (empty($s['url'])) continue; ?>
      <a href="<?= htmlspecialchars($s['url']) ?>" target="_blank" rel="noopener noreferrer"><?= $s['label'] ?></a>
    <?php endforeach; ?>
  </div>