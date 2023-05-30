<?php
  // Vérifier si les données sont soumises via la méthode POST
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérifier que les clés de tableau sont définies
    if (isset($_POST['Numero_Telephone'], $_POST['Nom_Client'], $_POST['Prénom_Client'], $_POST['Email_Client'], $_POST['Password_Client'])) {
      // Assigner les valeurs du formulaire à des variables
      $telephone = $_POST['Numero_Telephone'];
      $nom = $_POST['Nom_Client'];
      $prenom = $_POST['Prénom_Client'];
      $email = $_POST['Email_Client'];
      $password = $_POST['Password_Client'];

      // Se connecter à la base de données
      $con = new mysqli('localhost','root','','myticket');
      if ($con->connect_error){
        echo "<script>alert('Erreur de connexion à la base de données: " . $con->connect_error . "'); window.location.href='Signup.php';</script>";
      } else {
        // Préparer une requête pour sélectionner le client avec le même numéro de téléphone
        $stmt = $con->prepare("SELECT * FROM client WHERE Numero_Telephone=?");
        $stmt->bind_param("i", $telephone);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0){
          echo "<script>alert('Ce numéro de téléphone est déjà utilisé!'); window.location.href='Signup.php';</script>";
          
        } else {
          // Hasher le mot de passe avant l'insertion dans la base de données
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          // Préparer une requête pour insérer le nouveau client dans la base de données
          $stmt = $con->prepare("INSERT INTO client(Numero_Telephone,Nom_Client,Prénom_Client,Email_Client,Password_Client) VALUES(?,?,?,?,?)");
          $stmt->bind_param("issss", $telephone, $nom, $prenom, $email, $hashed_password);
          if ($stmt->execute()){
                // Générer des données aléatoires pour les champs de la table "banque"
    $num_cart = $telephone;
    $cvv = rand(100, 999);
    $date_exp = date('Y-m-d', strtotime('+1 year')); // Date d'expiration d'un an à partir de la date actuelle
    $nom_prenom = $nom . ' ' . $prenom;
    $sold = rand(1000, 50000);; 

    // Préparer une requête pour insérer les données dans la table "banque"
    $stmt_banque = $con->prepare("INSERT INTO banque(Num_Cart, CVV, Date_Exp, Nom_Prenom, Sold) VALUES(?, ?, ?, ?, ?)");
    $stmt_banque->bind_param("iissi", $telephone, $cvv, $date_exp, $nom_prenom, $sold);
    $stmt_banque->execute();
    $stmt_banque->close();
            echo "<script>alert('Inscription réussie!'); window.location.href='Login.php';</script>";
            exit();
          } else {
            echo "<script>alert('Erreur lors de l\'insertion des données: " . $stmt->error . "'); window.location.href='Signup.php';</script>";
          }
        }
        $stmt->close();
        $con->close();
      }
    } else {
      // Si une clé de tableau est manquante, afficher un message d'erreur
      echo "<script>alert('Une ou plusieurs données sont manquantes!'); window.location.href='Signup.php';</script>";
    }
  }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    
    <!--Main Template CSS fille -->
    <link rel="stylesheet" href="../styles/styleSignup.css">

 <!--Script pour vérifier le mot de passe-->
<script>
function validateForm() {
    let password = document.getElementById("password").value;
    let repassword = document.getElementById("repassword").value;

    // Vérifier que le mot de passe fait au moins 8 caractères, contient une majuscule et un chiffre
    let regex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (!regex.test(password)) {
        alert("Le mot de passe doit faire au moins 8 caractères et contenir une majuscule et un chiffre.");
        return false;
    }

    if (password !== repassword) {
        alert("Les mots de passe ne correspondent pas.");
        return false;
    }
}
function showConditions() {
  var conditions = document.getElementById("password-conditions");
  if (conditions.style.display === "none") {
    conditions.style.display = "block";
  } else {
    conditions.style.display = "none";
  }
}

</script>




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



    <section id="Signup" class="login">

    <div class="container">

        <div class="login-form">
                <div class="titre">
    <h2>voulez vous creer un compte <br> <span>Client</span> ou <span>Organisateur</span> </h2>
    

</div>
            <div class="login-images-container">
  <a href="#Login" class="login-image right">
                <div class="login-image-text-right">
                        <h1>Client</h1>
                    </div>
  </a>
  <a href="signuporg.php" class="login-image left active">
    <div class="login-image-text">
                        <h1>Organisateur</h1>
                    </div>
  </a>
</div>


            <form action=""   onsubmit="return validateForm()" method="post">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="Nom_Client" placeholder="Votre Nom" required>
                </div>
                <div class="form-group">
                    <label for="Prenom">Prenom</label>
                    <input type="text" id="Prenom" name="Prénom_Client" placeholder="Votre Prenom" required>
                </div>
                                <div class="form-group">
                    <label for="CIN">Numero de tlephone</label>
                    <input type="number" id="CIN" name="Numero_Telephone" placeholder="Votre numero de telephone " required>
                </div>
                <div class="form-group">
                    <label for="email">adresse e-mail</label>
                    <input type="email" name="Email_Client" placeholder="entrez votre adresse e-mail" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="Password_Client" placeholder="entrez votre mot de passe" required onclick="showConditions()">

                    <div id="password-conditions" style="display:none;">
  <ul>
    <li>- au moins 8 caractères.</li>
    <li>- au moins une lettre majuscule.</li>
    <li>- au moins un chiffre.</li>
  </ul>
</div>


                </div>
                <div class="form-group">
                    <label for="Repassword">Confirmez votre mot de passe</label>
                    <input type="password" id="repassword" name="Confirm_Password_Client" placeholder=" confirmez votre mot de passe" required>
                </div>



                <div class="form-group">
                    <button type="submit">Inscription</button>
                </div>
                 <div class="signup">
                        <label for="Signup">Vous avez deja un compte ?   </label><a href="Login.php"> Connectez</a>
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
                    <li><p>Achetez vos billets pour les événements sportifs et culturels sur le site Myticket , une source de divertissement incontournable. </p></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Accueil</h4>
                <ul>
                    <li><a href="#">Accueil</a></li>
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
                    <li><a href="#">Service client</a></li>
                    <li><a href="#">Termes et conditions</a></li>
                    <li><a href="#">Contactez nous</a></li>
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
