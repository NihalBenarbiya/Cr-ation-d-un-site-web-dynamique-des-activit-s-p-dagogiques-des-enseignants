<?php
session_start();
if(isset($_POST["create"])){
  require("dbconnect.php");
  $nom = $_POST["Nom"];
  $prenom = $_POST["prenom"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $passw = $_POST["password2"];
  $dnaiss = $_POST["birthdate"];
  $lnaiss = $_POST["birthplace"];
  $email = $_POST["email"];
  $specialite = $_POST["specialite"];
  if($password==$passw)
  {
  $requete = "INSERT INTO etudiant(LOGIN, MOT_DE_PASS, EMAIL, NOM, PRENOM,DATE_NAISSANCE,LIEU_NAISSANCE, SPECIALITE,ANNE_UNIVERSITAIRE) VALUES ('$username','$password','$email','$nom','$prenom','$dnaiss','$lnaiss','$specialite','2020')";
        $exec_requete = mysqli_query($conn,$requete);
          $_SESSION['message']="vous etes connecte";
          $_SESSION['username']=$username;
          header('Location: loginetudiant.php');
           
  }
  else{
    $_SESSION['message']="mot de pass non identiques";
  }         
        
}


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>create account</title>
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body class="bg-default">
  <!-- Navbar -->
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <h1 class="text-white">CREE VOTRE COMPTE</h1>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
              <form role="form" method="POST">
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"></span>
                    </div>
                    <input class="form-control" name="Nom" placeholder="Votre Nom" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"></span>
                    </div>
                    <input class="form-control" name="prenom" placeholder="Votre prenom" type="text" required>
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"></span>
                    </div>
                    <input class="form-control" name="username" placeholder="Votre login" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"></span>
                    </div>
                    <input class="form-control" name="password" placeholder="Votre mot de passe" type="password" required>
                  </div>
                </div>
                 <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"></span>
                    </div>
                    <input class="form-control" name="password2" placeholder="confirmé votre mot de passe" type="password" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"></span>
                    </div>
                    <input class="form-control" name="birthdate" placeholder="Votre date de naissance" type="date" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"></span>
                    </div>
                    <input class="form-control" name="birthplace" placeholder="Votre lieu de naissance" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"></span>
                    </div>
                    <input class="form-control" name="email" placeholder="Votre email" type="email" required>
                  </div>
                </div>
                 <select class="form-control form-control-lg" name="specialite">
                <option value="DAI">DAI</option>
                <option value="ASR">ASR</option>
                <option value="GBA">GBA</option>
                </select>         
                <div class="text-center">
                  <input type="submit" name="create" value="s'inscrire" class="btn btn-primary my-4">
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->

  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>

