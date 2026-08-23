<?php
require_once __DIR__ . '/../admin/includes/db.php';
$stmt = db()->prepare("INSERT IGNORE INTO gp_content (page, cle, valeur, type, label) VALUES (?, ?, ?, ?, ?)");
$cles = [
    ['accompagnement', 'intro_image', 'https://images.unsplash.com/photo-1543269664-56d93c1b41a6?w=1200&q=80', 'image', 'Intro — Image'],
    ['accompagnement', 'intro_label', 'Une approche sur-mesure', 'text', 'Intro — Étiquette'],
    ['accompagnement', 'intro_titre', 'Chaque accompagnement commence par une écoute approfondie de votre situation', 'text', 'Intro — Titre'],
    ['accompagnement', 'intro_p1',    'Un premier échange gratuit pour cerner vos besoins et vos objectifs', 'text', 'Intro — Point 1'],
    ['accompagnement', 'intro_p2',    'Un parcours construit autour de vous, de votre rythme et de votre contexte', 'text', 'Intro — Point 2'],
    ['accompagnement', 'intro_p3',    'Des séances en présentiel ou en visioconférence, partout en France', 'text', 'Intro — Point 3'],
    ['accompagnement', 'intro_p4',    'Un suivi régulier pour ancrer les progrès dans la durée', 'text', 'Intro — Point 4'],
    ['accompagnement', 'intro_cta',   'Réserver un premier échange', 'text', 'Intro — Texte bouton'],
];
$n = 0;
foreach ($cles as $row) {
    $stmt->execute($row);
    $n++;
}
echo "<p style='font-family:sans-serif;padding:1rem;color:green'>✓ $n clés insérées. <a href='../admin/pages/accompagnement.php'>→ Admin</a> · <strong>Supprime ce fichier !</strong></p>";
