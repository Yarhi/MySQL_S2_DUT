var tab = document.getElementById("table_name").innerHTML;
var nb_col = document.getElementById("nb_col_"+tab).innerHTML;
var add=0;
var fixed=false;
var search_select = null;
var edit=0;

if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
} else {
    // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

function navbar_fixed(){
  if (this.fixed==false) {
    $('.navbar').addClass("navbar-fixed-top");
    $('#tableau').css("margin-top","74px");
    this.fixed=true;
  }
  else{ 
    $('.navbar').removeClass("navbar-fixed-top");
    $('#tableau').css("margin-top","0px");
    this.fixed=false;
  }
}





/******/
/*EDIT*/
/******/

function editer(id){
  edit_val();
  id_val = document.getElementById("li"+id+"0").innerHTML;
  document.getElementById("ModalLabel_title").innerHTML = "Edition ligne d'id "+id_val;
  if (tab=="ADHERENT") {
    for (var i=1; i<5; i++) {
      document.getElementById('li_edit'+i).value=document.getElementById('li'+id+(i-1)).innerHTML;
    };
  }
  else if(tab=="EMPRUNT"){
    document.getElementById('li_edit1').value=document.getElementById('li'+id+'0').innerHTML;
    document.getElementById('li_edit4').value=document.getElementById('li'+id+'3').innerHTML;
    document.getElementById('li_edit5').value=document.getElementById('li'+id+'4').innerHTML;
  }
  else if(tab=="OEUVRE"){
    document.getElementById('li_edit1').value=document.getElementById('li'+id+'0').innerHTML;
    document.getElementById('li_edit3').value=document.getElementById('li'+id+'3').innerHTML;
    document.getElementById('li_edit4').value=document.getElementById('li'+id+'4').innerHTML;
  }
  else if(tab=="AUTEUR"){
    document.getElementById('li_edit1').value=document.getElementById('li'+id+'0').innerHTML;
    document.getElementById('li_edit2').value=document.getElementById('li'+id+'1').innerHTML;
    document.getElementById('li_edit3').value=document.getElementById('li'+id+'2').innerHTML;
  }
  else if(tab=="EXEMPLAIRE"){
    document.getElementById('li_edit1').value=document.getElementById('li'+id+'0').innerHTML;
    document.getElementById('li_edit2').value=document.getElementById('li'+id+'1').innerHTML;
    document.getElementById('li_edit3').value=document.getElementById('li'+id+'2').innerHTML;  
    document.getElementById('li_edit4').value=document.getElementById('li'+id+'3').innerHTML;  
  }
};

/******/
/*EDIT*/
/******/






















function deleter(id){
  document.getElementById("delete_id").value=document.getElementById("li"+id+"0").innerHTML;
  document.getElementById("ModalLabel_title_del").innerHTML="Suppression ligne "+document.getElementById("li"+id+"0").innerHTML;
};




function add_val(table){
  var col = [];
  var nb_col = document.getElementById("nb_col_"+table).innerHTML;
  var nb_li = document.getElementById("nb_li_"+table).innerHTML;
  nb_li = parseInt(nb_li);
  document.getElementById("table_add").value=table;

  for(var i = 0;i <= nb_col;i++){
    col.push(document.getElementById("col"+table+""+i).innerHTML);
  }

  if (this.add==1) {
    $("#modal_body_add").remove();
    $("#modal_body_bef").append("<div class='modal-body' id='modal_body_add'></div>");
  };
  document.getElementById("ModalLabel_title_add").innerHTML = "Ajout de données sur "+table;
  for(var i = 1 ;i < col.length;i++){
    $("#modal_body_add").append('<label for="recipient-name" class="control-label">'+col[i]+'</label>');
    if (i==1) {
      $("#modal_body_add").append("<input type='text' name='li_add"+i+"' readonly='true' class='form-control' value='"+(nb_li+1)+"'/>");
    }
    else{
      if (table=="EMPRUNT") {
        if(i==2 || i==3){
          dropdown_emprunt('add');
          i=3;
        }
        else{
          $("#modal_body_add").append("<input type='text' name='li_add"+i+"' class='form-control' />");
        }
      }
      else if(table=="OEUVRE"){
        if(i==2){ 
          dropdown_oeuvre('add');
          i=2;
        } 
        else{
          $("#modal_body_add").append("<input type='text' name='li_add"+i+"' class='form-control' />");
        }
      }
      else if(table=="EXEMPLAIRE"){
        if(i==5){ 
          dropdown_exemplaire('add');
          i=5;
        } 
        else{
          $("#modal_body_add").append("<input type='text' name='li_add"+i+"' class='form-control' />");
        }
      }
      else{
          $("#modal_body_add").append("<input type='text' name='li_add"+i+"' class='form-control' />");       
      }
    }
  }
  this.add=1;
}



function edit_val(){
  if (edit!=1) {
    var col = [];
    var nb_col = document.getElementById("nb_col_"+tab).innerHTML;

    for(var i = 0;i <= nb_col;i++){
      col.push(document.getElementById("col"+tab+""+i).innerHTML);
    }

    for (var i=1; i<col.length; i++) {
      $("#modal_body_edit").append('<label for="recipient-name" class="control-label">'+col[i]+'</label>');
      if (tab=="ADHERENT") {
        if(i==1){
          $("#modal_body_edit").append("<input type='text' id='li_edit"+i+"' name='li_add"+i+"' readonly='true' class='form-control' />");
        }else{
          $("#modal_body_edit").append("<input type='text' id='li_edit"+i+"' name='li_add"+i+"' class='form-control' />");
        }
      }
      else if(tab=="EMPRUNT"){
        if(i==1){
          $("#modal_body_edit").append("<input type='text' id='li_edit"+i+"' name='li_add"+i+"' readonly='true' class='form-control' />");
        }
        else if(i==2){
          dropdown_emprunt('edit');
          i=3;
        }
        else{
          $("#modal_body_edit").append("<input type='text' id='li_edit"+i+"' name='li_add"+i+"' class='form-control' />");
        }        
      }
      else if(tab=="OEUVRE"){
        if(i==1){
          $("#modal_body_edit").append("<input type='text' id='li_edit"+i+"' name='li_add"+i+"' readonly='true' class='form-control' />");
        }
        else if(i==2){
          dropdown_oeuvre('edit');
          i=2;
        }
        else{
          $("#modal_body_edit").append("<input type='text' id='li_edit"+i+"' name='li_add"+i+"' class='form-control' />");
        }     
      }
      else if (tab=="AUTEUR") {
        if(i==1){
          $("#modal_body_edit").append("<input type='text' id='li_edit"+i+"' name='li_add"+i+"' readonly='true' class='form-control' />");
        }else{
          $("#modal_body_edit").append("<input type='text' id='li_edit"+i+"' name='li_add"+i+"' class='form-control' />");
        }
      }
      else if(tab=="EXEMPLAIRE"){
        if(i==1){
          $("#modal_body_edit").append("<input type='text' id='li_edit"+i+"' name='li_add"+i+"' readonly='true' class='form-control' />");
        }
        else if(i==5){
          dropdown_exemplaire('edit');
          i=5;
        }
        else{
          $("#modal_body_edit").append("<input type='text' id='li_edit"+i+"' name='li_add"+i+"' class='form-control' />");
        }     
      }
    };
  };
  this.edit=1;
}



















function dropdown_emprunt(val){
  $("#modal_body_"+val).append("<div id='dropdown_emprunt'></div>");
  if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
  } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById("dropdown_emprunt").innerHTML = xmlhttp.responseText;
      }
  }
  xmlhttp.open("GET","data/dropdown_add/drop_emprunt.php?val="+val);
  xmlhttp.send();
}

function dropdown_oeuvre(val){
  $("#modal_body_"+val).append("<div id='dropdown_oeuvre'></div>");
  if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
  } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById("dropdown_oeuvre").innerHTML = xmlhttp.responseText;
      }
  }
  xmlhttp.open("GET","data/dropdown_add/drop_oeuvre.php?val="+val);
  xmlhttp.send();
}

function dropdown_exemplaire(val){
  $("#modal_body_"+val).append("<div id='dropdown_exemplaire'></div>");
  if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
  } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById("dropdown_exemplaire").innerHTML = xmlhttp.responseText;
      }
  }
  xmlhttp.open("GET","data/dropdown_add/drop_exemplaire.php?val="+val);
  xmlhttp.send();
}


function information(id){
  showInfo(document.getElementById("li"+id+"0").innerHTML);
}
function showInfo(id) {
    if (id == "") {
        document.getElementById("nb_emprunt_info").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("nb_emprunt_info").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","data/getInfo.php?id="+id+"&table="+tab);
        xmlhttp.send();
    }
}

function search_ajax(){
  $(document).ready(function () {
      var refreshId = setInterval(function () {
        var search_value = document.getElementById("search").value;
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("search_result").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","data/search.php?table="+tab+"&search="+search_value+"&data="+search_select);
        xmlhttp.send();
      }, 500);
      $.ajaxSetup({
          cache: false
      });
  });    
}

function change_select(str){
  this.search_select = str;
  $('#dropdown_value').html(this.search_select);
  document.getElementById("col_hidden_send").value= (this.search_select);
}
function change_value_search(str){
  document.getElementById("search").value=str;
  $('#search_result').css('display','none');
}

$('#search').mouseover(function(){
  if($('#search_result').html()!=""){
    $('#search_result').css('display','block');
  }
});
$('#search').mouseout(function(){
  $('#search_result').css('display','none');
});
$('#search_result').mouseover(function(){
  if($('#search_result').html()!=""){
    $('#search_result').css('display','block');
  }
});
$('#search_result').mouseout(function(){
  $('#search_result').css('display','none');
});

function show_pointer(val){
  var search_id_ptn = document.getElementById("sear"+val+"0").innerHTML;
  var nb_li_ptn = document.getElementById("nb_li_"+tab).innerHTML;
  var i=0;
  var table_id_cor=0;
  while(table_id_cor!=search_id_ptn){
    i++;
    var table_id_cor = document.getElementById('li'+i+"0").innerHTML;
  };
  $('html,body').animate({scrollTop: $("#li"+i+"0").offset().top},'slow');
  $('#tr'+i).css('text-decoration','underline');
  $('#tr'+i).css('font-weight','bold');
}