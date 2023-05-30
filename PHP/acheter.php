
<?php
// Connecter à la base de données
$conn = mysqli_connect('localhost', 'root', '', 'myticket');
session_start();

// Vérifier si la connexion a réussi
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer les données soumises dans le formulaire
  $nom = $_POST['Nom_Prenom'];
  $Num_Cart = $_POST['Num_Cart'];
  $CVV = $_POST['CVV'];
  $Date_Exp = $_POST['Date_Exp'];

  // Vérifier si les informations de paiement existent dans la table "banque"
  $stmt = $conn->prepare('SELECT * FROM banque WHERE Num_Cart = ? AND CVV = ? AND Date_Exp = ? AND Nom_Prenom = ?');
  $stmt->bind_param('isss', $Num_Cart, $CVV, $Date_Exp, $nom);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // Les informations de paiement existent dans la table "banque", afficher un message de succès
    echo "<script>alert('les infos de paiement sont valides');</script>";

    // Stocker le numéro de carte de crédit dans une variable de session
    $_SESSION['Num_Cart'] = $Num_Cart;

    // Récupérer les autres paramètres de l'URL
    $ID_Event = $_GET['ID_Event'];
    $id_organisateur = $_GET['id_organisateur'];
    $prix = $_GET['prix'];

    // Rediriger vers la page facture.php avec les paramètres de l'URL
    header("Location: facture.php?ID_Event=$ID_Event&id_organisateur=$id_organisateur&prix=$prix");
    exit();
  } else {
    // Les informations de paiement n'existent pas dans la table "banque", afficher un message d'erreur
    echo "<script>alert('Erreur : Les informations de paiement sont incorrectes.');</script>";
  }
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
                            <li><a href="Sportif.php">Sportif</a></li>
                            <li><a href="Culturel.php">Culturel</a></li>
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
        <div class="titre">
          <h2>Veuillez remplir le formulaire suivant :</h2>
        </div>

        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
          <div class="form-group">
            <label for="Num_Cart">Numéro carte de credit <span>*</span></label>
            <input type="number" id="Num_Cart" name="Num_Cart" placeholder="" required>
          </div>
          <div class="form-group">
            <label for="CVV">CVV <span>*</span></label>
            <input type="number" id="CVV" name="CVV" placeholder="" required>
          </div>
          <div class="form-group">
            <label for="Date_Exp">Date d’éxpiration <span>*</span></label>
            <input type="date" id="Date_Exp" name="Date_Exp" placeholder="" required>
          </div>

          <div class="form-group">
            <label for="nom">Nom et prénom <span>*</span></label>
            <input type="text" id="nom" name="Nom_Prenom" placeholder="Le nom de l'événement" required>
          </div>

          <div class="form-group">
            <button type="submit" name="submit">Valider</button>
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
