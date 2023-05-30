<?php
if (isset($_POST['valeur_cachée'])) {
  $identifiantEven = $_POST['valeur_cachée'];

  $con = new mysqli('localhost', 'root', '', 'myticket');

  if ($con->connect_error) {
    echo "<script>alert('Erreur de connexion à la base de données: " . $con->connect_error . "'); window.location.href='My_commande.php';</script>";
  } else {
    // Supprimer les enregistrements liés dans la table "commande"
    $deleteCommandeQuery = "DELETE FROM commande WHERE ID_Event = ?";
    $deleteCommandeStmt = $con->prepare($deleteCommandeQuery);
    $deleteCommandeStmt->bind_param("i", $identifiantEven);
    $deleteCommandeStmt->execute();
    $deleteCommandeStmt->close();

    // Supprimer l'événement de la table "evenements"
    $deleteEvenementQuery = "DELETE FROM evenements WHERE ID_Event = ?";
    $deleteEvenementStmt = $con->prepare($deleteEvenementQuery);
    $deleteEvenementStmt->bind_param("i", $identifiantEven);

    if ($deleteEvenementStmt->execute()) {
      
      echo "<script>window.location.href='Mes_evenement.php';</script>";
    } else {
      echo "<p>Erreur lors de la suppression de la ligne: " . $deleteEvenementStmt->error . "</p>";
    }
    
    $deleteEvenementStmt->close();
  }

  $con->close();
}
?>