<?php
session_start();

// Générer un token CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Récupérer les messages/erreurs de session
$sent        = isset($_GET['sent']);
$form_errors = $_SESSION['form_errors'] ?? [];
$form_error  = $_SESSION['form_error']  ?? '';
$form_data   = $_SESSION['form_data']   ?? [];

// Nettoyer la session après lecture
unset($_SESSION['form_errors'], $_SESSION['form_error'], $_SESSION['form_data']);

// Helper : valeur pré-remplie
function old(string $key, array $data): string {
    return htmlspecialchars($data[$key] ?? '');
}
?>
<?php include 'includes/header.php'; ?>

<!-- ══ HERO ══ -->
<section class="contact-hero">
  <span class="label fade-up">Contact</span>
  <h1 class="fade-up delay-1"><em>Échangeons</em></h1>
  <p class="section-intro fade-up delay-2">
    Vous avez une question ou souhaitez échanger sur vos besoins ?<br>Je vous réponds personnellement.
  </p>
</section>


<!-- ══ LAYOUT CONTACT ══ -->
<section class="contact-layout">
  <div class="contact-grid">

    <!-- GAUCHE : coordonnées + photo -->
    <div>
      <div class="contact-info fade-up">
        <h2>Mes coordonnées</h2>
        <div class="contact-info-list">

          <div class="contact-info-item">
            <div class="contact-info-icon">📞</div>
            <div class="contact-info-text">
              <strong><a href="tel:+33672724444" style="color:inherit">06 72 72 44 44</a></strong>
              <span>Du lundi au vendredi, 9h – 18h</span>
            </div>
          </div>

          <div class="contact-info-item">
            <div class="contact-info-icon">✉️</div>
            <div class="contact-info-text">
              <strong><a href="mailto:GP2coaching@gmail.com" style="color:inherit">GP2coaching@gmail.com</a></strong>
              <span>Réponse sous 24h</span>
            </div>
          </div>

          <div class="contact-info-item">
            <div class="contact-info-icon">📍</div>
            <div class="contact-info-text">
              <strong>Béthune et sa région</strong>
              <span>Hauts-de-France</span>
            </div>
          </div>

          <div class="contact-info-item">
            <div class="contact-info-icon">🎥</div>
            <div class="contact-info-text">
              <strong>En présentiel et en visioconférence</strong>
              <span>Partout en France</span>
            </div>
          </div>

        </div>
      </div>

      <div class="contact-photo fade-up delay-1">
        <img
          src="https://images.unsplash.com/photo-1556761175-4b46a572b786?w=700&q=80&auto=format&fit=crop"
          alt="Cabinet GP Coaching"
        />
      </div>
    </div>

    <!-- DROITE : formulaire + RDV -->
    <div>

      <?php if ($sent) : ?>
        <!-- Message de confirmation -->
        <div class="form-success fade-up">
          <div class="form-success-icon">✓</div>
          <h3>Message envoyé !</h3>
          <p>Merci pour votre message. Je vous répondrai dans les plus brefs délais, généralement sous 24h.</p>
          <a class="btn btn-outline" href="index.php" style="margin-top:1.5rem">Retour à l'accueil</a>
        </div>

      <?php else : ?>

        <div class="contact-form-wrap fade-up delay-1" id="contact-form">
          <h2>Écrivez-moi</h2>

          <!-- Erreurs globales -->
          <?php if ($form_error) : ?>
            <div class="form-alert form-alert-error">
              <?= htmlspecialchars($form_error) ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($form_errors)) : ?>
            <div class="form-alert form-alert-error">
              <ul>
                <?php foreach ($form_errors as $e) : ?>
                  <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form class="contact-form" method="POST" action="includes/contact-handler.php" novalidate>
            <!-- CSRF -->
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>"/>
            <!-- Honeypot anti-spam (caché en CSS) -->
            <input type="text" name="website" tabindex="-1" autocomplete="off" style="display:none" aria-hidden="true"/>

            <div class="form-group">
              <label for="nom">Nom et prénom <span style="color:var(--gold)">*</span></label>
              <input
                type="text" id="nom" name="nom"
                placeholder="Votre nom complet"
                value="<?= old('nom', $form_data) ?>"
                required autocomplete="name"
              />
            </div>

            <div class="form-group">
              <label for="email">Email <span style="color:var(--gold)">*</span></label>
              <input
                type="email" id="email" name="email"
                placeholder="votre@email.com"
                value="<?= old('email', $form_data) ?>"
                required autocomplete="email"
              />
            </div>

            <div class="form-group">
              <label for="telephone">Téléphone</label>
              <input
                type="tel" id="telephone" name="telephone"
                placeholder="06 XX XX XX XX"
                value="<?= old('telephone', $form_data) ?>"
                autocomplete="tel"
              />
            </div>

            <div class="form-group">
              <label for="message">Votre message <span style="color:var(--gold)">*</span></label>
              <textarea
                id="message" name="message"
                placeholder="Décrivez votre situation ou votre besoin..."
                required
              ><?= old('message', $form_data) ?></textarea>
            </div>

            <button class="btn btn-gold" type="submit" style="width:100%;justify-content:center">
              Envoyer
            </button>
          </form>
        </div>

      <?php endif; ?>

      <!-- Box RDV -->
      <div class="rdv-box fade-up delay-2">
        <h3>Réservez votre premier rendez-vous</h3>
        <p>Un premier échange pour faire le point sur votre situation et vos objectifs.</p>
        <button class="btn btn-gold" onclick="openBooking()">Prendre rendez-vous</button>
      </div>

    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
