<?php
/*
** FONCTION QUI VERIFIE SI IL Y A UNE INJECTION SQL
*/
/*
  function injection_prepare($str){
    if () {
      return true;
    }
    else{
      return false;
    }
  }
*/
/* à appeller avant chaque utilisation de la base de donnée */
/*
** http://php.net/manual/fr/function.htmlspecialchars.php
** http://www.bases-hacking.org/sql-injection.html
** http://fr.wikipedia.org/wiki/Injection_SQL
*/

	include('data/connexion_bdd.php');
	
	$table_array = array("ADHERENT","EMPRUNT","OEUVRE","AUTEUR","EXEMPLAIRE");
  if (!isset($_GET['table'])) {
    $table = "ADHERENT";
  }else{
    $table = $_GET['table'];
  }

  //données colonnes
  $req_table_check = $pdo->query("SELECT * FROM ".$table.";");
  if($table=="EMPRUNT"){
    $req_table_check = $pdo->query("SELECT EMPRUNT.idEmprunt,ADHERENT.nomAdherent,OEUVRE.titre,EMPRUNT.dateEmprunt,EMPRUNT.dateRendu FROM EMPRUNT,ADHERENT,EXEMPLAIRE,OEUVRE where EMPRUNT.idAdherent = ADHERENT.idAdherent and EMPRUNT.noExemplaire = EXEMPLAIRE.noExemplaire and EXEMPLAIRE.noOeuvre = OEUVRE.noOeuvre;");
  }
  if($table=="OEUVRE"){
    $req_table_check = $pdo->query("SELECT OEUVRE.noOeuvre , AUTEUR.prenomAuteur , AUTEUR.nomAuteur , OEUVRE.titre , OEUVRE.dateParution FROM OEUVRE,AUTEUR WHERE OEUVRE.idAuteur = AUTEUR.idAuteur;");
  }
  if($table=="EXEMPLAIRE"){
    $req_table_check = $pdo->query("SELECT EXEMPLAIRE.noExemplaire,EXEMPLAIRE.etat,EXEMPLAIRE.dateAchat,EXEMPLAIRE.prix,OEUVRE.titre FROM OEUVRE,EXEMPLAIRE WHERE EXEMPLAIRE.noOeuvre=OEUVRE.noOeuvre;");
  }
  
  //récupération des checks
  $data = "";
  $check_ok=0;
  if (isset($_GET['check'])) {
    $data_check = array();
    for($i=0;$i<$req_table_check->columnCount();$i++){
        $name_col = $req_table_check->getColumnMeta($i);
        if (isset($_GET[$name_col['name']])) {
          $check_ok++;
          array_push($data_check,$name_col['name']);
        }
    }
    for ($i=0; $i <count($data_check) ; $i++) {
      if ($i!=count($data_check)-1) 
        $data = $data.$data_check[$i].",";
      else
        $data = $data.$data_check[$i];
    }
  }else{
    $data = "*";
  }
  if ($check_ok==0) {
    if($table=="EMPRUNT"){
      $data = "EMPRUNT.idEmprunt,ADHERENT.nomAdherent,OEUVRE.titre,EMPRUNT.dateEmprunt,EMPRUNT.dateRendu";
    }
    if($table=="OEUVRE"){
      $data = "noOEUVRE,AUTEUR.prenomAuteur,AUTEUR.nomAuteur,titre,dateParution";
    }
    if($table=="EXEMPLAIRE"){
      $data = "EXEMPLAIRE.noExemplaire,EXEMPLAIRE.etat,EXEMPLAIRE.dateAchat,EXEMPLAIRE.prix,OEUVRE.titre";
    } 
  }


  //récupération des données de la table
  //VERSION 1 
  if(!isset($_GET['order'])){
    $req_table_str = "SELECT ".$data." FROM ".$table.";";
  }else{
    $order = $_GET['order'];
    if (!isset($_GET['by'])) { 
      $req_table_str = "SELECT ".$data." FROM ".$table." ORDER BY ".$order.";";
    }else{
      $req_table_str = "SELECT ".$data." FROM ".$table." ORDER BY ".$order." ".$_GET['by'].";";    
    }
  }


  //VERSION 2
  if ($table=="ADHERENT") {
    $req_opt = " FROM ADHERENT ";
  }
  if($table=="EMPRUNT"){
    $req_opt = " FROM EMPRUNT,ADHERENT,EXEMPLAIRE,OEUVRE where EMPRUNT.idAdherent = ADHERENT.idAdherent and EMPRUNT.noExemplaire = EXEMPLAIRE.noExemplaire and EXEMPLAIRE.noOeuvre = OEUVRE.noOeuvre ";
  }
  if ($table=="OEUVRE") {
    $req_opt = "  FROM AUTEUR,OEUVRE WHERE OEUVRE.idAuteur = AUTEUR.idAuteur ";
  }
  if ($table=="AUTEUR") {
    $req_opt = " FROM AUTEUR;";
  }
  if ($table=="EXEMPLAIRE") {
    $req_opt = " FROM EXEMPLAIRE,OEUVRE WHERE EXEMPLAIRE.noOeuvre = OEUVRE.noOeuvre ";
  }


  if(!isset($_GET['order'])){
    $req_table_str = "SELECT ".$data.$req_opt; 
  }else{
    $order = $_GET['order'];
    if (!isset($_GET['by'])) { 
      $req_table_str = "SELECT ".$data.$req_opt." ORDER BY ".$order.";";
    }else{
      $req_table_str = "SELECT ".$data.$req_opt." ORDER BY ".$order." ".$_GET['by'].";";    
    }
  }  

  $req_table = $pdo->query($req_table_str);
  $rep_table = $req_table->fetchAll();


  //récupération
  $describe_req = $pdo->query("DESCRIBE ".$table);
  $describe = $describe_req->fetchAll();
  foreach ($describe as $key) {
    if($key["Key"] == "PRI"){}
  }

  //récupère les données des tables
  include("data/tables.php");


?>
<html>
	<head>
		<title>Bibliothèque</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://bootswatch.com/lumen/bootstrap.min.css">
		<link rel="stylesheet" href="https://bootswatch.com/lumen/bootstrap.css">
    <link rel="shortcut icon" href="img/ico.png">
		<style type="text/css">
			body{
				background-image: url(img/background.jpg);
				background-size: 106% 106%;
				background-attachment: fixed;*
			}

      .table{
        color:black;
        border: 2px black;
        height:500px;
        overflow: scroll;        
      }

      #order{
        color:black;
        text-decoration: none;
      }

      #btn_tab{
        font-size: 18px;
        margin-right: 20px;
      }
      #btn_tab:hover{
        color: rgb(0, 153, 255);
        cursor: pointer;
      }

      #add_nav{
        margin-left:0px;
        margin-right: 5px;
      }
      #add_nav:hover{
        color: rgb(0, 153, 255);
        cursor: pointer;        
      }

      #dropdown{
        width:100%;
        border:solid 1px grey;
      }
		</style>
	</head>
	<body>
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
     <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Bibliothèque</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <?php
              for ($i=0; $i < count($table_array) ; $i++) { 
                echo '<li><a href="?table='.$table_array[$i].'" id="'.$table_array[$i].'"onclick="menu_link("'.$table_array[$i].'")">'.$table_array[$i].'</a></li>';
                echo '<li><a href="#" onclick="add_val(\''.$table_array[$i].'\')" data-toggle="modal" data-target="#ModalAdd" id="add_nav"><span class="glyphicon glyphicon-plus"></span></a></li>';
              }
            ?>
          </ul>
          <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <select name="search_col" class="btn">
                <?php
                  for ($i=1; $i < $req_table->ColumnCount() ; $i++) {
                    $meta_col_name = $req_table->getColumnMeta($i); 
                    echo "<option>".$meta_col_name['name']."</option>";
                  }
                ?>
              </select>
              <input type="hidden" name="table" value="<?=$table?>"/>
              <input type="text" class="form-control" id="search" onClick="search_ajax()" name="search" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Rechercher</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" onclick="navbar_fixed()"><span class="glyphicon glyphicon-bookmark"></span></a>
          </ul>
        </div>
      </div>
    </nav>
<<<<<<< HEAD
    <?php
  if (isset($_GET["erreur"])) {?>
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      <h4>Erreur, impossible de supprimer :<a class="anchorjs-link" href="#oh-snap!-you-got-an-error!"><span class="anchorjs-icon"></span></a></h4>
      <p><?php 
      if ($_GET["erreur"] == "AUTEUR") {
        echo "L'auteur est utilisé dans une oeuvre, vous ne pouvez supprimer un auteur en gardant ses oeuvres.";
      } else if ($_GET["erreur"] == "OEUVRE") {
        echo "L'oeuvre est utilisée dans exemplaire, vous ne pouvez supprimer une oeuvre en gardant ses exemplaires.";
      } else if ($_GET["erreur"] == "EXEMPLAIRE") {
        echo "L'exemplaire est utilisé dans emprunt, vous ne pouvez supprimer un exemplaire si il est actuellement emprunté.";
      } else if ($_GET["erreur"] == "ADHERENT") { 
        echo "L'adhérent est utilisé dans emprunt, vous ne pouvez supprimer un adhérent en gardant les emprunts liés effectués par cet adhérent.";
      } else echo $_GET['erreur'];
      ?>
    </div>
    <?php
  }?>		
=======
    <div id="test"></div>		
>>>>>>> a9932d975f532c7f02d3e80b1f0ba1dd93316293
    <div class="container" id="tableau" style="margin-top:0px;">
      <div class="col-md-12">
        <form method="GET">
          <div style="border-bottom:solid 2px black;padding:5px;">
          <input type="hidden" name="check" value="true"/>
          <input type="hidden" name="table" value="<?=$table?>"/>
          <input style="font-size:15px;background-image:none;color:black;border:none;background-color:transparent;" type="submit" value="Rafraichir"></input>
          <?php

            for ($i=0; $i <$req_table_check->columnCount() ; $i++) { 
              $name_col = $req_table_check->getColumnMeta($i);

              if(isset($_GET[''.$name_col['name']])){
                if($_GET[''.$name_col['name']]=="on"){
                  $check="<input type='checkbox' checked name='".$name_col['name']."'> ";
                }else{
                  $check="<input type='checkbox' name='".$name_col['name']."'> ";
                }
              }else{
                $check = "<input type='checkbox' name='".$name_col['name']."'> ";
              }



              if (!isset($_GET['check'])) {
                $check = "<input type='checkbox' checked name='".$name_col['name']."'> ";
              }
              echo "<th>".$check.$name_col['name']."</th> ";
            }
          ?>
          </div>
        </form>
        <table class="table table-hover">
          <thead>
            <tr>
              <?php

                for ($i=0; $i <$req_table->columnCount() ; $i++) { 
                  $name_col = $req_table->getColumnMeta($i);
                  //$col_type = $name_col['native_type'];
                  $glyph="down";

                  if (!isset($_GET['order'])){ 
                    $order_href = "<a id='order' href='index.php?table=".$table."&order=".$name_col['name']."&by=desc'>";
                  }else{
                    if (isset($_GET['by'])) {
                      if($_GET['by']=="desc"){
                        $glyph="down";
                        $order_href = "<a id='order' href='index.php?table=".$table."&order=".$name_col['name']."&by=asc'>";
                      }else{
                        $glyph="up";
                        $order_href = "<a id='order' href='index.php?table=".$table."&order=".$name_col['name']."&by=desc'>";
                      }
                    }else{
                      $order_href = "<a id='order' href='index.php?table=".$table."&order=".$name_col['name']."&by=desc'>";
                    }
                  }



                  //Affichage du type de données avec glyphicon 
                  /*
                  if ($col_type=="LONG") {
                    $glyph_type = "glyphicon glyphicon-cog";
                  }else if($col_type=="VAR_STRING"){
                    $glyph_type = "glyphicon glyphicon-text-size";                
                  }else if($col_type=="DATE"){
                    $glyph_type = "glyphicon glyphicon-calendar";
                  }else if($col_type=="FLOAT"){
                    $glyph_type = "glyphicon glyphicon-euro";
                  }else{
                    $glyph_type = "glyphicon glyphicon-file";  
                  }
                  $glyph_span = " <span style='font-size:10px' class='".$glyph_type."'></span>";
                  */


                  $glyph_span="";

                  echo "<th>".$order_href.$name_col['name'].$glyph_span." <span class='glyphicon glyphicon-menu-".$glyph."'></span></a></th>";
                }
              ?>
              <th>Opérations</th>
            </tr>
          </thead>
            <?php
              $j=0;
              foreach ($rep_table as $data) {
                $j++;
                echo "<tr>";
                for ($i=0; $i < $req_table->columnCount() ; $i++) { 
                  $name_col = $req_table->getColumnMeta($i);
                  //if($i!=0){
                    echo "<td id='li".$j.$i."'>".$data[$name_col['name']]."</td>";
                  //}else{
                  //  echo "<td style='display:none' id='li".$j.$i."'>".$data[$name_col['name']]."</td>";
                  //}
                }
                //buttons edit et delete
                echo "<td><span id='btn_tab' onclick='edit($j)' data-toggle='modal' data-target='#modalEdit' class='glyphicon glyphicon-pencil'></span>";
                echo "<span id='btn_tab' onclick='deleter($j)' data-toggle='modal' data-target='#modalDelete' class='glyphicon glyphicon-remove'></span>";
                echo "<span data-toggle='modal' data-target='#modalInfo' class='glyphicon glyphicon-info-sign' id='btn_tab' onclick='information($j)'></span></td>";
                echo "</tr>";
              }
            ?>
        </table>
      </div>
    </div>

    <div id="table" style="display:none"><?=$table?></div>
    <div style="display:none" id="nb_col">
      <div id="nb_col_ADHERENT"><?=$nb_col_adherent?></div>
      <div id="nb_col_EMPRUNT"><?=$nb_col_emprunt?></div>
      <div id="nb_col_OEUVRE"><?=$nb_col_oeuvre?></div>
      <div id="nb_col_AUTEUR"><?=$nb_col_auteur?></div>
      <div id="nb_col_EXEMPLAIRE"><?=$nb_col_exemplaire?></div>
    </div>
    <div style="display:none" id="nb_li">
      <div id="nb_li_ADHERENT"><?=$count_adherent?></div>
      <div id="nb_li_EMPRUNT"><?=$count_emprunt?></div>
      <div id="nb_li_OEUVRE"><?=$count_oeuvre?></div>
      <div id="nb_li_AUTEUR"><?=$count_auteur?></div>
      <div id="nb_li_EXEMPLAIRE"><?=$count_exemplaire?></div>
    </div>
    <div style="display:none" id="col">
      <div id="ADHERENT_col">
        <?php
          $k=0;
          foreach ($adherent_t as $row) {
            echo "<div id='colADHERENT".$k."'>".$row."</div>";
            $k++;
          }
        ?>
      </div>
      <div id="EMPRUNT_col">
        <?php
          $k=0;
          foreach ($emprunt_t as $row) {
            echo "<div id='colEMPRUNT".$k."'>".$row."</div>";
            $k++;
          }
        ?>
      </div>
      <div id="OEUVRE_col">
        <?php
          $k=0;
          foreach ($oeuvre_t as $row) {
            echo "<div id='colOEUVRE".$k."'>".$row."</div>";
            $k++;
          }
        ?>
      </div>
      <div id="AUTEUR_col">
        <?php
          $k=0;
          foreach ($auteur_t as $row) {
            echo "<div id='colAUTEUR".$k."'>".$row."</div>";
            $k++;
          }
        ?>
      </div>
      <div id="EXEMPLAIRE_col">
        <?php
          $k=0;
          foreach ($exemplaire_t as $row) {
            echo "<div id='colEXEMPLAIRE".$k."'>".$row."</div>";
            $k++;
          }
        ?>
      </div>
    </div>


    <!--MODAL EDIT-->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form method="get" action="data/edit.php">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="ModalLabel_title">Edition ligne</h4>
              <div id="nb_col" style="display:none;"><?=$req_table->columnCount()?></div>
            </div>
            <div class="modal-body">
              <input type="hidden" value="<?=$table?>" name="table" />
              <?php
                for ($i=0; $i < $req_table->columnCount() ; $i++) { 
                  $name_col = $req_table->getColumnMeta($i);
              ?>
                <div class="form-group">
                  <label for="recipient-name" class="control-label"><?=$name_col['name']?></label>
                  <input type="text" <?php if($i==0) echo "readonly='true'";?> name="li<?=$i?>" class="form-control" id="recipient-name<?=$i?>">
                </div>
              <?php
                }
              ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary">Editer</button>
            </div>
          </div>
        </div>
      </form>
    </div>


    <!--MODAL DELETE-->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form method="get" action="data/delete.php">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="ModalLabel_title_del">Suppression ligne </h4>
              <div id="nb_col" style="display:none;"><?=$req_table->columnCount()?></div>
            </div>
            <div class="modal-body">
              Etes vous sûr de vouloir supprimer la ligne ?
              <input type="hidden" value="<?=$table?>" name="table" />
              <input type="hidden" value="" id="delete_id" name="id" />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
              <button type="submit" class="btn btn-primary">Oui</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <?php
      include('data/modal_add.php');
      include('data/modal_info.php');
    ?>
    <script type="text/javascript" src="js/script.js"></script>
		<script type="text/javascript">

		</script>
	</body>
</html>