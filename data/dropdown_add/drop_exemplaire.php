<?php
	include('../connexion_bdd.php');
	$req_str = "SELECT titre,noOeuvre FROM OEUVRE";
	$req = $pdo->query($req_str);
	$req->fetch();
	echo "<select id='dropdown' name='li_add5' id='dropdown_emprunt' class='btn'>";
	echo "<option value='1'>le retour de Poirot</option>";
	foreach ($req as $key) {
		echo "<option value='".$key['noOeuvre']."'>".$key['titre']."</option>";
	}
	echo "</select>";
?>