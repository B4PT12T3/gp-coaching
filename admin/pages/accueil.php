<?php
session_start();
define('BASE_URL', '../../');
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/save.php';

$page   = 'accueil';
$msg    = '';
$errors = [];

$fields = [
    'hero_titre'       => ['type' => 'textarea', 'label' => 'Titre hero'],
    'hero_sous_titre'  => ['type' => 'textarea', 'label' => 'Sous-titre hero'],
    'hero_image'       => ['type' => 'image',    'label' => 'Image hero'],
    'citation_texte'   => ['type' => 'textarea', 'label' => 'Citation'],
    'citation_auteur'  => ['type' => 'text',     'label' => 'Auteur citation'],
    'univers1_titre'   => ['type' => 'text',     'label' => 'Univers 1 — Titre'],
    'univers1_texte'   => ['type' => 'textarea', 'label' => 'Univers 1 — Texte'],
    'univers1_image'   => ['type' => 'image',    'label' => 'Univers 1 — Image'],
    'univers2_titre'   => ['type' => 'text',     'label' => 'Univers 2 — Titre'],
    'univers2_texte'   => ['type' => 'textarea', 'label' => 'Univers 2 — Texte'],
    'univers2_image'   => ['type' => 'image',    'label' => 'Univers 2 — Image'],
    'univers3_titre'   => ['type' => 'text',     'label' => 'Univers 3 — Titre'],
    'univers3_texte'   => ['type' => 'textarea', 'label' => 'Univers 3 — Texte'],
    'univers3_image'   => ['type' => 'image',    'label' => 'Univers 3 — Image'],
];

// Sauvegarde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $errors = save_fields($page, $fields);
    $msg    = empty($errors) ? 'success' : 'error';
}

// Lecture valeurs actuelles
$rows = db()->query("SELECT cle, valeur FROM gp_content WHERE page = '$page'")->fetchAll();
$vals = array_column($rows, 'valeur', 'cle');

require_once __DIR__ . '/../includes/header.php';
?>

<h1 style="font-family:var(--serif);font-size:1.4rem;font-weight:400;color:var(--ink);margin-bottom:1.5rem">
  Page Accueil
</h1>

<?php if ($msg === 'success'): ?>
  <div class="alert alert-success">✓ Modifications enregistrées avec succès.</div>
<?php elseif ($msg === 'error'): ?>
  <div class="alert alert-error">
    <?php foreach ($errors as $e): ?>
      <div><?= htmlspecialchars($e) ?></div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
  <?= csrf_field() ?>

  <!-- HERO -->
  <div class="card">
    <div class="card-header">
      <span class="card-header-icon">⌂</span>
      <h2>Section Hero</h2>
    </div>
    <div class="card-body">
      <div class="field">
        <label>Titre hero</label>
        <textarea name="hero_titre" rows="2"><?= htmlspecialchars($vals['hero_titre'] ?? '') ?></textarea>
      </div>
      <div class="field">
        <label>Sous-titre hero</label>
        <textarea name="hero_sous_titre" rows="3"><?= htmlspecialchars($vals['hero_sous_titre'] ?? '') ?></textarea>
      </div>
      <?php $img = $vals['hero_image'] ?? ''; ?>
      <div class="field">
        <label>Image hero</label>
        <?php if ($img): ?>
          <img src="<?= htmlspecialchars(BASE_URL . $img) ?>" class="img-preview" onerror="this.style.display='none'"/>
        <?php endif; ?>
        <div class="img-upload-zone" onclick="this.querySelector('input').click()">
          <input type="file" name="hero_image" accept="image/*"
                 onchange="previewImg(this, '<?= $img ? 'prev_hero' : '' ?>')"/>
          <label>
            <strong>Choisir un fichier</strong> ou glisser-déposer<br>
            <span style="font-size:.72rem">JPG, PNG, WebP — max 5 Mo</span>
          </label>
        </div>
        <div class="field" style="margin-top:.75rem;margin-bottom:0">
          <label>Ou coller une URL d'image</label>
          <input type="url" name="hero_image_url" placeholder="https://..." value=""/>
        </div>
      </div>
    </div>
  </div>

  <!-- CITATION -->
  <div class="card">
    <div class="card-header">
      <span class="card-header-icon">❝</span>
      <h2>Citation</h2>
    </div>
    <div class="card-body">
      <div class="field">
        <label>Texte de la citation</label>
        <textarea name="citation_texte" rows="2"><?= htmlspecialchars($vals['citation_texte'] ?? '') ?></textarea>
      </div>
      <div class="field">
        <label>Auteur</label>
        <input type="text" name="citation_auteur" value="<?= htmlspecialchars($vals['citation_auteur'] ?? '') ?>"/>
      </div>
    </div>
  </div>

  <!-- UNIVERS -->
  <?php foreach ([1, 2, 3] as $n):
    $labels = [1 => 'Équilibre & Développement personnel', 2 => 'Leadership & Performance', 3 => 'Signature'];
    $img_key = "univers{$n}_image";
    $img_val = $vals[$img_key] ?? '';
  ?>
  <div class="card">
    <div class="card-header">
      <span class="card-header-icon"><?= ['◇','◈','⭐'][$n-1] ?></span>
      <h2>Univers <?= $n ?> — <?= $labels[$n] ?></h2>
    </div>
    <div class="card-body">
      <div class="field">
        <label>Titre</label>
        <input type="text" name="univers<?= $n ?>_titre"
               value="<?= htmlspecialchars($vals["univers{$n}_titre"] ?? '') ?>"/>
      </div>
      <div class="field">
        <label>Texte</label>
        <textarea name="univers<?= $n ?>_texte" rows="3"><?= htmlspecialchars($vals["univers{$n}_texte"] ?? '') ?></textarea>
      </div>
      <div class="field">
        <label>Image</label>
        <?php if ($img_val): ?>
          <img src="<?= htmlspecialchars(BASE_URL . $img_val) ?>" class="img-preview" onerror="this.style.display='none'"/>
        <?php endif; ?>
        <div class="img-upload-zone" onclick="this.querySelector('input').click()">
          <input type="file" name="<?= $img_key ?>" accept="image/*"/>
          <label><strong>Choisir un fichier</strong> — JPG, PNG, WebP max 5 Mo</label>
        </div>
        <div class="field" style="margin-top:.75rem;margin-bottom:0">
          <label>Ou URL d'image</label>
          <input type="url" name="<?= $img_key ?>_url" placeholder="https://..."/>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>

  <div class="form-actions">
    <button type="submit" class="btn btn-navy">Enregistrer les modifications</button>
    <a href="<?= BASE_URL ?>index.php" target="_blank" class="btn btn-ghost">↗ Voir la page</a>
  </div>
</form>

<script>
function previewImg(input, previewId) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      const prev = input.closest('.field').querySelector('.img-preview');
      if (prev) prev.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
