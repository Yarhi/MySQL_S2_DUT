<?php
  include('../data/connexion_bdd.php');
  
  $table=$_GET['table'];

  if ($table=="ADHERENT") {
   $req_update = "INSERT INTO ADHERENT VALUES('','".$_GET['li_add2']."','".$_GET['li_add3']."','".$_GET['li_add4']."');";
   echo $req_update;
   $pdo -> exec($req_update);
   header('Location: ../../index.php?table='.$table);
   exit;
  }

  if ($table=="EMPRUNT") {
    $pdo->exec("UPDATE EMPRUNT set dateRendu=NULL where dateRendu='0000-00-00';");
    if ($_GET['li_add5']=='') $dateRendu='NULL';
    else $dateRendu = $_GET['li_add5'];
    $req_update = "INSERT INTO EMPRUNT VALUES('','".$_GET['li_add2']."','".$_GET['li_add3']."','".$_GET['li_add4']."','".$dateRendu."');";
  //$req_update = "INSERT INTO EMPRUNT SELECT '',ADHERENT.idAdherent,EXEMPLAIRE.noExemplaire,'".$_GET['li_add4']."','".$_GET['li_add5']."' FROM ADHERENT , EXEMPLAIRE , OEUVRE WHERE OEUVRE.titre = '".$_GET['li_add3']."' and EXEMPLAIRE.noOeuvre = OEUVRE.noOeuvre and nomAdherent = '".$_GET['li_add2']."';";
   $req_verif_nb_emprunt = "SELECT count(dateEmprunt)-count(dateRendu) as nb_emprunt from EMPRUNT where idAdherent='".$_GET['li_add2']."';";
    echo $req_verif_nb_emprunt;
    echo $req_update;
    $rep_verif = $pdo->query($req_verif_nb_emprunt);
    $rep_verif = $rep_verif->fetch();
    echo $rep_verif['nb_emprunt'];
    if ($rep_verif['nb_emprunt']<5) {
      $pdo -> exec($req_update);
      echo "Possible !";
      header('Location: ../../index.php?table='.$table);
      exit;
    }else{
      header('Location: ../../index.php?table='.$table."&error=nb_emprunt");
    }
  }

  if ($table=="OEUVRE") {
  $req_update = "INSERT INTO OEUVRE VALUES('','".$_GET['li_add2']."','".$_GET['li_add3']."','".$_GET['li_add4']."');";
    //$req_update = "INSERT INTO OEUVRE SELECT '',AUTEUR.idAuteur,'".$_GET['li_add3']."','".$_GET['li_add4']."' FROM AUTEUR,OEUVRE WHERE AUTEUR.nomAuteur = '".$_GET['li_add2']."' and AUTEUR.prenomAuteur = '".$_GET['li_add1']."' LIMIT 1,1;";
   echo $req_update;
   $pdo -> exec($req_update);
   header('Location: ../../index.php?table='.$table);
   exit;
  }

  if ($table=="AUTEUR") {
  $req_update = "INSERT INTO AUTEUR VALUES('','".$_GET['li_add2']."','".$_GET['li_add3']."');";
   echo $req_update;
   $pdo -> exec($req_update);
   header('Location: ../../index.php?table='.$table);
   exit;
  }

  if ($table=="EXEMPLAIRE") { 
  $req_update = "INSERT INTO EXEMPLAIRE VALUES('','".$_GET['li_add2']."','".$_GET['li_add3']."','".$_GET['li_add4']."','".$_GET['li_add5']."');"; 
   echo $req_update;
   $pdo -> exec($req_update);
   header('Location: ../../index.php?table='.$table);
   exit;
  }

  
//SELECT TABLE_NAME, COLUMN_NAME, CONSTRAINT_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE REFERENCED_TABLE_NAME = 'auteur';
?>