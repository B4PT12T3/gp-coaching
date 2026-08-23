<?php
require_once 'includes/content.php';
include 'includes/header.php';
?>

<section class="rgpd-hero">
    <div class="container">
        <span class="label fade-up">Mentions légales & Confidentialité</span>
        <h1 class="fade-up delay-1">
            <?= c('rgpd', 'titre', 'Politique de confidentialité & RGPD') ?>
        </h1>
    </div>
</section>

<section class="rgpd-content">
    <div class="container rgpd-inner fade-up visible">
        <?= content('rgpd', 'contenu', '<p>Contenu à remplir depuis le panel admin.</p>') ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>