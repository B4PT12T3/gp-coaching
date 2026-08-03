<?php

/**
 * GP COACHING — test-form.php
 * Diagnostic formulaire contact
 * ⚠️ SUPPRIMER APRÈS TEST
 */
session_start();

// Simuler exactement ce que fait contact.php
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$log = [];

// Si on reçoit un POST de test
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $log[] = ['info', 'POST reçu ✓'];

    // Vérif CSRF
    $token_post    = $_POST['csrf_token'] ?? '(absent)';
    $token_session = $_SESSION['csrf_token'] ?? '(absent en session)';
    $log[] = ['info', "Token POST    : $token_post"];
    $log[] = ['info', "Token SESSION : $token_session"];

    if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $token_session) {
        $log[] = ['err', '❌ CSRF invalide — c\'est probablement la cause du problème !'];
    } else {
        $log[] = ['ok', '✓ CSRF valide'];
    }

    // Vérif champs
    $nom     = trim($_POST['nom']     ?? '');
    $email   = trim($_POST['email']   ?? '');
    $message = trim($_POST['message'] ?? '');
    $log[] = ['info', "Nom : $nom | Email : $email | Message : " . substr($message, 0, 30)];

    if (mb_strlen($nom) < 2)                        $log[] = ['err', '❌ Nom trop court'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $log[] = ['err', '❌ Email invalide'];
    if (mb_strlen($message) < 10)                   $log[] = ['err', '❌ Message trop court'];

    // Test envoi direct
    if (empty(array_filter($log, fn($l) => $l[0] === 'err'))) {
        $ok = mail(
            'gilles@gpcoaching.fr',
            '[TEST FORM] Message de ' . $nom,
            "Nom     : $nom\nEmail   : $email\nMessage : $message",
            "From: mail_php@gpcoaching.fr\r\nCc: gp2coach@gmail.com\r\nContent-Type: text/plain; charset=UTF-8\r\n"
        );
        $log[] = $ok
            ? ['ok',  '✓ mail() retourne true — email envoyé !']
            : ['err', '❌ mail() retourne false'];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Test formulaire</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 2rem;
            background: #F7F3ED;
        }

        .box {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
        }

        h1 {
            color: #1B2B4B;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }

        .step {
            padding: .65rem 1rem;
            border-radius: 6px;
            margin-bottom: .5rem;
            font-size: .85rem;
        }

        .ok {
            background: rgba(58, 125, 68, .1);
            border: 1px solid rgba(58, 125, 68, .3);
            color: #2d6b37;
        }

        .err {
            background: rgba(180, 64, 64, .1);
            border: 1px solid rgba(180, 64, 64, .3);
            color: #b44040;
        }

        .info {
            background: rgba(27, 43, 75, .07);
            border: 1px solid rgba(27, 43, 75, .15);
            color: #1B2B4B;
        }

        input,
        textarea {
            width: 100%;
            padding: .6rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: inherit;
            font-size: .9rem;
            margin-top: .25rem;
        }

        label {
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #666;
            display: block;
            margin-top: 1rem;
        }

        button {
            margin-top: 1.25rem;
            background: #1B2B4B;
            color: #fff;
            border: none;
            padding: .75rem 2rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: .9rem;
        }

        .warn {
            background: rgba(180, 64, 64, .08);
            border: 1px solid rgba(180, 64, 64, .2);
            color: #b44040;
            padding: .75rem 1rem;
            border-radius: 6px;
            margin-top: 1.5rem;
            font-size: .82rem;
        }
    </style>
</head>

<body>
    <div class="box">
        <h1>🔍 Diagnostic formulaire contact</h1>

        <?php foreach ($log as [$type, $msg]): ?>
            <div class="step <?= $type ?>"><?= htmlspecialchars($msg) ?></div>
        <?php endforeach; ?>

        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
            <label>Nom</label>
            <input type="text" name="nom" value="Test Prénom" />
            <label>Email</label>
            <input type="email" name="email" value="gp2coach@gmail.com" />
            <label>Message</label>
            <textarea name="message">Ceci est un message de test du formulaire.</textarea>
            <button type="submit">Tester l'envoi</button>
        </form>

        <div class="warn">⚠️ Supprime ce fichier après le test :<br>
            <code>git rm test-form.php && git commit -m "remove test-form" && git push</code>
        </div>
    </div>
</body>

</html>