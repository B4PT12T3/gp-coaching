<?php
require_once __DIR__ . '/../admin/includes/db.php';
$stmt = db()->prepare("INSERT IGNORE INTO gp_content (page, cle, valeur, type, label) VALUES (?, ?, ?, ?, ?)");

$cles = [
    // Univers 1
    ['accompagnement', 'u1_titre',   'Équilibre & Développement personnel', 'text', 'U1 — Titre'],
    ['accompagnement', 'u1_accroche', 'Retrouver son équilibre, se reconnecter à l\'essentiel', 'text', 'U1 — Accroche'],
    ['accompagnement', 'u1_image',   'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80', 'image', 'U1 — Image'],
    ['accompagnement', 'u1_p1', 'Retrouver confiance en soi', 'text', 'U1 — Point 1'],
    ['accompagnement', 'u1_p2', 'Équilibrer vie personnelle et vie professionnelle', 'text', 'U1 — Point 2'],
    ['accompagnement', 'u1_p3', 'Traverser les périodes de transition', 'text', 'U1 — Point 3'],
    ['accompagnement', 'u1_p4', 'Retrouver du sens et de la clarté', 'text', 'U1 — Point 4'],
    // Univers 2
    ['accompagnement', 'u2_titre',   'Leadership & Performance', 'text', 'U2 — Titre'],
    ['accompagnement', 'u2_accroche', 'Développer votre leadership et votre impact', 'text', 'U2 — Accroche'],
    ['accompagnement', 'u2_image',   'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80', 'image', 'U2 — Image'],
    // 2.1 Leadership
    ['accompagnement', 'u2_1_titre',   'Parcours Leadership', 'text', 'U2.1 — Titre'],
    ['accompagnement', 'u2_1_accroche', 'Piloter avec clarté, décider et performer', 'text', 'U2.1 — Accroche'],
    ['accompagnement', 'u2_1_image',   'https://images.unsplash.com/photo-1500835556837-99ac94a94552?w=800&q=80', 'image', 'U2.1 — Image'],
    ['accompagnement', 'u2_1_p1', 'Clarifier votre vision et vos objectifs', 'text', 'U2.1 — Point 1'],
    ['accompagnement', 'u2_1_p2', 'Prendre des décisions alignées et efficaces', 'text', 'U2.1 — Point 2'],
    ['accompagnement', 'u2_1_p3', 'Passer à l\'action avec impact', 'text', 'U2.1 — Point 3'],
    ['accompagnement', 'u2_1_p4', 'Développer votre performance et celle de votre équipe', 'text', 'U2.1 — Point 4'],
    // 2.2 Posture
    ['accompagnement', 'u2_2_titre',   'Parcours Posture', 'text', 'U2.2 — Titre'],
    ['accompagnement', 'u2_2_accroche', 'Affirmer votre posture, inspirer et avoir de l\'impact', 'text', 'U2.2 — Accroche'],
    ['accompagnement', 'u2_2_image',   'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80', 'image', 'U2.2 — Image'],
    ['accompagnement', 'u2_2_p1', 'Affirmer votre leadership', 'text', 'U2.2 — Point 1'],
    ['accompagnement', 'u2_2_p2', 'Inspirer confiance et motivation', 'text', 'U2.2 — Point 2'],
    ['accompagnement', 'u2_2_p3', 'Renforcer votre présence et votre influence', 'text', 'U2.2 — Point 3'],
    ['accompagnement', 'u2_2_p4', 'Développer votre impact au quotidien', 'text', 'U2.2 — Point 4'],
    // Univers 3
    ['accompagnement', 'u3_titre',   'Signature', 'text', 'U3 — Titre'],
    ['accompagnement', 'u3_accroche', 'Accompagnements premium et sur-mesure', 'text', 'U3 — Accroche'],
    ['accompagnement', 'u3_image',   'https://images.unsplash.com/photo-1502780402662-acc01917949e?w=800&q=80', 'image', 'U3 — Image'],
    // 3.1 Trajectoire
    ['accompagnement', 'u3_1_titre',   'Parcours Trajectoire', 'text', 'U3.1 — Titre'],
    ['accompagnement', 'u3_1_accroche', 'Structurer, développer et piloter votre croissance', 'text', 'U3.1 — Accroche'],
    ['accompagnement', 'u3_1_image',   'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800&q=80', 'image', 'U3.1 — Image'],
    ['accompagnement', 'u3_1_p1', 'Structurer votre activité et votre organisation', 'text', 'U3.1 — Point 1'],
    ['accompagnement', 'u3_1_p2', 'Développer votre entreprise de façon maîtrisée', 'text', 'U3.1 — Point 2'],
    ['accompagnement', 'u3_1_p3', 'Piloter vos résultats et vos équipes', 'text', 'U3.1 — Point 3'],
    ['accompagnement', 'u3_1_p4', 'Préparer la croissance et l\'avenir', 'text', 'U3.1 — Point 4'],
    // 3.2 Alignement
    ['accompagnement', 'u3_2_titre',   'Parcours Alignement', 'text', 'U3.2 — Titre'],
    ['accompagnement', 'u3_2_accroche', 'Se reconnecter, se réaliser et se révéler', 'text', 'U3.2 — Accroche'],
    ['accompagnement', 'u3_2_image',   'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80', 'image', 'U3.2 — Image'],
    ['accompagnement', 'u3_2_p1', 'Se reconnecter à soi et à ses valeurs', 'text', 'U3.2 — Point 1'],
    ['accompagnement', 'u3_2_p2', 'Se réaligner avec sa vision et ses priorités', 'text', 'U3.2 — Point 2'],
    ['accompagnement', 'u3_2_p3', 'Se révéler et agir avec cohérence', 'text', 'U3.2 — Point 3'],
    ['accompagnement', 'u3_2_p4', 'Dédié aux entreprises entre 3 et 5 ans d\'activité', 'text', 'U3.2 — Point 4'],
];

$n = 0;
foreach ($cles as $row) {
    $stmt->execute($row);
    $n++;
}

echo "<p style='font-family:sans-serif;padding:1rem;color:green'>✓ $n clés insérées. <a href='../admin/pages/accompagnement.php'>→ Admin</a> · <strong>Supprime ce fichier !</strong></p>";
