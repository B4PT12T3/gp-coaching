<?php
require_once 'includes/content.php';
include 'includes/header.php';
?>

<!-- ══ HERO ══ -->
<section class="hero">
  <div class="hero-img">
    <?= img('accueil', 'hero_image',
        'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1600&q=80&auto=format&fit=crop',
        'GP Coaching — coaching de carrière') ?>
  </div>
  <div class="hero-content">
    <span class="label fade-up">Coaching de carrière &amp; de vie</span>
    <h1 class="fade-up delay-1">
      <?= nl2br(c('accueil', 'hero_titre', "Retrouvez la clarté pour avancer avec confiance.")) ?>
    </h1>
    <p class="hero-sub fade-up delay-2">
      <?= c('accueil', 'hero_sous_titre', "J'accompagne les personnes, les entrepreneurs, les dirigeants et les organisations à retrouver la clarté, de l'équilibre et la capacité d'agir durablement.") ?>
    </p>
    <div class="hero-cta fade-up delay-3">
      <button class="btn btn-gold" onclick="openBooking()">Prendre rendez-vous</button>
    </div>
  </div>
</section>

<!-- ══ CITATION ══ -->
<div class="quote-band">
  <p class="quote-text fade-up">
    <?= c('accueil', 'citation_texte', 'Construire des personnes solides pour développer des projets durables.') ?>
  </p>
  <p class="quote-author fade-up delay-1">
    <?= c('accueil', 'citation_auteur', '— Gilles, fondateur de GP Coaching') ?>
  </p>
</div>

<!-- ══ TROIS UNIVERS ══ -->
<section class="univers-section">
  <div class="container">
    <div class="text-center">
      <span class="label fade-up">Trois univers d'accompagnement</span>
      <h2 class="fade-up delay-1">Comment puis-je vous aider ?</h2>
    </div>
    <div class="univers-grid">

      <?php
      $univers = [
        1 => ['icon' => '🌿', 'icon_cls' => 'icon-sage', 'link' => 'equilibre',   'delay' => ''],
        2 => ['icon' => '👥', 'icon_cls' => 'icon-dark', 'link' => 'leadership',  'delay' => ' delay-1'],
        3 => ['icon' => '⭐', 'icon_cls' => 'icon-gold', 'link' => 'signature',   'delay' => ' delay-2'],
      ];
      foreach ($univers as $n => $u):
        $default_imgs = [
          1 => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=700&q=80',
          2 => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=700&q=80',
          3 => 'https://images.unsplash.com/photo-1502780402662-acc01917949e?w=700&q=80',
        ];
      ?>
      <div class="univers-card hv-lift fade-up<?= $u['delay'] ?>">
        <div class="univers-card-img hv-image">
          <?= img('accueil', "univers{$n}_image", $default_imgs[$n], c('accueil', "univers{$n}_titre", "Univers $n")) ?>
        </div>
        <div class="univers-card-body">
          <div class="univers-icon <?= $u['icon_cls'] ?> hv-glow"><?= $u['icon'] ?></div>
          <h3><?= c('accueil', "univers{$n}_titre", "Univers $n") ?></h3>
          <p><?= c('accueil', "univers{$n}_texte", '') ?></p>
          <a class="link-arrow" href="accompagnement.php#<?= $u['link'] ?>">En savoir plus <span>→</span></a>
        </div>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>

<!-- ══ POURQUOI GP COACHING ══ -->
<section class="why-section">
  <div class="container">
    <div class="text-center">
      <span class="label fade-up">Pourquoi choisir GP Coaching ?</span>
      <h2 class="fade-up delay-1">Une méthode, des résultats</h2>
    </div>
    <div class="why-grid">
      <div class="why-card hv-lift-sm fade-up">
        <div class="why-icon">🤝</div>
        <h4>Approche humaine et personnalisée</h4>
        <p>Chaque accompagnement est unique, construit autour de vous et de vos objectifs spécifiques.</p>
      </div>
      <div class="why-card hv-lift-sm fade-up delay-1">
        <div class="why-icon">📋</div>
        <h4>Méthode structurée et éprouvée</h4>
        <p>La méthode GPACE : un cadre clair pour avancer avec confiance à chaque étape.</p>
      </div>
      <div class="why-card hv-lift-sm fade-up delay-2">
        <div class="why-icon">💚</div>
        <h4>Écoute, exigence et bienveillance</h4>
        <p>Un espace de confiance pour explorer, décider et agir — sans jugement.</p>
      </div>
      <div class="why-card hv-lift-sm fade-up delay-3">
        <div class="why-icon">📈</div>
        <h4>Orientation résultats et développement durable</h4>
        <p>Des transformations concrètes qui s'inscrivent dans la durée, pas des effets ponctuels.</p>
      </div>
    </div>
  </div>
</section>

<!-- ══ CTA FINAL ══ -->
<section class="final-cta">
  <div class="final-cta-inner fade-up">
    <span class="label">Premier échange</span>
    <h2>Prêt·e à retrouver votre clarté ?</h2>
    <div class="divider center"></div>
    <p>Un premier échange pour faire le point sur votre situation et vos objectifs — sans engagement.</p>
    <div class="final-cta-actions">
      <button class="btn btn-navy" onclick="openBooking()">Prendre rendez-vous</button>
      <a class="btn btn-outline" href="approche.php">Découvrir mon approche</a>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
