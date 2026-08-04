<?php
// test-contact-minimal.php
// Formulaire contact sans aucune dépendance
// ⚠️ SUPPRIMER APRÈS TEST
session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$resultat = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $resultat .= "✓ POST reçu\n";
    $resultat .= "CSRF POST    : " . ($_POST['csrf_token'] ?? 'ABSENT') . "\n";
    $resultat .= "CSRF SESSION : " . ($_SESSION['csrf_token'] ?? 'ABSENT') . "\n";

    // CSRF check
    if (empty($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $resultat .= "❌ CSRF invalide\n";
    } else {
        $resultat .= "✓ CSRF valide\n";

        $nom     = trim($_POST['nom']     ?? '');
        $email   = trim($_POST['email']   ?? '');
        $message = trim($_POST['message'] ?? '');
        $resultat .= "Nom: $nom | Email: $email | Message: $message\n";

        // Envoi mail
        $headers  = "From: mail_php@gpcoaching.fr\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Cc: gp2coach@gmail.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        $ok = mail('gilles@gpcoaching.fr', 'Test contact - ' . $nom, $message, $headers);
        $resultat .= $ok ? "✓ mail() = TRUE\n" : "❌ mail() = FALSE\n";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Test contact minimal</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 2rem;
            background: #F7F3ED;
        }

        .box {
            max-width: 500px;
            margin: 0 auto;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
        }

        pre {
            background: #f0f0f0;
            padding: 1rem;
            border-radius: 6px;
            font-size: .85rem;
            white-space: pre-wrap;
        }

        input,
        textarea {
            width: 100%;
            padding: .6rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: inherit;
            margin-top: .25rem;
            box-sizing: border-box;
        }

        label {
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            display: block;
            margin-top: 1rem;
        }

        button {
            margin-top: 1rem;
            background: #1B2B4B;
            color: #fff;
            border: none;
            padding: .75rem 2rem;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="box">
        <h2>Test formulaire minimal</h2>

        <?php if ($resultat): ?>
            <pre><?= htmlspecialchars($resultat) ?></pre>
        <?php endif; ?>

        <form method="POST" action="test-contact-minimal.php">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
            <label>Nom</label>
            <input type="text" name="nom" value="Test Nom" required />
            <label>Email</label>
            <input type="email" name="email" value="gp2coach@gmail.com" required />
            <label>Message</label>
            <textarea name="message" required>Message de test minimal.</textarea>
            <button type="submit">Envoyer</button>
        </form>

        <p style="margin-top:1.5rem;font-size:.75rem;color:#999">
            ⚠️ Supprimer après test : <code>git rm test-contact-minimal.php</code>
        </p>
    </div>
</body>

</html>