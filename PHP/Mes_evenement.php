<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Myticket</title>
    
    <!--Main Template CSS fille -->
    <link rel="stylesheet" href="../styles/styleMesEvent.css">
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

                                         <div class="insc">
                                        <li><a href="logout.php">Log out</a></li>
                                        <li><a href="profil.php"><i class="fa-solid fa-user"></i><a href="#SingUp"></a></li>
                                    </div>';

                                        <div class="nav">
                                            <li><a href="Mes_evenement.php">Mes evenements</a></li>
                                            
                                            <li><a href="creeevent.php"><b>créer un évenement</b></a></li>
                                        </div>                       
                    </ul>
                </div>
                
            </div>
            <div class="buttom">

            </div>
        </div>
    </div>
<!--End header -->   
<!--Start Categories-->
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
        <h2 class="titre">Mes événement</h2>
        <a class="plus" href="creeevent.php">Ajouter un événement 
          <i class="fa-solid fa-circle-plus" style="color: #ff9e2d;">
          </i>
        </a>                         

        
    <div class="header">
    <div class="event">
  <?php
  session_start();
  $ID_Org = $_SESSION['user_id'];
  $con = new mysqli('localhost','root','','myticket');
  if ($con->connect_error){
    echo "<p>Erreur de connexion à la base de données: " . $con->connect_error . "</p>";
  } else {
    $query = "SELECT * FROM evenements WHERE ID_Org = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $ID_Org);
$stmt->execute();
$result = $stmt->get_result();
  

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
      </div>
      <div class="ajouter">
        <div class="container-ajouter">
        <form action="DeleteEvent.php" method="post">
             <?php
             $idévén = $row["ID_Event"];
             ?>
             <input type="hidden" name="valeur_cachée" value="<?php echo $idévén; ?>">
             <h3><button type="submit" class="btn" name="supprimer" >Supprimer</button></h3>
        </form>
  
        </div>
      </div>
    </div>
  </div>



  <?php
      }
    } else {
      echo "<p>Aucun événement récent trouvé.</p>";
    }

  }
  $con->close();
  ?>


</div>

 

<!--End Catégories-->


<div class="creation">
    <h2>Créez votre <span>Evènement</span> :</h2>  
    <p> Découvrez la puissance de l'organisation d'événements ! En tant qu'organisateur inscrit, vous avez la possibilité de donner vie à vos idées en créant des événements exceptionnels. Il vous suffit de créer un compte organisateur, de le valider et vous serez prêt à donner vie à vos projets les plus excitants. <b href="loginorg">Rejoignez-nous</b> dès maintenant et créez des expériences inoubliables pour tous ! </p>
    
</div>

<!-- <div class="text">
    <div class="container">
        <p class="titre-text">Créez votre <span>Evènement</span></p>
        <p class="container-text">La fonctionnalité de création d'événements sur le site permet aux organisateurs de vendre des billets pour leurs propres événements.
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