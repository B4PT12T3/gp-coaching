<?php

/**
 * GP COACHING — admin/includes/header.php
 */
$current_page = basename($_SERVER['PHP_SELF']);
$admin_nav = [
  'index.php'          => ['icon' => '◈', 'label' => 'Tableau de bord'],
  'pages/accueil.php'  => ['icon' => '⌂', 'label' => 'Accueil'],
  'pages/approche.php' => ['icon' => '◎', 'label' => 'Mon Approche'],
  'pages/accompagnement.php' => ['icon' => '◇', 'label' => 'Accompagnement'],
  'pages/contact.php'  => ['icon' => '✉', 'label' => 'Contact & Coordonnées'],
  'upload.php'         => ['icon' => '⊕', 'label' => 'Images'],
];
// Déterminer la clé active
$active_key = '';
foreach (array_keys($admin_nav) as $key) {
  if (str_ends_with($_SERVER['PHP_SELF'], str_replace('/', DIRECTORY_SEPARATOR, $key))) {
    $active_key = $key;
    break;
  }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin — GP Coaching</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=Jost:wght@300;400;500;600&display=swap');

    :root {
      --navy: #1B2B4B;
      --navy-l: #243659;
      --navy-ll: #2f4670;
      --gold: #B8905A;
      --gold-l: #CEAA78;
      --gold-dim: rgba(184, 144, 90, .12);
      --bg: #F7F3ED;
      --bg-alt: #F0EBE2;
      --bg-card: #FFFFFF;
      --ink: #1E1A14;
      --ink-60: rgba(30, 26, 20, .6);
      --ink-20: rgba(30, 26, 20, .1);
      --green: #3a7d44;
      --green-dim: rgba(58, 125, 68, .1);
      --red: #b44040;
      --red-dim: rgba(180, 64, 64, .1);
      --sans: 'Jost', sans-serif;
      --serif: 'Playfair Display', Georgia, serif;
      --sidebar-w: 240px;
      --radius: 6px;
    }

    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html {
      font-size: 15px;
    }

    body {
      font-family: var(--sans);
      background: var(--bg);
      color: var(--ink);
      display: flex;
      min-height: 100vh;
      -webkit-font-smoothing: antialiased;
    }

    /* ── SIDEBAR ── */
    .sidebar {
      width: var(--sidebar-w);
      flex-shrink: 0;
      background: var(--navy);
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      z-index: 100;
    }

    .sidebar-brand {
      padding: 1.5rem 1.25rem 1.25rem;
      border-bottom: 1px solid rgba(255, 255, 255, .07);
    }

    .sidebar-brand-name {
      font-family: var(--serif);
      font-size: 1.05rem;
      color: #fff;
      display: block;
    }

    .sidebar-brand-sub {
      font-size: .62rem;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--gold-l);
      margin-top: .2rem;
      display: block;
    }

    .sidebar-badge {
      display: inline-block;
      margin-top: .6rem;
      background: rgba(255, 255, 255, .08);
      color: rgba(255, 255, 255, .5);
      font-size: .6rem;
      letter-spacing: .1em;
      text-transform: uppercase;
      padding: .2rem .6rem;
      border-radius: 2px;
    }

    .sidebar-nav {
      flex: 1;
      padding: 1rem 0;
      overflow-y: auto;
    }

    .sidebar-nav a {
      display: flex;
      align-items: center;
      gap: .75rem;
      padding: .7rem 1.25rem;
      font-size: .78rem;
      font-weight: 500;
      letter-spacing: .04em;
      color: rgba(255, 255, 255, .45);
      text-decoration: none;
      transition: background .2s, color .2s;
      border-left: 3px solid transparent;
    }

    .sidebar-nav a:hover {
      background: rgba(255, 255, 255, .05);
      color: rgba(255, 255, 255, .8);
    }

    .sidebar-nav a.active {
      background: rgba(255, 255, 255, .07);
      color: #fff;
      border-left-color: var(--gold);
    }

    .sidebar-nav-icon {
      font-size: .85rem;
      width: 18px;
      text-align: center;
    }

    .sidebar-sep {
      height: 1px;
      background: rgba(255, 255, 255, .07);
      margin: .5rem 1.25rem;
    }

    .sidebar-footer {
      padding: 1rem 1.25rem;
      border-top: 1px solid rgba(255, 255, 255, .07);
    }

    .sidebar-footer a {
      display: flex;
      align-items: center;
      gap: .6rem;
      font-size: .73rem;
      color: rgba(255, 255, 255, .35);
      text-decoration: none;
      transition: color .2s;
    }

    .sidebar-footer a:hover {
      color: rgba(255, 255, 255, .7);
    }

    /* ── MAIN ── */
    .main {
      margin-left: var(--sidebar-w);
      flex: 1;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .topbar {
      background: var(--bg-card);
      border-bottom: 1px solid var(--ink-20);
      padding: .9rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 50;
    }

    .topbar-title {
      font-size: .82rem;
      color: var(--ink-60);
      font-weight: 400;
    }

    .topbar-title strong {
      color: var(--ink);
      font-weight: 600;
    }

    .topbar-view {
      font-size: .72rem;
      font-weight: 500;
      letter-spacing: .08em;
      text-transform: uppercase;
      color: var(--gold);
      text-decoration: none;
      border: 1px solid var(--gold-dim);
      padding: .35rem .85rem;
      border-radius: var(--radius);
      transition: background .2s;
    }

    .topbar-view:hover {
      background: var(--gold-dim);
    }

    .content {
      padding: 2rem;
      flex: 1;
      max-width: 900px;
    }

    /* ── CARDS ── */
    .card {
      background: var(--bg-card);
      border: 1px solid var(--ink-20);
      border-radius: var(--radius);
      margin-bottom: 1.5rem;
      overflow: hidden;
    }

    .card-header {
      padding: 1rem 1.5rem;
      border-bottom: 1px solid var(--ink-20);
      display: flex;
      align-items: center;
      gap: .6rem;
    }

    .card-header h2 {
      font-family: var(--sans);
      font-size: .85rem;
      font-weight: 600;
      color: var(--ink);
      letter-spacing: .02em;
    }

    .card-header-icon {
      color: var(--gold);
      font-size: .9rem;
    }

    .card-body {
      padding: 1.5rem;
    }

    /* ── FORM ELEMENTS ── */
    .field {
      margin-bottom: 1.25rem;
    }

    .field:last-child {
      margin-bottom: 0;
    }

    .field label {
      display: block;
      font-size: .7rem;
      font-weight: 600;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--ink-60);
      margin-bottom: .4rem;
    }

    .field input[type="text"],
    .field input[type="email"],
    .field input[type="tel"],
    .field input[type="password"],
    .field input[type="url"],
    .field textarea {
      width: 100%;
      background: var(--bg);
      border: 1px solid rgba(30, 26, 20, .15);
      border-radius: var(--radius);
      padding: .65rem .9rem;
      font-family: var(--sans);
      font-size: .88rem;
      color: var(--ink);
      transition: border-color .2s, box-shadow .2s;
      resize: vertical;
    }

    .field input:focus,
    .field textarea:focus {
      outline: none;
      border-color: var(--navy);
      box-shadow: 0 0 0 3px rgba(27, 43, 75, .08);
    }

    .field textarea {
      min-height: 100px;
    }

    .field-hint {
      font-size: .7rem;
      color: var(--ink-60);
      margin-top: .3rem;
      font-style: italic;
    }

    /* ── GRID CHAMPS ── */
    .fields-2 {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }

    /* ── BOUTONS ── */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: .5rem;
      font-family: var(--sans);
      font-size: .74rem;
      font-weight: 600;
      letter-spacing: .1em;
      text-transform: uppercase;
      padding: .65rem 1.6rem;
      border-radius: var(--radius);
      cursor: pointer;
      border: none;
      transition: background .2s, transform .15s, box-shadow .2s;
      text-decoration: none;
    }

    .btn:hover {
      transform: translateY(-1px);
    }

    .btn-navy {
      background: var(--navy);
      color: #fff;
    }

    .btn-navy:hover {
      background: var(--navy-l);
    }

    .btn-gold {
      background: var(--gold);
      color: #fff;
    }

    .btn-gold:hover {
      background: var(--gold-l);
    }

    .btn-ghost {
      background: transparent;
      color: var(--ink-60);
      border: 1px solid var(--ink-20);
    }

    .btn-ghost:hover {
      background: var(--bg-alt);
      color: var(--ink);
    }

    .btn-danger {
      background: var(--red-dim);
      color: var(--red);
      border: 1px solid rgba(180, 64, 64, .2);
    }

    .btn-danger:hover {
      background: rgba(180, 64, 64, .18);
    }

    .form-actions {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding-top: 1.25rem;
      border-top: 1px solid var(--ink-20);
      margin-top: 1.25rem;
    }

    /* ── ALERTES ── */
    .alert {
      padding: .85rem 1.1rem;
      border-radius: var(--radius);
      font-size: .83rem;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: .6rem;
    }

    .alert-success {
      background: var(--green-dim);
      border: 1px solid rgba(58, 125, 68, .25);
      color: var(--green);
    }

    .alert-error {
      background: var(--red-dim);
      border: 1px solid rgba(180, 64, 64, .25);
      color: var(--red);
    }

    /* ── IMAGE PREVIEW ── */
    .img-preview {
      width: 100%;
      max-height: 180px;
      object-fit: cover;
      border-radius: var(--radius);
      border: 1px solid var(--ink-20);
      margin-bottom: .75rem;
    }

    .img-upload-zone {
      border: 2px dashed rgba(30, 26, 20, .2);
      border-radius: var(--radius);
      padding: 1.5rem;
      text-align: center;
      background: var(--bg);
      cursor: pointer;
      transition: border-color .2s, background .2s;
    }

    .img-upload-zone:hover {
      border-color: var(--gold);
      background: var(--gold-dim);
    }

    .img-upload-zone input[type="file"] {
      display: none;
    }

    .img-upload-zone label {
      cursor: pointer;
      font-size: .82rem;
      color: var(--ink-60);
    }

    .img-upload-zone label strong {
      color: var(--gold);
    }

    /* ── DASHBOARD TILES ── */
    .tiles {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .tile {
      background: var(--bg-card);
      border: 1px solid var(--ink-20);
      border-radius: var(--radius);
      padding: 1.5rem;
      text-decoration: none;
      color: var(--ink);
      display: flex;
      flex-direction: column;
      gap: .4rem;
      border-left: 4px solid var(--gold);
      transition: box-shadow .2s, transform .2s;
    }

    .tile:hover {
      box-shadow: 0 6px 24px rgba(27, 43, 75, .1);
      transform: translateY(-2px);
    }

    .tile-icon {
      font-size: 1.4rem;
    }

    .tile-label {
      font-size: .72rem;
      font-weight: 600;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--ink-60);
    }

    .tile-title {
      font-size: .95rem;
      font-weight: 600;
      color: var(--ink);
    }

    .tile-desc {
      font-size: .78rem;
      color: var(--ink-60);
      line-height: 1.5;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
      }

      .main {
        margin-left: 0;
      }

      .tiles {
        grid-template-columns: 1fr;
      }

      .fields-2 {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>

  <aside class="sidebar">
    <div class="sidebar-brand">
      <span class="sidebar-brand-name">GP Coaching</span>
      <span class="sidebar-brand-sub">Grandir avec Perspective</span>
      <span class="sidebar-badge">Administration</span>
    </div>

    <nav class="sidebar-nav">
      <?php foreach ($admin_nav as $href => $item): ?>
        <?php $is_active = ($active_key === $href); ?>
        <a href="<?= $href === 'index.php' ? '../index.php' : '../' . $href ?>"
          class="<?= $is_active ? 'active' : '' ?>">
          <span class="sidebar-nav-icon"><?= $item['icon'] ?></span>
          <?= $item['label'] ?>
        </a>
      <?php endforeach; ?>
      <div class="sidebar-sep"></div>
      <a href="<?= BASE_URL ?>index.php" target="_blank">
        <span class="sidebar-nav-icon">↗</span> Voir le site
      </a>
    </nav>

    <div class="sidebar-footer">
      <a href="<?= BASE_URL ?>admin/logout.php">
        <span>⏻</span> Déconnexion
      </a>
    </div>
  </aside>

  <div class="main">
    <div class="topbar">
      <div class="topbar-title">
        Connecté en tant que <strong><?= htmlspecialchars($_SESSION['gp_admin_user'] ?? 'Admin') ?></strong>
      </div>
      <a class="topbar-view" href="<?= BASE_URL ?>index.php" target="_blank">↗ Voir le site</a>
    </div>
    <div class="content">