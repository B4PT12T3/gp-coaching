<?php
session_start();
define('BASE_URL', '../../');
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/save.php';

$page   = 'rgpd';
$msg    = '';
$errors = [];

$fields = [
    'titre'   => ['type' => 'text',     'label' => 'Titre de la page'],
    'contenu' => ['type' => 'textarea',  'label' => 'Contenu (HTML autorisé)'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    // Pour le contenu RGPD on accepte le HTML — on bypasse strip_tags
    if (!empty($_POST['contenu'])) {
        $stmt = db()->prepare("
            INSERT INTO gp_content (page, cle, valeur, type, label)
            VALUES (?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE valeur = VALUES(valeur), updated_at = CURRENT_TIMESTAMP
        ");
        $stmt->execute([$page, 'contenu', $_POST['contenu'], 'textarea', 'Contenu RGPD']);
        unset($_POST['contenu'], $fields['contenu']);
    }
    $errors = save_fields($page, $fields);
    $msg    = empty($errors) ? 'success' : 'error';
}

$rows = db()->query("SELECT cle, valeur FROM gp_content WHERE page = 'rgpd'")->fetchAll();
$vals = array_column($rows, 'valeur', 'cle');

require_once __DIR__ . '/../includes/header.php';

$default_contenu = '<h2>1. Responsable du traitement</h2>
<p>GP Coaching — Gilles Petitprez<br>
Béthune, Hauts-de-France<br>
Email : gilles@gpcoaching.fr</p>

<h2>2. Données collectées</h2>
<p>Dans le cadre de l\'utilisation du formulaire de contact, nous collectons les informations suivantes : nom, prénom, adresse email, numéro de téléphone (optionnel) et message. Ces données sont utilisées uniquement pour répondre à vos demandes.</p>

<h2>3. Durée de conservation</h2>
<p>Vos données sont conservées pour la durée nécessaire au traitement de votre demande, et au maximum 3 ans à compter du dernier contact.</p>

<h2>4. Vos droits</h2>
<p>Conformément au RGPD, vous disposez d\'un droit d\'accès, de rectification, de suppression et d\'opposition à vos données. Pour exercer ces droits, contactez-nous à : gilles@gpcoaching.fr</p>

<h2>5. Cookies</h2>
<p>Ce site n\'utilise pas de cookies de tracking. Seuls des cookies techniques nécessaires au fonctionnement du site peuvent être déposés.</p>

<h2>6. Hébergement</h2>
<p>Ce site est hébergé par LWS (Ligne Web Services), France.</p>';
?>

<h1 style="font-family:var(--serif);font-size:1.4rem;font-weight:400;color:var(--ink);margin-bottom:1.5rem">
    Politique de confidentialité &amp; RGPD
</h1>

<?php if ($msg === 'success'): ?>
    <div class="alert alert-success">✓ Page RGPD mise à jour.</div>
<?php elseif ($msg === 'error'): ?>
    <div class="alert alert-error"><?php foreach ($errors as $e) echo htmlspecialchars($e) . '<br>'; ?></div>
<?php endif; ?>

<form method="POST">
    <?= csrf_field() ?>

    <div class="card">
        <div class="card-header">
            <span class="card-header-icon">◈</span>
            <h2>Informations générales</h2>
        </div>
        <div class="card-body">
            <div class="field">
                <label>Titre de la page</label>
                <input type="text" name="titre"
                    value="<?= htmlspecialchars($vals['titre'] ?? 'Politique de confidentialité & RGPD') ?>" />
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <span class="card-header-icon">✦</span>
            <h2>Contenu de la page</h2>
        </div>
        <div class="card-body">
            <div class="field">
                <label>Contenu (HTML autorisé — utilisez &lt;h2&gt;, &lt;p&gt;, &lt;ul&gt;)</label>
                <textarea name="contenu" rows="20"
                    style="font-family:monospace;font-size:.8rem"><?= htmlspecialchars($vals['contenu'] ?? $default_contenu) ?></textarea>
                <span class="field-hint">Vous pouvez utiliser du HTML basique : &lt;h2&gt;, &lt;h3&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;li&gt;, &lt;strong&gt;, &lt;a&gt;</span>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-navy">Enregistrer</button>
        <a href="<?= BASE_URL ?>rgpd.php" target="_blank" class="btn btn-ghost">↗ Voir la page</a>
    </div>
</form>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>