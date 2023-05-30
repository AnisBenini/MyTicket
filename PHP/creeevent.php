<?php
// Connecter à la base de données
$conn = mysqli_connect('localhost', 'root', '', 'myticket');
session_start();

// Vérifier si la connexion a réussi
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Vérifier si l'image a été téléchargée
  if($_FILES["image_event"]["error"] == 4){
    echo "<script> alert('image n existe pas '); </script>";
    exit();
  }

  // Récupérer les données soumises dans le formulaire
  $nom = $_POST['nom_event'];
  $type_event = $_POST['type_event'];
  $lieu_event = $_POST['lieu_event'];
  $date_event = $_POST['date_event'];
  $heure_event = $_POST['heure_event'];
  $quantite = $_POST['quantite'];
  $prix = $_POST['prix'];
   $idOrganisateur = $_SESSION['user_id'];

  // Vérifier si l'image est valide
  $fileName = $_FILES["image_event"]["name"];
  $fileSize = $_FILES["image_event"]["size"];
  $tmpName = $_FILES["image_event"]["tmp_name"];
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

  // Préparer une requête SQL pour insérer les données dans la base de données
  $stmt = $conn->prepare('INSERT INTO evenements (ID_Org,nom_event, lieu_event, date_event,heure_event, prix , quantite,type_event,image_event) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');

  // Déplacer l'image téléchargée vers le dossier "img" et obtenir le nouveau nom de fichier généré
  $newImageName = uniqid() . '.' . $imageExtension;
  move_uploaded_file($tmpName, '../img/cover/' . $newImageName);

  // Exécuter la requête avec les données en paramètres
  $stmt->bind_param('sssssssss', $idOrganisateur, $nom, $lieu_event, $date_event, $heure_event, $quantite,$prix,$type_event, $newImageName);
  $stmt->execute();

  // Rediriger l'utilisateur vers une page de confirmation
  header('Location: Mes_evenement.php');
  exit();
}  else {
  // Vérifier si l'utilisateur est déjà connecté en tant qu'organisateur
  if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'organisateur') {
    // Rediriger l'utilisateur vers la page Signup.php
    header("Location: Signup.php");
    exit();
  }
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
    <link rel="stylesheet" href="../styles/styleevent.css">
    <link rel="stylesheet" href="../styles/fontawesome.css">

 <!--Script pour vérifier le mot de passe-->
<script>


</script>




      </head>

  <body>




    <!--Start header -->
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
                                        <li><a href="profil.php"><i class="fa-solid fa-user"></i>
                                        <a href="#SingUp"></a></li>
                                    </div>
                                  

                                        <div class="nav">
                                            <li><a href="Mes_evenement.php">Mes evenements</a></li>
                                           
                                            
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
    <h2>Veuillez remplir le formulaire suivant :  </h2>
    

</div>

     <form action =""   method="post" autocomplete="off" enctype="multipart/form-data">
      <div class="form-group">
                    <label for="nom">Nom de l’événement <span>*</span></label>
                    <input type="text" id="nom" name="nom_event" placeholder="le nom de l'evenement" required>
                </div>
                                <div class="form-group">
                    <label for="CIN">Lieu de l'evenement<span>*</span> </label>
                    <input type="text" id="CIN" name="lieu_event" placeholder="le lieu de l'evenement" required>
                </div>
                <div class="form-group">
                    <label for="date"> la date de l'evenement<span> *</span></label>
                    <input type="date" name="date_event" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="heure"> l'heure de l'evenement<span> *</span></label>
                    <input type="time" name="heure_event" placeholder="" required>
                </div>
              
                <div class="form-group">
                    <label for="quantite">Nombre de ticket <span>*</span></label>
                    <input type="number" id="quantite" name=" quantite" placeholder="" required>
                </div>

                <div class="form-group">
                    <label for="prix">prix du ticket <span>*</span></label>
                    <input type="number" id="prix" name=" prix" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="type">type de l'evenement  <span>*</span></label>
                    <select id="type" name="type_event" placeholder="" required>
                     <option value="sportif">Sportif</option>
                    <option value="culturel">Culturel</option>
                  </select>

                </div>


      <div class="form-group">
      <label for="registre">image de coverture de l'evenement <span>*</span></label>
       <input type="file" id="image_event" name="image_event" class="upload-box" accept=".jpg , .jpeg , .png"> <br> <br> 
     </div>
     <div class="form-group">
      <button type = "submit" name = "submit">Valider</button>
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
            >
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
