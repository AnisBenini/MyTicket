<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['Email_Client'];
  $password = $_POST['Password_Client'];

  // Créer une connexion à la base de données
  $con = new mysqli('localhost', 'root', '', 'myticket');

  // Vérifier s'il y a une erreur de connexion
  if ($con->connect_error) {
    // Si une erreur est survenue, afficher un message d'alerte
    echo "<script>alert('Erreur de connexion à la base de données: " . $con->connect_error . "');</script>";
  } else {
    // Vérifier si les identifiants correspondent à ceux de l'administrateur
    if ($email === 'admin@admin.com' && $password === 'Admin123') {
      // Rediriger l'utilisateur vers la page "admin/dashboard.php"
      header('Location: ../admin/dashboard.php');
      exit;
    }

    // Si les identifiants ne correspondent pas à ceux de l'administrateur, continuer avec la logique existante

    // Préparer une requête SQL pour récupérer l'utilisateur correspondant à l'email fourni dans la table "client"
    $stmt_client = $con->prepare("SELECT * FROM client WHERE Email_Client=?");
    $stmt_client->bind_param("s", $email);
    $stmt_client->execute();
    $result_client = $stmt_client->get_result();

    // Si l'email n'est pas trouvé dans la table "client", chercher dans la table "organisateur"
    if ($result_client->num_rows == 0) {
      $stmt_org = $con->prepare("SELECT * FROM organisateur WHERE Email_Org=?");
      $stmt_org->bind_param("s", $email);
      $stmt_org->execute();
      $result_org = $stmt_org->get_result();

      // Si l'email n'est pas trouvé dans la table "organisateur" non plus, afficher un message d'alerte
      if ($result_org->num_rows == 0) {
        echo "<script>alert('Email incorrect!');</script>";
      } else {
        // Si l'email est trouvé dans la table "organisateur", récupérer la première ligne de résultat
        $row_org = $result_org->fetch_assoc();

        // Vérifier si le mot de passe fourni correspond au hash stocké dans la table "organisateur"
        if (password_verify($password, $row_org['Mdp_Org'])) {
          // Si le mot de passe est correct, vérifier si l'organisateur est approuvé
          if ($row_org['Approuve_Org'] == 1) {
            // Si l'organisateur est approuvé, connecter l'utilisateur organisateur
            $_SESSION['user_id'] = $row_org['ID_Org'];
            $_SESSION['username'] = $row_org['Nom_Org'];
            $_SESSION['logged_in'] = true;
            $_SESSION['user_type'] = 'organisateur';
            // ...
            echo "<script>alert('Connexion réussie en tant qu\'organisateur!'); window.location.href='Mes_evenement.php';</script>";

          } else {
            // Si l'organisateur n'est pas approuvé, afficher un message d'alerte
            echo "<script>alert('Votre compte est en attente d\'approbation.');</script>";
          }
        } else {
          // Si le mot de passe est incorrect, afficher un message d'alerte
          echo "<script>alert('Mot de passe incorrect! Veuillez réessayer.');</script>";
        }
      }
    } else {
      // Si l'email est trouvé dans la table "client", récupérer la première ligne de résultat
      $row_client = $result_client->fetch_assoc();

      // Vérifier si le mot de passe fourni correspond au hash stocké dans la table "client"
      if (password_verify($password, $row_client['Password_Client'])) {
        // Si le mot de passe est correct, connecter l'utilisateur client
        $_SESSION['user_id'] = $row_client['ID_Client'];
        $_SESSION['username'] = $row_client['Username_Client'];
        $_SESSION['logged_in'] = true;
        $_SESSION['user_type'] = 'client';
        // ...
        echo "<script>alert('Connexion réussie en tant que client!'); window.location.href='../index1.php';</script>";
      } else {
        // Si le mot de passe est incorrect, afficher un message d'alerte
        echo "<script>alert('Mot de passe incorrect! Veuillez réessayer.');</script>";
      }
    }

    // Fermer les requêtes et la connexion à la base de données
    $stmt_client->close();
    $con->close();
  }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!--Main Template CSS fille -->
    <link rel="stylesheet" href="../styles/styleLogin.css">
</head>

<body>
<!--Start header -->
    <div class="header">
        <div class="container">
            <div class="top">
                <div class="logo">
                    <h1>Myticket</h1>
                </div>
                <div class="link">
                    <ul>                    
                                    <div class="insc">
                                        
                                        <li><a href="Login.php">Login</a></li>
                                    </div>
                                                             
                    </ul>
                </div>
                
            </div>
    </div>
</div>

<!--End header -->   
    <section id="Login" class="login">
    <div class="container">
        <div class="login-form">
           <a href="#Login" class="login-image">
                            <h2>Connection</h2>
                        </a>
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" name="Email_Client" placeholder="Votre adresse email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="Password_Client" placeholder="Votre mot de passe" required>
                </div>
                <div class="form-group">
                    
                   <div class="mdp-oublie">
                        <a href="#MotdepasseOublie">Mot de passe oublié ?</a>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit">Connexion</button>
                </div>
                 <div class="signup">
                        <label for="Signup">Vous n’avez pas de compte ?   </label><a href="Signup.php">inscrivez-vous</a>
                    </div>
            </form>
        </div>
    </div>
</section>
<!-- End Login Section -->

<!--Start Footer-->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col">
                <h4 class="logo">Myticket</h4>
                <ul>
                    <li><p>une source de divertissement incontournable.</p></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Catégorie</h4>
                <ul>
                    <li><a href="#">Sportif</a></li>
                    <li><a href="#">Culturel</a></li>
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
    <a href="#"><img src="facebook.png" alt="Facebook" class="social-icon"></a>
    <a href="#"><img src="twitter.png" alt="Twitter" class="social-icon"></a>
    <a href="#"><img src="instagram.png" alt="Instagram" class="social-icon"></a>
</div>
            </div>
        </div>
    </div>
</footer>

<!--End Footer-->
</body>
</html>