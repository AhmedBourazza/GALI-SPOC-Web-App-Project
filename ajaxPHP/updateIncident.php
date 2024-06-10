<?php
session_start();
include_once '../includes/dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['incidentId']) && !empty($_POST['incidentId'])) {
        $incidentId = $_POST['incidentId'];

        // Update the etatIncident attribute to 'Taking' and change the customer ID (matriculeBeneficie#) here
        // Replace 'your_table_name' with the actual table name where you store the incidents
        $updateSql = "UPDATE incident SET etatIncident='Taking',`numConsultant#`=$_SESSION[numConsultant] WHERE numIncident = $incidentId";

        if (mysqli_query($conn, $updateSql)) {
            echo "Incident updated successfully";
        } else {
            echo "Error updating incident: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid incident ID";
    }
} else {
    echo "Invalid request method";
}
?>
