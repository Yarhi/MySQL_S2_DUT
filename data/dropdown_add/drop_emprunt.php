<?php
	include('../connexion_bdd.php');
	$req_str = "SELECT idAdherent,nomAdherent FROM adherent";
	$req = $pdo->query($req_str);
	$req->fetch();
	echo "<select id='dropdown' name='li_add2' id='dropdown_emprunt' class='btn'>";
	echo "<option value='1'>millet</option>";
	foreach ($req as $key) {
		echo "<option value='".$key['idAdherent']."'>".$key['nomAdherent']."</option>";
	}
	echo "</select>";
?>
<label for="recipient-name" class="control-label">Exemplaire</label>
<?php
	$req_str = "SELECT EXEMPLAIRE.noExemplaire,OEUVRE.noOeuvre,OEUVRE.titre FROM EXEMPLAIRE,OEUVRE,EMPRUNT WHERE OEUVRE.noOeuvre = EXEMPLAIRE.noOeuvre AND EMPRUNT.noExemplaire=EXEMPLAIRE.noExemplaire and EMPRUNT.dateRendu!='null' ";
	$req = $pdo->query($req_str);
	$req->fetch();
	echo "<select id='dropdown' name='li_add3' id='dropdown_emprunt' class='btn'>";
	echo "<option value='1'>(1)le retour de Poirot</option>";
	foreach ($req as $key) {
		echo "<option value='".$key['noExemplaire']."'>(".$key['noExemplaire'].")".$key['titre']."</option>";
	}
	echo "</select>";
?>