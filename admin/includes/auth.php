<?php
/**
 * GP COACHING — admin/includes/auth.php
 * Vérifie que l'admin est connecté, redirige sinon
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['gp_admin_logged'])) {
    header('Location: ' . BASE_URL . 'admin/login.php');
    exit;
}

// Renouveler le token CSRF si absent
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function csrf_field(): string {
    return '<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">';
}

function csrf_check(): void {
    if (
        empty($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        http_response_code(403);
        die('Token CSRF invalide.');
    }
}
