<?php
	include('../connexion_bdd.php');
	$req_str = "SELECT idAuteur,prenomAuteur,nomAuteur FROM auteur";
	$req = $pdo->query($req_str);
	$req->fetch();
	echo "<select id='dropdown' name='li_add2' id='dropdown_emprunt' class='btn'>";
	echo "<option value='1'>Christie agatha</option>";
	foreach ($req as $key) {
		echo "<option value='".$key['idAuteur']."'>".$key['prenomAuteur']." ".$key['nomAuteur']."</option>";
	}
	echo "</select>";
?>