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
      body{background-color: #FBE8A6;}

	</style>

</head>
<body>
<?php
	$conn = new mysqli("localhost","root","","monpfe")OR die("Error: ".mysqli_error($conn));
	$squery="SELECT * from cours";
	$result= $conn->query($squery);
	while($row = $result->fetch_assoc()){ ?>
		<div class="monCours" value="0" >
			<div class="alert alert-primary cours" role="alert">
				 <span class="badge badge-primary">COURS : </span> <?php echo $row['TITRE']; ?>
   				 <a href="docs/<?php echo $row['PIECE_JOINTE'];?>" target="_blank">    <i class="fa fa-arrow-circle-o-down dlwd " aria-hidden="true" ></i>
					</a>
    			 <i class="fa fa-plus-circle dlwd devent" aria-hidden="true" value="1" onclick="closeOpen(this.parentNode.parentNode)"></i>
  			</div>

  			<div class="alert alert-danger dcours" role="alert">
  	  			<h4 class="alert-heading">TPS</h4>
  	 				<?php
    				$tps= $conn->query("Select * from tp where num_c=".$row['NUM_C']); ?>
  	 				<?php	while($rowp = $tps->fetch_assoc()){ ?>
  	 				<div class="alert alert-danger  tps" role="alert">
  	 					<span class="badge badge-danger">TP : </span>  <?php echo $rowp['TITRE']; ?>
  		 				<a href="docs/<?php echo $rowp['PIECE'] ;?>" target="_blank"><i class="fa fa-arrow-circle-o-down dtps " aria-hidden="true"></i></a>
	 				</div>
  	 				<?php } ?>
			</div>

			<div class="alert alert-dark dcours dtds" role="alert">
				<h4 class="alert-heading">TDS</h4>
				<?php
    			$tds= $conn->query("Select * from td where num_c=".$row['NUM_C']); ?>
  	 			<?php	while($rowt = $tds->fetch_assoc()){ ?>
  	  			<div class="alert alert-danger  tps" role="alert">
 					<span class="badge badge-success">TD1 : </span> <?php echo $rowt['TITRE']; ?>
  					<a href="docs/<?php echo $rowt['PIECE'];?>" target="_blank"><i class="fa fa-arrow-circle-o-down dtps " aria-hidden="true"></i></a>
	  			</div>
	  			<?php } ?>
			</div>
		</div>
	<?php } ?>






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
	</script>
</body>
</html>
