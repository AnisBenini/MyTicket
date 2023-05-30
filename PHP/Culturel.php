<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Myticket</title>
    
    <!--Main Template CSS fille -->
    <link rel="stylesheet" href="../styles/style_Cul_Spo.css">
    <link rel="stylesheet" href="../styles/fontawesome.css">
    

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
                       <?php
                                  session_start();
                                  
                                  if (isset($_SESSION['user_id'])) {
                                    // Utilisateur connecté, afficher l'icône de compte
                                    echo '<div class="insc">
                                        <li><a href="logout.php">Log out</a></li>
                                        <li><a href="profil.php"><i class="fa-solid fa-user"></i></a></li>
                                    </div>';
                                  } else {
                                    // Utilisateur non connecté, afficher les boutons de connexion
                                    echo '<div class="insc">
                                        <li><a href="Login.php">Login</a></li>
                                        <li id="sign"><a href="#SingUp">SingUp</a></li>
                                    </div>';
                                  }
                                  ?>         

                                        <div class="nav">
                                            <li><a href="../index1.php">Acceuil</a></li>
                                            <li><a href="Sportif.php">Sportif</a></li>
                                            
                                        </div>                       
                    </ul>
                </div>
                
            </div>
            <div class="buttom">

            </div>
        </div>
    </div>
<!--End header -->   
<!--Start Catégories-->
    <div class="categories">
        <div class="container">
<div class="boutonP"> 
  <div class="bouton">
<!--     <div class="sportif"><h2><a href="#Sportif">Sportif</a></h2></div>
    <div class="culturel"><h2><a href="#Culturel">Culturel</a></h2></div> -->

  </div>
</div>


        </div>
    </div>
        <h2 class="titre">Evenements Culturel</h2>
                   

        
    <div class="header">
        <div class="event">
    <?php
    $con = new mysqli('localhost','root','','myticket');
    if ($con->connect_error){
      echo "<p>Erreur de connexion à la base de données: " . $con->connect_error . "</p>";
    } else {
        $query = "SELECT * FROM evenements WHERE type_event='culturel' ORDER BY ID_Event";

      $result = $con->query($query);

      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
           
          ?>
          <div class="container">
            <div class="image">
              <img src="../img/cover/<?php echo $row["image_event"]; ?>" alt="image">
            </div>
            <div class="buttom">
              <div class="info">
                <div class="nom">
                       <h3><?php echo $row['nom_event']; ?></h3> 
                </div>
                <div class="lieu">
                  <i class="fa-solid fa-location-dot" style="color:#ff9e2d ;"></i>
                  <p><?php echo $row['lieu_event']; ?></p>
                </div>
                <div class="date">
                  <i class="fa-solid fa-calendar-days" style="color: #ff9e2d;"></i>
                  <p><?php echo $row['date_event']; ?></p>
                </div>
                <div class="restant">
                  <i class="fa-solid fa-ticket" style="color: #ff9e2d;"></i>
                  <p><?php echo $row['quantite']; ?> Billet(s) restant(s)</p>
                </div>
                <div class="montant">
                  <i class="fa-solid fa-coins" style="color: #ff9e2d;"></i>
                  <p><?php echo $row['prix']; ?> da</p>
                </div>
                <div class="montant">
                <?php 
               // Date de début de l'événement (à titre d'exemple)
                  $dateDebutEvenement = $row['date_event'];
                          
                  // Calcul de la date limite pour la vente des billets (24 heures avant la date de début)
                  $dateLimiteVente = strtotime($dateDebutEvenement) - (24 * 60 * 60); // 24 heures = 24 * 60 minutes * 60 secondes
                          
                  // Date et heure actuelles
                  $dateActuelle = time();
                  $quant = $row['quantite'];
                  // Vérification si la vente des billets est terminée
                  if ($dateActuelle >= $dateLimiteVente | $quant == 0 ) {
                      echo "La vente des billets est terminée.";
                  } else {
                ?>
                </div>
              </div>
              <div class="ajouter">
                                        <div class="container-ajouter">
                                          <a href="commande.php"></a>
                                            <h3><a href="commande.php?ID_Event=<?php echo $row['ID_Event']; ?>&id_organisateur=<?php echo $row['ID_Org']; ?>&prix=<?php echo $row['prix']; ?>">Acheter</a></h3>
                                        <?php } ?>
                                        </div>
                                    </div>
            </div>
          </div>
          <?php
        }
      }
       else {
        echo "<p>Aucun evenements récent trouvé.</p>";
      }
      $con->close();
    }
      
    
    ?>
</div>
</div>
 

<!--End Catégories-->


<div class="creation">
    <h2>Créez votre <span>Evènement</span> :</h2>  
    <p> Découvrez la puissance de l'organisation d'evenementss ! En tant qu'organisateur inscrit, vous avez la possibilité de donner vie à vos idées en créant des evenementss exceptionnels. Il vous suffit de créer un compte organisateur, de le valider et vous serez prêt à donner vie à vos projets les plus excitants. <b href="loginorg">Rejoignez-nous</b> dès maintenant et créez des expériences inoubliables pour tous ! </p>
    
</div>

<!-- <div class="text">
    <div class="container">
        <p class="titre-text">Créez votre <span>Evènement</span></p>
        <p class="container-text">La fonctionnalité de création d'evenementss sur le site permet aux organisateurs de vendre des billets pour leurs propres evenementss.
            pour cela veuillez  contacter notre service :
            create_event@Myticket.com
            ou bien visiter la page <span> Créez votre évènement </span> </p>
    </div>
</div> -->

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
                    <li><a href="Sportif.php">Sportif</a></li>
                    
                </ul>
            </div>
            <div class="footer-col">
                <h4>A-Propos</h4>
                <ul>
                    <li><a href="#">Termes et conditions</a></li>
                    <li><a href="#">myticket_contact@gmail.com
                    </a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>follow us</h4>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!--End Footer-->
</body>
</html>