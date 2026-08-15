<?php

/**
 * GP COACHING — admin/includes/save.php
 * Sauvegarde un ensemble de champs en BDD
 * Gère aussi l'upload d'images
 */

function save_fields(string $page, array $fields): array
{
    $errors = [];
    $pdo    = db();

    $stmt = $pdo->prepare("
        INSERT INTO gp_content (page, cle, valeur, type, label)
        VALUES (?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE valeur = VALUES(valeur), updated_at = CURRENT_TIMESTAMP
    ");

    foreach ($fields as $key => $def) {
        $type  = $def['type']  ?? 'text';
        $label = $def['label'] ?? $key;

        if ($type === 'image') {
            // Upload de fichier ?
            if (!empty($_FILES[$key]['name']) && $_FILES[$key]['error'] === UPLOAD_ERR_OK) {
                $result = upload_image($key);
                if ($result['success']) {
                    $valeur = $result['path'];
                } else {
                    $errors[] = $result['error'];
                    continue;
                }
            } elseif (isset($_POST[$key . '_url']) && trim($_POST[$key . '_url']) !== '') {
                // URL externe
                $valeur = trim($_POST[$key . '_url']);
            } else {
                // Pas de changement image → on skip
                continue;
            }
        } else {
            $valeur = trim($_POST[$key] ?? '');
            // Ne pas écraser avec une valeur vide
            if ($valeur === '') continue;
        }

        $stmt->execute([$page, $key, $valeur, $type, $label]);
    }

    return $errors;
}

/**
 * Compte combien de champs ont été mis à jour
 * (pour afficher dans le message de succès)
 */
function save_fields_count(string $page, array $fields): array
{
    $errors  = [];
    $updated = 0;
    $pdo     = db();

    $stmt = $pdo->prepare("
        INSERT INTO gp_content (page, cle, valeur, type, label)
        VALUES (?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE valeur = VALUES(valeur), updated_at = CURRENT_TIMESTAMP
    ");

    foreach ($fields as $key => $def) {
        $type  = $def['type']  ?? 'text';
        $label = $def['label'] ?? $key;

        if ($type === 'image') {
            if (!empty($_FILES[$key]['name']) && $_FILES[$key]['error'] === UPLOAD_ERR_OK) {
                $result = upload_image($key);
                if ($result['success']) {
                    $valeur = $result['path'];
                } else {
                    $errors[] = $result['error'];
                    continue;
                }
            } elseif (isset($_POST[$key . '_url']) && trim($_POST[$key . '_url']) !== '') {
                $valeur = trim($_POST[$key . '_url']);
            } else {
                continue;
            }
        } else {
            $valeur = trim($_POST[$key] ?? '');
            if ($valeur === '') continue;
        }

        $stmt->execute([$page, $key, $valeur, $type, $label]);
        $updated++;
    }

    return ['errors' => $errors, 'updated' => $updated];
}

function upload_image(string $field_name): array
{
    $allowed_types = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
    $max_size      = 5 * 1024 * 1024; // 5 Mo
    $upload_dir    = __DIR__ . '/../../assets/images/';

    $file = $_FILES[$field_name];

    // Vérifications
    if (!in_array($file['type'], $allowed_types)) {
        return ['success' => false, 'error' => "Format non autorisé pour $field_name (jpg, png, webp, gif uniquement)."];
    }
    if ($file['size'] > $max_size) {
        return ['success' => false, 'error' => "Image trop lourde pour $field_name (max 5 Mo)."];
    }

    // Nom unique sécurisé
    $ext      = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = $field_name . '_' . time() . '.' . strtolower($ext);
    $dest     = $upload_dir . $filename;

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    if (!move_uploaded_file($file['tmp_name'], $dest)) {
        return ['success' => false, 'error' => "Erreur lors du déplacement du fichier $field_name."];
    }

    return ['success' => true, 'path' => 'assets/images/' . $filename];
}
