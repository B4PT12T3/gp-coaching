<?php
session_start();
require_once 'includes/content.php';

if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$sent        = isset($_GET['sent']);
$form_errors = $_SESSION['form_errors'] ?? [];
$form_error  = $_SESSION['form_error']  ?? '';
$form_data   = $_SESSION['form_data']   ?? [];
unset($_SESSION['form_errors'], $_SESSION['form_error'], $_SESSION['form_data']);

function old(string $key, array $data): string
{
  return htmlspecialchars($data[$key] ?? '');
}
?>
<?php include 'includes/header.php'; ?>

<section class="contact-hero">
  <span class="label fade-up">Contact</span>
  <h1 class="fade-up delay-1"><em>Échangeons</em></h1>
  <p class="section-intro fade-up delay-2">
    <?= c('contact', 'intro_texte', 'Vous avez une question ou souhaitez échanger sur vos besoins ? Je vous réponds personnellement.') ?>
  </p>
</section>

<section class="contact-layout">
  <div class="contact-grid">

    <div>
      <div class="contact-info fade-up">
        <h2>Mes coordonnées</h2>
        <div class="contact-info-list">

          <div class="contact-info-item hv-border">
            <div class="contact-info-icon">📞</div>
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
            <div class="contact-info-icon">✉️</div>
            <div class="contact-info-text">
              <strong>
                <a href="mailto:<?= c('contact', 'email', 'GP2coaching@gmail.com') ?>" style="color:inherit">
                  <?= c('contact', 'email', 'GP2coaching@gmail.com') ?>
                </a>
              </strong>
              <span>Réponse sous 24h</span>
            </div>
          </div>

          <div class="contact-info-item hv-border">
            <div class="contact-info-icon">📍</div>
            <div class="contact-info-text">
              <strong><?= c('contact', 'adresse', 'Béthune et sa région') ?></strong>
              <span><?= c('contact', 'adresse_detail', 'Hauts-de-France') ?></span>
            </div>
          </div>

          <div class="contact-info-item hv-border">
            <div class="contact-info-icon">🎥</div>
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
              <ul><?php foreach ($form_errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul>
            </div>
          <?php endif; ?>

          <form class="contact-form" method="POST" action="contact.php" novalidate>
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" />
            <input type="text" name="website" tabindex="-1" autocomplete="off" style="display:none" aria-hidden="true" />

            <div class="form-group">
              <label for="nom">Nom et prénom <span style="color:var(--gold)">*</span></label>
              <input type="text" id="nom" name="nom" placeholder="Votre nom complet" value="<?= old('nom', $form_data) ?>" required autocomplete="name" />
            </div>
            <div class="form-group">
              <label for="email">Email <span style="color:var(--gold)">*</span></label>
              <input type="email" id="email" name="email" placeholder="votre@email.com" value="<?= old('email', $form_data) ?>" required autocomplete="email" />
            </div>
            <div class="form-group">
              <label for="telephone">Téléphone</label>
              <input type="tel" id="telephone" name="telephone" placeholder="06 XX XX XX XX" value="<?= old('telephone', $form_data) ?>" autocomplete="tel" />
            </div>
            <div class="form-group">
              <label for="message">Votre message <span style="color:var(--gold)">*</span></label>
              <textarea id="message" name="message" placeholder="Décrivez votre situation ou votre besoin..." required><?= old('message', $form_data) ?></textarea>
            </div>
            <button class="btn btn-navy" type="submit" style="width:100%;justify-content:center">Envoyer</button>
          </form>
        </div>
      <?php endif; ?>

      <div class="rdv-box fade-up delay-2">
        <h3>Réservez votre premier rendez-vous</h3>
        <p>Un premier échange pour faire le point sur votre situation et vos objectifs.</p>
        <button class="btn btn-gold" onclick="openBooking()">Prendre rendez-vous</button>
      </div>
    </div>

  </div>
</section>

<?php include 'includes/footer.php'; ?>