<?php include 'includes/header.php'; ?>

<!-- ══ MON PARCOURS ══ -->
<section class="approach-hero" style="padding-bottom:var(--section-py)">
  <div class="approach-grid container">

    <div class="approach-photo fade-up">
      <img
        src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=600&q=80&auto=format&fit=crop&crop=faces"
        alt="Gilles, fondateur de GP Coaching"
      />
    </div>

    <div class="approach-content">
      <span class="label fade-up">Mon parcours</span>
      <h2 class="fade-up delay-1">Mon Parcours,<br>ma <em>conviction</em></h2>
      <div class="divider fade-up delay-2"></div>
      <p class="fade-up delay-2">
        Fort de mon parcours professionnel et personnel, j'accompagne des personnes confrontées à des périodes de transition, de décision ou de transformation.
      </p>
      <p class="fade-up delay-2" style="margin-top:1rem">
        J'ai constaté que la véritable clé du changement ne réside pas dans les compétences, mais dans la clarté, la confiance et la capacité d'agir avec cohérence.
      </p>
      <p class="fade-up delay-3" style="margin-top:1rem">
        C'est cette conviction qui m'anime aujourd'hui en mission de coach.
      </p>
    </div>

  </div>
</section>


<!-- ══ MA PHILOSOPHIE ══ -->
<section style="background:var(--dark-1);padding:var(--section-py) var(--gutter)">
  <div class="container text-center">
    <span class="label fade-up">Ma philosophie</span>
    <h2 class="fade-up delay-1">Quatre piliers pour avancer</h2>
    <div class="philo-grid">
      <div class="philo-step fade-up">
        <div class="philo-icon">🔍</div>
        <h4>Comprendre avant d'agir</h4>
        <p>Prendre le temps de comprendre la situation avant de s'engager dans l'action.</p>
      </div>
      <div class="philo-step fade-up delay-1">
        <div class="philo-icon">📋</div>
        <h4>Clarifier avant de décider</h4>
        <p>Mettre de l'ordre dans ses pensées pour décider avec discernement.</p>
      </div>
      <div class="philo-step fade-up delay-2">
        <div class="philo-icon">🎯</div>
        <h4>Aligner pour avancer</h4>
        <p>Mettre en cohérence ses valeurs, ses objectifs et ses actions.</p>
      </div>
      <div class="philo-step fade-up delay-3">
        <div class="philo-icon">🌱</div>
        <h4>Évoluer pour durer</h4>
        <p>S'inscrire dans une croissance durable et un développement continu.</p>
      </div>
    </div>
  </div>
</section>


<!-- ══ MISSION / CONVICTION ══ -->
<section style="background:var(--black);padding:var(--section-py) var(--gutter)">
  <div class="container">
    <div class="mission-grid">
      <div class="mission-card fade-up">
        <h4>Ma Mission</h4>
        <h3 style="color:var(--ivory);margin-bottom:1rem">Accompagner les personnes dans les périodes clés</h3>
        <p>Accompagner les personnes, les entrepreneurs, les dirigeants et les organisations dans les périodes de transition, de développement ou de transformation pour leur permettre de retrouver clarté, équilibre et capacité d'action durable.</p>
      </div>
      <div class="mission-card fade-up delay-1">
        <h4>Ma Conviction</h4>
        <h3 style="color:var(--ivory);margin-bottom:1rem">Les ressources sont déjà en vous</h3>
        <p>Chaque personne possède déjà en elle les ressources nécessaires pour évoluer. Mon rôle est de créer les conditions qui lui permettront de les révéler et de les mobiliser.</p>
      </div>
    </div>
  </div>
</section>


<!-- ══ MÉTHODE GPACE ══ -->
<section class="methode-section">
  <div class="container text-center">
    <span class="label fade-up">La méthode GP</span>
    <h2 class="methode-title fade-up delay-1">
      <em>Grandir</em> avec <em>Perspective</em>
    </h2>
    <p class="section-intro fade-up delay-2">
      Parce que le coaching consiste à changer de regard sur une situation pour faire émerger de nouvelles possibilités.
    </p>

    <div class="methode-steps">
      <?php
      $etapes = [
        ['G', 'Grandir par la connaissance de soi',  'Comprendre qui vous êtes.'],
        ['P', 'Prendre conscience',                   'Porter un regard nouveau sur votre situation.'],
        ['A', 'Agir',                                 'Passer de la réflexion à l\'action.'],
        ['C', 'Consolider',                           'Ancrer les progrès et ajuster.'],
        ['E', 'Évoluer',                              'Devenir autonome et prêt pour vos futurs défis.'],
      ];
      foreach ($etapes as $i => [$lettre, $titre, $sous]) :
        $delay = $i > 0 ? " delay-{$i}" : '';
      ?>
      <div class="methode-step fade-up<?= $delay ?>">
        <div class="methode-dot"><?= $lettre ?></div>
        <?php if ($i < 4) : ?><div class="methode-arrow">→</div><?php endif; ?>
        <h4><?= htmlspecialchars($titre) ?></h4>
        <p class="methode-step-sub"><?= htmlspecialchars($sous) ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ══ CTA ══ -->
<section class="final-cta">
  <div class="final-cta-inner fade-up">
    <span class="label">Envie d'en savoir plus ?</span>
    <h2>Parlons de votre situation</h2>
    <div class="divider center"></div>
    <p>Un premier échange de 30 minutes pour comprendre où vous en êtes et voir comment je peux vous accompagner.</p>
    <div class="final-cta-actions">
      <button class="btn btn-gold" onclick="openBooking()">Prendre rendez-vous</button>
      <a class="btn btn-outline" href="accompagnement.php">Voir les accompagnements</a>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
