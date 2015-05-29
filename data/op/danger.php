<?php
	include('../data/connexion_bdd.php');
	$req_danger = "SELECT EMPRUNT.idEmprunt,ADHERENT.nomAdherent,DATEDIFF(CURRENT_DATE,dateEmprunt) as nb_jours FROM EMPRUNT,ADHERENT WHERE  ADHERENT.idAdherent = EMPRUNT.idAdherent and DATEDIFF(CURRENT_DATE,dateEmprunt)>30 and dateRendu is NULL GROUP BY idEmprunt;";
	$req_danger = $pdo->query($req_danger);
	$rep_danger = $req_danger->fetchAll();

	foreach ($rep_danger as $key) {
		echo 'L\'adherent <span style="color:red;">'.$key['nomAdherent']."</span> possède un emprunt depuis <span style='color:red;'>".$key['nb_jours']."</span> jours.<br/>";
	}
?>