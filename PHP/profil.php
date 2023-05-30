<?php
session_start();

// Vérifier si l'utilisateur est connecté
if ($_SESSION['logged_in']) {
  if (isset($_POST['submit'])) { // Vérifier si le formulaire a été soumis
    if (!empty($_POST['adresse'])) { // Vérifier si le champ d'adresse n'est pas vide
      $newAdresse = $_POST['adresse'];

      // Mettre à jour l'adresse de l'utilisateur dans la base de données
      $con = new mysqli('localhost', 'root', '', 'myticket');
      if ($con->connect_error) {
        echo "<script>alert('Erreur de connexion à la base de données: " . $con->connect_error . "');</script>";
      } else {
        // Préparer une requête pour mettre à jour l'adresse de l'utilisateur
        if ($_SESSION['user_type'] === 'client') {
        $stmt = $con->prepare("UPDATE client SET Email_Client=? WHERE ID_Client=?");
        } elseif ($_SESSION['user_type'] === 'organisateur') {
          $stmt = $con->prepare("UPDATE organisateur SET Email_Org=? WHERE ID_Org=?");
        }
        $stmt->bind_param("si", $newAdresse, $_SESSION['user_id']);
        $stmt->execute();

        // Vérifier si la mise à jour a réussi
        if ($stmt->affected_rows > 0) {
          echo "<script>alert('Les modifications ont été enregistrées avec succès');</script>";
        } else {
          echo "<script>alert('Erreur lors de l'enregistrement des modifications');</script>";
        }

        $stmt->close();
        $con->close();
      }
    }
  }

  if (isset($_POST['password_submit'])) { // Vérifier si le formulaire de changement de mot de passe a été soumis
    if (!empty($_POST['new_password']) && !empty($_POST['confirm_password'])) { // Vérifier si les champs de mot de passe ne sont pas vides
      $newPassword = $_POST['new_password'];
      $confirmPassword = $_POST['confirm_password'];

      if ($newPassword === $confirmPassword) { // Vérifier si les mots de passe saisis correspondent
        // Mettre à jour le mot de passe de l'utilisateur dans la base de données
        $con = new mysqli('localhost', 'root', '', 'myticket');
        if ($con->connect_error) {
          echo "<script>alert('Erreur de connexion à la base de données: " . $con->connect_error . "');</script>";
        } else {
          // Préparer une requête pour mettre à jour le mot de passe de l'utilisateur
          if ($_SESSION['user_type'] === 'client') {
          $stmt = $con->prepare("UPDATE client SET Password_Client=? WHERE ID_Client=?");
          } elseif ($_SESSION['user_type'] === 'organisateur') {
            $stmt = $con->prepare("UPDATE organisateur SET Mdp_Org=? WHERE ID_Org=?");
          }
          $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
          $stmt->bind_param("si", $hashedPassword, $_SESSION['user_id']);
          $stmt->execute();

          // Vérifier si la mise à jour a réussi
          if ($stmt->affected_rows > 0) {
            echo "<script>alert('Le mot de passe a été modifié avec succès');</script>";
          } else {
            echo "<script>alert('Erreur lors de la modification du mot de passe');</script>";
          }

          $stmt->close();
          $con->close();
        }
      } else {
        echo "<script>alert('Les mots de passe saisis ne correspondent pas');</script>";
      }
    } else {
      echo "<script>alert('Veuillez remplir tous les champs de mot de passe');</script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    
    <!-- Main Template CSS file -->
    <link rel="stylesheet" href="../styles/styleprofil.css">
    <link rel="stylesheet" href="../styles/fontawesome.css">

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const icon = document.querySelector('.icon');
        const search = document.querySelector('.search');
        icon.addEventListener('click', function() {
          search.classList.toggle('active');
        });
      });

      function showConditions() {
        var conditions = document.getElementById("password-conditions");
        if (conditions.style.display === "none") {
          conditions.style.display = "block";
        } else {
          conditions.style.display = "none";
        }
      }
      function emailmod() {
        var conditions = document.getElementById("email-mod");
        if (conditions.style.display === "none") {
          conditions.style.display = "block";
        } else {
          conditions.style.display = "none";
        }
      }

       function passmod() {
        var conditions = document.getElementById("pass-mod");
        if (conditions.style.display === "none") {
          conditions.style.display = "block";
        } else {
          conditions.style.display = "none";
        }
      }
    </script>
  </head>

  <body>
    <!-- Start header -->
    <div class="header">
      <div class="container">
        <div class="top">
          <div class="burg">
          </div>
          <div class="logo">
            <h1><a href="index1.php" style="
    text-decoration: none;
    color: var(--logo-color);
">Myticket</a></h1>
          </div>
          <div class="link">
            <ul>
              <div class="insc">
 
                <li><a href="logout.php">Log out</a></li>
                <li><a href="profil.php"><i class="fa-solid fa-user"></i><a href="#SingUp"></a></li>
              </div>
              
              <div class="nav">
                  <?php 
                   if($_SESSION['user_type'] === 'client'){
                echo '<li><a href="index1.php">Acceuil</a></li>
                <li><a href="Sportif.php">Sportif</a></li>
                            <li><a href="Culturel.php">Culturel</a></li>' ; 
              }
              if($_SESSION['user_type'] === 'organisateur'){
                echo '<li><a href="Mes_evenement.php">Mes evenements</a></li>
                <li><a href="creeevent.php">Creer un evenement</a></li>' ;

              }
                ?>

                 <!--   <?php
                            if (isset($_SESSION['user_id']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'client') {
                                // Utilisateur connecté en tant que client, masquer le lien "Créer un evenements"
                                // Ne rien afficher
                            } else {
                                
                                echo '<li><a href="creeevent.php"><b>Créer un evenements</b></a></li>';
                            }
                            ?> -->
              }
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
          <h2>Mon profil</h2>
        </div>

        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
          <div class="form-group">
            <p id="my-info" onclick="showConditions()"> → Voir mon profil</p>
            <div id="password-conditions" style="display:none;">
              <div class="profile-info">
                <?php
                // Afficher les informations de l'utilisateur depuis la base de données
                $con = new mysqli('localhost', 'root', '', 'myticket');
                if ($con->connect_error) {
                  echo "<script>alert('Erreur de connexion à la base de données: " . $con->connect_error . "');</script>";
                } else {
                        if ($_SESSION['user_type'] === 'client') {
                  $stmt = $con->prepare("SELECT * FROM client WHERE ID_Client=?");
                  $stmt->bind_param("i", $_SESSION['user_id']);
                  $stmt->execute();
                  $result = $stmt->get_result();

                  if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $nom = $row['Nom_Client'];
                    $prenom = $row['Prénom_Client'];
                    
                    $telephone = $row['Numero_Telephone'];
                    $email = $row['Email_Client'];

                    // Afficher les informations de l'utilisateur dans le formulaire
                    echo '<h3>Nom :</h3>';
                    echo '<p>' . $nom . '</p>';

                    echo '<h3>Prénom :</h3>';
                    echo '<p>' . $prenom . '</p>';



                    echo '<h3>Numéro de téléphone :</h3>';
                    echo '<p>' . $telephone . '</p>';

                    echo '<h3>Adresse e-mail :</h3>';
                    echo '<p>' . $email . '</p>';
                  }

                  $stmt->close();
                  $con->close();
                } elseif($_SESSION['user_type'] === 'organisateur') {

                  $stmt = $con->prepare("SELECT * FROM organisateur WHERE ID_Org=?");
                  $stmt->bind_param("i", $_SESSION['user_id']);
                  $stmt->execute();
                  $result = $stmt->get_result();

                  if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $nom = $row['Nom_Org'];
                    $prenom = $row['Compte_Org'];
                    $telephone = $row['Numero_Telephone_Org'];
                    $email = $row['Email_Org'];

                    // Afficher les informations de l'utilisateur dans le formulaire
                    echo '<h3>Nom :</h3>';
                    echo '<p>' . $nom . '</p>';

                    echo '<h3>Numero de compte bancaire :</h3>';
                    echo '<p>' . $prenom . '</p>';



                    echo '<h3>Numéro de téléphone :</h3>';
                    echo '<p>' . $telephone . '</p>';

                    echo '<h3>Adresse e-mail :</h3>';
                    echo '<p>' . $email . '</p>';
                  }
                   $stmt->close();
                  $con->close();
                }
              }
                ?>
              </div>
            </div>
          </div>
<div class="form-group">
            <p id="my-info" onclick="emailmod()"> → Modifier mon adresse </p>
            <div id="email-mod" style="display:none;">
              <div class="profile-info">
                  <?php
                     if ($_SESSION['user_type'] === 'client') {
                  $adresse = $row['Email_Client'];
                                      echo '<h3>Adresse :</h3>';
                    echo '<input type="text" name="adresse" value="' . $adresse . '">';
                  } elseif ($_SESSION['user_type'] === 'organisateur') {
                    $adresse = $row['Email_Org'];
                                      echo '<h3>Adresse :</h3>';
                    echo '<input type="text" name="adresse" value="' . $adresse . '">';
                  }
                  ?>




              </div>
              <button type="submit" name="submit">Valider</button>
              </div>  
            </div>

            <div class="form-group">
              <p id="my-info" onclick="passmod()"> → Modifier mon mot de passe</p>
              <div id="pass-mod" style="display:none;">
                <div class="profile-info">
                  <h3>Nouveau mot de passe :</h3>
                  <input type="password" name="new_password">

                  <h3>Confirmer le mot de passe :</h3>
                  <input type="password" name="confirm_password">
                </div>
                <button type="submit" name="password_submit">Modifier le mot de passe</button>
              </div>

            </div>

            <div class="form-group">
              <a href="logout.php">Déconnecter</a>
              
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
                    <h4>type_event</h4>
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
