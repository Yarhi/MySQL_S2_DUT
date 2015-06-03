<?php
	include('../data/connexion_bdd.php');
	$req_count = $pdo->query("SELECT count(*) from EMPRUNT;");
	$rep_count = $req_count->fetch();

	$tot_emprunt = $rep_count['count(*)'];

	$req_stats_str = 'SELECT count(EMPRUNT.idEmprunt) as count,AUTEUR.nomAuteur FROM AUTEUR,EMPRUNT,EXEMPLAIRE,OEUVRE where EMPRUNT.noExemplaire = EXEMPLAIRE.noExemplaire and EXEMPLAIRE.noExemplaire = OEUVRE.noOeuvre and OEUVRE.idAuteur = AUTEUR.idAuteur GROUP BY AUTEUR.nomAuteur;';
	$req_stats = $pdo->query($req_stats_str);
	$rep_stats = $req_stats->fetchAll();
	foreach ($rep_stats as $key) {
		$percent = ($key['count']/$tot_emprunt)*100;
		
?>
		<div style="margin-bottom:-15px;">
			<?=$key['nomAuteur'];?>
			<div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="<?=$percent?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$percent?>%;">
					<?=$key['count']?>
				</div>
			</div>
		</div>
<?php	
	}
?>