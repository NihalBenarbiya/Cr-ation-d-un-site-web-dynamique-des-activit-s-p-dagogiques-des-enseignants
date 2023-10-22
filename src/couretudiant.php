<?php
session_start();
if(isset($_SESSION["login"])){
  require("dbconnect.php");

  $username = $_SESSION["login"];
  $requete = "SELECT NOM, PRENOM FROM etudiant where LOGIN= '".$username."'";
  $exec_requete = mysqli_query($conn,$requete);
  $reponse = mysqli_fetch_array($exec_requete);
  $FULL_NAME = $reponse['NOM']." ".$reponse['PRENOM'];

  $requete = "SELECT count(*) FROM cours ";
  $exec_requete = mysqli_query($conn,$requete);
  $reponse = mysqli_fetch_array($exec_requete);
  $NbCours = $reponse['count(*)'];

  $requete = "SELECT count(*) FROM etudiant ";
  $exec_requete = mysqli_query($conn,$requete);
  $reponse = mysqli_fetch_array($exec_requete);
  $NbEtudiant = $reponse['count(*)'];

}else{
  header('Location: loginetudiant.php');

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


  <style>
		#oils .monCours {
			margin-bottom: -30px;
			display: none;

		}
	#oils	.monProf > .cours {
		background-color: violet;
		margin-bottom: -40px;
		}

	#oils	.cours{
			width :500px;
			margin-top: 50px;

		 }
	#oils	 .dlwd{
		 	display:inline-block;
		 	float:right;
		 	color:#003366;
		 	zoom: 1.5;
		 	background: white;
		 	border: 1px #003366 solid;
		 	width:25px;
		 	border-radius: 5px;

		 }
	#oils	 .dcours{
		 	width:400px;
		 	margin-left:100px;
		 	background: #F4976C;
		 	display: none;
		}


		#oils i{
		 	text-align:center;
		 	margin-right: 10px;
		 }
	#oils	 i:hover {
		 	color: red;
		 }
		#oils .tps{
		 	background:white;


		 }
		#oils .dtps{
		 	float: right;
		 	zoom: 1.3;

		 }
		#oils .dtds {
		 	background: #AFD275;
		 }

     td > div {
       margin-left: 300px;

     }

     td div:first-child{
       margin-top: -60px;
     }
     td{
       background-color: #ccd3de;
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
              <a class="nav-link" href="dashboard_etudiant.php" >
                <i class="ni ni-tv-2 text-primary" ></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="couretudiant.php">
                <i class="ni ni-books text-orange"></i>
                <span class="nav-link-text"> Cours</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Logoutetudiant.php">
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
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Cours du site</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Page name</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td id="oils">
                      <?php
                        $conn = new mysqli("localhost","root","","monpfe")OR die("Error: ".mysqli_error($conn));

                        $squery="SELECT * from enseignant";
                        $eresult= $conn->query($squery);
                      while($erow = $eresult->fetch_assoc()){?>
                        <div class="monProf" value="0" >
                          <div class="alert alert-primary cours" role="alert">
                             <span class="badge badge-secondary">PROF : </span> <?php echo $erow['NOM_EN']." ".$erow['PRENOM_EN']; ?>
                               <i class="fa fa-plus-circle dlwd devent" aria-hidden="true" value="1" onclick="closeOpenC(this.parentNode.parentNode)"></i>
                            </div>
                        <?php
                        $squery="SELECT * from cours where login_en='".$erow['LOGIN_EN']."'";
                        $result= $conn->query($squery);
                        while($row = $result->fetch_assoc()){ ?>
                          <div class="monCours" value="0" >
                            <div class="alert alert-primary cours" role="alert">
                               <span class="badge badge-primary">COURS : </span> <?php echo $row['TITRE']; ?>
                                 <a href="../docs/<?php echo $row['PIECE_JOINTE'];?>" target="_blank" onclick="inc(<?php echo $row['NUM_C'].','; echo "'nbtelech'";  ?>)">    <i class="fa fa-arrow-circle-o-down dlwd " aria-hidden="true" ></i>
                                </a>
                                 <i class="fa fa-plus-circle dlwd devent" aria-hidden="true" value="1" onclick="closeOpen(this.parentNode.parentNode); inc(<?php echo $row['NUM_C'].','; echo "'nbvisiteur'";  ?>)"></i>
                              </div>

                              <div class="alert alert-danger dcours" role="alert">
                                  <h4 class="alert-heading">TPS</h4>
                                  <?php
                                  $tps= $conn->query("Select * from tp where num_c=".$row['NUM_C']); ?>
                                  <?php	while($rowp = $tps->fetch_assoc()){ ?>
                                  <div class="alert alert-danger  tps" role="alert">
                                    <span class="badge badge-danger">TP : </span>  <?php echo $rowp['TITRE']; ?>
                                    <a href="../docs/<?php echo $rowp['PIECE'] ;?>" target="_blank"><i class="fa fa-arrow-circle-o-down dtps " aria-hidden="true"></i></a>
                                </div>
                                  <?php } ?>
                            </div>

                            <div class="alert alert-dark dcours dtds" role="alert">
                              <h4 class="alert-heading">TDS</h4>
                              <?php
                                $tds= $conn->query("Select * from td where num_c=".$row['NUM_C']); ?>
                                <?php	while($rowt = $tds->fetch_assoc()){ ?>
                                  <div class="alert alert-danger  tps" role="alert">
                                <span class="badge badge-success">TD : </span> <?php echo $rowt['TITRE']; ?>
                                  <a href="../docs/<?php echo $rowt['PIECE'];?>" target="_blank"><i class="fa fa-arrow-circle-o-down dtps " aria-hidden="true"></i></a>
                                </div>
                                <?php } ?>
                            </div>
                          </div>

                        <?php } ?> </div> <?php }?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script type="text/javascript">
	function closeOpen(divs){
		var value = divs.getAttribute("value");
		dcours = divs.getElementsByClassName("dcours");

		if(value == 0){
				dcours[0].style.display = "block";
				dcours[1].style.display = "block";
				divs.setAttribute("value", 1);


			}else{
				dcours[0].style.display = "none";
				dcours[1].style.display = "none";
				divs.setAttribute("value", 0);

			}

	}

		function closeOpenC(divs){
			var mesc = divs.querySelectorAll(".monCours");

			for(var i = 0; i< mesc.length; i++){
				mesc[i].style.display =  divs.value ? 'block': 'none';
			}
			divs.value = divs.value ? 0 : 1;
		}

    function inc(cours, col){
      $.post( "inc.php?cours="+cours+"&cols="+col );
    }
	</script>
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
</body>

</html>
