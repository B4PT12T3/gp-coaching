<?php
session_start();
define('BASE_URL', '../../');
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/save.php';

$page   = 'approche';
$msg    = '';
$errors = [];

$fields = [
  'coach_photo'      => ['type' => 'image',    'label' => 'Photo du coach'],
  'parcours_titre'   => ['type' => 'text',     'label' => 'Titre parcours'],
  'parcours_p1'      => ['type' => 'textarea', 'label' => 'Paragraphe 1'],
  'parcours_p2'      => ['type' => 'textarea', 'label' => 'Paragraphe 2'],
  'parcours_p3'      => ['type' => 'textarea', 'label' => 'Paragraphe 3'],
  'mission_texte'    => ['type' => 'textarea', 'label' => 'Texte Mission'],
  'conviction_texte' => ['type' => 'textarea', 'label' => 'Texte Conviction'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  csrf_check();
  $result  = save_fields_count($page, $fields);
  $errors  = $result['errors'];
  $updated = $result['updated'];
  $msg     = empty($errors) ? 'success' : 'error';
}

$rows = db()->query("SELECT cle, valeur FROM " . DB_PREFIX . "content WHERE page = '$page'")->fetchAll();
$vals = array_column($rows, 'valeur', 'cle');

require_once __DIR__ . '/../includes/header.php';
?>

<h1 style="font-family:var(--serif);font-size:1.4rem;font-weight:400;color:var(--ink);margin-bottom:1.5rem">
  Mon Approche
</h1>

<?php if ($msg === 'success'): ?>
  <div class="alert alert-success">✓ <?= $updated ?? 0 ?> champ(s) enregistré(s) avec succès.</div>
<?php elseif ($msg === 'error'): ?>
  <div class="alert alert-error"><?php foreach ($errors as $e) echo htmlspecialchars($e) . '<br>'; ?></div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
  <?= csrf_field() ?>

  <!-- Photo coach -->
  <div class="card">
    <div class="card-header"><span class="card-header-icon">◎</span>
      <h2>Photo du coach</h2>
    </div>
    <div class="card-body">
      <?php $img = $vals['coach_photo'] ?? ''; ?>
      <?php if ($img): ?>
        <img src="<?= htmlspecialchars(BASE_URL . $img) ?>" class="img-preview" style="max-height:240px" onerror="this.style.display='none'" />
      <?php endif; ?>
      <div class="img-upload-zone" onclick="this.querySelector('input').click()">
        <input type="file" name="coach_photo" accept="image/*" />
        <label><strong>Choisir la photo du coach</strong><br><span style="font-size:.72rem">JPG, PNG, WebP — max 5 Mo · Portrait recommandé</span></label>
      </div>
      <div class="field" style="margin-top:.75rem;margin-bottom:0">
        <label>Ou URL d'image</label>
        <input type="url" name="coach_photo_url" placeholder="https://..." />
      </div>
    </div>
  </div>

  <!-- Mon parcours -->
  <div class="card">
    <div class="card-header"><span class="card-header-icon">✦</span>
      <h2>Mon Parcours, ma conviction</h2>
    </div>
    <div class="card-body">
      <div class="field">
        <label>Titre de la section</label>
        <input type="text" name="parcours_titre" value="<?= htmlspecialchars($vals['parcours_titre'] ?? '') ?>" />
      </div>
      <div class="field">
        <label>Paragraphe 1</label>
        <textarea name="parcours_p1" rows="3"><?= htmlspecialchars($vals['parcours_p1'] ?? '') ?></textarea>
      </div>
      <div class="field">
        <label>Paragraphe 2</label>
        <textarea name="parcours_p2" rows="3"><?= htmlspecialchars($vals['parcours_p2'] ?? '') ?></textarea>
      </div>
      <div class="field">
        <label>Paragraphe 3</label>
        <textarea name="parcours_p3" rows="2"><?= htmlspecialchars($vals['parcours_p3'] ?? '') ?></textarea>
      </div>
    </div>
  </div>

  <!-- Mission / Conviction -->
  <div class="card">
    <div class="card-header"><span class="card-header-icon">◈</span>
      <h2>Mission & Conviction</h2>
    </div>
    <div class="card-body">
      <div class="field">
        <label>Texte — Ma Mission</label>
        <textarea name="mission_texte" rows="4"><?= htmlspecialchars($vals['mission_texte'] ?? '') ?></textarea>
      </div>
      <div class="field">
        <label>Texte — Ma Conviction</label>
        <textarea name="conviction_texte" rows="3"><?= htmlspecialchars($vals['conviction_texte'] ?? '') ?></textarea>
      </div>
    </div>
  </div>

  <div class="form-actions">
    <button type="submit" class="btn btn-navy">Enregistrer</button>
    <a href="<?= BASE_URL ?>approche.php" target="_blank" class="btn btn-ghost">↗ Voir la page</a>
  </div>
</form>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>