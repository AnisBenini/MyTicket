<?php
// Connecter à la base de données
$conn = mysqli_connect('localhost', 'root', '', 'myticket');
session_start();
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Récupérer l'ID de l'événement depuis la variable de session
if (isset($_SESSION['ID_Event']) && (isset($_SESSION['user_id']))) {
  $ID_Event = $_SESSION['ID_Event'];
  $id_client = $_SESSION['user_id'];

  // Récupérer la dernière ligne récemment ajoutée à la table "commande"
  $query = "SELECT * FROM commande WHERE ID_Event = '$ID_Event' ORDER BY Num_Commande DESC LIMIT 1";
  $result = $conn->query($query);

  if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Récupérer le nom de l'organisateur
    $id_organisateur = $_SESSION['id_organisateur'];
    $query_organisateur = "SELECT Nom_Org FROM organisateur WHERE ID_Org = '$id_organisateur'";
    $result_organisateur = $conn->query($query_organisateur);

    if ($result_organisateur && $result_organisateur->num_rows > 0) {
      $row_organisateur = $result_organisateur->fetch_assoc();
      $nom_organisateur = $row_organisateur['Nom_Org'];

      // Récupérer les informations sur l'événement
      $query_evenement = "SELECT nom_event, lieu_event, date_event FROM evenements WHERE ID_Event = '$ID_Event'";
      $result_evenement = $conn->query($query_evenement);

      if ($result_evenement && $result_evenement->num_rows > 0) {
        $row_evenement = $result_evenement->fetch_assoc();
        $nom_event = $row_evenement['nom_event'];
        $lieu_event = $row_evenement['lieu_event'];
        $date_event = $row_evenement['date_event'];
      }
    }
  }
                  $date_commande = $row['Date_Commande'];
                  $Num_Cart_id_client = $row['Num_Cart_id_client'];

          // Récupérer le nom et prénom du client à partir de la table "client"
          $query_client = "SELECT Nom_Client , Prénom_Client FROM client WHERE ID_Client = '$id_client'";
          $result_client = $conn->query($query_client);

          if ($result_client && $result_client->num_rows > 0) {
            $row_client = $result_client->fetch_assoc();
            $nom_client = $row_client['Nom_Client'];
            $prenom_client = $row_client['Prénom_Client'];
      }
}
// Afficher les informations récupérées
?>
<?php
require_once('TCPDF/tcpdf.php');

// Connecter à la base de données
$conn = mysqli_connect('localhost', 'root', '', 'myticket');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Récupérer l'ID de l'événement depuis la variable de session
if (isset($_SESSION['ID_Event']) && (isset($_SESSION['user_id']))) {
    $ID_Event = $_SESSION['ID_Event'];
    $id_client = $_SESSION['user_id'];

    // Récupérer la dernière ligne récemment ajoutée à la table "commande"
    $query = "SELECT * FROM commande WHERE ID_Event = '$ID_Event' ORDER BY Num_Commande DESC LIMIT 1";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Récupérer le nom de l'organisateur
        $id_organisateur = $_SESSION['id_organisateur'];
        $query_organisateur = "SELECT Nom_Org FROM organisateur WHERE ID_Org = '$id_organisateur'";
        $result_organisateur = $conn->query($query_organisateur);

        if ($result_organisateur && $result_organisateur->num_rows > 0) {
            $row_organisateur = $result_organisateur->fetch_assoc();
            $nom_organisateur = $row_organisateur['Nom_Org'];

            // Récupérer les informations sur l'événement
            $query_evenement = "SELECT nom_event, lieu_event, date_event FROM evenements WHERE ID_Event = '$ID_Event'";
            $result_evenement = $conn->query($query_evenement);

            if ($result_evenement && $result_evenement->num_rows > 0) {
                $row_evenement = $result_evenement->fetch_assoc();
                $nom_event = $row_evenement['nom_event'];
                $lieu_event = $row_evenement['lieu_event'];
                $date_event = $row_evenement['date_event'];
            }
        }
    }

    $date_commande = $row['Date_Commande'];
    $Num_Cart_id_client = $row['Num_Cart_id_client'];
    $Nom_Prénom = $row['Nom_Prénom'];

    // Récupérer le nom et prénom du client à partir de la table "client"
    $query_client = "SELECT Nom_Client , Prénom_Client FROM client WHERE ID_Client = '$id_client'";
    $result_client = $conn->query($query_client);

    if ($result_client && $result_client->num_rows > 0) {
        $row_client = $result_client->fetch_assoc();
        $nom_client = $row_client['Nom_Client'];
        $prenom_client = $row_client['Prénom_Client'];
    }
}

// Générer le fichier PDF
if (isset($_POST['submit'])) {
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// En-tête du document PDF
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('MyTicket');
$pdf->SetTitle('Votre Ticket');
$pdf->SetHeaderData('', 0, 'Votre Ticket', '', array(0, 0, 0), array(255, 255, 255));
$pdf->setHeaderFont(array('helvetica', '', 12));
$pdf->setFooterFont(array('helvetica', '', 8));

// Ajouter une page
$pdf->AddPage();

// Tableau de la commande
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Commande', 0, 1, 'L');
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(50, 10, 'Numéro commande:', 0, 0, 'L');
$pdf->Cell(0, 10, $row['Num_Commande'], 0, 1, 'L');
$pdf->Cell(50, 10, 'Date de commande:', 0, 0, 'L');
$pdf->Cell(0, 10, $date_commande, 0, 1, 'L');

// Tableau de l'événement
$pdf->Ln(10);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Événement', 0, 1, 'L');
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(50, 10, 'Nom de l\'événement:', 0, 0, 'L');
$pdf->Cell(0, 10, $nom_event, 0, 1, 'L');
$pdf->Cell(50, 10, 'Lieu de l\'événement:', 0, 0, 'L');
$pdf->Cell(0, 10, $lieu_event, 0, 1, 'L');
$pdf->Cell(50, 10, 'Date de l\'événement:', 0, 0, 'L');
$pdf->Cell(0, 10, $date_event, 0, 1, 'L');

// Tableau du personnel
$pdf->Ln(10);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Personnel', 0, 1, 'L');
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(50, 10, 'Organisateur:', 0, 0, 'L');
$pdf->Cell(0, 10, $nom_organisateur, 0, 1, 'L');
$pdf->Cell(50, 10, 'ID Organisateur:', 0, 0, 'L');
$pdf->Cell(0, 10, $id_organisateur, 0, 1, 'L');
$pdf->Cell(50, 10, 'ID Client:', 0, 0, 'L');
$pdf->Cell(0, 10, $id_client, 0, 1, 'L');
$pdf->Cell(50, 10, 'Nom du client:', 0, 0, 'L');
$pdf->Cell(0, 10, $nom_client . ' ' . $prenom_client, 0, 1, 'L');
$pdf->Cell(50, 10, 'Numéro carte nationale:', 0, 0, 'L');
$pdf->Cell(0, 10, $Num_Cart_id_client, 0, 1, 'L');
$pdf->Cell(50, 10, 'Nom & Prenom:', 0, 0, 'L');
$pdf->Cell(0, 10, $Nom_Prénom, 0, 1, 'L');

// Générer le fichier PDF
$pdf->Output('ticket.pdf', 'D');
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
  <link rel="stylesheet" href="../styles/stylerecus.css">
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
        <div class="form-group">
          <h1 style="text-align: center; color: var(--header-background-color-);">Votre Recus</h1>
        </div>
        <div class="form-group" style="text-align: center;">
          <h2>Numero commande :<p> <?php echo $row['Num_Commande']; ?></p></h2>
          <h2>Organisateur : <p><?php echo $nom_organisateur; ?></p></h2>
          <h2>ID Organisateur : <p><?php echo $id_organisateur; ?></p></h2>
          <h2>ID Client : <p><?php echo $id_client; ?></p></h2>
          <h2>Nom de l'événement : <p><?php echo $nom_event; ?></p></h2>
          <h2>Lieu de l'événement : <p><?php echo $lieu_event; ?></p></h2>
          <h2>Date de l'événement : <p><?php echo $date_event; ?></p></h2>

            <h2>Date de commande :<p><?php echo $date_commande ; ?></h2> 
            <h2>Nom du client : <p><?php echo $nom_client . " " . $prenom_client;  ?></h2> 
              <h2>numero carte nationalle :<p><?php echo $Num_Cart_id_client ; ?></h2>
              <h2>nom & prenom :<p><?php echo $Nom_Prénom ; ?></h2>
        </div>

        <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
          <div class="form-group" style="text-align: center;">
            <button type="submit" name="submit">imprimer mon ticket</button>
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
