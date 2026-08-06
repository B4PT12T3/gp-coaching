<?php include 'includes/header.php'; ?>

<!-- ══ HERO ══ -->
<section class="accompagner-hero">
  <span class="label fade-up">Trois univers, un objectif commun</span>
  <h1 class="fade-up delay-1">Comment je peux<br>vous <em>accompagner</em></h1>
  <p class="section-intro fade-up delay-2">Vous aider à avancer avec clarté, confiance et impact.</p>
</section>


<!-- ══ SERVICES DÉTAILLÉS ══ -->
<section class="services-full" style="padding:0 var(--gutter) var(--section-py)">

  <?php
  $services = [
    [
      'id'      => 'equilibre',
      'univers' => '01',
      'icon'    => '<i data-lucide="leaf"></i>',
      'icon_cls' => 'icon-sage',
      'titre'   => 'Équilibre &amp; Développement personnel',
      'p1'      => 'Retrouver confiance, sérénité et équilibre pour avancer en harmonie avec soi-même et donner le meilleur de soi.',
      'p2'      => 'Que vous traversiez une période de doute, de transition ou que vous souhaitiez simplement mieux vous connaître pour mieux agir, cet accompagnement vous offre le cadre et les outils pour retrouver votre équilibre intérieur.',
      'cta'     => 'Commencer l\'accompagnement',
      'img'     => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
      'img_alt' => 'Équilibre et sérénité',
      'layout'  => 'img-right',
    ],
    [
      'id'      => 'leadership',
      'univers' => '02',
      'icon'    => '<i data-lucide="users"></i>',
      'icon_cls' => 'icon-dark',
      'titre'   => 'Leadership &amp; Performance',
      'p1'      => 'Développer votre leadership, renforcer votre posture et améliorer votre performance pour atteindre durablement vos objectifs professionnels.',
      'p2'      => 'Pour les managers, cadres et dirigeants qui souhaitent affirmer leur leadership, mieux piloter leurs équipes et aligner leurs actions avec leur vision stratégique.',
      'cta'     => 'Discuter de vos besoins',
      'img'     => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80&auto=format&fit=crop',
      'img_alt' => 'Leadership et performance',
      'layout'  => 'img-left',
    ],
    [
      'id'      => 'signature',
      'univers' => '03',
      'icon'    => '<i data-lucide="sparkles"></i>',
      'icon_cls' => 'icon-gold',
      'titre'   => 'Signature',
      'p1'      => 'Des accompagnements premium et sur-mesure pour les entrepreneurs, dirigeants et professionnels qui souhaitent construire l\'avenir avec vision, sens et impact.',
      'p2'      => 'Le programme Signature est un accompagnement exclusif conçu pour ceux qui veulent aller au fond des choses. Il combine coaching individuel intensif, outils de développement avancés et un suivi de proximité sur la durée.',
      'cta'     => 'Réserver un entretien',
      'img'     => 'https://images.unsplash.com/photo-1502780402662-acc01917949e?w=800&q=80&auto=format&fit=crop',
      'img_alt' => 'Accompagnement Signature',
      'layout'  => 'img-right',
    ],
  ];

  foreach ($services as $i => $s) :
    $delay_img  = $s['layout'] === 'img-right' ? 'delay-1' : '';
    $delay_txt  = $s['layout'] === 'img-left'  ? 'delay-1' : '';
  ?>
    <div class="service-full-card <?= $s['layout'] ?>" id="<?= $s['id'] ?>">

      <?php if ($s['layout'] === 'img-left') : ?>
        <div class="service-img hv-image fade-up <?= $delay_img ?>">
          <img src="<?= $s['img'] ?>" alt="<?= htmlspecialchars($s['img_alt']) ?>" />
        </div>
      <?php endif; ?>

      <div class="service-content fade-up <?= $delay_txt ?>">
        <div class="service-icon-large <?= $s['icon_cls'] ?>"><?= $s['icon'] ?></div>
        <span class="label">UNIVERS <?= $s['univers'] ?></span>
        <h2><?= $s['titre'] ?></h2>
        <div class="divider"></div>
        <p><?= $s['p1'] ?></p>
        <p style="margin-top:1rem"><?= $s['p2'] ?></p>
        <a class="btn btn-gold" style="margin-top:2rem" href="contact.php">
          <?= htmlspecialchars($s['cta']) ?>
        </a>
      </div>

      <?php if ($s['layout'] === 'img-right') : ?>
        <div class="service-img hv-image fade-up <?= $delay_img ?>">
          <img src="<?= $s['img'] ?>" alt="<?= htmlspecialchars($s['img_alt']) ?>" />
        </div>
      <?php endif; ?>

    </div>
  <?php endforeach; ?>

</section>


<!-- ══ PARCOURS ══ -->
<section class="parcours-section">
  <div class="container">
    <div class="text-center">
      <span class="label fade-up">Un parcours adapté à vos besoins</span>
      <h2 class="fade-up delay-1">Comment ça se passe ?</h2>
    </div>
    <div class="parcours-steps" style="margin-top:3.5rem">
      <?php
      $etapes = [
        ['<i data-lucide="message-circle"></i>', 'Premier échange'],
        ['<i data-lucide="search"></i>', 'Diagnostic personnalisé'],
        ['<i data-lucide="map"></i>', 'Choix du parcours adapté'],
        ['<i data-lucide="target"></i>', 'Accompagnement sur-mesure'],
        ['<i data-lucide="trending-up"></i>', 'Bilan &amp; suivi dans la durée'],
      ];
      foreach ($etapes as $i => [$icon, $label]) :
        $delay = $i > 0 ? " delay-{$i}" : '';
      ?>
        <div class="parcours-step fade-up<?= $delay ?>">
          <div class="parcours-dot hv-glow"><?= $icon ?></div>
          <h4><?= $label ?></h4>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ══ VALEURS ══ -->
<div class="valeurs-bar">
  <div class="valeurs-grid">
    <div class="valeur-item hv-lift-sm fade-up">
      <div class="valeur-icon"><i data-lucide="lock"></i></div>
      <h4>Confidentialité</h4>
      <p>Vos échanges sont traités en toute confidentialité.</p>
    </div>
    <div class="valeur-item hv-lift-sm fade-up delay-1">
      <div class="valeur-icon"><i data-lucide="heart"></i></div>
      <h4>Écoute &amp; Bienveillance</h4>
      <p>Une écoute active et sans jugement à chaque séance.</p>
    </div>
    <div class="valeur-item hv-lift-sm fade-up delay-2">
      <div class="valeur-icon"><i data-lucide="handshake"></i></div>
      <h4>Engagement</h4>
      <p>Un accompagnement personnalisé et engagé à vos côtés.</p>
    </div>
  </div>
</div>


<!-- ══ CTA ══ -->
<section class="final-cta">
  <div class="final-cta-inner fade-up">
    <span class="label">Réservez votre premier rendez-vous</span>
    <h2>Un premier échange pour faire le point</h2>
    <div class="divider center"></div>
    <p>Sur votre situation et vos objectifs. Je vous réponds personnellement.</p>
    <div class="final-cta-actions">
      <a class="btn btn-gold" href="contact.php">Prendre rendez-vous</a>
      <a class="btn btn-outline" href="contact.php">Me contacter</a>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>