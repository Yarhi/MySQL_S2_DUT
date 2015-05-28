<?php
  include('connexion_bdd.php');
  
  $table=$_GET['table'];

  if ($table=="ADHERENT") {
  	$req_update = "UPDATE ADHERENT SET nomAdherent='".$_GET['li_add2']."',adresse='".$_GET['li_add3']."',datePaiement='".$_GET['li_add4']."' WHERE idAdherent=".$_GET['li_add1']."; ";
  	echo $req_update;
  	$pdo -> exec($req_update);
  	header('Location: ../index.php?table='.$table);
  	exit;
  }

  if ($table=="EMPRUNT") {
 	$req_update = "UPDATE EMPRUNT SET idAdherent='".$_GET['li_edit2']."',noExemplaire='".$_GET['li_edit3']."',dateEmprunt='".$_GET['li_add4']."',dateRendu='".$_GET['li_add5']."' WHERE idEmprunt=".$_GET['li_add1']."; ";
  	echo $req_update;
  	$pdo -> exec($req_update);
  	header('Location: ../index.php?table='.$table);
  	exit;
  }

  if ($table=="OEUVRE") {
 	$req_update = "UPDATE OEUVRE SET idAuteur='".$_GET['li_edit2']."',titre='".$_GET['li_add3']."',dateParution='".$_GET['li_add4']."' WHERE noOeuvre=".$_GET['li_add1']."; ";
  	echo $req_update;
  	$pdo -> exec($req_update);
  	header('Location: ../index.php?table='.$table);
  	exit;
  }

  if ($table=="AUTEUR") {
 	$req_update = "UPDATE AUTEUR SET nomAuteur='".$_GET['li_add2']."',prenomAuteur='".$_GET['li_add3']."' WHERE idAuteur=".$_GET['li_add1']."; ";
  	echo $req_update;
  	$pdo -> exec($req_update);
  	header('Location: ../index.php?table='.$table);
  	exit;
  }

  if ($table=="EXEMPLAIRE") {
 	$req_update = "UPDATE EXEMPLAIRE SET etat='".$_GET['li_add2']."',dateAchat='".$_GET['li_add3']."',prix='".$_GET['li_add4']."',noOeuvre='".$_GET['li_edit5']."' WHERE noExemplaire=".$_GET['li_add1']."; ";
  	echo $req_update;
  	$pdo -> exec($req_update);
  	header('Location: ../index.php?table='.$table);
  	exit;
  }

  
//SELECT TABLE_NAME, COLUMN_NAME, CONSTRAINT_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_NAME = 'auteur';
//SELECT count(EMPRUNT.idAdherent),ADHERENT.nomAdherent FROM EMPRUNT,ADHERENT WHERE ADHERENT.idAdherent=EMPRUNT.idAdherent GROUP BY EMPRUNT.idAdherent;


?>