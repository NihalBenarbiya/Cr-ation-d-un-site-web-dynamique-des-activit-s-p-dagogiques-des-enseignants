<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cours</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


	<style>
		 .monCours {
			margin-bottom: -30px;
			display: none;
			margin-left: 500px;

		}
		.monProf > .cours {
		background-color: #f2bce4;
		margin-bottom: -40px;
		margin-left: 500px;
		}
		.cours{
			width :500px;
			margin-top: 50px;

		 }
		 .dlwd{
		 	display:inline-block;
		 	float:right;
		 	color:#003366;
		 	zoom: 1.5;
		 	background: white;
		 	border: 1px #003366 solid;
		 	width:25px;
		 	border-radius: 5px;

		 }
		 .dcours{
		 	width:400px;
		 	margin-left:100px;
		 	background: #F4976C;
		 	display: none;
		}


		 i{
		 	text-align:center;
		 	margin-right: 10px;
		 }
		 i:hover {
		 	color: red;
		 }
		 .tps{
		 	background:white;


		 }
		 .dtps{
		 	float: right;
		 	zoom: 1.3;

		 }
		 .dtds {
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
      body{background-color: #FBE8A6;}
     </style>


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
              <a class="nav-link " href="gst.php">
                <i class="ni ni-books text-orange"></i>
                <span class="nav-link-text">Gestion de Cours</span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link active " href="listecours.php">
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
	</script>
</body>
</html>