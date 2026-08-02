<?php
session_start();
define('BASE_URL', '../../');
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/save.php';

$page   = 'global';
$msg    = '';
$errors = [];

$fields = [
    'social_linkedin'  => ['type' => 'text', 'label' => 'URL LinkedIn'],
    'social_facebook'  => ['type' => 'text', 'label' => 'URL Facebook'],
    'social_instagram' => ['type' => 'text', 'label' => 'URL Instagram'],
    'social_youtube'   => ['type' => 'text', 'label' => 'URL YouTube'],
    'footer_copyright' => ['type' => 'text', 'label' => 'Texte copyright footer'],
    'calendly_url'     => ['type' => 'text', 'label' => 'Lien Calendly'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $errors = save_fields($page, $fields);
    $msg    = empty($errors) ? 'success' : 'error';
}

$rows = db()->query("SELECT cle, valeur FROM gp_content WHERE page = 'global'")->fetchAll();
$vals = array_column($rows, 'valeur', 'cle');

require_once __DIR__ . '/../includes/header.php';
?>

<h1 style="font-family:var(--serif);font-size:1.4rem;font-weight:400;color:var(--ink);margin-bottom:1.5rem">
  Réseaux sociaux &amp; Paramètres globaux
</h1>

<?php if ($msg === 'success'): ?>
  <div class="alert alert-success">✓ Paramètres enregistrés.</div>
<?php elseif ($msg === 'error'): ?>
  <div class="alert alert-error"><?php foreach ($errors as $e) echo htmlspecialchars($e) . '<br>'; ?></div>
<?php endif; ?>

<form method="POST">
  <?= csrf_field() ?>

  <!-- Réseaux sociaux -->
  <div class="card">
    <div class="card-header">
      <span class="card-header-icon">◈</span>
      <h2>Réseaux sociaux</h2>
    </div>
    <div class="card-body">

      <p style="font-size:.8rem;color:var(--ink-60);margin-bottom:1.25rem">
        Laisse un champ vide pour masquer le réseau correspondant sur le site.
      </p>

      <div class="field">
        <label>LinkedIn — URL complète</label>
        <input type="url" name="social_linkedin"
               value="<?= htmlspecialchars($vals['social_linkedin'] ?? '') ?>"
               placeholder="https://linkedin.com/in/gilles-..."/>
        <span class="field-hint">Ex : https://www.linkedin.com/in/votre-profil</span>
      </div>

      <div class="field">
        <label>Facebook — URL complète</label>
        <input type="url" name="social_facebook"
               value="<?= htmlspecialchars($vals['social_facebook'] ?? '') ?>"
               placeholder="https://facebook.com/gpcoaching"/>
        <span class="field-hint">Ex : https://www.facebook.com/votre-page</span>
      </div>

      <div class="field">
        <label>Instagram — URL complète</label>
        <input type="url" name="social_instagram"
               value="<?= htmlspecialchars($vals['social_instagram'] ?? '') ?>"
               placeholder="https://instagram.com/gpcoaching"/>
        <span class="field-hint">Ex : https://www.instagram.com/votre-compte</span>
      </div>

      <div class="field">
        <label>YouTube — URL complète</label>
        <input type="url" name="social_youtube"
               value="<?= htmlspecialchars($vals['social_youtube'] ?? '') ?>"
               placeholder="https://youtube.com/@gpcoaching"/>
        <span class="field-hint">Ex : https://www.youtube.com/@votre-chaine</span>
      </div>

    </div>
  </div>

  <!-- Lien Calendly -->
  <div class="card">
    <div class="card-header">
      <span class="card-header-icon">◷</span>
      <h2>Lien de réservation (Calendly)</h2>
    </div>
    <div class="card-body">
      <div class="field">
        <label>URL Calendly</label>
        <input type="url" name="calendly_url"
               value="<?= htmlspecialchars($vals['calendly_url'] ?? 'https://calendly.com/') ?>"
               placeholder="https://calendly.com/gilles-gpcoaching/30min"/>
        <span class="field-hint">
          Ce lien est utilisé par tous les boutons "Prendre rendez-vous" du site.
        </span>
      </div>
      <div style="margin-top:1rem;padding:.85rem 1rem;background:var(--bg);border-radius:var(--radius);font-size:.8rem;color:var(--ink-60)">
        <strong style="color:var(--ink)">Comment trouver ton lien Calendly ?</strong><br>
        Connecte-toi sur <a href="https://calendly.com" target="_blank" style="color:var(--gold)">calendly.com</a>
        → ton profil → copie l'URL de l'événement souhaité.
      </div>
    </div>
  </div>

  <!-- Copyright -->
  <div class="card">
    <div class="card-header">
      <span class="card-header-icon">✦</span>
      <h2>Pied de page</h2>
    </div>
    <div class="card-body">
      <div class="field">
        <label>Texte copyright (après l'année)</label>
        <input type="text" name="footer_copyright"
               value="<?= htmlspecialchars($vals['footer_copyright'] ?? 'GP Coaching · Béthune et sa région · Tous droits réservés') ?>"/>
        <span class="field-hint">L'année © est ajoutée automatiquement devant.</span>
      </div>
    </div>
  </div>

  <div class="form-actions">
    <button type="submit" class="btn btn-navy">Enregistrer</button>
  </div>
</form>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
