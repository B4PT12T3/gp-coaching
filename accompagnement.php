<?php
require_once 'includes/content.php';
include 'includes/header.php';

$univers = [

  1 => [
    'id'      => 'equilibre',
    'couleur' => '#667264',
    'logo'    => 'E_D_P2.png',
    'label'   => 'Univers 1',
    'titre'   => content('accompagnement', 'u1_titre',    'Équilibre & Développement personnel'),
    'accroche' => content('accompagnement', 'u1_accroche', 'Retrouver son équilibre, se reconnecter à l\'essentiel'),
    'sous_parcours' => [
      [
        'icon'     => 'sprout',
        'titre'    => content('accompagnement', 'u1_titre',    'Parcours Équilibre'),
        'accroche' => content('accompagnement', 'u1_accroche', 'Retrouver son équilibre, se reconnecter à l\'essentiel'),
        'image'    => content('accompagnement', 'u1_image',    'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=1200&q=80'),
        'points'   => [
          content('accompagnement', 'u1_p1', 'Retrouver confiance en soi'),
          content('accompagnement', 'u1_p2', 'Équilibrer vie personnelle et vie professionnelle'),
          content('accompagnement', 'u1_p3', 'Traverser les périodes de transition'),
          content('accompagnement', 'u1_p4', 'Retrouver du sens et de la clarté'),
        ],
      ],
    ],
  ],

  2 => [
    'id'      => 'leadership',
    'couleur' => '#142739',
    'logo'    => 'L_P2.png',
    'label'   => 'Univers 2',
    'titre'   => content('accompagnement', 'u2_titre',    'Leadership & Performance'),
    'accroche' => content('accompagnement', 'u2_accroche', 'Développer votre leadership et votre impact'),
    'sous_parcours' => [
      [
        'icon'     => 'goal',
        'titre'    => content('accompagnement', 'u2_1_titre',    'Parcours Leadership'),
        'accroche' => content('accompagnement', 'u2_1_accroche', 'Piloter avec clarté, décider et performer'),
        'image'    => content('accompagnement', 'u2_1_image',    'https://images.unsplash.com/photo-1500835556837-99ac94a94552?w=1200&q=80'),
        'points'   => [
          content('accompagnement', 'u2_1_p1', 'Clarifier votre vision et vos objectifs'),
          content('accompagnement', 'u2_1_p2', 'Prendre des décisions alignées et efficaces'),
          content('accompagnement', 'u2_1_p3', 'Passer à l\'action avec impact'),
          content('accompagnement', 'u2_1_p4', 'Développer votre performance et celle de votre équipe'),
        ],
      ],
      [
        'icon'     => 'shield',
        'titre'    => content('accompagnement', 'u2_2_titre',    'Parcours Posture'),
        'accroche' => content('accompagnement', 'u2_2_accroche', 'Affirmer votre posture, inspirer et avoir de l\'impact'),
        'image'    => content('accompagnement', 'u2_2_image',    'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1200&q=80'),
        'points'   => [
          content('accompagnement', 'u2_2_p1', 'Affirmer votre leadership'),
          content('accompagnement', 'u2_2_p2', 'Inspirer confiance et motivation'),
          content('accompagnement', 'u2_2_p3', 'Renforcer votre présence et votre influence'),
          content('accompagnement', 'u2_2_p4', 'Développer votre impact au quotidien'),
        ],
      ],
    ],
  ],

  3 => [
    'id'      => 'signature',
    'couleur' => '#C17501',
    'logo'    => 'Signature_1.png',
    'label'   => 'Univers 3',
    'titre'   => content('accompagnement', 'u3_titre',    'Signature'),
    'accroche' => content('accompagnement', 'u3_accroche', 'Accompagnements premium et sur-mesure'),
    'sous_parcours' => [
      [
        'icon'     => 'trending-up',
        'titre'    => content('accompagnement', 'u3_1_titre',    'Parcours Trajectoire'),
        'accroche' => content('accompagnement', 'u3_1_accroche', 'Structurer, développer et piloter votre croissance'),
        'image'    => content('accompagnement', 'u3_1_image',    'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=1200&q=80'),
        'points'   => [
          content('accompagnement', 'u3_1_p1', 'Structurer votre activité et votre organisation'),
          content('accompagnement', 'u3_1_p2', 'Développer votre entreprise de façon maîtrisée'),
          content('accompagnement', 'u3_1_p3', 'Piloter vos résultats et vos équipes'),
          content('accompagnement', 'u3_1_p4', 'Préparer la croissance et l\'avenir'),
        ],
      ],
      [
        'icon'     => 'tree-pine',
        'titre'    => content('accompagnement', 'u3_2_titre',    'Parcours Alignement'),
        'accroche' => content('accompagnement', 'u3_2_accroche', 'Se reconnecter, se réaliser et se révéler'),
        'image'    => content('accompagnement', 'u3_2_image',    'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1200&q=80'),
        'points'   => [
          content('accompagnement', 'u3_2_p1', 'Se reconnecter à soi et à ses valeurs'),
          content('accompagnement', 'u3_2_p2', 'Se réaligner avec sa vision et ses priorités'),
          content('accompagnement', 'u3_2_p3', 'Se révéler et agir avec cohérence'),
          content('accompagnement', 'u3_2_p4', 'Dédié aux entreprises entre 3 et 5 ans d\'activité'),
        ],
      ],
    ],
  ],
];
?>

<!-- ══ HERO ══ -->
<section class="accompagner-hero">
  <span class="section-heading fade-up">Comment je peux vous <em>accompagner</em></span>
  <p class="section-intro fade-up delay-2">Vous aider à avancer avec clarté, confiance et impact.</p>
</section>

<!-- ══ SECTION INTRO ══ -->
<section class="univers-section-full" id="intro" style="background:var(--bg-card)">
  <div class="container">
    <div class="usf-grid img-left fade-up">

      <div class="usf-img hv-image">
        <img src="<?= content('accompagnement', 'intro_image', 'https://images.unsplash.com/photo-1543269664-56d93c1b41a6?w=1200&q=80') ?>"
          alt="Accompagnement GP Coaching" />
      </div>

      <div class="usf-content">
        <div class="usf-sous-header">
          <i data-lucide="compass"
            style="stroke:var(--gold);width:22px;height:22px;flex-shrink:0"></i>
          <span class="usf-sous-label" style="color:var(--gold)">
            <?= c('accompagnement', 'intro_label', 'Une approche sur-mesure') ?>
          </span>
        </div>
        <h3><?= c('accompagnement', 'intro_titre', 'Chaque accompagnement commence par une écoute approfondie de votre situation') ?></h3>
        <ul class="usf-points">
          <?php foreach (
            [
              c('accompagnement', 'intro_p1', 'Un premier échange gratuit pour cerner vos besoins et vos objectifs'),
              c('accompagnement', 'intro_p2', 'Un parcours construit autour de vous, de votre rythme et de votre contexte'),
              c('accompagnement', 'intro_p3', 'Des séances en présentiel ou en visioconférence, partout en France'),
              c('accompagnement', 'intro_p4', 'Un suivi régulier pour ancrer les progrès dans la durée'),
            ] as $point
          ): ?>
            <li>
              <i data-lucide="check" style="stroke:var(--gold)"></i>
              <?= $point ?>
            </li>
          <?php endforeach; ?>
        </ul>
        <button class="btn usf-cta" onclick="openBooking()"
          style="background:var(--gold);color:#fff">
          <?= c('accompagnement', 'intro_cta', 'Réserver un premier échange') ?>
        </button>
      </div>

    </div>
  </div>
</section>

<!-- ══ SECTIONS UNIVERS ══ -->
<?php foreach ($univers as $n => $u):
  $bg = $n % 2 === 0 ? 'var(--bg-alt)' : 'var(--bg-base)';
?>
  <section class="univers-section-full" id="<?= $u['id'] ?>"
    style="background:<?= $bg ?>">
    <div class="container">

      <!-- Header univers -->
      <div class="usf-header fade-up">
        <img src="<?= BASE_URL ?>assets/images/<?= $u['logo'] ?>"
          alt="<?= htmlspecialchars($u['label']) ?>"
          style="width:64px;height:64px;object-fit:contain" />
        <div>
          <span class="usf-label" style="color:<?= $u['couleur'] ?>">
            <?= htmlspecialchars($u['label']) ?>
          </span>
          <h2 class="usf-titre"><?= htmlspecialchars($u['titre']) ?></h2>
          <p class="usf-accroche"><em><?= htmlspecialchars($u['accroche']) ?></em></p>
        </div>
      </div>

      <!-- Sous-parcours -->
      <?php foreach ($u['sous_parcours'] as $i => $sp):
        $layout = $i % 2 === 0 ? 'img-left' : 'img-right';
        $delay  = $i > 0 ? ' delay-1' : '';
      ?>
        <div class="usf-grid <?= $layout ?> <?= $i > 0 ? 'usf-sous-sep' : '' ?> fade-up<?= $delay ?>">

          <div class="usf-img hv-image">
            <img src="<?= htmlspecialchars($sp['image']) ?>"
              alt="<?= htmlspecialchars($sp['titre']) ?>" />
          </div>

          <div class="usf-content">
            <div class="usf-sous-header">
              <i data-lucide="<?= $sp['icon'] ?>"
                style="stroke:<?= $u['couleur'] ?>;width:22px;height:22px;flex-shrink:0"></i>
              <span class="usf-sous-label" style="color:<?= $u['couleur'] ?>">
                <?= htmlspecialchars($sp['titre']) ?>
              </span>
            </div>
            <h3><?= htmlspecialchars($sp['accroche']) ?></h3>
            <ul class="usf-points">
              <?php foreach ($sp['points'] as $point): ?>
                <li>
                  <i data-lucide="check" style="stroke:<?= $u['couleur'] ?>"></i>
                  <?= htmlspecialchars($point) ?>
                </li>
              <?php endforeach; ?>
            </ul>
            <button class="btn usf-cta" onclick="openBooking()"
              style="background:<?= $u['couleur'] ?>;color:#fff">
              Commencer ce parcours
            </button>
          </div>

        </div>
      <?php endforeach; ?>

    </div>
  </section>
<?php endforeach; ?>

<!-- ══ PARCOURS ADAPTÉ ══ -->
<section class="parcours-section">
  <div class="container">
    <span class="section-heading fade-up">Un parcours adapté à vos besoins</span>
    <div class="parcours-steps" style="margin-top:3.5rem">
      <?php
      $etapes = [
        ['message-circle', 'Premier échange'],
        ['search',         'Diagnostic personnalisé'],
        ['map',            'Choix du parcours adapté'],
        ['target',         'Accompagnement sur-mesure'],
        ['trending-up',    'Bilan & suivi dans la durée'],
      ];
      foreach ($etapes as $i => [$icon, $label]):
        $delay = $i > 0 ? " delay-{$i}" : '';
      ?>
        <div class="parcours-step fade-up<?= $delay ?>">
          <div class="parcours-dot hv-glow">
            <i data-lucide="<?= $icon ?>"></i>
          </div>
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
    <span class="section-heading">Un premier échange pour faire le point</span>
    <div class="divider center"></div>
    <p>Sur votre situation et vos objectifs. Je vous réponds personnellement.</p>
    <div class="final-cta-actions">
      <button class="btn btn-navy" onclick="openBooking()">Prendre rendez-vous</button>
      <a class="btn btn-outline" href="contact.php">Me contacter</a>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>