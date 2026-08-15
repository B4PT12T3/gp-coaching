</div><!-- /content -->
</div><!-- /main -->

</body>

</html>

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