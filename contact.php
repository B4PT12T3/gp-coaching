<?php
session_start();

// Générer token CSRF
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// ── TRAITEMENT DU FORMULAIRE ──────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // CSRF
  if (
    empty($_POST['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
  ) {
    $_SESSION['form_error'] = 'Token de sécurité invalide. Veuillez réessayer.';
    header('Location: contact.php');
    exit;
  }

  // Honeypot anti-spam
  if (!empty($_POST['website'])) {
    header('Location: contact.php?sent=1');
    exit;
  }

  // Rate limiting (1 envoi / 60s par IP)
  $ip_key = 'last_contact_' . md5($_SERVER['REMOTE_ADDR']);
  if (isset($_SESSION[$ip_key]) && (time() - $_SESSION[$ip_key]) < 60) {
    $_SESSION['form_error'] = 'Merci de patienter avant de renvoyer un message.';
    header('Location: contact.php');
    exit;
  }

  // Validation
  $nom       = trim(strip_tags($_POST['nom']       ?? ''));
  $email     = trim(strip_tags($_POST['email']     ?? ''));
  $telephone = trim(strip_tags($_POST['telephone'] ?? ''));
  $message   = trim(strip_tags($_POST['message']   ?? ''));

  $errors = [];
  if (mb_strlen($nom) < 2)                        $errors[] = 'Veuillez indiquer votre nom et prénom.';
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "L'adresse email n'est pas valide.";
  if (mb_strlen($message) < 10)                   $errors[] = 'Votre message est trop court.';

  if (!empty($errors)) {
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_data']   = compact('nom', 'email', 'telephone', 'message');
    header('Location: contact.php#contact-form');
    exit;
  }

  // Envoi email
  $sujet  = '[GP Coaching] Nouveau message de ' . $nom;
  $corps  = "Nouveau message reçu depuis le site GP Coaching\n";
  $corps .= str_repeat('-', 50) . "\n\n";
  $corps .= "Nom       : $nom\n";
  $corps .= "Email     : $email\n";
  $corps .= "Telephone : " . ($telephone ?: 'Non renseigné') . "\n\n";
  $corps .= "Message :\n$message\n\n";
  $corps .= str_repeat('-', 50) . "\n";
  $corps .= "Envoyé le : " . date('d/m/Y à H:i') . "\n";

  $headers  = "From: GP Coaching <mail_php@gpcoaching.fr>\r\n";
  $headers .= "Reply-To: $nom <$email>\r\n";
  $headers .= "Cc: gp2coach@gmail.com\r\n";
  $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
  $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

  $envoye = mail('gilles@gpcoaching.fr', $sujet, $corps, $headers);

  if ($envoye) {
    $_SESSION[$ip_key] = time();
    unset($_SESSION['form_data'], $_SESSION['form_errors']);
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    header('Location: contact.php?sent=1');
  } else {
    $_SESSION['form_error'] = 'Une erreur est survenue. Veuillez réessayer ou me contacter par téléphone.';
    header('Location: contact.php#contact-form');
  }
  exit;
}

// ── LECTURE SESSION après redirect ────────────────────────────────────
$sent        = isset($_GET['sent']);
$form_errors = $_SESSION['form_errors'] ?? [];
$form_error  = $_SESSION['form_error']  ?? '';
$form_data   = $_SESSION['form_data']   ?? [];
unset($_SESSION['form_errors'], $_SESSION['form_error'], $_SESSION['form_data']);

// BDD chargée uniquement pour l'affichage (après le traitement POST)
require_once 'includes/content.php';

function old(string $key, array $data): string
{
  return htmlspecialchars($data[$key] ?? '');
}
?>
<?php include 'includes/header.php'; ?>

<section class="contact-hero">
  <span class="section-heading fade-up"><em>Échangeons</em></span>
  <p class="section-intro fade-up delay-2">
    <?= c('contact', 'intro_texte', 'Vous avez une question ou souhaitez échanger sur vos besoins ? Je vous réponds personnellement.') ?>
  </p>
</section>

<section class="contact-layout">
  <div class="contact-grid">

    <!-- GAUCHE : coordonnées + photo -->
    <div>
      <div class="contact-info fade-up">
        <h2>Mes coordonnées</h2>
        <div class="contact-info-list">

          <div class="contact-info-item hv-border">
            <div class="contact-info-icon"><i data-lucide="phone"></i></div>
            <div class="contact-info-text">
              <strong>
                <a href="tel:+33<?= preg_replace('/\D/', '', c('contact', 'telephone', '0672724444')) ?>" style="color:inherit">
                  <?= c('contact', 'telephone', '06 72 72 44 44') ?>
                </a>
              </strong>
              <span>Du lundi au vendredi, 9h – 18h</span>
            </div>
          </div>

          <div class="contact-info-item hv-border">
            <div class="contact-info-icon"><i data-lucide="mail"></i></div>
            <div class="contact-info-text">
              <strong>
                <a href="mailto:<?= c('contact', 'email', 'gilles@gpcoaching.fr') ?>" style="color:inherit">
                  <?= c('contact', 'email', 'gilles@gpcoaching.fr') ?>
                </a>
              </strong>
              <span>Réponse dans les plus brefs délais</span>
            </div>
          </div>

          <div class="contact-info-item hv-border">
            <div class="contact-info-icon"><i data-lucide="map-pin"></i></div>
            <div class="contact-info-text">
              <strong><?= c('contact', 'adresse', 'Béthune et sa région') ?></strong>
              <span><?= c('contact', 'adresse_detail', 'Hauts-de-France') ?></span>
            </div>
          </div>

          <div class="contact-info-item hv-border">
            <div class="contact-info-icon"><i data-lucide="video"></i></div>
            <div class="contact-info-text">
              <strong><?= c('contact', 'modalites', 'En présentiel et en visioconférence') ?></strong>
              <span><?= c('contact', 'modalites_detail', 'Partout en France') ?></span>
            </div>
          </div>

        </div>
      </div>

      <div class="contact-photo hv-image fade-up delay-1">
        <?= img(
          'contact',
          'cabinet_photo',
          'https://images.unsplash.com/photo-1556761175-4b46a572b786?w=700&q=80&auto=format&fit=crop',
          'Cabinet GP Coaching'
        ) ?>
      </div>
    </div>

    <!-- DROITE : formulaire + RDV -->
    <div>

      <?php if ($sent): ?>
        <div class="form-success fade-up">
          <div class="form-success-icon">✓</div>
          <h3>Message envoyé !</h3>
          <p>Merci pour votre message. Je vous répondrai dans les plus brefs délais, généralement sous 24h.</p>
          <a class="btn btn-outline" href="index.php" style="margin-top:1.5rem">Retour à l'accueil</a>
        </div>

      <?php else: ?>

        <div class="contact-form-wrap fade-up delay-1" id="contact-form">
          <h2>Écrivez-moi</h2>

          <?php if ($form_error): ?>
            <div class="form-alert form-alert-error"><?= htmlspecialchars($form_error) ?></div>
          <?php endif; ?>

          <?php if (!empty($form_errors)): ?>
            <div class="form-alert form-alert-error">
              <ul><?php foreach ($form_errors as $e): ?>
                  <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form class="contact-form" method="POST"
            action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" novalidate>
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
            <!-- Honeypot -->
            <input type="text" name="website" tabindex="-1"
              autocomplete="off" style="display:none" aria-hidden="true" />

            <div class="form-group">
              <label for="nom">Nom et prénom <span style="color:var(--gold)">*</span></label>
              <input type="text" id="nom" name="nom"
                placeholder="Votre nom complet"
                value="<?= old('nom', $form_data) ?>"
                required autocomplete="name" />
            </div>
            <div class="form-group">
              <label for="email_contact">Email <span style="color:var(--gold)">*</span></label>
              <input type="email" id="email_contact" name="email"
                placeholder="votre@email.com"
                value="<?= old('email', $form_data) ?>"
                required autocomplete="email" />
            </div>
            <div class="form-group">
              <label for="telephone">Téléphone</label>
              <input type="tel" id="telephone" name="telephone"
                placeholder="06 XX XX XX XX"
                value="<?= old('telephone', $form_data) ?>"
                autocomplete="tel" />
            </div>
            <div class="form-group">
              <label for="message">Votre message <span style="color:var(--gold)">*</span></label>
              <textarea id="message" name="message"
                placeholder="Décrivez votre situation ou votre besoin..."
                required><?= old('message', $form_data) ?></textarea>
            </div>
            <button class="btn btn-navy" type="submit"
              style="width:100%;justify-content:center">
              Envoyer
            </button>
          </form>
        </div>

      <?php endif; ?>

      <div class="rdv-box fade-up delay-2">
        <h3>Réservez votre premier rendez-vous</h3>
        <p>Un premier échange pour faire le point sur votre situation et vos objectifs.</p>
        <a class="btn btn-gold" href="contact.php">Prendre rendez-vous</a>
      </div>

    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>