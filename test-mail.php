<?php
/**
 * GP COACHING — test-mail.php
 * Diagnostic envoi email
 * ⚠️ SUPPRIMER APRÈS TEST
 */

$destinataire = 'gilles@gpcoaching.fr';
$copie        = 'gp2coach@gmail.com';
$expediteur   = 'mail_php@gpcoaching.fr';

echo '<style>
  body { font-family: sans-serif; padding: 2rem; background: #F7F3ED; }
  .box { max-width: 600px; margin: 0 auto; background: #fff; padding: 2rem; border-radius: 8px; }
  h1 { color: #1B2B4B; font-size: 1.2rem; margin-bottom: 1.5rem; }
  .step { padding: .75rem 1rem; border-radius: 6px; margin-bottom: .75rem; font-size: .9rem; }
  .ok   { background: rgba(58,125,68,.1);  border: 1px solid rgba(58,125,68,.3);  color: #2d6b37; }
  .err  { background: rgba(180,64,64,.1);  border: 1px solid rgba(180,64,64,.3);  color: #b44040; }
  .info { background: rgba(27,43,75,.07);  border: 1px solid rgba(27,43,75,.15);  color: #1B2B4B; }
  code  { background: rgba(0,0,0,.06); padding: .1rem .4rem; border-radius: 3px; font-size: .85rem; }
</style>
<div class="box">
<h1>🔍 Diagnostic envoi email — GP Coaching</h1>';

// ── 1. Infos serveur ──
echo '<div class="step info">';
echo '<strong>Serveur PHP :</strong> ' . phpversion() . '<br>';
echo '<strong>Serveur :</strong> ' . ($_SERVER['SERVER_NAME'] ?? 'inconnu') . '<br>';
echo '<strong>OS :</strong> ' . PHP_OS . '<br>';
echo '</div>';

// ── 2. Vérifier si mail() existe ──
if (!function_exists('mail')) {
    echo '<div class="step err">❌ La fonction <code>mail()</code> n\'est pas disponible sur ce serveur.</div>';
    echo '</div></body></html>'; exit;
}
echo '<div class="step ok">✓ Fonction <code>mail()</code> disponible.</div>';

// ── 3. Vérifier sendmail_path ──
$sendmail = ini_get('sendmail_path');
echo '<div class="step info"><strong>sendmail_path :</strong> ' . ($sendmail ?: '(non défini)') . '</div>';

// ── 4. Test envoi simple ──
$sujet = '[TEST] Formulaire GP Coaching — ' . date('d/m/Y H:i:s');
$corps  = "Ceci est un email de test envoyé depuis le diagnostic.\n\n";
$corps .= "Date    : " . date('d/m/Y à H:i:s') . "\n";
$corps .= "Serveur : " . ($_SERVER['SERVER_NAME'] ?? 'inconnu') . "\n";
$corps .= "IP      : " . ($_SERVER['SERVER_ADDR'] ?? 'inconnue') . "\n";

$headers  = "From: GP Coaching <{$expediteur}>\r\n";
$headers .= "Reply-To: test@test.fr\r\n";
$headers .= "Cc: {$copie}\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

echo '<div class="step info">Tentative d\'envoi vers <code>' . $destinataire . '</code> + copie <code>' . $copie . '</code>...</div>';

$result = mail($destinataire, $sujet, $corps, $headers);

if ($result) {
    echo '<div class="step ok">
        ✓ <code>mail()</code> a retourné <strong>true</strong> — l\'email a été accepté par le serveur.<br>
        <small>Vérifie ta boîte <strong>' . $destinataire . '</strong> et <strong>' . $copie . '</strong> (y compris les spams).</small>
    </div>';
} else {
    echo '<div class="step err">
        ❌ <code>mail()</code> a retourné <strong>false</strong> — le serveur a refusé l\'envoi.<br>
        Le problème est dans la configuration serveur LWS, pas dans le code.
    </div>';
}

// ── 5. Test sans Cc (pour isoler le problème) ──
$headers2  = "From: GP Coaching <{$expediteur}>\r\n";
$headers2 .= "Content-Type: text/plain; charset=UTF-8\r\n";

$result2 = mail($copie, '[TEST DIRECT] ' . $sujet, $corps, $headers2);

if ($result2) {
    echo '<div class="step ok">✓ Envoi direct vers <code>' . $copie . '</code> accepté.</div>';
} else {
    echo '<div class="step err">❌ Envoi direct vers <code>' . $copie . '</code> refusé aussi.</div>';
}

// ── 6. Vérifier error_log ──
$error_log = ini_get('error_log');
echo '<div class="step info"><strong>Fichier error_log :</strong> ' . ($error_log ?: '(non défini — les erreurs PHP ne sont pas loguées)') . '</div>';

echo '<div class="step err" style="margin-top:1rem">
    ⚠️ <strong>Supprime ce fichier après le test !</strong><br>
    <code>git rm test-mail.php && git commit -m "remove test-mail" && git push</code>
</div>';

echo '</div>';
