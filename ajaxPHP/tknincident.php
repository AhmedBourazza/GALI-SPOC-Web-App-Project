<?php
include_once '../includes/dbh.inc.php';
session_start();
$Rsql2 ="SELECT COUNT(*) AS total_rows FROM incident WHERE etatIncident='Taking' AND `numConsultant#` = {$_SESSION['numConsultant']};";
$rt2 = mysqli_query($conn, $Rsql2);
$numberTaking = mysqli_fetch_assoc($rt2);
echo $numberTaking["total_rows"];
?>
