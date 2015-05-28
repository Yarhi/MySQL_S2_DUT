<?php

	$req_search = "SELECT * FROM ".$_GET['table']." WHERE ".$_GET['colonne']." = '".$_GET['search']."';";
	
	if($_GET['table']=="EMPRUNT"){
		$req_search = $pdo->query("SELECT EMPRUNT.idEmprunt,ADHERENT.nomAdherent,OEUVRE.titre,EMPRUNT.dateEmprunt,EMPRUNT.dateRendu FROM EMPRUNT,ADHERENT,EXEMPLAIRE,OEUVRE where EMPRUNT.idAdherent = ADHERENT.idAdherent and EMPRUNT.noExemplaire = EXEMPLAIRE.noExemplaire and EXEMPLAIRE.noOeuvre = OEUVRE.noOeuvre and ".$_GET['colonne']."= '".$_GET['search']."';");
		$rep_search = $req_search->fetchAll();
	}
	elseif($_GET['table']=="OEUVRE"){
		$req_search = $pdo->query("SELECT OEUVRE.noOeuvre , AUTEUR.prenomAuteur , AUTEUR.nomAuteur , OEUVRE.titre , OEUVRE.dateParution FROM OEUVRE,AUTEUR WHERE OEUVRE.idAuteur = AUTEUR.idAuteur and ".$_GET['colonne']."= '".$_GET['search']."';");
		$rep_search = $req_search->fetchAll();
	}
	elseif($_GET['table']=="EXEMPLAIRE"){
		$req_search = $pdo->query("SELECT EXEMPLAIRE.noExemplaire,EXEMPLAIRE.etat,EXEMPLAIRE.dateAchat,EXEMPLAIRE.prix,OEUVRE.titre FROM OEUVRE,EXEMPLAIRE WHERE EXEMPLAIRE.noOeuvre=OEUVRE.noOeuvre and ".$_GET['colonne']."= '".$_GET['search']."';");
		$rep_search = $req_search->fetchAll();
	}
	else{
		$req_search = $pdo->query($req_search);
		$rep_search = $req_search->fetchAll();
	}
	
?>
<div id="border_table_search">
	<table id="table-search" class="table table-hover">
		<h2 id="result_title">Résultat de la recherche :</h2>
		<thead>
			<tr>
				<?php
					for ($i=0; $i <$req_search->ColumnCount() ; $i++) { 
						$meta = $req_search->getColumnMeta($i);
						echo "<th>".$meta['name']."</th>";
					}
				?>
			<th>Opérations</th>
			</tr>
		</thead>
		<?php
			$j=0;
			foreach ($rep_search as $key) {
				$j++;
				echo "<tr>";
				for ($i=0; $i < $req_search->ColumnCount() ; $i++) {
					$meta = $req_search->getColumnMeta($i);
					$meta_id = $req_search->getColumnMeta(0);
					echo "<td style='background-color:transparent' id='sear".$j.$i."'>".$key[$meta['name']]."</td>";
				}
                echo "<td><span id='btn_tab' onclick='edit($j)' data-toggle='modal' data-target='#modalEdit' class='glyphicon glyphicon-pencil'></span>";
                echo "<span id='btn_tab' onclick='deleter($j)' data-toggle='modal' data-target='#modalDelete' class='glyphicon glyphicon-remove'></span>";
                echo "<span class='glyphicon glyphicon glyphicon-eye-open' id='btn_tab' onclick='show_pointer(".$j.")'></span></td>";
                echo "</tr>";
			}
		?>
	</table>
</div>