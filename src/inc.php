<?php

require("dbconnect.php");

if(isset($_REQUEST['cols'])){
  $col = $_REQUEST['cols'];
  $idc = $_REQUEST['cours'];
  $requete = "update cours set ".$col."=".$col."+1 where num_c =".$idc;
  mysqli_query($conn,$requete);

}
 ?>
