<?php
require_once 'includes/content.php';
include 'includes/header.php';

// ── DONNÉES DES UNIVERS ──────────────────────────────────────────────
$univers = [

  1 => [
    'id'       => 'equilibre',
    'couleur'  => '#667264',
    'icon'     => 'sprout',
    'logo'     => 'E_D_P2.png',
    'label'    => 'Univers 1',
    'titre'    => content('accompagnement', 'u1_titre',   'Équilibre & Développement personnel'),
    'accroche' => content('accompagnement', 'u1_accroche', 'Retrouver son équilibre, se reconnecter à l\'essentiel'),
    'image'    => content('accompagnement', 'u1_image',   'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80'),
    'points'   => [],
    'sous_parcours' => [
      [
        'icon'     => 'sprout',
        'titre'    => content('accompagnement', 'u1_titre', 'Parcours Équilibre'),
        'accroche' => content('accompagnement', 'u1_accroche', 'Retrouver son équilibre, se reconnecter à l\'essentiel'),
        'image'    => content('accompagnement', 'u1_image', 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80'),
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
    'id'       => 'leadership',
    'couleur'  => '#142739',
    'icon'     => 'compass',
    'logo'     => 'L_P2.png',
    'label'    => 'Univers 2',
    'titre'    => content('accompagnement', 'u2_titre',   'Leadership & Performance'),
    'accroche' => content('accompagnement', 'u2_accroche', 'Développer votre leadership et votre impact'),
    'image'    => content('accompagnement', 'u2_image',   'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80'),
    'points'   => [],
    'sous_parcours' => [
      [
        'id'       => 'leadership-parcours',
        'icon'     => 'goal',
        'titre'    => content('accompagnement', 'u2_1_titre',   'Parcours Leadership'),
        'accroche' => content('accompagnement', 'u2_1_accroche', 'Piloter avec clarté, décider et performer'),
        'image'    => content('accompagnement', 'u2_1_image',   'https://images.unsplash.com/photo-1500835556837-99ac94a94552?w=800&q=80'),
        'points'   => [
          content('accompagnement', 'u2_1_p1', 'Clarifier votre vision et vos objectifs'),
          content('accompagnement', 'u2_1_p2', 'Prendre des décisions alignées et efficaces'),
          content('accompagnement', 'u2_1_p3', 'Passer à l\'action avec impact'),
          content('accompagnement', 'u2_1_p4', 'Développer votre performance et celle de votre équipe'),
        ],
      ],
      [
        'id'       => 'posture',
        'icon'     => 'shield',
        'titre'    => content('accompagnement', 'u2_2_titre',   'Parcours Posture'),
        'accroche' => content('accompagnement', 'u2_2_accroche', 'Affirmer votre posture, inspirer et avoir de l\'impact'),
        'image'    => content('accompagnement', 'u2_2_image',   'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80'),
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
    'id'       => 'signature',
    'couleur'  => '#C17501',
    'icon'     => 'diamond',
    'logo'     => 'Signature_1.png',
    'label'    => 'Univers 3',
    'titre'    => content('accompagnement', 'u3_titre',   'Signature'),
    'accroche' => content('accompagnement', 'u3_accroche', 'Accompagnements premium et sur-mesure'),
    'image'    => content('accompagnement', 'u3_image',   'https://images.unsplash.com/photo-1502780402662-acc01917949e?w=800&q=80'),
    'points'   => [],
    'sous_parcours' => [
      [
        'id'       => 'trajectoire',
        'icon'     => 'trending-up',
        'titre'    => content('accompagnement', 'u3_1_titre',   'Parcours Trajectoire'),
        'accroche' => content('accompagnement', 'u3_1_accroche', 'Structurer, développer et piloter votre croissance'),
        'image'    => content('accompagnement', 'u3_1_image',   'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800&q=80'),
        'points'   => [
          content('accompagnement', 'u3_1_p1', 'Structurer votre activité et votre organisation'),
          content('accompagnement', 'u3_1_p2', 'Développer votre entreprise de façon maîtrisée'),
          content('accompagnement', 'u3_1_p3', 'Piloter vos résultats et vos équipes'),
          content('accompagnement', 'u3_1_p4', 'Préparer la croissance et l\'avenir'),
        ],
      ],
      [
        'id'       => 'alignement',
        'icon'     => 'tree-pine',
        'titre'    => content('accompagnement', 'u3_2_titre',   'Parcours Alignement'),
        'accroche' => content('accompagnement', 'u3_2_accroche', 'Se reconnecter, se réaliser et se révéler'),
        'image'    => content('accompagnement', 'u3_2_image',   'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80'),
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

<!-- ══ ACCORDÉONS ══ -->
<section class="univers-accordeon-section">
  <div class="container">

    <?php foreach ($univers as $n => $u): ?>
      <div class="ua-item fade-up" id="<?= $u['id'] ?>" data-index="<?= $n ?>">

        <!-- ── HEADER accordéon ── -->
        <button class="ua-header" onclick="toggleUnivers(<?= $n ?>)"
          style="--u-color: <?= $u['couleur'] ?>">
          <div class="ua-header-left">
            <div class="ua-icon">
              <img src="<?= BASE_URL ?>assets/images/<?= $u['logo'] ?>"
                alt="<?= htmlspecialchars($u['titre']) ?>"
                style="width:52px;height:52px;object-fit:contain;display:block" />
            </div>
            <div class="ua-header-text">
              <span class="ua-label"><?= htmlspecialchars($u['label']) ?></span>
              <span class="ua-titre"><?= htmlspecialchars($u['titre']) ?></span>
              <span class="ua-accroche"><?= htmlspecialchars($u['accroche']) ?></span>
            </div>
          </div>
          <div class="ua-chevron">
            <i data-lucide="chevron-down"></i>
          </div>
        </button>

        <!-- ── BODY accordéon ── -->
        <div class="ua-body" id="ua-body-<?= $n ?>">
          <div class="ua-body-inner">

            <?php if (empty($u['sous_parcours'])): ?>
              <!-- Univers simple (pas de sous-parcours) -->
              <div class="ua-parcours" style="--p-color: <?= $u['couleur'] ?>">
                <div class="ua-parcours-img hv-image">
                  <img src="<?= htmlspecialchars($u['image']) ?>"
                    alt="<?= htmlspecialchars($u['titre']) ?>" />
                </div>
                <div class="ua-parcours-content">
                  <h3><?= htmlspecialchars($u['accroche']) ?></h3>
                  <ul class="ua-points">
                    <?php foreach ($u['points'] as $point): ?>
                      <li>
                        <i data-lucide="check" style="stroke:<?= $u['couleur'] ?>"></i>
                        <?= htmlspecialchars($point) ?>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                  <a class="btn ua-cta" style="background:<?= $u['couleur'] ?>;color:#fff"
                    onclick="openBooking()" href="#">
                    Commencer ce parcours
                  </a>
                </div>
              </div>

            <?php else: ?>
              <!-- Univers avec sous-parcours -->
              <?php foreach ($u['sous_parcours'] as $i => $sp): ?>
                <div class="ua-parcours ua-sous-parcours <?= $i > 0 ? 'ua-sous-separator' : '' ?>"
                  style="--p-color: <?= $u['couleur'] ?>">
                  <div class="ua-parcours-img hv-image">
                    <img src="<?= htmlspecialchars($sp['image']) ?>"
                      alt="<?= htmlspecialchars($sp['titre']) ?>" />
                  </div>
                  <div class="ua-parcours-content">
                    <div class="ua-sous-header">
                      <div class="ua-sous-icon" style="background:<?= $u['couleur'] ?>1a; border:1px solid <?= $u['couleur'] ?>44">
                        <i data-lucide="<?= $sp['icon'] ?>" style="stroke:<?= $u['couleur'] ?>"></i>
                      </div>
                      <div>
                        <div class="ua-sous-label" style="color:<?= $u['couleur'] ?>">
                          <?= htmlspecialchars($sp['titre']) ?>
                        </div>
                        <h3><?= htmlspecialchars($sp['accroche']) ?></h3>
                      </div>
                    </div>
                    <ul class="ua-points">
                      <?php foreach ($sp['points'] as $point): ?>
                        <li>
                          <i data-lucide="check" style="stroke:<?= $u['couleur'] ?>"></i>
                          <?= htmlspecialchars($point) ?>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                    <a class="btn ua-cta" style="background:<?= $u['couleur'] ?>;color:#fff"
                      onclick="openBooking()" href="#">
                      Commencer ce parcours
                    </a>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>

          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</section>

<!-- ══ PARCOURS ══ -->
<section class="parcours-section">
  <div class="container">
    <div class="text-center">
      <span class="section-heading fade-up">Un parcours adapté à vos besoins</span>
    </div>
    <div class="parcours-steps" style="margin-top:3.5rem">
      <?php
      $etapes = [
        ['<i data-lucide="message-circle"></i>', 'Premier échange'],
        ['<i data-lucide="search"></i>',         'Diagnostic personnalisé'],
        ['<i data-lucide="map"></i>',             'Choix du parcours adapté'],
        ['<i data-lucide="target"></i>',          'Accompagnement sur-mesure'],
        ['<i data-lucide="trending-up"></i>',     'Bilan &amp; suivi dans la durée'],
      ];
      foreach ($etapes as $i => [$icon, $label]):
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
    <span class="section-heading">Un premier échange pour faire le point</span>
    <div class="divider center"></div>
    <p>Sur votre situation et vos objectifs. Je vous réponds personnellement.</p>
    <div class="final-cta-actions">
      <button class="btn btn-navy" onclick="openBooking()">Prendre rendez-vous</button>
      <a class="btn btn-outline" href="contact.php">Me contacter</a>
    </div>
  </div>
</section>

<script>
  function toggleUnivers(n) {
    const body = document.getElementById('ua-body-' + n);
    const item = body.closest('.ua-item');
    const isOpen = item.classList.contains('open');

    // Fermer tous
    document.querySelectorAll('.ua-item.open').forEach(el => {
      el.classList.remove('open');
      el.querySelector('.ua-body').style.maxHeight = null;
    });

    // Ouvrir si était fermé
    if (!isOpen) {
      item.classList.add('open');
      body.style.maxHeight = body.scrollHeight + 'px';
      // Scroll doux vers l'item
      setTimeout(() => item.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      }), 50);
    }
  }

  // Réinitialiser maxHeight après resize
  window.addEventListener('resize', () => {
    document.querySelectorAll('.ua-item.open .ua-body').forEach(body => {
      body.style.maxHeight = body.scrollHeight + 'px';
    });
  });

  // Init Lucide
  document.addEventListener('DOMContentLoaded', () => {
    if (typeof lucide !== 'undefined') lucide.createIcons();
  });
</script>

<?php include 'includes/footer.php'; ?>