<?php
// Connecter à la base de données
$conn = mysqli_connect('localhost', 'root', '', 'myticket');
session_start();
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_SESSION['ID_Event']) && isset($_SESSION['id_organisateur']) && isset($_SESSION['prix'])) {
    $ID_Event = $_SESSION['ID_Event'];
    $id_organisateur = $_SESSION['id_organisateur'];
    $prix = $_SESSION['prix'];
    $query = "SELECT Nom_Org FROM organisateur WHERE ID_Org = '$id_organisateur'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $nom_organisateur = $row['Nom_Org'];

      // Stocker le nom de l'organisateur dans une variable de session
      $_SESSION['organizer_name'] = $nom_organisateur;
    }

    // Faites ce que vous voulez avec les variables $ID_Event et $id_organisateur
    // Par exemple, vous pouvez les stocker dans les variables de session si nécessaire

    // Autres traitements et logique de votre formulaire de paiement ici

    // Requête SQL pour récupérer le solde de la carte
    $stmt = $conn->prepare('SELECT Sold FROM banque WHERE Num_Cart = ?');
    $stmt->bind_param('s', $_SESSION['Num_Cart']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $carte_solde = $row['Sold'];

      // Vérifier si le solde de la carte est suffisant pour effectuer le paiement
      if ($carte_solde >= $prix) {
        // Calculer les montants à déduire et à ajouter
        $montant_admin = $prix * 0.07; // 7% du prix
        $montant_organisateur = $prix * 0.93; // 93% du prix

        // Déduire le montant du prix du solde de la carte
        $nouveau_solde_carte = $carte_solde - $prix;

        // Mettre à jour le solde de la carte dans la table "cartes"
        $stmt = $conn->prepare('UPDATE banque SET Sold = ? WHERE Num_Cart = ?');
        $stmt->bind_param('ds', $nouveau_solde_carte, $_SESSION['Num_Cart']);
        $stmt->execute();

        // Ajouter le montant à l'Admin
        $stmt = $conn->prepare('UPDATE banque SET Sold = Sold + ? WHERE Nom_Prenom = ?');
        $admin_name = 'Admin';
        $stmt->bind_param('ds', $montant_admin, $admin_name);
        $stmt->execute();

        // Récupérer le solde actuel de l'organisateur
        $stmt = $conn->prepare('SELECT Sold FROM banque WHERE Nom_Prenom = ?');
        $stmt->bind_param('s', $_SESSION['organizer_name']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $solde_organisateur = $row['Sold'];

          // Ajouter le montant au solde de l'organisateur
          $nouveau_solde_organisateur = $solde_organisateur + $montant_organisateur;

          // Mettre à jour le solde de l'organisateur dans la table "banque"
          $stmt = $conn->prepare('UPDATE banque SET Sold = ? WHERE Nom_Prenom = ?');
          $stmt->bind_param('ds', $nouveau_solde_organisateur, $_SESSION['organizer_name']);
          $stmt->execute();

          echo"<script>alert('payement effectuer avec succes.');</script>";
          
        }
         $sql = "UPDATE evenements SET quantite = quantite - 1 WHERE ID_Event = $ID_Event";
  
                    // Exécution de la requête SQL
                    if (mysqli_query($conn, $sql)) {
                      echo "<script>alert('le nombre de ticket est mis a jour.');</script>";
                      header("Location: recus.php?ID_Event=$ID_Event&id_organisateur=$id_organisateur&prix=$prix");
                    } else {
                      echo "   Erreur lors de la mise à jour Le Nombre de ticket: " . mysqli_error($conn);
                    }

      } else {
        // Le solde de la carte est insuffisant, afficher un message d'erreur
        echo "<script>alert('Erreur : Le solde de la carte est insuffisant pour effectuer le paiement.');</script>";
      }
    } else {
      // La carte n'est pas trouvée, afficher un message d'erreur
      echo "<script>alert('Erreur : Le solde de la carte est introuvable.');</script>";
    }
  } else {
    // Gérer le cas où les paramètres de session sont manquants
    echo "<script>alert('Erreur : Les paramètres de session sont manquants.');</script>";
  }
}

// Assurez-vous que la variable $prix est définie avant de l'utiliser
if (isset($_GET['prix'])) {
  $prix = $_GET['prix'];
} else {
  $prix = 0;
}
?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription organisateur</title>
  
  <!-- Main Template CSS file -->
  <link rel="stylesheet" href="../styles/styleacheter.css">
  <link rel="stylesheet" href="../styles/fontawesome.css">

  <!-- Script pour vérifier le mot de passe -->
  <script>
    // Ajoutez ici votre script de vérification du mot de passe si nécessaire
  </script>
</head>

<body>
  <!-- Start header -->
  <div class="header">
    <div class="container">
      <div class="top">
        <div class="burg">
          <span></span>
          <span></span>
          <span></span>
        </div>
        <div class="logo">
          <h1>Myticket</h1>
        </div>
        <div class="link">
          <ul>           
            <div class="insc">
              <li><a href="logout.php">Log out</a></li>
              <li><a href="profil.php"><i class="fa-solid fa-user"></i></a></li>
            </div>
            <div class="nav">
              <li><a href="../index1.php">Accueil</a></li>
         
            </div>                       
          </ul>
        </div>              
      </div>
    </div>
  </div>
  <!-- End header -->   

  <section id="Login" class="login">
    <div class="container">
      <div class="login-form">
        <div class="form-group">
          <h1 style="text-align: center; color: var(--header-background-color-);">Votre Facture</h1>
          <div class="montant" style="text-align: center; font-size: 35px; padding: 10px;">
            <i class="fa-solid fa-coins" style="color: #ff9e2d;"></i><p><?php echo $prix; ?> da</p>
          </div>
        </div>

        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
          <div class="form-group">
            <button type="submit" name="submit">Payer</button>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-- End Login Section -->

  <!-- Start Footer -->
   <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4 class="logo">Myticket</h4>
                    <ul>
                        <li>
                            <p>une source de divertissement incontournable. </p>
                        </li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Categorie</h4>
                    <ul>
                        <li><a href="#">sportif</a></li>
                        <li><a href="#">culturel</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>A-Propos</h4>
                    <ul>
                        <li><a href="#">Termes et conditions</a></li>
                        <li><a href="#">myticket_contact@gmail.com</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>follow us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
  <!-- End Footer -->
</body>
</html>
