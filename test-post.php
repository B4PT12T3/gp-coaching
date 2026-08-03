<?php
// test-post.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "POST reçu : " . htmlspecialchars($_POST['test'] ?? 'vide');
    exit;
}
?>
<form method="POST">
    <input name="test" value="hello" />
    <button type="submit">Envoyer</button>
</form>