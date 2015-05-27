<?php
  include('connexion_bdd.php');
  
  $table=$_GET['table'];

  if ($table=="ADHERENT") {
    try {
      $req_delete = "DELETE FROM ADHERENT WHERE idAdherent=".$_GET['id'];

    	echo $req_delete;
    	$pdo -> exec($req_delete);
    	header('Location: ../index.php?table='.$table);
    	exit;
    } catch (Exception $e) {
      header('Location: ../index.php?table='.$table."&erreur=".$table);
    }
  }

  if ($table=="EMPRUNT") {
    try {
      $req_delete = "DELETE FROM EMPRUNT WHERE idEmprunt=".$_GET['id'];
    
    	echo $req_delete;
    	$pdo -> exec($req_delete);
    	header('Location: ../index.php?table='.$table);
    	exit;
    } catch (Exception $e) {
      header('Location: ../index.php?table='.$table."&erreur=".$table);
    }
  }

  if ($table=="OEUVRE") {
    try {
      $req_delete = "DELETE FROM OEUVRE WHERE noOeuvre=".$_GET['id'];

    	echo $req_delete;
    	$pdo -> exec($req_delete);
    	header('Location: ../index.php?table='.$table);
    	exit;
    } catch (Exception $e) {
      header('Location: ../index.php?table='.$table."&erreur=".$table);
    }
  }

  if ($table=="AUTEUR") {
    try {
      $req_delete = "DELETE FROM AUTEUR WHERE idAuteur=".$_GET['id'];

    	echo $req_delete;
    	$pdo -> exec($req_delete);
    	header('Location: ../index.php?table='.$table);
    	exit;
    } catch (Exception $e) {
      header('Location: ../index.php?table='.$table."&erreur=".$table);
    }
  }

  if ($table=="EXEMPLAIRE") {
    try {
      $req_delete = "DELETE FROM EXEMPLAIRE WHERE noExemplaire=".$_GET['id'];

    	echo $req_delete;
    	$pdo -> exec($req_delete);
    	header('Location: ../index.php?table='.$table);
    	exit;
    } catch (Exception $e) {
      header('Location: ../index.php?table='.$table."&erreur=".$table);
    }
  }
?>