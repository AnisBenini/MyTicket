<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashbord</title>

    <link rel="stylesheet" href="styles/fontawesome.css">
    <link rel="stylesheet" href="styles/dashboard.css">
    
    <script defer src="scripts/dashboard.js"></script>
 
    
</head>

<body>
    
    <div class="wrapper">
        <div class="sidebar">
            <div class="sidebar--top">
                <a href="../index.html" class="logo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ticket-perforated" viewBox="0 0 16 16">
                        <path d="M4 4.85v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Zm-7 1.8v.9h1v-.9H4Zm7 0v.9h1v-.9h-1Z"/>
                        <path d="M1.5 3A1.5 1.5 0 0 0 0 4.5V6a.5.5 0 0 0 .5.5 1.5 1.5 0 1 1 0 3 .5.5 0 0 0-.5.5v1.5A1.5 1.5 0 0 0 1.5 13h13a1.5 1.5 0 0 0 1.5-1.5V10a.5.5 0 0 0-.5-.5 1.5 1.5 0 0 1 0-3A.5.5 0 0 0 16 6V4.5A1.5 1.5 0 0 0 14.5 3h-13ZM1 4.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v1.05a2.5 2.5 0 0 0 0 4.9v1.05a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-1.05a2.5 2.5 0 0 0 0-4.9V4.5Z"/>
                      </svg>
                    <p> MyTicket</p>
                </a>

                <button class="sidebar--collapse-btn">
                    <svg class="icon-24" viewBox="0 0 32 32">
                        <path d="M20 7L11 16M11 16L20 25" fill="none" fill-rule="evenodd" stroke=currentColor
                            stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <svg class="icon-24" viewBox="0 0 32 32">
                        <path d="M0 0L32 0L32 32L0 32L0 0L0 0Z" fill="none" fill-rule="evenodd" stroke="none" />
                        <path d="M7 7.98016L25 8.01981" fill-rule="evenodd" stroke=currentColor stroke-width="2" stroke-linecap="round" />
                        <path d="M7 23.0198L25 23.0198" fill-rule="evenodd" stroke=currentColor stroke-width="2" stroke-linecap="round" />
                        <path d="M7 15.0198L25 15.0198" fill-rule="evenodd" stroke=currentColor stroke-width="2" stroke-linecap="round" />
                    </svg>

                    <svg class="icon-24" viewBox="0 0 32 32">
                        <path d="M0 0L32 0L32 32L0 32L0 0L0 0Z" fill="none" fill-rule="evenodd" stroke="none" />
                        <path d="M7.16116 7.16116L24.8388 24.8388" fill-rule="evenodd" stroke=currentColor stroke-width="2" stroke-linecap="round" />
                        <path d="M7.16116 24.8388L24.8388 7.16116" fill-rule="evenodd" stroke=currentColor stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
            </div>

            <div class="sidebar--tab-controls">
                <button class="sidebar--btn tab-control tab-control__selected">
                    <i class="fa-solid fa-chart-simple  sidebar--btn--icon icon-32"></i>
                    <p>Tableau de bord</p>
                </button>

                <button class="sidebar--btn tab-control">
                    <i class="fa-sharp fa-regular fa-calendar-days  sidebar--btn--icon icon-32"></i>
                    <p>Events</p>
                </button>

                <button class="sidebar--btn tab-control">
                    <i class="fa-solid fa-gears sidebar--btn--icon icon-32"></i>
                    <p>Paramétres</p>
                </button>
                <button class="sidebar--btn tab-control">
                    <i class="fa fa-user   sidebar--btn--icon icon-32"></i>
                    <p>Nos Clients</p>
                </button>
                <button class="sidebar--btn tab-control">
                    <i class="fa-solid fa-user-tie  sidebar--btn--icon icon-32 "></i>
                    <p>Nos Organisateurs</p>
                </button>
            </div>

            <div class="sidebar--bottom">
                <div class="sidebar--divider"></div>
                <button class="sidebar--btn">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <p>Log Out</p>
                </button>
            </div>
        </div>

        <div class="content-wrapper">
            <header class="navbar">
                <div class="tab--headers">
                    <div class="tab--header tab--header__selected">
                        <p class="tab--title">Statistique</p>
                        <select class="select-btn statistics-option">
                            <option value="value 1">Event 1</option>
                            <option value="value 2">Event 2</option>
                            <option value="value 3">Event 3</option>
                        </select>
                    </div>

                    <div class="tab--header">
                        <p class="tab--title">Events</p>
                    </div>
                    <div class="tab--header">
                        <p class="tab--title">Paramétres</p>
                    </div>
                    <div class="tab--header">
                        <p class="tab--title">Nos Clients</p>
                    </div>
                    
                    <div class="tab--header">
                        <p class="tab--title">Nos Organisateurs</p>
                    </div>
                </div>
                

                <div class="primary-header-right">
                        <div class="switch-theme-container">
                          <input class="switch-theme-btn" type="checkbox" name="switch theme">
                          <div class="switch-theme-icons">
                            <i class="moon-icon fa-solid fa-moon"></i>
                            <i class="sun-icon fa-solid fa-sun"></i>
                          </div>
                        </div>
                        <div class="seperator"></div>                
                        <div class="primary-header-user">
                          <a href="#" class="primary-header-account">
                            <i class="fa-solid fa-user"></i>
                          </a>
                        </div>

                </div>
            </header>
            
            <main class="tabs">
                <div class="tab tab__grades tab__selected">
                    <div class="tab--container">
                        <div class="chart-card--wrapper">
                            <div class="card card__compare">
                                <header class="card--header">
                                    <p class="card--title">Tickets Vendus</p>
                                    <div class="compare-chart--info-wrapper">
                                        <div class="chart--info">
                                            <div class="chart--info-circle"></div>
                                            <p>Réservé</p>
                                        </div>
                                        <div class="chart--info">
                                            <div class="chart--info-circle"></div>
                                            <p>Disponibilité</p>
                                        </div>
                                    </div>
                                </header>
                                <main class="compare-chart">
                                    <div class="bars">
                                        <div class="bar--wrapper">
                                            <div style="height: 60%" data-value="2500" class="bar bar__s1"></div>
                                            <div style="height:45%" data-value="1200" class="bar bar__s2"></div>
                                            <p class="bar--text">BT</p>
                                        </div>
                                        <div class="bar--wrapper">
                                            <div style="height:50%" data-value="2000" class="bar bar__s1"></div>
                                            <div style="height:45%" data-value="1600" class="bar bar__s2"></div>
                                            <p class="bar--text">RB</p>
                                        </div>
                                        <div class="bar--wrapper">
                                            <div style="height:70%" data-value="3000" class="bar bar__s1"></div>
                                            <div style="height:23%" data-value="400" class="bar bar__s2"></div>
                                            <p class="bar--text">RT</p>
                                        </div>
                                        <div class="bar--wrapper">
                                            <div style="height:91%" data-value="9500" class="bar bar__s1"></div>
                                            <div style="height:50%" data-value="3800" class="bar bar__s2"></div>
                                            <p class="bar--text">LB</p>
                                        </div>
                                        
                                        <div class="bar--wrapper">
                                            <div style="height:20%" data-value="900" class="bar bar__s1"></div>
                                            <div style="height:8%" data-value="750" class="bar bar__s2"></div>
                                            <p class="bar--text">VIP</p>
                                        </div>
                                        
                                    </div>

                                    <div class="axises">
                                        <div class="axis">
                                            <p class="namber">10000</p>
                                            <div class="line"></div>
                                        </div>
                                        <div class="axis">
                                            <p class="namber">5000</p>
                                            <div class="line"></div>
                                        </div>
                                        <div class="axis">
                                            <p class="namber">2000</p>
                                            <div class="line"></div>
                                        </div>
                                        <div class="axis">
                                            <p class="namber">500</p>
                                            <div class="line"></div>
                                        </div>
                                        <div class="axis">
                                            <p class="namber">0</p>
                                            <div class="line"></div>
                                        </div>
                                    </div>
                                </main>
                                
                            
                            </div>

                            <div class="card card__gauge">
                                <header class="card--header">
                                    <p class="card--title">Pourcentage de Vente</p>
                                </header>
                                <main class="gauge-chart--wrapper">
                                    <div class="gauge-chart">
                                        <svg class="gauge-chart--circles" viewBox="0 0 250 250">
                                            <circle class="gauge-chart--back" style="fill:none;stroke-width:23.8095"
                                                cx="121.04727" cy="126.98376" r="107.14255" StrockWidth="24"
                                                Radius="120" InnerRadius="108" id="circle880" />
                                            <circle class="gauge-chart--cc"
                                                style="fill:none;stroke-width:31.7459;stroke-linecap:round;stroke-miterlimit:4;stroke-dasharray:648.263, 648.263;stroke-dashoffset:248.015"
                                                cx="-126.98376" cy="121.04727" r="107.14255" StrockWidth="32"
                                                Radius="120" InnerRadius="104" Circumference="653.451271947"
                                                Arc="653.451271947" DashArray="653.451271947,653.451271947"
                                                transform="rotate(-90)" help="251.327412287" id="circle882" />
                                            <circle class="gauge-chart--exam"
                                                style="fill:none;stroke-width:39.6824;stroke-linecap:round;stroke-miterlimit:4;stroke-dasharray:623.331, 623.331;stroke-dashoffset:373.998;stroke-opacity:1"
                                                cx="-126.98376" cy="121.04727" r="107.14255" StrockWidth="40"
                                                Radius="120" InnerRadius="100" Circumference="628.318530718"
                                                Arc="628.318530718" DashArray="628.318530718,628.318530718"
                                                transform="rotate(-90)" id="circle884" />
                                        </svg>

                                        <p class="score score__large">
                                            63.5<span class="score--total">%</span>
                                        </p>
                                    </div>
                                    <div class="gauge-chart--info-wrapper">
                                        <div class="chart--info">
                                            <div class="chart--info-circle"></div>
                                            <p>Vendu</p>
                                        </div>
                                        <div class="chart--info">
                                            <div class="chart--info-circle"></div>
                                            <p>Pas encore</p>
                                        </div>
                                    </div>

                                </main>
                            </div>
                        </div>
                       
                    </div>
                  
                    
                </div>
           
                <div class="tab tab__courses">
                    <div class="tab--container">
                        <div class="photo-grid">
                            <div class="photo-grid--item">
                                <div class="photo-grid--item-image">
                                    <img src="img/ticket.jpg" alt="Image 1">
                                </div>
                                <div class="photo-grid--item-title">Evenement 01</br><div class="NameOrg">Nom de L'org :</div></div>
                            </div>
                            <div class="photo-grid--item">
                                <div class="photo-grid--item-image">
                                    <img src="img/ticket.jpg" alt="Image 2">
                                </div>
                                <div class="photo-grid--item-title">Evenement 02</br> <div class="NameOrg">Nom de L'org :</div></div>
                            </div>
                            <div class="photo-grid--item">
                                <div class="photo-grid--item-image">
                                    <img src="img/ticket.jpg" alt="Image 3">
                                </div>
                                <div class="photo-grid--item-title">Evenement 03</br><div class="NameOrg">Nom de L'org :</div></div>
                            </div>
                            <div class="photo-grid--item">
                                <div class="photo-grid--item-image">
                                    <img src="img/ticket.jpg" alt="Image 4">
                                </div>
                                <div class="photo-grid--item-title">Evenement 04 </br><div class="NameOrg">Nom de L'org :</div></div>
                            </div>
                            <div class="photo-grid--item">
                                <div class="photo-grid--item-image">
                                    <img src="img/ticket.jpg" alt="Image 5">
                                </div>
                                <div class="photo-grid--item-title">Evenement 05</br><div class="NameOrg">Nom de L'org :</div></div>
                            </div>
                            <div class="photo-grid--item">
                                <div class="photo-grid--item-image">
                                    <img src="img/ticket.jpg" alt="Image 6">
                                </div>
                                <div class="photo-grid--item-title">Evenement 06</br><div class="NameOrg">Nom de L'org :</div></div>
                            </div>
                            <!-- Ajoutez autant d'éléments de grille de photos que nécessaire -->
                        </div>
                    </div>
                </div>
            
                <div class="tab tab__schedules">
                    <div class="tab--container"></div>
                </div>
                <div class="tab tab__clients">
                    <!-- Tab content for "Nos Clients" -->
                    <div class="tab--container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Suppression</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
    // Se connecter à la base de données (remplacez les valeurs par vos propres informations de connexion)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "myticket";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion à la base de données
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    // Vérifier si le formulaire de suppression a été soumis
    if(isset($_POST['supprimer'])) {
        $id = $_POST['supprimer'];

        // Supprimer le client correspondant à l'ID
       $sql_delete = "DELETE FROM client WHERE ID_Client = '$id'";
        if ($conn->query($sql_delete) === TRUE) {
            echo "Le compte client a été supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression du compte client : " . $conn->error;
        }
    }

    // Récupérer les données des clients depuis la table "client"
    $sql = "SELECT ID_Client , Nom_Client, Prénom_Client, Password_Client, Email_Client, Numero_Telephone FROM client";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Nom_Client"] . "</td>";
            echo "<td>" . $row["Prénom_Client"] . "</td>";
       
            echo "<td>" . $row["Email_Client"] . "</td>";
            echo "<td>" . $row["Numero_Telephone"] . "</td>";
            

            echo "<td>
                    <form method='post' action=''>
                        <input type='hidden' name='supprimer' value='" . $row["ID_Client"] . "'>
                        <button class='supp' type='submit'>Supprimer le compte</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "Aucun client trouvé.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab tab__organizers">









                    <!-- Tab content for "Nos Organisateurs" -->
                    <div class="tab--container">
                      <table>
                        <thead>
        <tr>
            <th>Nom</th>
            <th>compte bancaire</th>
            <th>Email</th>
            <th>Registre Commerce</th>
            <th>Approuver</th>
        </tr>
        </thead>
        <tbody>
        <?php
// Connexion à la base de données
$conn = mysqli_connect('localhost', 'root', '', 'myticket');

if (!$conn) {
    die("Connexion échouée: " . mysqli_connect_error());
}

// Récupération des organisateurs en attente d'approbation
$sql = "SELECT * FROM organisateur WHERE Approuve_Org = '0'";
$result = mysqli_query($conn, $sql);

// Affichage des informations des organisateurs en attente
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["Nom_Org"] . "</td>";
        echo "<td>" . $row["Compte_Org"] . "</td>";
        echo "<td>" . $row["Email_Org"] . "</td>";
        echo '<td><img src="../img/' . $row["Registre_commerce_Org"] . '"></td>';
        echo '<td>
                <form action="" method="post">
                    <button class="Approuve" type="submit" name="approuver" value="' . $row["ID_Org"] . '">Approuver</button>
                    <button class="Refus" type="submit" name="refuser" value="' . $row["ID_Org"] . '">Refuser</button>
                </form>
            </td>';
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>Aucun organisateur en attente d'approbation</td></tr>";
}

// Traitement de l'appui sur le bouton "Approuver"
if (isset($_POST['approuver'])) {
    $id_org = $_POST['approuver'];

    // Mise à jour de la valeur "Approuve_Org" à 1 pour l'organisateur sélectionné
    $sql_update = "UPDATE organisateur SET Approuve_Org = '1' WHERE ID_Org = '$id_org'";
    if (mysqli_query($conn, $sql_update)) {
        echo "L'organisateur a été approuvé avec succès !";
    } else {
        echo "Erreur lors de l'approbation de l'organisateur : " . mysqli_error($conn);
    }
}

// Traitement de l'appui sur le bouton "Refuser"
if (isset($_POST['refuser'])) {
    $id_org = $_POST['refuser'];

    // Mise à jour du statut de l'organisateur à "Refusé"
    $sql_update = "UPDATE organisateur SET statut = 'Refusé' WHERE ID_Org = '$id_org'";
    if (mysqli_query($conn, $sql_update)) {
        echo "L'organisateur a été refusé avec succès !";
    } else {
        echo "Erreur lors du refus de l'organisateur : " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
</tbody>
    </table>
                        






<table>
                                <thead>
        <tr>
            <th>Nom</th>
            <th>compte bancaire</th>
            <th>Email</th>
            <th>supprimer</th>
        </tr>
        </thead>
        <tbody>
       <?php
// Se connecter à la base de données (remplacez les valeurs par vos propres informations de connexion)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myticket";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion à la base de données
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Vérifier si le formulaire de suppression a été soumis
if (isset($_POST['supprimer'])) {
    $id = $_POST['supprimer'];

    // Supprimer les enregistrements liés dans la table "commande"
    $sql_delete_commande = "DELETE FROM commande WHERE ID_Event IN (SELECT ID_Event FROM evenements WHERE ID_Org = '$id')";
    if ($conn->query($sql_delete_commande) === TRUE) {
        // Supprimer l'événement correspondant à l'ID
        $sql_delete_event = "DELETE FROM evenements WHERE ID_Org = '$id'";
        if ($conn->query($sql_delete_event) === TRUE) {
            // Supprimer l'organisateur correspondant à l'ID
            $sql_delete_org = "DELETE FROM organisateur WHERE ID_Org = '$id'";
            if ($conn->query($sql_delete_org) === TRUE) {
                echo "Le compte organisateur a été supprimé avec succès.";
            } else {
                echo "Erreur lors de la suppression du compte organisateur : " . $conn->error;
            }
        } else {
            echo "Erreur lors de la suppression de l'événement : " . $conn->error;
        }
    } else {
        echo "Erreur lors de la suppression des enregistrements liés : " . $conn->error;
    }
}

// Récupérer les données des clients depuis la table "client"
$sql = "SELECT ID_Org, Nom_Org, Email_Org, Compte_Org FROM organisateur";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Nom_Org"] . "</td>";
        echo "<td>" . $row["Compte_Org"] . "</td>";

        echo "<td>" . $row["Email_Org"] . "</td>";

        echo "<td>
                <form method='post' action=''>
                    <input type='hidden' name='supprimer' value='" . $row["ID_Org"] . "'>
                    <button class='supp' type='submit'>Supprimer le compte</button>
                </form>
              </td>";
        echo "</tr>";
    }
} else {
    echo "Aucun client trouvé.";
}

// Fermer la connexion à la base de données
$conn->close();
?>

</tbody>
    </table>  
                    </div>
         
                </div>
            </main>
        </div>
    </div>
</body>

</html>
            </main>
        </div>
    </div>
</body>

</html>