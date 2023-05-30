<!DOCTYPE html>
<html>
<head>
	<title>Page d'approbation</title>
	<link rel="stylesheet" href="admin.css">
</head>
<body>

	<h1>Liste des organisateurs en attente d'approbation :</h1>

	<table>
		<tr>
			<th>Nom</th>
			<th>Email</th>
			<th>Registre Commerce</th>
			<th>Approuver</th>
		</tr>
		
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
			    while($row = mysqli_fetch_assoc($result)) {
			        echo "<tr>";
			        echo "<td>" . $row["Nom_Org"] . "</td>";
			        echo "<td>" . $row["Email_Org"] . "</td>";
			        echo '<td><img src="img/' . $row["Registre_commerce_Org"] . '"></td>';





			        echo '<td><form action="" method="post"><button type="submit" name="approuver" value="' . $row["ID_Org"] . '">Approuver</button></form></td>';
			        echo "</tr>";
			    }
			} else {
			    echo "<tr><td colspan='5'>Aucun organisateur en attente d'approbation</td></tr>";
			}

			// Traitement de l'appui sur le bouton "Approuver"
			if (isset($_POST['approuver'])) {
				$id_org = $_POST['approuver'];

				// Mise à jour de la valeur "Approuve_Org" à 1 pour l'organisateur sélectionné
				$sql_update = "UPDATE organisateur SET Approuve_Org = '1' WHERE Id_Org = '$id_org'";
				if (mysqli_query($conn, $sql_update)) {
					echo "L'organisateur a été approuvé avec succès !";
				} else {
					echo "Erreur lors de l'approbation de l'organisateur : " . mysqli_error($conn);
				}
			}

			mysqli_close($conn);
		?>
	</table>

</body>
</html>
