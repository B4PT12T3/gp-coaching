<?php

/**
 * GP COACHING — includes/content.php
 * Helper : lit le contenu depuis MySQL, fallback sur la valeur par défaut
 */

require_once __DIR__ . '/../admin/includes/db.php';

/**
 * Récupère une valeur de contenu depuis la BDD
 *
 * @param string $page     Ex: 'accueil', 'approche', 'contact'
 * @param string $key      Ex: 'hero_titre', 'hero_sous_titre'
 * @param string $default  Valeur affichée si la clé n'existe pas en BDD
 */
function content(string $page, string $key, string $default = ''): string
{
    static $cache = [];

    $cache_key = $page . '.' . $key;
    if (isset($cache[$cache_key])) {
        return $cache[$cache_key];
    }

    try {
        $stmt = db()->prepare(
            'SELECT valeur FROM " . DB_PREFIX . "content WHERE page = ? AND cle = ? LIMIT 1'
        );
        $stmt->execute([$page, $key]);
        $row = $stmt->fetch();
        $value = $row ? $row['valeur'] : $default;
    } catch (Exception $e) {
        $value = $default;
    }

    $cache[$cache_key] = $value;
    return $value;
}

/**
 * Même chose mais avec htmlspecialchars() appliqué (pour les textes dans le HTML)
 */
function c(string $page, string $key, string $default = ''): string
{
    return htmlspecialchars(content($page, $key, $default), ENT_QUOTES, 'UTF-8');
}

/**
 * Pour les images : retourne l'URL (peut être Unsplash ou assets/images/)
 */
function img(string $page, string $key, string $default_url = '', string $alt = ''): string
{
    $src = content($page, $key, $default_url);
    $alt_safe = htmlspecialchars($alt, ENT_QUOTES, 'UTF-8');
    $src_safe = htmlspecialchars($src, ENT_QUOTES, 'UTF-8');
    return '<img src="' . $src_safe . '" alt="' . $alt_safe . '"/>';
}
