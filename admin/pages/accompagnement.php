<?php
session_start();
define('BASE_URL', '../../');
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/save.php';

$page   = 'accompagnement';
$msg    = '';
$errors = [];

$fields = [
  'intro_image' => ['type' => 'image',   'label' => 'Intro — Image'],
  'intro_label' => ['type' => 'text',    'label' => 'Intro — Étiquette'],
  'intro_titre' => ['type' => 'text',    'label' => 'Intro — Titre'],
  'intro_p1'    => ['type' => 'text',    'label' => 'Intro — Point 1'],
  'intro_p2'    => ['type' => 'text',    'label' => 'Intro — Point 2'],
  'intro_p3'    => ['type' => 'text',    'label' => 'Intro — Point 3'],
  'intro_p4'    => ['type' => 'text',    'label' => 'Intro — Point 4'],
  'intro_cta'   => ['type' => 'text',    'label' => 'Intro — Texte bouton'],
  'u1_titre' => ['type' => 'text', 'label' => 'U1 — Titre'],
  'u1_accroche' => ['type' => 'text', 'label' => 'U1 — Accroche'],
  'u1_image' => ['type' => 'image', 'label' => 'U1 — Image'],
  'u1_p1' => ['type' => 'text', 'label' => 'U1 — Point 1'],
  'u1_p2' => ['type' => 'text', 'label' => 'U1 — Point 2'],
  'u1_p3' => ['type' => 'text', 'label' => 'U1 — Point 3'],
  'u1_p4' => ['type' => 'text', 'label' => 'U1 — Point 4'],
  'u2_titre' => ['type' => 'text', 'label' => 'U2 — Titre'],
  'u2_accroche' => ['type' => 'text', 'label' => 'U2 — Accroche'],
  'u2_1_titre' => ['type' => 'text', 'label' => 'U2.1 — Titre'],
  'u2_1_accroche' => ['type' => 'text', 'label' => 'U2.1 — Accroche'],
  'u2_1_image' => ['type' => 'image', 'label' => 'U2.1 — Image'],
  'u2_1_p1' => ['type' => 'text', 'label' => 'U2.1 — Point 1'],
  'u2_1_p2' => ['type' => 'text', 'label' => 'U2.1 — Point 2'],
  'u2_1_p3' => ['type' => 'text', 'label' => 'U2.1 — Point 3'],
  'u2_1_p4' => ['type' => 'text', 'label' => 'U2.1 — Point 4'],
  'u2_2_titre' => ['type' => 'text', 'label' => 'U2.2 — Titre'],
  'u2_2_accroche' => ['type' => 'text', 'label' => 'U2.2 — Accroche'],
  'u2_2_image' => ['type' => 'image', 'label' => 'U2.2 — Image'],
  'u2_2_p1' => ['type' => 'text', 'label' => 'U2.2 — Point 1'],
  'u2_2_p2' => ['type' => 'text', 'label' => 'U2.2 — Point 2'],
  'u2_2_p3' => ['type' => 'text', 'label' => 'U2.2 — Point 3'],
  'u2_2_p4' => ['type' => 'text', 'label' => 'U2.2 — Point 4'],
  'u3_titre' => ['type' => 'text', 'label' => 'U3 — Titre'],
  'u3_accroche' => ['type' => 'text', 'label' => 'U3 — Accroche'],
  'u3_1_titre' => ['type' => 'text', 'label' => 'U3.1 — Titre'],
  'u3_1_accroche' => ['type' => 'text', 'label' => 'U3.1 — Accroche'],
  'u3_1_image' => ['type' => 'image', 'label' => 'U3.1 — Image'],
  'u3_1_p1' => ['type' => 'text', 'label' => 'U3.1 — Point 1'],
  'u3_1_p2' => ['type' => 'text', 'label' => 'U3.1 — Point 2'],
  'u3_1_p3' => ['type' => 'text', 'label' => 'U3.1 — Point 3'],
  'u3_1_p4' => ['type' => 'text', 'label' => 'U3.1 — Point 4'],
  'u3_2_titre' => ['type' => 'text', 'label' => 'U3.2 — Titre'],
  'u3_2_accroche' => ['type' => 'text', 'label' => 'U3.2 — Accroche'],
  'u3_2_image' => ['type' => 'image', 'label' => 'U3.2 — Image'],
  'u3_2_p1' => ['type' => 'text', 'label' => 'U3.2 — Point 1'],
  'u3_2_p2' => ['type' => 'text', 'label' => 'U3.2 — Point 2'],
  'u3_2_p3' => ['type' => 'text', 'label' => 'U3.2 — Point 3'],
  'u3_2_p4' => ['type' => 'text', 'label' => 'U3.2 — Point 4'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  csrf_check();
  $errors = save_fields($page, $fields);
  $msg    = empty($errors) ? 'success' : 'error';
}

$rows = db()->query("SELECT cle, valeur FROM gp_content WHERE page = 'accompagnement'")->fetchAll();
$vals = array_column($rows, 'valeur', 'cle');

require_once __DIR__ . '/../includes/header.php';

function ft(string $k, array $v, string $l): void
{
  echo '<div class="field"><label>' . htmlspecialchars($l) . '</label>';
  echo '<input type="text" name="' . $k . '" value="' . htmlspecialchars($v[$k] ?? '') . '"/></div>';
}
function fi(string $k, array $v, string $l): void
{
  $img = $v[$k] ?? '';
  echo '<div class="field"><label>' . htmlspecialchars($l) . '</label>';
  if ($img) echo '<img src="' . htmlspecialchars(BASE_URL . $img) . '" class="img-preview" onerror="this.style.display=\'none\'"/>';
  echo '<div class="img-upload-zone" onclick="this.querySelector(\'input\').click()">';
  echo '<input type="file" name="' . $k . '" accept="image/*"/>';
  echo '<label><strong>Choisir une image</strong> — max 5 Mo</label></div>';
  echo '<div class="field" style="margin-top:.5rem;margin-bottom:0"><label>Ou URL</label>';
  echo '<input type="url" name="' . $k . '_url" placeholder="https://..."/></div></div>';
}
function fp(string $prefix, array $v): void
{
  for ($i = 1; $i <= 4; $i++) ft($prefix . '_p' . $i, $v, 'Point ' . $i);
}
?>

<h1 style="font-family:var(--serif);font-size:1.4rem;font-weight:400;color:var(--ink);margin-bottom:1.5rem">
  Accompagnement — Univers &amp; Parcours
</h1>

<?php if ($msg === 'success'): ?><div class="alert alert-success">✓ Modifications enregistrées.</div><?php endif; ?>
<?php if ($msg === 'error'):   ?><div class="alert alert-error"><?php foreach ($errors as $e) echo htmlspecialchars($e) . '<br>'; ?></div><?php endif; ?>

<form method="POST" enctype="multipart/form-data">
  <?= csrf_field() ?>

  <!-- ══ SECTION INTRO ══ -->
  <div class="card">
    <div class="card-header" style="border-left:4px solid var(--gold)">
      <span class="card-header-icon">◈</span>
      <h2>Section d'introduction (bandeau)</h2>
    </div>
    <div class="card-body">
      <?php ft('intro_label', $vals, 'Étiquette (ex: Une approche sur-mesure)'); ?>
      <?php ft('intro_titre', $vals, 'Titre'); ?>
      <?php fi('intro_image', $vals, 'Image'); ?>
      <div style="margin-top:1rem">
        <div class="field"><label style="color:var(--ink)">Points</label></div>
        <?php ft('intro_p1', $vals, 'Point 1'); ?>
        <?php ft('intro_p2', $vals, 'Point 2'); ?>
        <?php ft('intro_p3', $vals, 'Point 3'); ?>
        <?php ft('intro_p4', $vals, 'Point 4'); ?>
      </div>
      <?php ft('intro_cta', $vals, 'Texte du bouton Calendly'); ?>
    </div>
  </div>

  <!-- ══ UNIVERS 1 ══ -->
  <div class="card">
    <div class="card-header" style="border-left:4px solid #667264">
      <span class="card-header-icon">🌿</span>
      <h2>Univers 1 — Équilibre &amp; Développement personnel</h2>
    </div>
    <div class="card-body">
      <?php ft('u1_titre', $vals, 'Titre');
      ft('u1_accroche', $vals, 'Accroche');
      fi('u1_image', $vals, 'Image'); ?>
      <div style="margin-top:1rem">
        <div class="field"><label style="color:var(--ink)">Points du parcours</label></div>
        <?php fp('u1', $vals); ?>
      </div>
    </div>
  </div>

  <!-- ══ UNIVERS 2 ══ -->
  <div class="card">
    <div class="card-header" style="border-left:4px solid #142739">
      <span class="card-header-icon">🧭</span>
      <h2>Univers 2 — Leadership &amp; Performance</h2>
    </div>
    <div class="card-body">
      <?php ft('u2_titre', $vals, 'Titre');
      ft('u2_accroche', $vals, 'Accroche'); ?>
    </div>
  </div>

  <div class="card" style="margin-left:1.5rem;border-left:3px solid #14273944">
    <div class="card-header">
      <h2 style="color:#142739">2.1 — Parcours Leadership</h2>
    </div>
    <div class="card-body">
      <?php ft('u2_1_titre', $vals, 'Titre');
      ft('u2_1_accroche', $vals, 'Accroche');
      fi('u2_1_image', $vals, 'Image'); ?>
      <div style="margin-top:1rem"><?php fp('u2_1', $vals); ?></div>
    </div>
  </div>

  <div class="card" style="margin-left:1.5rem;border-left:3px solid #14273944">
    <div class="card-header">
      <h2 style="color:#142739">2.2 — Parcours Posture</h2>
    </div>
    <div class="card-body">
      <?php ft('u2_2_titre', $vals, 'Titre');
      ft('u2_2_accroche', $vals, 'Accroche');
      fi('u2_2_image', $vals, 'Image'); ?>
      <div style="margin-top:1rem"><?php fp('u2_2', $vals); ?></div>
    </div>
  </div>

  <!-- ══ UNIVERS 3 ══ -->
  <div class="card">
    <div class="card-header" style="border-left:4px solid #C17501">
      <span class="card-header-icon">💎</span>
      <h2>Univers 3 — Signature</h2>
    </div>
    <div class="card-body">
      <?php ft('u3_titre', $vals, 'Titre');
      ft('u3_accroche', $vals, 'Accroche'); ?>
    </div>
  </div>

  <div class="card" style="margin-left:1.5rem;border-left:3px solid #C1750144">
    <div class="card-header">
      <h2 style="color:#C17501">3.1 — Parcours Trajectoire</h2>
    </div>
    <div class="card-body">
      <?php ft('u3_1_titre', $vals, 'Titre');
      ft('u3_1_accroche', $vals, 'Accroche');
      fi('u3_1_image', $vals, 'Image'); ?>
      <div style="margin-top:1rem"><?php fp('u3_1', $vals); ?></div>
    </div>
  </div>

  <div class="card" style="margin-left:1.5rem;border-left:3px solid #C1750144">
    <div class="card-header">
      <h2 style="color:#C17501">3.2 — Parcours Alignement</h2>
    </div>
    <div class="card-body">
      <?php ft('u3_2_titre', $vals, 'Titre');
      ft('u3_2_accroche', $vals, 'Accroche');
      fi('u3_2_image', $vals, 'Image'); ?>
      <div style="margin-top:1rem"><?php fp('u3_2', $vals); ?></div>
    </div>
  </div>

  <div class="form-actions">
    <button type="submit" class="btn btn-navy">Enregistrer</button>
    <a href="<?= BASE_URL ?>accompagnement.php" target="_blank" class="btn btn-ghost">↗ Voir la page</a>
  </div>
</form>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>