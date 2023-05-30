<?php
// Connecter à la base de données
$conn = mysqli_connect('localhost', 'root', '', 'myticket');
session_start();

// Vérifier si la connexion a réussi
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if (!isset($_SESSION['user_id'])) {
  // Rediriger l'utilisateur vers la page Signup.php
  header("Location: Signup.php");
  exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_GET['ID_Event']) && isset($_GET['id_organisateur']) && isset($_GET['prix'])) {
    $ID_Event = $_GET['ID_Event'];
    $id_organisateur = $_GET['id_organisateur'];
    $prix = $_GET['prix'];

    // Récupérer le prix de l'événement correspondant à l'ID de l'événement
    $query = "SELECT prix FROM evenements WHERE ID_Event = '$ID_Event'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $prix = $row['prix'];

      // Stocker le prix dans une variable de session
      $_SESSION['prix'] = $prix;
    }

    // Faites ce que vous voulez avec les variables $ID_Event, $id_organisateur et $prix
    // Par exemple, vous pouvez les stocker dans des variables de session si nécessaire
    $_SESSION['ID_Event'] = $ID_Event;
    $_SESSION['id_organisateur'] = $id_organisateur;
  } else {
    // Gérer le cas où les paramètres d'URL sont manquants
  }

  // Récupérer les données soumises dans le formulaire
  $nom = $_POST['Nom_Prénom'];
  $Date_Commande = date('Y-m-d');
  $Num_Cart_id_client = $_POST['Num_Cart_id_client'];

  // Préparer une requête SQL pour insérer les données dans la base de données
  $stmt = $conn->prepare('INSERT INTO commande (ID_Event, Nom_Prénom, Date_Commande, Num_Cart_id_client) VALUES (?, ?, ?, ?)');

  // Exécuter la requête avec les données en paramètres
  $stmt->bind_param('isss', $ID_Event, $nom, $Date_Commande, $Num_Cart_id_client);
  $stmt->execute();

  // Rediriger l'utilisateur vers une page de confirmation
  header("Location: acheter.php?ID_Event=$ID_Event&id_organisateur=$id_organisateur&prix=$prix");
  exit();
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
  <link rel="stylesheet" href="../styles/stylecommande.css">
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
            <label for="Num_Cart_id_client">Numéro de la carte nationale <span>*</span></label>
            <input type="number" id="Num_Cart_id_client" name="Num_Cart_id_client" placeholder="" required>
          </div>

          <div class="form-group">
            <label for="nom">Nom et prénom <span>*</span></label>
            <input type="text" id="nom" name="Nom_Prénom" placeholder="Le nom de l'événement" required>
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
