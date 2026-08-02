<?php
session_start();
define('BASE_URL', '../../');
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/save.php';

$page   = 'contact';
$msg    = '';
$errors = [];

$fields = [
    'telephone'        => ['type' => 'text',     'label' => 'Téléphone'],
    'email'            => ['type' => 'text',     'label' => 'Email'],
    'adresse'          => ['type' => 'text',     'label' => 'Adresse'],
    'adresse_detail'   => ['type' => 'text',     'label' => 'Détail adresse'],
    'modalites'        => ['type' => 'text',     'label' => 'Modalités'],
    'modalites_detail' => ['type' => 'text',     'label' => 'Détail modalités'],
    'intro_texte'      => ['type' => 'textarea', 'label' => 'Texte intro'],
    'cabinet_photo'    => ['type' => 'image',    'label' => 'Photo cabinet'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $errors = save_fields($page, $fields);
    $msg    = empty($errors) ? 'success' : 'error';
}

$rows = db()->query("SELECT cle, valeur FROM gp_content WHERE page = '$page'")->fetchAll();
$vals = array_column($rows, 'valeur', 'cle');

require_once __DIR__ . '/../includes/header.php';
?>

<h1 style="font-family:var(--serif);font-size:1.4rem;font-weight:400;color:var(--ink);margin-bottom:1.5rem">
  Contact & Coordonnées
</h1>

<?php if ($msg === 'success'): ?>
  <div class="alert alert-success">✓ Coordonnées mises à jour.</div>
<?php elseif ($msg === 'error'): ?>
  <div class="alert alert-error"><?php foreach ($errors as $e) echo htmlspecialchars($e) . '<br>'; ?></div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
  <?= csrf_field() ?>

  <!-- Coordonnées -->
  <div class="card">
    <div class="card-header"><span class="card-header-icon">✉</span><h2>Coordonnées</h2></div>
    <div class="card-body">
      <div class="fields-2">
        <div class="field">
          <label>Téléphone</label>
          <input type="tel" name="telephone" value="<?= htmlspecialchars($vals['telephone'] ?? '') ?>" placeholder="06 72 72 44 44"/>
          <span class="field-hint">Affiché tel quel sur le site</span>
        </div>
        <div class="field">
          <label>Email</label>
          <input type="email" name="email" value="<?= htmlspecialchars($vals['email'] ?? '') ?>" placeholder="GP2coaching@gmail.com"/>
        </div>
      </div>
      <div class="fields-2">
        <div class="field">
          <label>Adresse / Ville</label>
          <input type="text" name="adresse" value="<?= htmlspecialchars($vals['adresse'] ?? '') ?>" placeholder="Béthune et sa région"/>
        </div>
        <div class="field">
          <label>Détail adresse</label>
          <input type="text" name="adresse_detail" value="<?= htmlspecialchars($vals['adresse_detail'] ?? '') ?>" placeholder="Hauts-de-France"/>
        </div>
      </div>
      <div class="fields-2">
        <div class="field">
          <label>Modalités</label>
          <input type="text" name="modalites" value="<?= htmlspecialchars($vals['modalites'] ?? '') ?>" placeholder="En présentiel et en visioconférence"/>
        </div>
        <div class="field">
          <label>Détail modalités</label>
          <input type="text" name="modalites_detail" value="<?= htmlspecialchars($vals['modalites_detail'] ?? '') ?>" placeholder="Partout en France"/>
        </div>
      </div>
    </div>
  </div>

  <!-- Intro -->
  <div class="card">
    <div class="card-header"><span class="card-header-icon">◎</span><h2>Texte d'introduction</h2></div>
    <div class="card-body">
      <div class="field">
        <label>Texte affiché sous le titre "Échangeons"</label>
        <textarea name="intro_texte" rows="3"><?= htmlspecialchars($vals['intro_texte'] ?? '') ?></textarea>
      </div>
    </div>
  </div>

  <!-- Photo cabinet -->
  <div class="card">
    <div class="card-header"><span class="card-header-icon">⊕</span><h2>Photo du cabinet</h2></div>
    <div class="card-body">
      <?php $img = $vals['cabinet_photo'] ?? ''; ?>
      <?php if ($img): ?>
        <img src="<?= htmlspecialchars(BASE_URL . $img) ?>" class="img-preview" onerror="this.style.display='none'"/>
      <?php endif; ?>
      <div class="img-upload-zone" onclick="this.querySelector('input').click()">
        <input type="file" name="cabinet_photo" accept="image/*"/>
        <label><strong>Choisir la photo du cabinet</strong><br><span style="font-size:.72rem">JPG, PNG, WebP — max 5 Mo</span></label>
      </div>
      <div class="field" style="margin-top:.75rem;margin-bottom:0">
        <label>Ou URL d'image</label>
        <input type="url" name="cabinet_photo_url" placeholder="https://..."/>
      </div>
    </div>
  </div>

  <div class="form-actions">
    <button type="submit" class="btn btn-navy">Enregistrer</button>
    <a href="<?= BASE_URL ?>contact.php" target="_blank" class="btn btn-ghost">↗ Voir la page</a>
  </div>
</form>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
