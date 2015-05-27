<?php
  include('connexion_bdd.php');
  
  $table=$_GET['table'];

  if ($table=="ADHERENT") {
  	$req_update = "UPDATE ADHERENT SET nomAdherent='".$_GET['li1']."',adresse='".$_GET['li2']."',datePaiement='".$_GET['li3']."' WHERE idAdherent=".$_GET['li0']."; ";
  	echo $req_update;
  	$pdo -> exec($req_update);
  	header('Location: ../index.php?table='.$table);
  	exit;
  }

  if ($table=="EMPRUNT") {
 	$req_update = "UPDATE EMPRUNT SET idAdherent='".$_GET['li1']."',noExemplaire='".$_GET['li2']."',dateEmprunt='".$_GET['li3']."',dateRendu='".$_GET['li4']."' WHERE idEmprunt=".$_GET['li0']."; ";
  	echo $req_update;
  	$pdo -> exec($req_update);
  	header('Location: ../index.php?table='.$table);
  	exit;
  }

  if ($table=="OEUVRE") {
 	$req_update = "UPDATE OEUVRE SET idAuteur='".$_GET['li1']."',titre='".$_GET['li2']."',dateParution='".$_GET['li3']."' WHERE noOeuvre=".$_GET['li0']."; ";
  	echo $req_update;
  	$pdo -> exec($req_update);
  	header('Location: ../index.php?table='.$table);
  	exit;
  }

  if ($table=="AUTEUR") {
 	$req_update = "UPDATE AUTEUR SET nomAuteur='".$_GET['li1']."',prenomAuteur='".$_GET['li2']."' WHERE idAuteur=".$_GET['li0']."; ";
  	echo $req_update;
  	$pdo -> exec($req_update);
  	header('Location: ../index.php?table='.$table);
  	exit;
  }

  if ($table=="EXEMPLAIRE") {
 	$req_update = "UPDATE EXEMPLAIRE SET etat='".$_GET['li1']."',dateAchat='".$_GET['li2']."',prix='".$_GET['li3']."',noOeuvre='".$_GET['li4']."' WHERE noExemplaire=".$_GET['li0']."; ";
  	echo $req_update;
  	$pdo -> exec($req_update);
  	header('Location: ../index.php?table='.$table);
  	exit;
  }

  
//SELECT TABLE_NAME, COLUMN_NAME, CONSTRAINT_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_NAME = 'auteur';
//SELECT count(EMPRUNT.idAdherent),ADHERENT.nomAdherent FROM EMPRUNT,ADHERENT WHERE ADHERENT.idAdherent=EMPRUNT.idAdherent GROUP BY EMPRUNT.idAdherent;


?>