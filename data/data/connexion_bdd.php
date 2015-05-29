<?php
	$dsn = 'mysql:dbname=cours;host=localhost';
	$user='root';
	$passwd='0312';


	try {
		$pdo = new PDO($dsn,$user);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND,'SET NAMES utf8');
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		echo 'Connexion échouée : ' . $e->getMessage();
	}
	$pdo->exec("SET NAMES UTF8;");
	
/*
INSERT INTO EMPRUNT 
SELECT '',ADHERENT.idAdherent,EXEMPLAIRE.noExemplaire,'2014-01-01','2014-02-02'
FROM ADHERENT,EXEMPLAIRE,OEUVRE 
WHERE OEUVRE.titre = "paroles" 
and EXEMPLAIRE.noOeuvre = OEUVRE.noOeuvre
and nomAdherent = "millet";
*/


/*
INSERT INTO OEUVRE
SELECT '',AUTEUR.idAuteur,'abcdef','2000-01-01'
FROM AUTEUR , OEUVRE 
WHERE AUTEUR.nomAuteur = "Christie"
AND AUTEUR.prenomAuteur = "agatha" LIMIT 1,1;
*/
?>