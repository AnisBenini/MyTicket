<?php
// Connecter à la base de données
$conn = mysqli_connect('localhost', 'root', '', 'myticket');

// Vérifier si la connexion a réussi
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Vérifier si l'image a été téléchargée
  if($_FILES["Registre_commerce_Org"]["error"] == 4){
    echo "<script> alert('image n existe pas '); </script>";
    exit();
  }

  // Récupérer les données soumises dans le formulaire
  $nom = $_POST['Nom_Org'];
  $telephone = $_POST['Numero_Telephone_Org'];
  $email = $_POST['Email_Org'];
  $mdp = $_POST['Mdp_Org'];
  $compte = $_POST['Compte_Org'];

  // Vérifier si l'image est valide
  $fileName = $_FILES["Registre_commerce_Org"]["name"];
  $fileSize = $_FILES["Registre_commerce_Org"]["size"];
  $tmpName = $_FILES["Registre_commerce_Org"]["tmp_name"];
  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $fileName);
  $imageExtension = strtolower(end($imageExtension));
  if ( !in_array($imageExtension, $validImageExtension) ){
    echo "<script> alert('Extension de l image est invalide '); </script>";
    exit();
  }
  else if($fileSize > 1000000){
    echo "<script> alert('la taille de l image est trop grosse '); </script>";
    exit();
  }

  // Hasher le mot de passe avec l'algorithme bcrypt
  $hashed_password = password_hash($mdp, PASSWORD_BCRYPT);

  // Préparer une requête SQL pour insérer les données dans la base de données
  $stmt = $conn->prepare('INSERT INTO organisateur (Nom_Org, Numero_Telephone_Org, Email_Org, Mdp_Org, Compte_Org, Registre_commerce_Org) VALUES (?, ?, ?, ?, ?, ?)');

  // Déplacer l'image téléchargée vers le dossier "img" et obtenir le nouveau nom de fichier généré
  $newImageName = uniqid() . '.' . $imageExtension;
  move_uploaded_file($tmpName, '../img/' . $newImageName);

  // Exécuter la requête avec les données en paramètres
  $stmt->bind_param('ssssss', $nom, $telephone, $email, $hashed_password, $compte, $newImageName);
  $stmt->execute();
  $num_cart = $compte;
    $cvv = rand(100, 999);
    $date_exp = date('Y-m-d', strtotime('+1 year')); // Date d'expiration d'un an à partir de la date actuelle
    $nom_prenom = $nom ;
    $sold = rand(1000, 50000);; 

    // Préparer une requête pour insérer les données dans la table "banque"
    $stmt_banque = $conn->prepare("INSERT INTO banque(Num_Cart, CVV, Date_Exp, Nom_Prenom, Sold) VALUES(?, ?, ?, ?, ?)");
    $stmt_banque->bind_param("iissi", $num_cart, $cvv, $date_exp, $nom_prenom, $sold);
    $stmt_banque->execute();
    $stmt_banque->close();

  // Rediriger l'utilisateur vers une page de confirmation
  header('Location: Login.php');
  exit();
}
?>




<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription organisateur</title>
    
    <!--Main Template CSS fille -->
    <link rel="stylesheet" href="../styles/stylesignuporg.css">

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
                    <h1 >Myticket</h1>
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
                <div class="titre">
    <h2>voulez vous creer un compte <br><span>Client</span> ou <span>Organisateur</span> </h2>
    

</div>

            <div class="login-images-container">
  <a href="signup.php" class="login-image left active">
                <div class="login-image-text">
                        <h1>Client</h1>
                    </div>
  </a>
  <a href="#Login" class="login-image right">
    <div class="login-image-text-right">
                        <h1>Organisateur</h1>
                    </div>
  </a>
</div>
     <form action =""   method="post" autocomplete="off" enctype="multipart/form-data">
      <div class="form-group">
                    <label for="nom">Nom Organisateur</label>
                    <input type="text" id="nom" name="Nom_Org" placeholder="Votre Nom" required>
                </div>
                                <div class="form-group">
                    <label for="CIN">Numero de tlephone</label>
                    <input type="number" id="CIN" name="Numero_Telephone_Org" placeholder="Votre numero de telephone " required>
                </div>
                <div class="form-group">
                    <label for="email">adresse e-mail</label>
                    <input type="email" name="Email_Org" placeholder="entrez votre adresse e-mail" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="Mdp_Org" placeholder="entrez votre mot de passe" required onclick="showConditions()">

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
                    <label for="Prenom">Numero de compte bancaire</label>
                    <input type="number" id="Prenom" name="Compte_Org" placeholder="Votre Numero de compte bancaire" required>
                </div>
      <div class="form-group">
      <label for="registre">Registre de commerce (image)</label>
       <input type="file" id="registre" name="Registre_commerce_Org" class="upload-box" accept=".jpg , .jpeg , .png"> <br> <br> 
     </div>
     <div class="form-group">
      <button type = "submit" name = "submit">Submit</button>
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
                    <li><a href="#">Accueil </a></li>
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
