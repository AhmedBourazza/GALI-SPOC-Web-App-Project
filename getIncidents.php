<?php
// getIncidents.php
include_once 'includes/dbh.inc.php';
session_start();

$sql = "SELECT i.numIncident, i.titreIncident, i.descriptionIncident, i.`idBusinessApp#`, i.`matriculeBeneficie#`, b.nomBusinessApp, b.`idService#`
        FROM incident i
        JOIN businessapp b ON i.`idBusinessApp#` = b.idBusinessApp
        WHERE i.etatIncident = 'Pending';";

$resultData = mysqli_query($conn, $sql);

if (!$resultData) {
    die("Error executing query: " . mysqli_error($conn));
}

$incidents = array();

while ($row = mysqli_fetch_assoc($resultData)) {
    $incident = array(
        'numIncident' => $row['numIncident'],
        'titreIncident' => $row['titreIncident'],
        'descriptionIncident' => $row['descriptionIncident'],
        'idBusinessApp#' => $row['idBusinessApp#'],
        'matriculeBeneficie#' => $row['matriculeBeneficie#'],
        'nomBusinessApp' => $row['nomBusinessApp'],
    );

    // Get additional data for each incident
    $beneficieSql = "SELECT numTeleBeneficie, emailBeneficie FROM beneficie WHERE matriculeBeneficie = " . $row['matriculeBeneficie#'];
    $beneficieResult = mysqli_query($conn, $beneficieSql);

    if (!$beneficieResult) {
        die("Error executing query: " . mysqli_error($conn));
    }

    $beneficieData = mysqli_fetch_assoc($beneficieResult);

    // Add additional data to the incident array
    $incident['numTeleBeneficie'] = $beneficieData['numTeleBeneficie'];
    $incident['emailBeneficie'] = $beneficieData['emailBeneficie'];

    // Fetch additional data for each incident from the service table
    $serviceSql = "SELECT intituleService, typeService FROM service WHERE idService = " . $row['idService#'];
    $serviceResult = mysqli_query($conn, $serviceSql);

    if (!$serviceResult) {
        die("Error executing query: " . mysqli_error($conn));
    }

    $serviceData = mysqli_fetch_assoc($serviceResult);

    // Add additional service data to the incident array
    $incident['intituleService'] = $serviceData['intituleService'];
    $incident['typeService'] = $serviceData['typeService'];

    // Add the updated incident array to the incidents array
    $incidents[] = $incident;
}

echo json_encode($incidents);


?>
