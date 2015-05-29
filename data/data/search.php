<?php
	$table = $_GET['table'];
	include('../data/connexion_bdd.php');
	if($table=="ADHERENT"){
		$req_str = "SELECT ".$_GET['data']." FROM ADHERENT WHERE ".$_GET['data']." LIKE ('".$_GET['search']."%') GROUP BY ".$_GET['data'].";";
	}
	else if($table=="EMPRUNT"){
		if($_GET['data']=="nomAdherent"){
			$req_str = "SELECT ADHERENT.nomAdherent FROM ADHERENT,EMPRUNT WHERE ADHERENT.idAdherent = EMPRUNT.idAdherent and nomAdherent like '".$_GET['search']."%' GROUP BY nomAdherent;";
		}else if($_GET['data']=="titre"){
			$req_str = "SELECT oeuvre.titre FROM OEUVRE,EXEMPLAIRE,EMPRUNT WHERE OEUVRE.noOeuvre = EXEMPLAIRE.noOeuvre and EXEMPLAIRE.noExemplaire = EMPRUNT.noExemplaire and OEUVRE.titre like '".$_GET['search']."%' GROUP BY titre;";
		}else{
			$req_str = "SELECT ".$_GET['data']." FROM ".$_GET['table']." WHERE ".$_GET['data']." LIKE ('".$_GET['search']."%') GROUP BY ".$_GET['data'].";";
		}
	}else if($table=="OEUVRE"){
		if($_GET['data']=="prenomAuteur"){
			$req_str="SELECT AUTEUR.prenomAuteur FROM AUTEUR,OEUVRE WHERE OEUVRE.idAuteur = AUTEUR.idAuteur and AUTEUR.prenomAuteur!='' and AUTEUR.prenomAuteur like '".$_GET['search']."%' GROUP BY prenomAuteur;";
		}else if ($_GET['data']=="nomAuteur"){
			$req_str="SELECT AUTEUR.nomAuteur FROM AUTEUR,OEUVRE WHERE OEUVRE.idAuteur = AUTEUR.idAuteur and AUTEUR.nomAuteur!='' and AUTEUR.nomAuteur like '".$_GET['search']."%' GROUP BY nomAuteur;";
		}else{
			$req_str = "SELECT ".$_GET['data']." FROM ".$_GET['table']." WHERE ".$_GET['data']." LIKE ('".$_GET['search']."%') GROUP BY ".$_GET['data'].";";
		}
	}else if ($table=="AUTEUR") {
		$req_str = "SELECT ".$_GET['data']." FROM ".$_GET['table']." WHERE ".$_GET['data']." LIKE ('".$_GET['search']."%') GROUP BY ".$_GET['data'].";";
	}else if($table=="EXEMPLAIRE"){
		if($_GET['data']=="titre"){
			$req_str = "SELECT OEUVRE.titre FROM OEUVRE,EXEMPLAIRE WHERE OEUVRE.noOeuvre = EXEMPLAIRE.noOeuvre and OEUVRE.titre like '".$_GET['search']."%' GROUP BY titre;";
		}else{
			$req_str = "SELECT ".$_GET['data']." FROM ".$_GET['table']." WHERE ".$_GET['data']." LIKE ('".$_GET['search']."%') GROUP BY ".$_GET['data'].";";
		}
	}else{
		$req_str = "SELECT ".$_GET['data']." FROM ".$_GET['table']." WHERE ".$_GET['data']." LIKE ('".$_GET['search']."%') GROUP BY ".$_GET['data'].";";
	}





	try{
		$rep_str = $pdo->query($req_str);
		$rep_str = $rep_str->fetchAll();
	}catch(PDOException $e){
		echo "Erreur : ".$e->getMessage();
	}


	foreach ($rep_str as $key) {
		echo "<a id='autocomplement' onclick='change_value_search(\"".$key[$_GET['data']]."\")'>".$key[$_GET['data']]."</a><br/>";
	}
		
?>