<?php

/**
 * GP COACHING — admin/includes/db.php
 * Connexion MySQL centralisée
 * ⚠️  Remplir les constantes avant déploiement
 */

define('DB_HOST', '91.216.107.219');
define('DB_NAME', 'gpcoa2829021');       // ← ex: client_gpcoaching
define('DB_USER', 'gpcoa2829021');      // ← identifiant MySQL LWS
define('DB_PASS', 'bZ4-meuFqUhSxSY');  // ← mot de passe MySQL LWS
define('DB_CHARSET', 'utf8mb4');
// Préfixe de table selon l'environnement
$_host = $_SERVER['HTTP_HOST'] ?? '';
define('DB_PREFIX', str_contains($_host, 'test.gpcoaching') ? 'test_' : 'gp_');
function db(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=%s',
                DB_HOST,
                DB_NAME,
                DB_CHARSET
            );
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            error_log('[GP Coaching DB] ' . $e->getMessage());
            die('<p style="font-family:sans-serif;color:#b44040;padding:2rem">
                Erreur de connexion à la base de données.<br>
                Vérifiez les paramètres dans <code>admin/includes/db.php</code>.
            </p>');
        }
    }
    return $pdo;
}
