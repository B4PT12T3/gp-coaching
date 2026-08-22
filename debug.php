<?php
require_once __DIR__ . '/../admin/includes/db.php';
$stmt = db()->prepare("INSERT IGNORE INTO gp_content (page, cle, valeur, type, label) VALUES (?, ?, ?, ?, ?)");
$cles = [
    ['accueil', 'mea_image', 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&q=80', 'image',    'Section mise en avant — Image'],
    ['accueil', 'mea_titre', 'Une approche structurée pour passer de la réflexion à l\'action',          'textarea', 'Section mise en avant — Titre'],
    ['accueil', 'mea_texte', 'Prendre du recul, clarifier vos priorités, identifier vos leviers d\'action et avancer avec justesse.', 'textarea', 'Section mise en avant — Texte'],
];
$n = 0;
foreach ($cles as $row) {
    $stmt->execute($row);
    $n++;
}
echo "<p style='font-family:sans-serif;padding:1rem;color:green'>✓ $n clés insérées. <a href='../admin/pages/accueil.php'>→ Admin</a> · <strong>Supprime ce fichier !</strong></p>";
