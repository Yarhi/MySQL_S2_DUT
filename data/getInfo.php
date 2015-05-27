<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="ModalLabel_title_del">Informations</h4>
</div>
<div class="modal-body">
<?php
    include('connexion_bdd.php');
    //POUR TABLE ADHERENT
    if($_GET['table']=="ADHERENT"){
    	$req_info_str = "SELECT count(EMPRUNT.idAdherent) as nb_emprunt,ADHERENT.nomAdherent FROM EMPRUNT,ADHERENT WHERE ADHERENT.idAdherent=EMPRUNT.idAdherent AND ADHERENT.idAdherent=".$_GET['id']." GROUP BY EMPRUNT.idAdherent;";
        $req_info = $pdo->query($req_info_str);
        $rep_info = $req_info->fetch();
        if($rep_info['nb_emprunt']==""){
            echo "Aucun emprunt pour l'adherent sélectionné.";
        }
        else{
            echo "Nombre d'emprunts de l'adherent ".$rep_info['nomAdherent']." : ".$rep_info['nb_emprunt']."<br/><br/>";
    
    
    
        	$req_info = "SELECT ADHERENT.nomAdherent,EMPRUNT.dateEmprunt,EMPRUNT.dateRendu, EMPRUNT.idAdherent,EXEMPLAIRE.noOeuvre,OEUVRE.titre FROM ADHERENT,EMPRUNT,EXEMPLAIRE,OEUVRE WHERE ADHERENT.idAdherent=EMPRUNT.idAdherent and EXEMPLAIRE.noExemplaire = EMPRUNT.noExemplaire and OEUVRE.noOeuvre = EXEMPLAIRE.noOeuvre and ADHERENT.idAdherent=".$_GET['id'].";";
        	$req_info = $pdo->query($req_info);
        	$rep_info = $req_info->fetchAll();
    
        	foreach ($rep_info as $key) {
        		if ($key['dateRendu'] == "") $rendu = " <span style='color:red'>Non rendu</span>";
        		else $rendu = "	Rendu le : <b>".$key['dateRendu']."</b>"; 
        		echo "-<b>".$key['titre']."</b> Emprunté le : <b>".$key['dateEmprunt']."</b> ,".$rendu.".<br/>";
        	}
        }
    }


    //POUR TABLE EMPRUNT
    if($_GET['table']=="EMPRUNT"){
    	$req_info_str = "SELECT ADHERENT.nomAdherent , EXEMPLAIRE.noExemplaire, OEUVRE.titre FROM ADHERENT , EMPRUNT , OEUVRE, EXEMPLAIRE where EMPRUNT.idAdherent = ADHERENT.idAdherent and EMPRUNT.noExemplaire = EXEMPLAIRE.noExemplaire and OEUVRE.noOeuvre = EXEMPLAIRE.noOeuvre AND EMPRUNT.idEmprunt=".$_GET['id'].";";
        $req_info = $pdo->query($req_info_str);
        $rep_info = $req_info->fetch();
    	echo "-<b>".$rep_info['titre']."</b> , emprunté par <b>".$rep_info['nomAdherent']."</b><br/>";
    }


    //POUR TABLE OEUVRE
    if($_GET['table']=="OEUVRE"){
        $req_info_str = "SELECT AUTEUR.nomAuteur,AUTEUR.prenomAuteur FROM OEUVRE,AUTEUR where AUTEUR.idAuteur = OEUVRE.idAuteur AND OEUVRE.noOeuvre =".$_GET['id'].";"; 
        $req_info = $pdo->query($req_info_str);
        $rep_info = $req_info->fetch();
        echo "Livre écrit par <b>".$rep_info['prenomAuteur']." ".$rep_info['nomAuteur']."<br/>";
    }


    //POUR TABLE AUTEUR
    if($_GET['table']=="AUTEUR"){
        $req_info_str = "SELECT OEUVRE.titre,OEUVRE.dateParution FROM OEUVRE WHERE idAuteur=".$_GET['id'].";";
        $nb_li_str ="SELECT COUNT(titre) FROM OEUVRE where idAuteur=".$_GET['id'].";";
        $nb_li = $pdo->query($nb_li_str);
        $req_info = $pdo->query($req_info_str);
        $nb_li = $nb_li->fetch();
        $rep_info = $req_info->fetchAll();
        if($nb_li['COUNT(titre)']!=0){
            echo "Nombre de livres recensées dans la bibliothèque : <b>".$nb_li['COUNT(titre)']."</b>.<br/>";
            foreach ($rep_info as $key) {
                echo "-<b>".$key['titre']."</b>"; 
                if ($key['dateParution']!="")  
                    echo " ,écrit le <b>".$key['dateParution']."</b>.<br/>";
                else
                    echo ".<br/>";
                    
            }
        }
        else{
            echo "Aucune oeuvre recensée dans la bibliothèque.";
        }
    }

    //POUR TABLE EXEMPLAIRE
    if($_GET['table']=="EXEMPLAIRE"){
        $req_info_str = "SELECT OEUVRE.idAuteur,AUTEUR.nomAuteur,AUTEUR.prenomAuteur,OEUVRE.titre FROM AUTEUR,OEUVRE,EXEMPLAIRE where AUTEUR.idAuteur=OEUVRE.idAuteur AND OEUVRE.noOeuvre = EXEMPLAIRE.noOeuvre AND EXEMPLAIRE.noExemplaire =".$_GET['id'].";"; 
        $req_info = $pdo->query($req_info_str);
        $rep_info = $req_info->fetch();
        echo "<b>".$rep_info['titre']."</b> ,écrit par <b>".$rep_info['prenomAuteur']." ".$rep_info['nomAuteur']."</b><br/>";
    }    


 
?>

</div>
<div class="modal-footer">
</div>