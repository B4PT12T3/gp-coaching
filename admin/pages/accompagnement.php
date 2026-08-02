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
    's1_titre' => ['type' => 'text',     'label' => 'Service 1 — Titre'],
    's1_p1'    => ['type' => 'textarea', 'label' => 'Service 1 — Paragraphe 1'],
    's1_p2'    => ['type' => 'textarea', 'label' => 'Service 1 — Paragraphe 2'],
    's1_image' => ['type' => 'image',    'label' => 'Service 1 — Image'],
    's2_titre' => ['type' => 'text',     'label' => 'Service 2 — Titre'],
    's2_p1'    => ['type' => 'textarea', 'label' => 'Service 2 — Paragraphe 1'],
    's2_p2'    => ['type' => 'textarea', 'label' => 'Service 2 — Paragraphe 2'],
    's2_image' => ['type' => 'image',    'label' => 'Service 2 — Image'],
    's3_titre' => ['type' => 'text',     'label' => 'Service 3 — Titre'],
    's3_p1'    => ['type' => 'textarea', 'label' => 'Service 3 — Paragraphe 1'],
    's3_p2'    => ['type' => 'textarea', 'label' => 'Service 3 — Paragraphe 2'],
    's3_image' => ['type' => 'image',    'label' => 'Service 3 — Image'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $errors = save_fields($page, $fields);
    $msg    = empty($errors) ? 'success' : 'error';
}

$rows = db()->query("SELECT cle, valeur FROM gp_content WHERE page = '$page'")->fetchAll();
$vals = array_column($rows, 'valeur', 'cle');

require_once __DIR__ . '/../includes/header.php';

$services_meta = [
    1 => ['icon' => '🌿', 'label' => 'Équilibre & Développement personnel'],
    2 => ['icon' => '👥', 'label' => 'Leadership & Performance'],
    3 => ['icon' => '⭐', 'label' => 'Signature'],
];
?>

<h1 style="font-family:var(--serif);font-size:1.4rem;font-weight:400;color:var(--ink);margin-bottom:1.5rem">
  Accompagnement — 3 services
</h1>

<?php if ($msg === 'success'): ?>
  <div class="alert alert-success">✓ Modifications enregistrées.</div>
<?php elseif ($msg === 'error'): ?>
  <div class="alert alert-error"><?php foreach ($errors as $e) echo htmlspecialchars($e) . '<br>'; ?></div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
  <?= csrf_field() ?>

  <?php foreach ([1, 2, 3] as $n): ?>
  <div class="card">
    <div class="card-header">
      <span class="card-header-icon"><?= $services_meta[$n]['icon'] ?></span>
      <h2>Service <?= $n ?> — <?= $services_meta[$n]['label'] ?></h2>
    </div>
    <div class="card-body">
      <div class="field">
        <label>Titre</label>
        <input type="text" name="s<?= $n ?>_titre"
               value="<?= htmlspecialchars($vals["s{$n}_titre"] ?? '') ?>"/>
      </div>
      <div class="fields-2">
        <div class="field">
          <label>Paragraphe 1</label>
          <textarea name="s<?= $n ?>_p1" rows="4"><?= htmlspecialchars($vals["s{$n}_p1"] ?? '') ?></textarea>
        </div>
        <div class="field">
          <label>Paragraphe 2</label>
          <textarea name="s<?= $n ?>_p2" rows="4"><?= htmlspecialchars($vals["s{$n}_p2"] ?? '') ?></textarea>
        </div>
      </div>
      <div class="field">
        <label>Image</label>
        <?php $img = $vals["s{$n}_image"] ?? ''; ?>
        <?php if ($img): ?>
          <img src="<?= htmlspecialchars(BASE_URL . $img) ?>" class="img-preview" onerror="this.style.display='none'"/>
        <?php endif; ?>
        <div class="img-upload-zone" onclick="this.querySelector('input').click()">
          <input type="file" name="s<?= $n ?>_image" accept="image/*"/>
          <label><strong>Choisir une image</strong> — JPG, PNG, WebP max 5 Mo</label>
        </div>
        <div class="field" style="margin-top:.75rem;margin-bottom:0">
          <label>Ou URL d'image</label>
          <input type="url" name="s<?= $n ?>_image_url" placeholder="https://..."/>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>

  <div class="form-actions">
    <button type="submit" class="btn btn-navy">Enregistrer</button>
    <a href="<?= BASE_URL ?>accompagnement.php" target="_blank" class="btn btn-ghost">↗ Voir la page</a>
  </div>
</form>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
