<?php
session_start();
require_once __DIR__ . '/includes/db.php';

define('BASE_URL', '../');

if (!empty($_SESSION['gp_admin_logged'])) {
    header('Location: index.php'); exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $pass  = $_POST['password'] ?? '';

    if ($login && $pass) {
        $stmt = db()->prepare('SELECT * FROM gp_admin WHERE login = ? LIMIT 1');
        $stmt->execute([$login]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($pass, $admin['password'])) {
            session_regenerate_id(true);
            $_SESSION['gp_admin_logged'] = true;
            $_SESSION['gp_admin_user']   = $admin['login'];
            $_SESSION['csrf_token']      = bin2hex(random_bytes(32));
            header('Location: index.php'); exit;
        }
    }
    $error = 'Identifiants incorrects.';
    // Pause anti-brute-force
    sleep(1);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Connexion — GP Coaching Admin</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=Jost:wght@300;400;500;600&display=swap');
    :root {
      --navy: #1B2B4B; --gold: #B8905A; --gold-l: #CEAA78;
      --bg: #F7F3ED; --card: #fff; --ink: #1E1A14; --ink-60: rgba(30,26,20,.6);
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Jost', sans-serif;
      background: var(--navy);
      min-height: 100vh;
      display: flex; align-items: center; justify-content: center;
      -webkit-font-smoothing: antialiased;
    }
    .login-box {
      background: var(--card); border-radius: 8px;
      padding: 2.5rem 2rem; width: 100%; max-width: 380px;
      box-shadow: 0 24px 64px rgba(0,0,0,.25);
    }
    .login-brand { text-align: center; margin-bottom: 2rem; }
    .login-brand-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.4rem; color: var(--navy); display: block;
    }
    .login-brand-sub {
      font-size: .65rem; letter-spacing: .14em; text-transform: uppercase;
      color: var(--gold); margin-top: .25rem; display: block;
    }
    .login-badge {
      display: inline-block; margin-top: .75rem;
      background: rgba(27,43,75,.07); color: var(--ink-60);
      font-size: .65rem; letter-spacing: .1em; text-transform: uppercase;
      padding: .25rem .7rem; border-radius: 2px;
    }
    .field { margin-bottom: 1rem; }
    .field label {
      display: block; font-size: .7rem; font-weight: 600;
      letter-spacing: .1em; text-transform: uppercase;
      color: var(--ink-60); margin-bottom: .35rem;
    }
    .field input {
      width: 100%; background: var(--bg);
      border: 1px solid rgba(30,26,20,.15); border-radius: 6px;
      padding: .7rem .9rem; font-family: 'Jost', sans-serif;
      font-size: .9rem; color: var(--ink);
      transition: border-color .2s, box-shadow .2s;
    }
    .field input:focus {
      outline: none; border-color: var(--navy);
      box-shadow: 0 0 0 3px rgba(27,43,75,.08);
    }
    .btn-login {
      width: 100%; background: var(--navy); color: #fff;
      border: none; border-radius: 6px; padding: .85rem;
      font-family: 'Jost', sans-serif; font-size: .78rem;
      font-weight: 600; letter-spacing: .1em; text-transform: uppercase;
      cursor: pointer; margin-top: .5rem;
      transition: background .2s;
    }
    .btn-login:hover { background: #243659; }
    .error {
      background: rgba(180,64,64,.08); border: 1px solid rgba(180,64,64,.25);
      color: #b44040; border-radius: 6px;
      padding: .65rem .9rem; font-size: .82rem; margin-bottom: 1rem;
    }
    .login-footer {
      text-align: center; margin-top: 1.5rem;
      font-size: .72rem; color: var(--ink-60);
    }
  </style>
</head>
<body>
<div class="login-box">
  <div class="login-brand">
    <span class="login-brand-name">GP Coaching</span>
    <span class="login-brand-sub">Grandir avec Perspective</span>
    <span class="login-badge">Administration</span>
  </div>

  <?php if ($error): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" novalidate>
    <div class="field">
      <label for="login">Identifiant</label>
      <input type="text" id="login" name="login"
             value="<?= htmlspecialchars($_POST['login'] ?? '') ?>"
             autocomplete="username" required autofocus/>
    </div>
    <div class="field">
      <label for="password">Mot de passe</label>
      <input type="password" id="password" name="password"
             autocomplete="current-password" required/>
    </div>
    <button type="submit" class="btn-login">Se connecter</button>
  </form>

  <div class="login-footer">
    Accès réservé à l'administrateur
  </div>
</div>
</body>
</html>
