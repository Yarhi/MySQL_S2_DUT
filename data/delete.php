<?php
  include('connexion_bdd.php');
  
  $table=$_GET['table'];

  if ($table=="ADHERENT") {
    $req_delete = "DELETE FROM ADHERENT WHERE idAdherent=".$_GET['id'];

  	echo $req_delete;
  	$pdo -> exec($req_delete);
  	header('Location: ../index.php?table='.$table);
  	exit;
  }

  if ($table=="EMPRUNT") {
    $req_delete = "DELETE FROM EMPRUNT WHERE idEmprunt=".$_GET['id'];
  
  	echo $req_delete;
  	$pdo -> exec($req_delete);
  	header('Location: ../index.php?table='.$table);
  	exit;
  }

  if ($table=="OEUVRE") {
    $req_delete = "DELETE FROM OEUVRE WHERE noOeuvre=".$_GET['id'];

  	echo $req_delete;
  	$pdo -> exec($req_delete);
  	header('Location: ../index.php?table='.$table);
  	exit;
  }

  if ($table=="AUTEUR") {
    $req_delete = "DELETE FROM AUTEUR WHERE idAuteur=".$_GET['id'];

  	echo $req_delete;
  	$pdo -> exec($req_delete);
  	header('Location: ../index.php?table='.$table);
  	exit;
  }

  if ($table=="EXEMPLAIRE") {
    $req_delete = "DELETE FROM EXEMPLAIRE WHERE noExemplaire=".$_GET['id'];

  	echo $req_delete;
  	$pdo -> exec($req_delete);
  	header('Location: ../index.php?table='.$table);
  	exit;
  }
?>