<?php
// Connexion à la base de données
$conn = mysqli_connect('localhost', 'root', '', 'myticket');

// Vérifier la connexion
if (!$conn) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}
?>
