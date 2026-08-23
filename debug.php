<?php
require_once __DIR__ . '/../admin/includes/db.php';
$stmt = db()->prepare("INSERT IGNORE INTO gp_content (page, cle, valeur, type, label) VALUES (?, ?, ?, ?, ?)");
$default = '<h2>1. Responsable du traitement</h2>
<p>GP Coaching — Gilles Petitprez<br>Béthune, Hauts-de-France<br>Email : gilles@gpcoaching.fr</p>
<h2>2. Données collectées</h2>
<p>Dans le cadre de l\'utilisation du formulaire de contact, nous collectons : nom, prénom, email, téléphone (optionnel) et message. Ces données sont utilisées uniquement pour répondre à vos demandes.</p>
<h2>3. Durée de conservation</h2>
<p>Vos données sont conservées 3 ans maximum à compter du dernier contact.</p>
<h2>4. Vos droits</h2>
<p>Conformément au RGPD, vous disposez d\'un droit d\'accès, rectification, suppression et opposition. Contactez-nous : gilles@gpcoaching.fr</p>
<h2>5. Cookies</h2>
<p>Ce site n\'utilise pas de cookies de tracking. Seuls des cookies techniques nécessaires au fonctionnement peuvent être déposés.</p>
<h2>6. Hébergement</h2>
<p>Site hébergé par LWS (Ligne Web Services), France.</p>';

$cles = [
    ['rgpd', 'titre',   'Politique de confidentialité & RGPD', 'text',     'Titre de la page'],
    ['rgpd', 'contenu', $default,                               'textarea', 'Contenu RGPD'],
];
$n = 0;
foreach ($cles as $row) {
    $stmt->execute($row);
    $n++;
}
echo "<p style='font-family:sans-serif;padding:1rem;color:green'>✓ $n clés insérées. <a href='../admin/pages/rgpd.php'>→ Admin RGPD</a> · <strong>Supprime ce fichier !</strong></p>";
