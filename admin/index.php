<?php
session_start();
define('BASE_URL', '../');
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/header.php';

// Dernières modifications
$recent = db()->query("
    SELECT page, cle, label, updated_at
    FROM gp_content
    ORDER BY updated_at DESC
    LIMIT 5
")->fetchAll();
?>

<h1 style="font-family:var(--serif);font-size:1.5rem;font-weight:400;color:var(--ink);margin-bottom:1.5rem">
  Tableau de bord
</h1>

<div class="tiles">
  <a class="tile" href="pages/accueil.php">
    <span class="tile-icon">⌂</span>
    <span class="tile-label">Page</span>
    <span class="tile-title">Accueil</span>
    <span class="tile-desc">Hero, citation, 3 univers, pourquoi GP Coaching</span>
  </a>
  <a class="tile" href="pages/approche.php">
    <span class="tile-icon">◎</span>
    <span class="tile-label">Page</span>
    <span class="tile-title">Mon Approche</span>
    <span class="tile-desc">Photo coach, parcours, mission, conviction</span>
  </a>
  <a class="tile" href="pages/accompagnement.php">
    <span class="tile-icon">◇</span>
    <span class="tile-label">Page</span>
    <span class="tile-title">Accompagnement</span>
    <span class="tile-desc">3 services : Équilibre, Leadership, Signature</span>
  </a>
  <a class="tile" href="pages/contact.php">
    <span class="tile-icon">✉</span>
    <span class="tile-label">Page</span>
    <span class="tile-title">Contact & Coordonnées</span>
    <span class="tile-desc">Téléphone, email, adresse, photo cabinet</span>
  </a>
</div>

<?php if (!empty($recent)): ?>
<div class="card">
  <div class="card-header">
    <span class="card-header-icon">◷</span>
    <h2>Dernières modifications</h2>
  </div>
  <div class="card-body" style="padding:0">
    <table style="width:100%;border-collapse:collapse;font-size:.82rem">
      <thead>
        <tr style="background:var(--bg);border-bottom:1px solid var(--ink-20)">
          <th style="padding:.65rem 1.25rem;text-align:left;font-weight:600;color:var(--ink-60);font-size:.68rem;letter-spacing:.08em;text-transform:uppercase">Champ</th>
          <th style="padding:.65rem 1.25rem;text-align:left;font-weight:600;color:var(--ink-60);font-size:.68rem;letter-spacing:.08em;text-transform:uppercase">Page</th>
          <th style="padding:.65rem 1.25rem;text-align:left;font-weight:600;color:var(--ink-60);font-size:.68rem;letter-spacing:.08em;text-transform:uppercase">Modifié le</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($recent as $r): ?>
        <tr style="border-bottom:1px solid var(--ink-20)">
          <td style="padding:.65rem 1.25rem;color:var(--ink)"><?= htmlspecialchars($r['label'] ?: $r['cle']) ?></td>
          <td style="padding:.65rem 1.25rem">
            <span style="background:var(--gold-dim);color:var(--gold);font-size:.68rem;padding:.15rem .5rem;border-radius:3px;font-weight:600;text-transform:uppercase;letter-spacing:.06em">
              <?= htmlspecialchars($r['page']) ?>
            </span>
          </td>
          <td style="padding:.65rem 1.25rem;color:var(--ink-60)">
            <?= date('d/m/Y à H:i', strtotime($r['updated_at'])) ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
