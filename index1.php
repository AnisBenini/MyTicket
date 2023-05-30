<!DOCTYPE html>
<html lang="fr">

<?php
$keywords = isset($_GET["keywords"]) ? trim($_GET["keywords"]) : "";
$valider = isset($_GET["valider"]) ? $_GET["valider"] : "";
$afficher = "";

if (isset($valider) && !empty(trim($keywords))) {
    $words = explode(" ", trim($keywords));
    $kw = array();

    for ($i = 0; $i < count($words); $i++) {
        $kw[$i] = "nom_event LIKE '%" . $words[$i] . "%'";
    }

    $host = 'localhost';
    $dbname = 'myticket';
    $user = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $res = $pdo->prepare("SELECT ID_Event FROM evenements WHERE " . implode(" AND ", $kw));
        $res->execute();

        $tab = $res->fetchAll(PDO::FETCH_ASSOC);

        $afficher = "oui";
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}
?>



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Myticket</title>

    <!--Main Template CSS fille -->
    <link rel="stylesheet" href="styles/styleIndex.css">
    <link rel="stylesheet" href="styles/fontawesome.css">


</head>

<body>

    <!--Start header -->
    <div class="header">
        <div class="container">
            <div class="top">
                
                <div class="logo">
                    <h1><a href="index1.php" style="
    text-decoration: none;
    color: var(--logo-color);
">Myticket</a></h1>
                </div>
                <div class="link">
                    <ul>
                        <?php
                        session_start();

                       if (isset($_SESSION['user_id']) && isset($_SESSION['user_type']) && ($_SESSION['user_type'] === 'client' || $_SESSION['user_type'] === 'organisateur')) {
    // Utilisateur connecté en tant que client ou organisateur, afficher l'icône de compte
    echo '<div class="insc">
        <li class="search">
            <form name="fo" method="get" action="">
                <input type="text" name="keywords" value="' . $keywords . '" placeholder="Recherche" />
                <input type="submit" name="valider" value="Rechercher" />
            </form>
        </li> 
        <li><a href="PHP/logout.php">Log out</a></li>
        <li><a href="PHP/profil.php"><i class="fa-solid fa-user"></i></a></li>
    </div>';

                        } else {
                            // Utilisateur non connecté ou connecté en tant qu'autre type d'utilisateur, afficher les boutons de connexion
                            echo '<div class="insc">
           
      <li class="search">
      <form name="fo" method="get" action="">
      <input type="text" name="keywords" value="' . $keywords . '" placeholder="Recherche" />
      <input type="submit" name="valider" value="Rechercher" />
  </form>
      </li> 
      <li><a href="PHP/Login.php">Login</a></li>
      <li id="sign"><a href="PHP/Signup.php">SingUp</a></li>
    </div>';
                        }
                        ?>

                        <div class="nav">
                            <li><a href="index1.php">Accueil</a></li>
                            <li><a href="PHP/Sportif.php">Sportif</a></li>
                            <li><a href="PHP/Culturel.php">Culturel</a></li>
                            <?php
                            if (isset($_SESSION['user_id']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'client') {
                                // Utilisateur connecté en tant que client, masquer le lien "Créer un evenements"
                                // Ne rien afficher
                            } else {
                                
                                echo '<li><a href="PHP/creeevent.php"><b>Créer un evenements</b></a></li>';
                            }
                            ?>
                        </div>
                    </ul>
                </div>

            </div>
            <div class="buttom">
                <h2>Assistez aux meilleurs
                    evenementss <br> <span>sportif</span> et
                    <span>culturels</span> <br> en un seul clique
                    avec nos <span>tickets</span>
                </h2>
            </div>
        </div>
    </div>
    <!--End header -->

    <?php


    if ($afficher == "oui") {
    ?>
    <h2 class="titre"><?php echo count($tab) . " " . (count($tab) > 1 ? "résultats trouvés:" : "résultat trouvé:"); ?></h2>
       
        <div class="header">
            <div class="event">
                <?php
                $con = new mysqli('localhost', 'root', '', 'myticket');
                if ($con->connect_error) {
                    echo "<p>Erreur de connexion à la base de données: " . $con->connect_error . "</p>";
                } else {
                    foreach ($tab as $result1) {
                        $id_even = $result1["ID_Event"];
                        $query = "SELECT * FROM evenements WHERE ID_Event = $id_even ORDER BY ID_Event ";
                        $result = $con->query($query);

                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                ?>
                                <div class="container">
                                    <div class="image">
                                        <img src="img/cover/<?php echo $row["image_event"]; ?>" alt="image">
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
                                            <div class="date">
                                                <i class="fa-solid fa-calendar-days" style="color: #ff9e2d;"></i>
                                                <p><?php echo $row['heure_event']; ?></p>
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
                                                if ($dateActuelle >= $dateLimiteVente | $quant == 0) {
                                                    echo "La vente des billets est terminée.";
                                                } else {
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ajouter">
                                            <div class="container-ajouter"><a href="PHP/commande.php"></a>
                                                <h3><a href="PHP/commande.php?ID_Event=<?php echo $row['ID_Event']; ?>&id_organisateur=<?php echo $row['ID_Org']; ?>&prix=<?php echo $row['prix']; ?>">Acheter</a></h3>
                                            <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <?php
                            }
                        } else {
                            echo "<p>Aucun evenements récent trouvé.</p><br>
                            <p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p>";
                        }
                    }
                    $con->close();
                }
                ?>
            </div>
        </div>

        <?php

        ?>

        </div>
        </div>
        <p></p>
        <p><br></p>
        <p><br></p>
        <p><br></p>
        <p><br></p>
        </div>
        <ol>
            <?php foreach ($tab as $result1) { ?>

            <?php }  ?>
        </ol>
    <?php
    } else {
    ?>
        <p></p>





        <!--Start type_events-->
        <div class="categories">
            <div class="container">
                <div class="boutonP">
                    <div class="bouton">
                        <div class="grand-bouton">
                            <h2 class="img-sport"><a href="PHP/Sportif.php">sportif</a></h2>
                        </div>
                        <div class="grand-bouton">
                            <h2 class="img-culture"><a href="PHP/Culturel.php">culturel</a></h2>
                        </div>
                    </div>
                </div>

                <div class="text">
                    <h2> Explorez vos <span>passions</span> ici ! </h2>
                    <p>Découvrez les evenementss recents : </p>
                </div>
            </div>
        </div>


        <h2 class="titre">sportif :</h2>
        <div style="text-align: right;">
            <div class="titre2">
                <h3><a href='PHP/Sportif.php'>Voir plus</a></h3>
            </div>
        </div>

        <div class="header">
            <div class="event">
                <?php
                $con = new mysqli('localhost', 'root', '', 'myticket');
                if ($con->connect_error) {
                    echo "<p>Erreur de connexion à la base de données: " . $con->connect_error . "</p>";
                } else {
                    $query = "SELECT * FROM evenements Where type_event='sportif' ORDER BY ID_Event DESC LIMIT 3";
                    $result = $con->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                ?>
                            <div class="container">
                                <div class="image">
                                    <img src="img/cover/<?php echo $row["image_event"]; ?>" alt="image">
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
                                        <div class="date">
                                            <i class="fa-solid fa-calendar-days" style="color: #ff9e2d;"></i>
                                            <p><?php echo $row['heure_event']; ?></p>
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

                                            // Vérification si la vente des billets est terminée
                                            if ($dateActuelle >= $dateLimiteVente) {
                                                echo "La vente des billets est terminée.";
                                            } else {

                                            ?>
                                        </div>
                                    </div>
                                    <div class="ajouter">
                                        <div class="container-ajouter"><a href="PHP/commande.php"></a>
                                            <h3><a href="PHP/commande.php?ID_Event=<?php echo $row['ID_Event']; ?>&id_organisateur=<?php echo $row['ID_Org']; ?>&prix=<?php echo $row['prix']; ?>">Acheter</a></h3>
                                        <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php

                        }
                    } else {
                        echo "<p>Aucun evenements récent trouvé.</p>";
                    }

                    $con->close();
                }
                ?>
            </div>
        </div>
        <h2 class="titre">culturel :</h2>
        <div style="text-align: right;">
            <div class="titre2">
                <h3><a href='PHP/Culturel.php'>Voir plus</a></h3>
            </div>
        </div>

        <div class="header">
            <div class="event">
                <?php
                $con = new mysqli('localhost', 'root', '', 'myticket');
                if ($con->connect_error) {
                    echo "<p>Erreur de connexion à la base de données: " . $con->connect_error . "</p>";
                } else {
                    $query = "SELECT * FROM evenements WHERE type_event='culturel' ORDER BY ID_Event DESC LIMIT 3";
                    $result = $con->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {

                ?>
                            <div class="container">
                                <div class="image">
                                    <img src="img/cover/<?php echo $row["image_event"]; ?>" alt="image">
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
                                        <div class="date">
                                            <i class="fa-solid fa-calendar-days" style="color: #ff9e2d;"></i>
                                            <p><?php echo $row['heure_event']; ?></p>
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
                                            if ($dateActuelle >= $dateLimiteVente | $quant == 0) {
                                                echo "La vente des billets est terminée.";
                                            } else {
                                            ?>



                                        </div>
                                    </div>
                                    <div class="ajouter">
                                        <div class="container-ajouter"><a href="PHP/commande.php"></a>
                                            <h3><a href="PHP/commande.php?ID_Event=<?php echo $row['ID_Event']; ?>&id_organisateur=<?php echo $row['ID_Org']; ?>&prix=<?php echo $row['prix']; ?>">Acheter</a></h3>
                                        <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php

                        }
                    } else {
                        echo "<p>Aucun evenements récent trouvé.</p>";
                    }

                    $con->close();
                }
                ?>
            </div>
        </div>

        <!--End type_events-->


        <div class="creation">
            <h2>Créez votre <span>Evènement</span> :</h2>
            <p> Découvrez la puissance de l'organisation d'evenementss ! En tant qu'organisateur inscrit, vous avez la possibilité de donner vie à vos idées en créant des evenementss exceptionnels. Il vous suffit de créer un compte organisateur, de le valider et vous serez prêt à donner vie à vos projets les plus excitants. <b href="loginorg">Rejoignez-nous</b> dès maintenant et créez des expériences inoubliables pour tous ! </p>

        </div>
    <?php
    } ?>

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
                        <li>
                            <p>une source de divertissement incontournable. </p>
                        </li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Categorie</h4>
                    <ul>
                        <li><a href="PHP/Sportif.php">sportif</a></li>
                        <li><a href="PHP/Culturel.php">culturel</a></li>
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

    <!--End Footer-->
</body>

</html>