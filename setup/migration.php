<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <title>Migration — Réseaux sociaux</title>
  <style>
    body { font-family: sans-serif; background: #F7F3ED; padding: 2rem; }
    .box { max-width: 560px; margin: 0 auto; background: #fff; border-radius: 8px; padding: 2rem; border: 1px solid rgba(30,26,20,.1); }
    h1 { font-size: 1.2rem; margin-bottom: 1.5rem; color: #1B2B4B; }
    .step { padding: .75rem 1rem; border-radius: 6px; font-size: .88rem; margin-bottom: .75rem; }
    .ok   { background: rgba(58,125,68,.1);  border: 1px solid rgba(58,125,68,.25);  color: #3a7d44; }
    .warn { background: rgba(184,144,90,.12); border: 1px solid rgba(184,144,90,.3); color: #8f6a2e; }
    .err  { background: rgba(180,64,64,.1);  border: 1px solid rgba(180,64,64,.25);  color: #b44040; }
    a { color: #1B2B4B; font-weight: 600; }
    code { background: rgba(30,26,20,.08); padding: .1rem .4rem; border-radius: 3px; font-size: .85rem; }
  </style>
</head>
<body>
<div class="box">
  <h1>⚙️ Migration — Réseaux sociaux &amp; liens footer</h1>
<?php
require_once __DIR__ . '/../admin/includes/db.php';

$nouvelles_cles = [
    // Réseaux sociaux
    ['global', 'social_linkedin',   '',  'text', 'URL LinkedIn (laisser vide pour masquer)'],
    ['global', 'social_facebook',   '',  'text', 'URL Facebook (laisser vide pour masquer)'],
    ['global', 'social_instagram',  '',  'text', 'URL Instagram (laisser vide pour masquer)'],
    ['global', 'social_youtube',    '',  'text', 'URL YouTube (laisser vide pour masquer)'],
    // Footer
    ['global', 'footer_copyright',  'GP Coaching · Béthune et sa région · Tous droits réservés', 'text', 'Texte copyright footer'],
    ['global', 'calendly_url',      'https://calendly.com/', 'text', 'Lien Calendly (bouton Prendre rendez-vous)'],
];

$stmt = db()->prepare("
    INSERT IGNORE INTO gp_content (page, cle, valeur, type, label)
    VALUES (?, ?, ?, ?, ?)
");

$count = 0;
foreach ($nouvelles_cles as $row) {
    try {
        $stmt->execute($row);
        echo '<div class="step ok">✓ Clé <code>' . $row[1] . '</code> ajoutée.</div>';
        $count++;
    } catch (Exception $e) {
        echo '<div class="step err">✗ ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
}

echo '<div class="step warn" style="margin-top:1rem">
    <strong>✓ Migration terminée (' . $count . ' clés).</strong><br><br>
    → <a href="../admin/pages/global.php">Configurer les réseaux sociaux dans l\'admin</a><br>
    → <strong>Supprime ce fichier</strong> : <code>setup/migration.php</code>
</div>';
?>
</div>
</body>
</html>
