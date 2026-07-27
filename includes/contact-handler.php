<?php
/**
 * GP COACHING — contact-handler.php
 * Traitement du formulaire de contact
 * Appelé en POST depuis contact.php
 */

// Sécurité : accès direct interdit
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

// ── CONFIG ──
define('DESTINATAIRE', 'GP2coaching@gmail.com');
define('NOM_SITE',     'GP Coaching');

// ── CSRF basique (token en session) ──
session_start();
if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
    $_SESSION['form_error'] = 'Token de sécurité invalide. Veuillez réessayer.';
    header('Location: contact.php');
    exit;
}

// ── HONEYPOT anti-spam ──
if (!empty($_POST['website'])) {
    // Bot détecté — on simule un succès sans envoyer
    header('Location: contact.php?sent=1');
    exit;
}

// ── RATE LIMITING basique (1 envoi / 60s par IP) ──
$ip_key = 'last_contact_' . md5($_SERVER['REMOTE_ADDR']);
if (isset($_SESSION[$ip_key]) && (time() - $_SESSION[$ip_key]) < 60) {
    $_SESSION['form_error'] = 'Merci de patienter avant de renvoyer un message.';
    header('Location: contact.php');
    exit;
}

// ── SANITIZE & VALIDATE ──
$nom       = trim(strip_tags($_POST['nom']       ?? ''));
$email     = trim(strip_tags($_POST['email']     ?? ''));
$telephone = trim(strip_tags($_POST['telephone'] ?? ''));
$message   = trim(strip_tags($_POST['message']   ?? ''));

$errors = [];

if (mb_strlen($nom) < 2) {
    $errors[] = 'Veuillez indiquer votre nom et prénom.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'L\'adresse email n\'est pas valide.';
}
if (mb_strlen($message) < 10) {
    $errors[] = 'Votre message est trop court.';
}

if (!empty($errors)) {
    $_SESSION['form_errors']  = $errors;
    $_SESSION['form_data']    = compact('nom', 'email', 'telephone', 'message');
    header('Location: contact.php#contact-form');
    exit;
}

// ── ENVOI EMAIL ──
$sujet = '[' . NOM_SITE . '] Nouveau message de ' . $nom;

$corps  = "Nouveau message reçu depuis le site " . NOM_SITE . "\n";
$corps .= str_repeat('─', 50) . "\n\n";
$corps .= "Nom      : " . $nom       . "\n";
$corps .= "Email    : " . $email     . "\n";
$corps .= "Téléphone: " . ($telephone ?: 'Non renseigné') . "\n\n";
$corps .= "Message :\n" . $message   . "\n\n";
$corps .= str_repeat('─', 50) . "\n";
$corps .= "Envoyé le : " . date('d/m/Y à H:i') . "\n";
$corps .= "IP       : " . $_SERVER['REMOTE_ADDR'] . "\n";

$headers  = "From: " . NOM_SITE . " <noreply@gp-coaching.fr>\r\n";
$headers .= "Reply-To: " . $nom . " <" . $email . ">\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

$envoye = mail(DESTINATAIRE, $sujet, $corps, $headers);

if ($envoye) {
    $_SESSION[$ip_key] = time(); // Rate limiting
    unset($_SESSION['form_data'], $_SESSION['form_errors']);
    header('Location: contact.php?sent=1');
} else {
    $_SESSION['form_error'] = 'Une erreur est survenue lors de l\'envoi. Veuillez réessayer ou me contacter par téléphone.';
    header('Location: contact.php#contact-form');
}
exit;
