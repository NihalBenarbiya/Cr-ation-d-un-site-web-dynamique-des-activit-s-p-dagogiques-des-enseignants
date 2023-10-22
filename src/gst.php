<?php
session_start();
require("dbconnect.php");

if(isset($_SESSION["login_en"])){
  $username = $_SESSION["login_en"];
  $requete = "SELECT NOM_EN, PRENOM_EN FROM enseignant where LOGIN_EN = '".$username."'";
  $exec_requete = mysqli_query($conn,$requete);
  $reponse = mysqli_fetch_array($exec_requete);
  $FULL_NAME = $reponse['NOM_EN']." ".$reponse['PRENOM_EN'];

  $requete = "SELECT count(*) FROM cours where LOGIN_EN = '".$username."'";
  $exec_requete = mysqli_query($conn,$requete);
  $reponse = mysqli_fetch_array($exec_requete);
  $NbCours = $reponse['count(*)'];

  $requete = "SELECT count(*) FROM etudiant ";
  $exec_requete = mysqli_query($conn,$requete);
  $reponse = mysqli_fetch_array($exec_requete);
  $NbEtudiant = $reponse['count(*)'];

  $requete = "SELECT * FROM cours where LOGIN_EN = '".$username."'";
  $exec_requete = mysqli_query($conn,$requete);

  $requete = "SELECT * FROM TD";

  $tds = mysqli_query($conn,$requete);

  $requete = "SELECT * FROM TP";

  $tps = mysqli_query($conn,$requete);

}else{
  header('Location: login.php');
}


if(isset($_POST["modifiert"])){
  $table = $_POST['tdor'];
  $choix = $_POST["modifiert"];
  $bl = 0;
  if($choix == "Modifier Titre"){
    $titre = $_POST["tnvtitre"];
    $id = ($table == "tp"? explode(" ", $_POST["num_c_mtp"])[1] : explode(" ", $_POST["num_c_mtd"])[1] );

    $sql = "update ".$table." set titre='".$titre."' where num_".$table." = ".$id;
    $bl = 1;

  }

  if($choix == "Supprimer"){
    $id = ($table == "tp"? explode(" ", $_POST["num_c_mtp"])[1] : explode(" ", $_POST["num_c_mtd"])[1] );

    $sql = "delete from ".$table." where num_".$table." = ".$id;
    $bl = 1;

  }

  if($choix == "Modifier la PS"){
    $id = ($table == "tp"? explode(" ", $_POST["num_c_mtp"])[1] : explode(" ", $_POST["num_c_mtd"])[1] );

    $fichier = $_FILES["tcours"];
    $dest = "../docs/".$fichier["name"];
    $src = $fichier['tmp_name'];
    move_uploaded_file($src, $dest);

    $sql = "update ".$table." set piece='".$fichier["name"]."' where num_".$table." = ".$id;
    $bl = 1;
  }
  if($choix == "Valider"){
    $id =  $_POST["num_c_ajout"];

    $sql = "delete from cours where num_c=".$id;
    $bl = 1;

  }
if($bl == 1){
  echo $sql;
  mysqli_query($conn,$sql);
  }
}



if (isset($_POST['inserer'])){

  $fichier = $_FILES["fcours"];
  $dest = "../docs/".$fichier["name"];
  $src = $fichier['tmp_name'];
  move_uploaded_file($src, $dest);

  $login = $_SESSION["login_en"];
  $titre=$_POST['titre'];
  $piece=$fichier["name"];

  $table=$_POST['table'];
  $numc=$_POST['num_c_ajout'];

  if($table == 'cours'){
    $query ="insert into cours(LOGIN_EN,TITRE,PIECE_JOINTE) values('".$login."','".$titre."','".$piece."')";
  }else{
    $query ="insert into $table(NUM_C,TITRE,PIECE) values(".$numc.",'".$titre."','".$piece."')";

  }
  mysqli_query($conn, $query);

}

if (isset($_POST['modifier'])){

  $Nvnom=$_POST["nvtitre"];
  $numco=$_POST['num_c_ajout'];
  $query ="update cours set TITRE = '".$Nvnom."' where NUM_C= '".$numco."'";

  mysqli_query($conn, $query);
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Page Enseignant</title>
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
  <style>
      .vidaloca{
        font-weight: bold;
        border-radius: 50px;
        background-color: #D9CCE1;
        width: 140px;
        height: 20px;
      }
  </style>
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="../assets/img/brand/lelogo.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>

              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="gst.php">
                <i class="ni ni-books text-orange"></i>
                <span class="nav-link-text">Gestion de Cours</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="listecours.php">
                <i class="ni ni-books text-orange"></i>
                <span class="nav-link-text">Cours du site</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Logout.php">
                <i class="ni ni-button-power text-red"></i>
                <span class="nav-link-text">Deconnexion</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $FULL_NAME; ?></span>
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">

          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-6 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Nb. Cours</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $NbCours; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-books"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Nb. Etudiants</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $NbEtudiant; ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-single-02"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-8" style="margin: 0 auto">
          <div class="card">
            <form style="padding: 20px;" method="POST" enctype="multipart/form-data">
              <select class="form-control form-control-lg" name="num_c_ajout" onchange="afficherTP(this.value);afficherTD(this.value);">
                <?php
                while($reponse = mysqli_fetch_array($exec_requete)){ ?>
                <option value="<?php   echo $reponse['NUM_C']; ?>"><?php   echo $reponse["TITRE"]; ?></option>
              <?php }  ?>
              </select>

              <div class="custom-control custom-radio custom-control-inline vidaloca" style="margin-top: 10px; margin-left:70px">
                <input type="radio" id="customRadioInline1" name="table" class="custom-control-input" value="tp">
                <label class="custom-control-label" for="customRadioInline1">Ajouter un TP</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline vidaloca">
                <input type="radio" id="customRadioInline2" name="table" class="custom-control-input" value="td">
                <label class="custom-control-label" for="customRadioInline2">Ajouter un TD</label>
              </div>

              <div class="custom-control custom-radio custom-control-inline vidaloca">
                <input type="radio" id="customRadioInline3" name="table" class="custom-control-input" value="cours">
                <label class="custom-control-label" for="customRadioInline3">Ajouter Cours</label>
              </div>

              <div class="custom-control custom-radio custom-control-inline vidaloca">
                <input type="radio" id="customRadioInline4" name="table" class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline4">Modifier cours</label>
              </div>
              <input value="o" id="tportd" name="tdor" style="display: none">
              <div style="text-align: center; display: none" class="openc"  >
                <hr>

                <div class="form-group">
                  <label for="exampleFormControlInput1">Titre</label>
                  <input type="text" class="form-control" id="exampleFormControlInput1" name="titre" placeholder="....">
                </div>
                <div class="custom-file" style="text-align: left">
                  <input type="file" class="custom-file-input" name="fcours" id="customFileLang" lang="en">
                  <label class="custom-file-label" for="customFileLang"></label>
                </div>
                <input type="submit" class="btn btn-primary" name="inserer" value="Ajouter" style="margin-top: 10px">

              </div>

              <!-- Modifier un Cours !-->
              <div style="text-align: center; display: none; color: green; margin-top: 0px;" class="modifiercours"  >

                <div class="custom-file" style="text-align: left">
                  <div class="custom-control custom-radio custom-control-inline vidaloca" style="margin-top: 10px; margin-left:70px">
                    <input type="radio" id="ccustomRadioInline1" name="ctable" class="custom-control-input" value="cours">
                    <label class="custom-control-label" for="ccustomRadioInline1">Modifier Titre</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline vidaloca">
                    <input type="radio" id="ccustomRadioInline2" name="ctable" class="custom-control-input" value="td">
                    <label class="custom-control-label" for="ccustomRadioInline2">Supp Cours</label>
                  </div>

                  <div class="custom-control custom-radio custom-control-inline vidaloca">
                    <input type="radio" id="ccustomRadioInline3" name="ctable" class="custom-control-input" value="tp">
                    <label class="custom-control-label" for="ccustomRadioInline3">Modifier TP</label>
                  </div>

                  <div class="custom-control custom-radio custom-control-inline vidaloca">
                    <input type="radio" id="ccustomRadioInline4" name="ctable" class="custom-control-input">
                    <label class="custom-control-label" for="ccustomRadioInline4">Modifier TD</label>
                  </div>

                </div>
              </div>

                <!-- Modifier un TD !-->
              <div style="text-align: center; display: none" class="modifierTD"  >
                <hr>

                <div class="form-group">
                  <div class="custom-file" style="text-align: left">

                  <select class="form-control form-control-lg" name="num_c_mtd" >
                    <option value="0" disabled>Selectioner un TD </option>
                    <?php
                    while($reponse = mysqli_fetch_array($tds)){ ?>
                    <option value="<?php   echo $reponse['NUM_C']." ".$reponse['NUM_TD']; ?>"><?php   echo $reponse["TITRE"]; ?></option>
                  <?php }  ?>
                  </select>
                </div>
              </div>

              </div>

                <!-- Modifier un TP !-->

              <div style="text-align: center; display: none" class="modifierTP"  >
                <hr>
                <div class="form-group" >
                  <div class="custom-file" style="text-align: left" id="editCours">

                  <select class="form-control form-control-lg" name="num_c_mtp" >
                    <option value="0" disabled>Selectioner un TP </option>
                    <?php
                    while($reponse = mysqli_fetch_array($tps)){ ?>
                    <option value="<?php   echo $reponse['NUM_C']." ".$reponse['NUM_TP']; ?>"><?php   echo $reponse["TITRE"]; ?></option>
                  <?php }  ?>
                  </select>

                </div>
              </div>
              </div>

              <div id="hollatptd" style="display: none">
                <div class="custom-control custom-radio custom-control-inline vidaloca" style="margin-top: 10px; margin-left: 150px">
                  <input type="radio" id="tcustomRadioInline1t" name="ttablet" class="custom-control-input" value="tp">
                  <label class="custom-control-label" for="tcustomRadioInline1t">Modifier Titre</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline vidaloca">
                  <input type="radio" id="tcustomRadioInline2t" name="ttablet" class="custom-control-input" >
                  <label class="custom-control-label" for="tcustomRadioInline2t">Modifier PS</label>
                </div>

                <div class="custom-control custom-radio custom-control-inline vidaloca">
                  <input type="radio" id="tcustomRadioInline3t" name="ttablet" class="custom-control-input" >
                  <label class="custom-control-label" for="tcustomRadioInline3t">Supprimer</label>
                </div>
              </div>
              <div class="form-group" style="display: block" id="editname">
                <label for="exampleFormControlInput1">Nouveau titre</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="tnvtitre" placeholder="....">
              </div>

              <div class="custom-file" style="text-align: left; display: block; margin-top: 10px"  id="editfile">

                <input type="file" class="custom-file-input" name="tcours" id="customFileLangd" lang="en">
                <label class="custom-file-label" for="customFileLang"></label>
              </div>
              <input type="submit" class="btn btn-primary" name="modifiert" id="tptds" value="Valider" style="margin-top: 10px; margin-left: 330px">

                <div style="text-align: center; display: none" class="opent"  >
                <hr>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Nouveau titre</label>
                  <input type="text" class="form-control" id="exampleFormControlInput1" name="nvtitre" placeholder="....">
                </div>
                <input type="submit" class="btn btn-primary" name="modifier" value="Modifier Titre" style="margin-top: 10px">
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Footer -->
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>
  <script>
    mesR =   document.getElementsByName("table");
    mesR[0].onclick = function(){
      document.getElementsByClassName("openc")[0].style.display = "block";
      document.getElementsByClassName("modifiercours")[0].style.display = "none";
      document.getElementsByClassName("modifierTD")[0].style.display = "none";
      document.getElementsByClassName("modifierTP")[0].style.display = "none";
      document.getElementById("hollatptd").style.display="none";
      document.getElementById("editname").style.display="none";
      document.getElementById("editfile").style.display="none";
      document.getElementById("tptds").style.display="none";

    }
    mesR[1].onclick = function(){
      document.getElementsByClassName("openc")[0].style.display = "block";
      document.getElementsByClassName("modifiercours")[0].style.display = "none";
      document.getElementsByClassName("modifierTD")[0].style.display = "none";
       document.getElementsByClassName("modifierTP")[0].style.display = "none";
       document.getElementById("hollatptd").style.display="none";
       document.getElementById("editname").style.display="none";
       document.getElementById("editfile").style.display="none";
       document.getElementById("tptds").style.display="none";

    }
    mesR[2].onclick = function(){
      document.getElementsByClassName("openc")[0].style.display = "block";
      document.getElementsByClassName("modifiercours")[0].style.display = "none";
      document.getElementsByClassName("modifierTD")[0].style.display = "none";
      document.getElementsByClassName("modifierTP")[0].style.display = "none";
      document.getElementById("hollatptd").style.display="none";
      document.getElementById("editname").style.display="none";
      document.getElementById("editfile").style.display="none";
      document.getElementById("tptds").style.display="none";

    }

    mesR[3].onclick = function(){
      document.getElementsByClassName("openc")[0].style.display = "none";
      document.getElementsByClassName("modifiercours")[0].style.display = "block";
      document.getElementById("hollatptd").style.display="none";
      document.getElementById("editname").style.display="none";
      document.getElementById("editfile").style.display="none";
      document.getElementById("tptds").style.display="none";

    }

    mesRt =   document.getElementsByName("ctable");

    mesRt[3].onclick = function(){
      document.getElementsByClassName("modifierTD")[0].style.display = "block";
      document.getElementsByClassName("openc")[0].style.display = "none";
      document.getElementsByClassName("modifierTP")[0].style.display = "none";
      document.getElementsByClassName("opent")[0].style.display = "none";
      document.getElementById("hollatptd").style.display="block";
      document.getElementById("editname").style.display="none";
      document.getElementById("editfile").style.display="none";

      document.getElementById("tportd").value = "td";



    }
     mesRt[2].onclick = function(){
      document.getElementsByClassName("modifierTP")[0].style.display = "block";
      document.getElementById("tptds").style.display="block";
      document.getElementById("tportd").value = "tp";


      document.getElementsByClassName("openc")[0].style.display = "none";
      document.getElementsByClassName("modifierTD")[0].style.display = "none";
      document.getElementsByClassName("opent")[0].style.display = "none";
      document.getElementById("hollatptd").style.display="block";
      document.getElementById("tptds").style.display="none";

      document.getElementById("editname").style.display="none";
      document.getElementById("editfile").style.display="none";
    }

    mesRt[1].onclick = function(){
     document.getElementsByClassName("modifierTP")[0].style.display = "none";
     document.getElementsByClassName("modifierTP")[0].style.display = "none";

     document.getElementById("tptds").style.display="none";


     document.getElementsByClassName("openc")[0].style.display = "none";
     document.getElementsByClassName("modifierTD")[0].style.display = "none";
     document.getElementsByClassName("opent")[0].style.display = "none";
     document.getElementById("hollatptd").style.display="none";
     document.getElementById("tptds").style.display="block";

     document.getElementById("editname").style.display="none";
     document.getElementById("editfile").style.display="none";


   }

    mesRt[0].onclick = function(){
      document.getElementsByClassName("opent")[0].style.display = "block";
      document.getElementsByClassName("modifierTP")[0].style.display = "none";
      document.getElementsByClassName("openc")[0].style.display = "none";
      document.getElementsByClassName("modifierTD")[0].style.display = "none";
      document.getElementById("hollatptd").style.display="none";
      document.getElementById("editname").style.display="none";
      document.getElementById("editfile").style.display="none";
      document.getElementById("tptds").style.display="none";

    }
    function afficherTD(valeur){

      //var optionas = document.querySelectorAll("select:nth-of-type(1) option");
      var selects = document.getElementsByTagName("select")[1];
      var optionas = selects.getElementsByTagName("option");
      for(var i = 1; i<optionas.length; i++){
        voption = optionas[i].value;
        numc = voption.split(" ")[0];
        numt = voption.split(" ")[1];
        if(numc == valeur){
          optionas[i].style.display = "block";
        }else{
          optionas[i].style.display = "none";
        }
      }

    }

    function afficherTP(valeur){

      //var optionas = document.querySelectorAll("select:nth-of-type(1) option");
      var selects = document.getElementsByTagName("select")[2];
      var optionas = selects.getElementsByTagName("option");
      for(var i = 1; i<optionas.length; i++){
        voption = optionas[i].value;
        numc = voption.split(" ")[0];
        numt = voption.split(" ")[1];
        if(numc == valeur){
          optionas[i].style.display = "block";
        }else{
          optionas[i].style.display = "none";
        }
      }

    }
    document.getElementById("editname").style.display="none";
    document.getElementById("editfile").style.display="none";
    document.getElementById("tptds").style.display="none";

    afficherTD(document.getElementsByTagName("select")[0].value);
    afficherTP(document.getElementsByTagName("select")[0].value);

    mesRo = document.getElementsByName("ttablet");
    mesRo[0].onclick = function (){
      document.getElementById("tptds").style.display="block";
      document.getElementById("editname").style.display="block";
      document.getElementById("editfile").style.display="none";

      document.getElementById("tptds").value = "Modifier Titre";


    }
    mesRo[1].onclick = function (){
      document.getElementById("tptds").style.display="block";
      document.getElementById("editfile").style.display="block";
      document.getElementById("editname").style.display="none";
      document.getElementById("tptds").value = "Modifier la PS";


    }
    mesRo[2].onclick = function (){
      document.getElementById("tptds").style.display="block";
      document.getElementById("editname").style.display="none";
      document.getElementById("editfile").style.display="none";
      document.getElementById("tptds").value = "Supprimer";

    }


  </script>
</body>

</html>
