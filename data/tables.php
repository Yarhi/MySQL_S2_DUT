<?php
  /***
  récupération des données du nombre de colonnes de toutes les tables
  ***/

  //REQUÊTE
  $req_adherent = "SELECT * FROM ADHERENT";  
  $req_emprunt = "SELECT * FROM EMPRUNT";  
  $req_oeuvre = "SELECT * FROM OEUVRE";  
  $req_auteur = "SELECT * FROM AUTEUR";  
  $req_exemplaire = "SELECT * FROM EXEMPLAIRE";  

  //PDO QUERY
  $req_adherent = $pdo->query($req_adherent);
  $req_emprunt = $pdo->query($req_emprunt);
  $req_oeuvre = $pdo->query($req_oeuvre);
  $req_auteur = $pdo->query($req_auteur);
  $req_exemplaire = $pdo->query($req_exemplaire);

  $req_count_adherent = $pdo->query("SELECT COUNT(*) as nb_li FROM ADHERENT");
  $req_count_emprunt = $pdo->query("SELECT COUNT(*) as nb_li FROM EMPRUNT");
  $req_count_oeuvre = $pdo->query("SELECT COUNT(*) as nb_li FROM OEUVRE");
  $req_count_auteur = $pdo->query("SELECT COUNT(*) as nb_li FROM AUTEUR");
  $req_count_exemplaire = $pdo->query("SELECT COUNT(*) as nb_li FROM EXEMPLAIRE");

  $count_adherent = $req_count_adherent->fetch();
  $count_emprunt = $req_count_emprunt->fetch();
  $count_oeuvre = $req_count_oeuvre->fetch();
  $count_auteur = $req_count_auteur->fetch();
  $count_exemplaire = $req_count_exemplaire->fetch();

  $count_adherent = $count_adherent['nb_li'];
  $count_emprunt = $count_emprunt['nb_li'];
  $count_oeuvre = $count_oeuvre['nb_li'];
  $count_auteur = $count_auteur['nb_li'];
  $count_exemplaire = $count_exemplaire['nb_li'];


  //récupération du nom des colonnes dans un tableau

  $adherent_t = array('');
  $emprunt_t = array('');
  $oeuvre_t = array('');
  $auteur_t = array('');
  $exemplaire_t = array('');

  for ($i=0; $i <$req_adherent->columnCount() ; $i++) { 
    $meta = $req_adherent->getColumnMeta($i);
    array_push($adherent_t,$meta['name']);
    //echo $adherent_t[$i]." ";
  }
  //echo "<br/>";
  for ($i=0; $i <$req_emprunt->columnCount() ; $i++) { 
    $meta = $req_emprunt->getColumnMeta($i);
    array_push($emprunt_t,$meta['name']);
    //echo $emprunt_t[$i]." ";
  }
  //echo "<br/>";
  for ($i=0; $i <$req_oeuvre->columnCount() ; $i++) { 
    $meta = $req_oeuvre->getColumnMeta($i);
    array_push($oeuvre_t,$meta['name']);
    //echo $oeuvre_t[$i]." ";
  }
  //echo "<br/>";
  for ($i=0; $i <$req_auteur->columnCount() ; $i++) { 
    $meta = $req_auteur->getColumnMeta($i);
    array_push($auteur_t,$meta['name']);
    //echo $auteur_t[$i]." ";
  }
  //echo "<br/>";
  for ($i=0; $i <$req_exemplaire->columnCount() ; $i++) { 
    $meta = $req_exemplaire->getColumnMeta($i);
    array_push($exemplaire_t,$meta['name']);
    //echo $exemplaire_t[$i]." ";
  }

  $nb_col_adherent = count($adherent_t)-1;
  $nb_col_emprunt = count($emprunt_t)-1;
  $nb_col_oeuvre = count($oeuvre_t)-1;
  $nb_col_auteur = count($auteur_t)-1;
  $nb_col_exemplaire = count($exemplaire_t)-1;

?>