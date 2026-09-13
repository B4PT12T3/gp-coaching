<?php

/**
 * GP COACHING — includes/content.php
 * Helper : lit le contenu depuis MySQL, fallback sur la valeur par défaut
 */

require_once __DIR__ . '/../admin/includes/db.php';

function content(string $page, string $key, string $default = ''): string
{
    static $cache = [];

    $cache_key = $page . '.' . $key;
    if (isset($cache[$cache_key])) {
        return $cache[$cache_key];
    }

    if (!defined('DB_PREFIX')) {
        return $default;
    }

    try {
        $stmt = db()->prepare(
            'SELECT valeur FROM ' . DB_PREFIX . 'content WHERE page = ? AND cle = ? LIMIT 1'
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

function c(string $page, string $key, string $default = ''): string
{
    return htmlspecialchars(content($page, $key, $default), ENT_QUOTES, 'UTF-8');
}

function img(string $page, string $key, string $default_url = '', string $alt = ''): string
{
    $src = content($page, $key, $default_url);

    if ($src === '') {
        $src = $default_url;
    }

    // Chemin relatif → absolu
    if ($src !== '' && !str_starts_with($src, 'http') && !str_starts_with($src, '/')) {
        $src = '/' . $src;
    }

    // Cache busting sur les images locales
    if (str_starts_with($src, '/assets/images/')) {
        $file_path = $_SERVER['DOCUMENT_ROOT'] . $src;
        $mtime     = @filemtime($file_path);
        if ($mtime) {
            $src .= '?v=' . $mtime;
        }
    }

    $alt_safe = htmlspecialchars($alt, ENT_QUOTES, 'UTF-8');
    $src_safe = htmlspecialchars($src, ENT_QUOTES, 'UTF-8');
    return '<img src="' . $src_safe . '" alt="' . $alt_safe . '"/>';
}
