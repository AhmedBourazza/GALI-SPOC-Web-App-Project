<?php
include_once '../includes/dbh.inc.php';
 $Rsql3 ="SELECT COUNT(*) AS total_rows FROM incident WHERE etatIncident='Solved';";
 $rt3 = mysqli_query($conn, $Rsql3);
 $numberSolved =mysqli_fetch_assoc($rt3);
 echo $numberSolved["total_rows"];
?>