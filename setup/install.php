<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Installation — GP Coaching Admin</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #F7F3ED;
            color: #1E1A14;
            padding: 2rem;
        }

        .box {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 8px;
            padding: 2rem;
            border: 1px solid rgba(30, 26, 20, .1);
        }

        h1 {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            color: #1B2B4B;
        }

        .step {
            margin-bottom: 1rem;
            padding: .75rem 1rem;
            border-radius: 6px;
            font-size: .9rem;
        }

        .ok {
            background: rgba(58, 125, 68, .1);
            border: 1px solid rgba(58, 125, 68, .25);
            color: #3a7d44;
        }

        .err {
            background: rgba(180, 64, 64, .1);
            border: 1px solid rgba(180, 64, 64, .25);
            color: #b44040;
        }

        .info {
            background: rgba(27, 43, 75, .07);
            border: 1px solid rgba(27, 43, 75, .15);
            color: #1B2B4B;
        }

        .warn {
            background: rgba(184, 144, 90, .12);
            border: 1px solid rgba(184, 144, 90, .3);
            color: #8f6a2e;
        }

        input {
            width: 100%;
            padding: .6rem .9rem;
            border: 1px solid rgba(30, 26, 20, .2);
            border-radius: 6px;
            font-family: inherit;
            font-size: .9rem;
            margin-top: .3rem;
        }

        label {
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: rgba(30, 26, 20, .6);
            display: block;
            margin-top: 1rem;
        }

        button {
            margin-top: 1.5rem;
            background: #1B2B4B;
            color: #fff;
            border: none;
            padding: .8rem 2rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: .85rem;
            font-weight: 600;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        button:hover {
            background: #243659;
        }

        code {
            background: rgba(30, 26, 20, .08);
            padding: .1rem .4rem;
            border-radius: 3px;
            font-size: .85rem;
        }
    </style>
</head>

<body>
    <div class="box">
        <h1>⚙️ Installation GP Coaching Admin</h1>

        <?php
        require_once __DIR__ . '/../admin/includes/db.php';

        // ─────────────────────────────────────────────
        // ÉTAPE 1 : formulaire de création du compte
        // ─────────────────────────────────────────────
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo '<div class="step info">
        Ce script va créer les tables MySQL et le compte administrateur.<br>
        <strong>À supprimer après installation !</strong>
    </div>';
        ?>
            <form method="POST">
                <label>Login administrateur</label>
                <input type="text" name="admin_login" value="admin" required />
                <label>Mot de passe (min. 8 caractères)</label>
                <input type="password" name="admin_pass" required minlength="8" />
                <label>Confirmer le mot de passe</label>
                <input type="password" name="admin_pass2" required minlength="8" />
                <button type="submit">Lancer l'installation</button>
            </form>
        <?php
            echo '</div></body></html>';
            exit;
        }

        // ─────────────────────────────────────────────
        // ÉTAPE 2 : traitement
        // ─────────────────────────────────────────────
        $login = trim($_POST['admin_login'] ?? '');
        $pass  = $_POST['admin_pass']  ?? '';
        $pass2 = $_POST['admin_pass2'] ?? '';

        if (strlen($login) < 3) {
            die('<div class="step err">Login trop court (min. 3 caractères).</div></div></body></html>');
        }
        if (strlen($pass) < 8) {
            die('<div class="step err">Mot de passe trop court (min. 8 caractères).</div></div></body></html>');
        }
        if ($pass !== $pass2) {
            die('<div class="step err">Les mots de passe ne correspondent pas.</div></div></body></html>');
        }

        $pdo = db();

        // ── Créer les tables ──
        try {
            // Table contenu
            $pdo->exec("
        CREATE TABLE IF NOT EXISTS gp_content (
            id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            page       VARCHAR(60)   NOT NULL,
            cle        VARCHAR(100)  NOT NULL,
            valeur     MEDIUMTEXT    NOT NULL DEFAULT '',
            type       ENUM('text','textarea','image') NOT NULL DEFAULT 'text',
            label      VARCHAR(200)  NOT NULL DEFAULT '',
            updated_at TIMESTAMP     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            UNIQUE KEY page_cle (page, cle)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
            echo '<div class="step ok">✓ Table <code>gp_content</code> créée.</div>';

            // Table admin
            $pdo->exec("
        CREATE TABLE IF NOT EXISTS gp_admin (
            id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            login      VARCHAR(80)  NOT NULL UNIQUE,
            password   VARCHAR(255) NOT NULL,
            created_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ");
            echo '<div class="step ok">✓ Table <code>gp_admin</code> créée.</div>';
        } catch (PDOException $e) {
            echo '<div class="step err">Erreur création tables : ' . htmlspecialchars($e->getMessage()) . '</div>';
            echo '</div></body></html>';
            exit;
        }

        // ── Créer le compte admin ──
        try {
            $hash = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 12]);
            $stmt = $pdo->prepare("
        INSERT INTO gp_admin (login, password)
        VALUES (?, ?)
        ON DUPLICATE KEY UPDATE password = VALUES(password)
    ");
            $stmt->execute([$login, $hash]);
            echo '<div class="step ok">✓ Compte admin <strong>' . htmlspecialchars($login) . '</strong> créé.</div>';
        } catch (PDOException $e) {
            echo '<div class="step err">Erreur création admin : ' . htmlspecialchars($e->getMessage()) . '</div>';
            echo '</div></body></html>';
            exit;
        }

        // ── Insérer le contenu par défaut ──
        $defaults = [
            // PAGE ACCUEIL
            ['accueil', 'hero_titre',       'Retrouvez la clarté pour avancer avec confiance.',          'textarea', 'Titre hero'],
            ['accueil', 'hero_sous_titre',  "J'accompagne les personnes, les entrepreneurs, les dirigeants et les organisations à retrouver la clarté, de l'équilibre et la capacité d'agir durablement.", 'textarea', 'Sous-titre hero'],
            ['accueil', 'hero_image',       'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1600&q=80', 'image', 'Image hero'],
            ['accueil', 'citation_texte',   'Construire des personnes solides pour développer des projets durables.', 'textarea', 'Citation'],
            ['accueil', 'citation_auteur',  '— Gilles', 'text', 'Auteur citation'],
            ['accueil', 'univers1_titre',   'Équilibre & Développement personnel', 'text', 'Univers 1 - Titre'],
            ['accueil', 'univers1_texte',   'Retrouver confiance, sérénité et équilibre pour avancer en harmonie avec soi-même et donner le meilleur de soi.', 'textarea', 'Univers 1 - Texte'],
            ['accueil', 'univers1_image',   'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=700&q=80', 'image', 'Univers 1 - Image'],
            ['accueil', 'univers2_titre',   'Leadership & Performance', 'text', 'Univers 2 - Titre'],
            ['accueil', 'univers2_texte',   'Développer votre leadership, renforcer votre posture et améliorer votre performance pour atteindre durablement vos objectifs professionnels.', 'textarea', 'Univers 2 - Texte'],
            ['accueil', 'univers2_image',   'https://images.unsplash.com/photo-1552664730-d307ca884978?w=700&q=80', 'image', 'Univers 2 - Image'],
            ['accueil', 'univers3_titre',   'Signature', 'text', 'Univers 3 - Titre'],
            ['accueil', 'univers3_texte',   'Des accompagnements premium et sur-mesure pour les entrepreneurs, dirigeants et professionnels qui souhaitent construire l\'avenir avec vision, sens et impact.', 'textarea', 'Univers 3 - Texte'],
            ['accueil', 'univers3_image',   'https://images.unsplash.com/photo-1502780402662-acc01917949e?w=700&q=80', 'image', 'Univers 3 - Image'],

            // PAGE APPROCHE
            ['approche', 'coach_photo',     'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=600&q=80', 'image', 'Photo du coach'],
            ['approche', 'parcours_titre',  'Mon Parcours, ma conviction', 'text', 'Titre parcours'],
            ['approche', 'parcours_p1',     "Fort de mon parcours professionnel et personnel, j'accompagne des personnes confrontées à des périodes de transition, de décision ou de transformation.", 'textarea', 'Paragraphe 1'],
            ['approche', 'parcours_p2',     "J'ai constaté que la véritable clé du changement ne réside pas dans les compétences, mais dans la clarté, la confiance et la capacité d'agir avec cohérence.", 'textarea', 'Paragraphe 2'],
            ['approche', 'parcours_p3',     "C'est cette conviction qui m'anime aujourd'hui en mission de coach.", 'textarea', 'Paragraphe 3'],
            ['approche', 'mission_texte',   "Accompagner les personnes, les entrepreneurs, les dirigeants et les organisations dans les périodes de transition, de développement ou de transformation pour leur permettre de retrouver clarté, équilibre et capacité d'action durable.", 'textarea', 'Texte Mission'],
            ['approche', 'conviction_texte', 'Chaque personne possède déjà en elle les ressources nécessaires pour évoluer. Mon rôle est de créer les conditions qui lui permettront de les révéler et de les mobiliser.', 'textarea', 'Texte Conviction'],

            // PAGE ACCOMPAGNEMENT
            ['accompagnement', 's1_titre',  'Équilibre & Développement personnel', 'text', 'Service 1 - Titre'],
            ['accompagnement', 's1_p1',     'Retrouver confiance, sérénité et équilibre pour avancer en harmonie avec soi-même et donner le meilleur de soi.', 'textarea', 'Service 1 - Paragraphe 1'],
            ['accompagnement', 's1_p2',     "Que vous traversiez une période de doute, de transition ou que vous souhaitiez simplement mieux vous connaître pour mieux agir, cet accompagnement vous offre le cadre et les outils pour retrouver votre équilibre intérieur.", 'textarea', 'Service 1 - Paragraphe 2'],
            ['accompagnement', 's1_image',  'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80', 'image', 'Service 1 - Image'],
            ['accompagnement', 's2_titre',  'Leadership & Performance', 'text', 'Service 2 - Titre'],
            ['accompagnement', 's2_p1',     'Développer votre leadership, renforcer votre posture et améliorer votre performance pour atteindre durablement vos objectifs professionnels.', 'textarea', 'Service 2 - Paragraphe 1'],
            ['accompagnement', 's2_p2',     'Pour les managers, cadres et dirigeants qui souhaitent affirmer leur leadership, mieux piloter leurs équipes et aligner leurs actions avec leur vision stratégique.', 'textarea', 'Service 2 - Paragraphe 2'],
            ['accompagnement', 's2_image',  'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80', 'image', 'Service 2 - Image'],
            ['accompagnement', 's3_titre',  'Signature', 'text', 'Service 3 - Titre'],
            ['accompagnement', 's3_p1',     "Des accompagnements premium et sur-mesure pour les entrepreneurs, dirigeants et professionnels qui souhaitent construire l'avenir avec vision, sens et impact.", 'textarea', 'Service 3 - Paragraphe 1'],
            ['accompagnement', 's3_p2',     "Le programme Signature est un accompagnement exclusif conçu pour ceux qui veulent aller au fond des choses. Il combine coaching individuel intensif, outils de développement avancés et un suivi de proximité sur la durée.", 'textarea', 'Service 3 - Paragraphe 2'],
            ['accompagnement', 's3_image',  'https://images.unsplash.com/photo-1502780402662-acc01917949e?w=800&q=80', 'image', 'Service 3 - Image'],

            // PAGE CONTACT
            ['contact', 'telephone',        '06 72 72 44 44', 'text', 'Téléphone'],
            ['contact', 'email',            'GP2coaching@gmail.com', 'text', 'Email'],
            ['contact', 'adresse',          'Béthune et sa région', 'text', 'Adresse'],
            ['contact', 'adresse_detail',   'Hauts-de-France', 'text', 'Détail adresse'],
            ['contact', 'modalites',        'En présentiel et en visioconférence', 'text', 'Modalités'],
            ['contact', 'modalites_detail', 'Partout en France', 'text', 'Détail modalités'],
            ['contact', 'cabinet_photo',    'https://images.unsplash.com/photo-1556761175-4b46a572b786?w=700&q=80', 'image', 'Photo cabinet'],
            ['contact', 'intro_texte',      'Vous avez une question ou souhaitez échanger sur vos besoins ? Je vous réponds personnellement.', 'textarea', 'Texte intro contact'],
        ];

        $stmt = $pdo->prepare("
    INSERT IGNORE INTO gp_content (page, cle, valeur, type, label)
    VALUES (?, ?, ?, ?, ?)
");

        $count = 0;
        foreach ($defaults as $row) {
            $stmt->execute($row);
            $count++;
        }
        echo '<div class="step ok">✓ ' . $count . ' entrées de contenu par défaut insérées.</div>';

        echo '
<div class="step warn" style="margin-top:1.5rem">
  <strong>⚠ Installation terminée !</strong><br><br>
  1. Supprime ou protège ce fichier : <code>setup/install.php</code><br>
  2. Connecte-toi : <a href="../admin/login.php">→ Accéder au panel admin</a>
</div>';
        ?>

    </div>
</body>

</html>