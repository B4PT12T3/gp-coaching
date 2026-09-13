</div><!-- /content -->
</div><!-- /main -->

</body>

</html>

<!-- ══ BANNIÈRE COOKIES ══ -->
<?php if (basename($_SERVER['PHP_SELF']) !== 'rgpd.php'): ?>
  <div id="cookie-banner" style="
  display:none;
  position:fixed; bottom:0; left:0; right:0; z-index:9998;
  background:var(--navy);
  border-top:1px solid rgba(255,255,255,.1);
  padding:1rem 2rem;
  display:flex; align-items:center; justify-content:space-between;
  gap:1.5rem; flex-wrap:wrap;
  font-family:var(--sans); font-size:.82rem;
  box-shadow:0 -4px 24px rgba(0,0,0,.2);">
    <p style="color:rgba(255,255,255,.75);margin:0;flex:1;min-width:200px">
      Ce site utilise Google Analytics pour mesurer son audience.
      <a href="/rgpd.php" style="color:var(--gold);text-decoration:underline">
        En savoir plus
      </a>
    </p>
    <div style="display:flex;gap:.75rem;flex-shrink:0">
      <button onclick="acceptCookies()" style="
      background:var(--gold);color:#fff;border:none;
      padding:.5rem 1.25rem;border-radius:4px;
      font-family:var(--sans);font-size:.78rem;font-weight:600;
      letter-spacing:.06em;text-transform:uppercase;cursor:pointer;
      transition:background .2s"
        onmouseover="this.style.background='#CEAA78'"
        onmouseout="this.style.background='var(--gold)'">
        Accepter
      </button>
      <button onclick="refuseCookies()" style="
      background:transparent;color:rgba(255,255,255,.5);
      border:1px solid rgba(255,255,255,.2);
      padding:.5rem 1.25rem;border-radius:4px;
      font-family:var(--sans);font-size:.78rem;font-weight:600;
      letter-spacing:.06em;text-transform:uppercase;cursor:pointer;
      transition:all .2s"
        onmouseover="this.style.color='#fff';this.style.borderColor='rgba(255,255,255,.5)'"
        onmouseout="this.style.color='rgba(255,255,255,.5)';this.style.borderColor='rgba(255,255,255,.2)'">
        Refuser
      </button>
    </div>
  </div>

  <script>
    (function() {
      var consent = localStorage.getItem('cookies_consent');
      if (!consent) {
        var banner = document.getElementById('cookie-banner');
        if (banner) banner.style.display = 'flex';
      }
    })();

    function acceptCookies() {
      localStorage.setItem('cookies_consent', 'accepted');
      document.getElementById('cookie-banner').style.display = 'none';
      loadGA();
    }

    function refuseCookies() {
      localStorage.setItem('cookies_consent', 'refused');
      document.getElementById('cookie-banner').style.display = 'none';
    }
  </script>
<?php endif; ?>

<script>
  /* ── ADMIN : Upload image + preview + soumission unique ── */
  document.addEventListener('DOMContentLoaded', () => {

    // Pour chaque zone d'upload
    document.querySelectorAll('.img-upload-zone input[type="file"]').forEach(input => {
      input.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;

        const zone = this.closest('.img-upload-zone');
        const field = this.closest('.field');
        const label = zone.querySelector('label');

        // Prévisualisation immédiate
        const reader = new FileReader();
        reader.onload = e => {
          // Chercher ou créer l'img-preview dans le champ parent
          let preview = field.querySelector('.img-preview');
          if (!preview) {
            preview = document.createElement('img');
            preview.className = 'img-preview';
            field.insertBefore(preview, zone);
          }
          preview.src = e.target.result;
          preview.style.display = 'block';

          // Mettre à jour le label
          label.innerHTML = '<strong>' + file.name + '</strong> sélectionné ✓<br>' +
            '<span style="font-size:.72rem;color:var(--ink-60)">Cliquez Enregistrer pour valider</span>';
        };
        reader.readAsDataURL(file);

        // Vider le champ URL si un fichier est sélectionné
        const urlField = field.querySelector('input[type="url"]');
        if (urlField) urlField.value = '';
      });
    });

    // Empêcher la soumission par Entrée dans les champs texte
    // (évite les soumissions accidentelles sans image)
    document.querySelectorAll('.contact-form, form').forEach(form => {
      form.addEventListener('keydown', e => {
        if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA' && e.target.type !== 'submit') {
          e.preventDefault();
        }
      });
    });

    // Preview sur URL externe (quand on colle une URL)
    document.querySelectorAll('input[type="url"]').forEach(urlInput => {
      urlInput.addEventListener('blur', function() {
        const url = this.value.trim();
        if (!url) return;
        const field = this.closest('.field').parentElement;
        let preview = field.querySelector('.img-preview');
        if (!preview) {
          preview = document.createElement('img');
          preview.className = 'img-preview';
          field.insertBefore(preview, field.querySelector('.img-upload-zone'));
        }
        preview.src = url;
        preview.style.display = 'block';
        preview.onerror = () => {
          preview.style.display = 'none';
        };
      });
    });

  });
</script>