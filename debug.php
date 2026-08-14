<?php
// debug-approche-admin.php — SUPPRIMER APRÈS TEST
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once 'admin/includes/db.php';

echo "<pre style='font-family:monospace;padding:1rem;font-size:.85rem;background:#fff'>";

// 1. Clés en BDD pour approche
echo "=== CLÉS EN BDD (page=approche) ===\n";
$rows = db()->query("SELECT cle, type, label, LEFT(valeur,40) as valeur FROM gp_content WHERE page = 'approche' ORDER BY cle")->fetchAll();
if (empty($rows)) {
    echo "⚠️  AUCUNE CLÉ TROUVÉE — la page approche n'a jamais été initialisée en BDD !\n";
    echo "Solution : relancer setup/install.php ou insérer les clés manuellement.\n";
} else {
    foreach ($rows as $r) {
        echo "  [{$r['type']}] {$r['cle']} = {$r['valeur']}\n";
    }
}

// 2. Simuler un POST pour voir si save_fields fonctionne
echo "\n=== TEST SAVE SIMULÉ ===\n";
require_once 'admin/includes/save.php';

$_POST = [
    'csrf_token'      => 'bypass_test',
    'parcours_titre'  => 'TEST TITRE ' . time(),
    'parcours_p1'     => 'TEST P1',
    'parcours_p2'     => 'TEST P2',
    'parcours_p3'     => 'TEST P3',
    'mission_texte'   => 'TEST MISSION',
    'conviction_texte' => 'TEST CONVICTION',
];
$_FILES = [];

$fields = [
    'coach_photo'      => ['type' => 'image',    'label' => 'Photo du coach'],
    'parcours_titre'   => ['type' => 'text',     'label' => 'Titre parcours'],
    'parcours_p1'      => ['type' => 'textarea', 'label' => 'Paragraphe 1'],
    'parcours_p2'      => ['type' => 'textarea', 'label' => 'Paragraphe 2'],
    'parcours_p3'      => ['type' => 'textarea', 'label' => 'Paragraphe 3'],
    'mission_texte'    => ['type' => 'textarea', 'label' => 'Texte Mission'],
    'conviction_texte' => ['type' => 'textarea', 'label' => 'Texte Conviction'],
];

try {
    $errors = save_fields('approche', $fields);
    if (empty($errors)) {
        echo "✓ save_fields() a fonctionné sans erreur\n";
        // Vérifier que la valeur a bien changé
        $check = db()->query("SELECT valeur FROM gp_content WHERE page='approche' AND cle='parcours_titre'")->fetch();
        echo "✓ Valeur en BDD après save : " . ($check['valeur'] ?? 'NON TROUVÉ') . "\n";
    } else {
        echo "❌ Erreurs : " . implode(', ', $errors) . "\n";
    }
} catch (Exception $e) {
    echo "❌ Exception : " . $e->getMessage() . "\n";
}

// 3. Vérifier la session CSRF
echo "\n=== SESSION ===\n";
echo "csrf_token en session : " . (isset($_SESSION['csrf_token']) ? 'présent' : 'ABSENT') . "\n";
echo "gp_admin_logged : " . (isset($_SESSION['gp_admin_logged']) ? 'connecté' : 'NON connecté') . "\n";

echo "</pre>";
echo "<p style='color:red;font-family:sans-serif'><strong>⚠️ Supprimer après test : git rm debug-approche-admin.php</strong></p>";
