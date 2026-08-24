<?php
require_once 'includes/content.php';
include 'includes/header.php';

$default_contenu = "<h2>1. Responsable du traitement</h2>
<p>GP Coaching — Gilles Petitprez<br>Béthune, Hauts-de-France<br>Email : gilles@gpcoaching.fr</p>
<h2>2. Données collectées</h2>
<p>Dans le cadre du formulaire de contact, nous collectons : nom, prénom, email, téléphone (optionnel) et message. Ces données sont utilisées uniquement pour répondre à vos demandes.</p>
<h2>3. Durée de conservation</h2>
<p>Vos données sont conservées 3 ans maximum à compter du dernier contact.</p>
<h2>4. Vos droits</h2>
<p>Conformément au RGPD, vous disposez d'un droit d'accès, rectification, suppression et opposition. Contactez-nous : gilles@gpcoaching.fr</p>
<h2>5. Cookies</h2>
<p>Ce site n'utilise pas de cookies de tracking. Seuls des cookies techniques nécessaires au fonctionnement peuvent être déposés.</p>
<h2>6. Hébergement</h2>
<p>Site hébergé par LWS (Ligne Web Services), France.</p>";
?>

<section class="mentions-hero">
    <div class="container">
        <span class="label">Mentions légales & Confidentialité</span>
        <h1><?= c('rgpd', 'titre', 'Politique de confidentialité & RGPD') ?></h1>
    </div>
</section>

<section class="mentions-content">
    <div class="container mentions-inner">
        <?= content('rgpd', 'contenu', $default_contenu) ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>