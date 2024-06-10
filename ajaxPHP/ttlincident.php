<?php
include_once '../includes/dbh.inc.php';
$Rsql ="SELECT COUNT(*) AS total_rows FROM incident WHERE etatIncident='Pending';";
$rt = mysqli_query($conn, $Rsql);
$numberPending =mysqli_fetch_assoc($rt);
echo $numberPending["total_rows"];

?>