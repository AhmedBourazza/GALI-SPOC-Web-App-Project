<?php
function emptyInput($email,$password)
{
    $result;
    if(empty($email) || empty($password))
    {
        $result=true;
    }
    else {
        $result = false;
    }
    return $result;
}
function emailExists($conn,$email)
{

    $sql="SELECT * FROM beneficie WHERE emailBeneficie=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        header("location:../login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$email);
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);
    if($row=mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else {
        $result=false;
        return $result;
    }
}
function invalidEmail($email)
{
    $result;
   
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
     $result=true;
    }
    else
    $result=false;
 
     return $result;
}
/************the other checks********/
function loginUser($conn, $email, $password)
{
    $row=emailExists($conn,$email);
    if($row===false)
    {
        header("location:../login.php?error=emailnotfound");//incorrect email : user do not exist
        exit();
    }

    if($row["passwordBeneficie"]!==$password)
    {
        header("location:../login.php?error=incorrectpassword");//incorrect password : user exists
        exit();
    }
    elseif ($row["passwordBeneficie"]===$password) {
        session_start();
        $_SESSION['UserloggedIn'] = true;
        $_SESSION["matriculeBeneficie"]=$row["matriculeBeneficie"];
        $_SESSION["nomBeneficie"]=$row["nomBeneficie"];
        $_SESSION["prenomBeneficie"]=$row["prenomBeneficie"];
        $_SESSION["numTeleBeneficie"]=$row["numTeleBeneficie"];
        $_SESSION["emailBeneficie"]=$row["emailBeneficie"];
        $_SESSION["dateDeNaissanceBeneficie"]=$row["dateDeNaissanceBeneficie"];
        $_SESSION["bioBeneficie"]=$row["bioBeneficie"];
        $_SESSION["societeBeneficie"]=$row["societeBeneficie"];
        $_SESSION["statutBeneficie"]=$row["statutBeneficie"];


        header("location:../userSpace.php?error=correctpassword");//correct password : user exists
        exit();
    }
}
/*-------------------consultant---------------*/
function emailExists2($conn,$email)
{

    $sql="SELECT * FROM consultant WHERE emailConsultant=?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        header("location:../login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$email);
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);
    if($row=mysqli_fetch_assoc($resultData))
    {
        return $row;
    }
    else {
        $result=false;
        return $result;
    }
}
function loginConsultant($conn, $email, $password)
{
    $row=emailExists2($conn,$email);
    if($row===false)
    {
        header("location:../login.php?error=emailnotfound");//incorrect email : user do not exist
        exit();
    }

    if($row["passwordConsultant"]!==$password)
    {
        header("location:../login.php?error=incorrectpassword");//incorrect password : user exists
        exit();
    }
    elseif ($row["passwordConsultant"]===$password) {
        session_start();
        $_SESSION['consultantloggedIn'] = true;
        $_SESSION["numConsultant"]=$row["numConsultant"];
        $_SESSION["nomConsultant"]=$row["nomConsultant"];
        $_SESSION["prenomConsultant"]=$row["prenomConsultant"];
        $_SESSION["numTeleConsultant"]=$row["numTeleConsultant"];
        $_SESSION["emailConsultant"]=$row["emailConsultant"];
        $_SESSION["dateDeNaissanceConsultant"]=$row["dateDeNaissanceConsultant"];
       

        header("location:../consultantSpace.php?error=correctpassword");//correct password : user exists
        exit();
    }
}
/*-------------------create incident---------------*/
function emptyInput2($title,$businnesApp,$urgency,$shortDescription)
{
    $result;
    if(empty($title) || empty($businnesApp)|| empty($urgency)|| empty($shortDescription))
    {
        $result=true;
    }
    else {
        $result = false;
    }
    return $result;
}
function createIncident($conn, $title, $businnesApp, $urgency, $shortDescription)
{
    $etatIncident = "Pending";
    $dateIncident = date('Y-m-d H:i:s');

    session_start();
    $matriculeBeneficie = $_SESSION["matriculeBeneficie"];

    // Prepare and execute the query to get the idBusinessApp based on the provided nomBusinessApp
    $sql = "SELECT idBusinessApp FROM businessapp WHERE nomBusinessApp = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // Handle the error gracefully (e.g., log the error, display a user-friendly message)
        exit("Error: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "s", $businnesApp);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    
    // Check if a valid idBusinessApp was found
    if (mysqli_num_rows($resultData) === 0) {
        // Handle the case when the provided nomBusinessApp doesn't exist in the businessapp table
        exit("Error: Business App not found!");
    }

    // Fetch the idBusinessApp
    $idBusinessApp = mysqli_fetch_assoc($resultData)['idBusinessApp'];

    // Prepare and execute the query to insert the new incident into the incident table
    $sql2 = "INSERT INTO incident (urgenceIncident, titreIncident, descriptionIncident, etatIncident, dateIncident, `matriculeBeneficie#`, `idBusinessApp#`) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt2 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
        // Handle the error gracefully (e.g., log the error, display a user-friendly message)
        exit("Error: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt2, "ssssssi", $urgency, $title, $shortDescription, $etatIncident, $dateIncident, $matriculeBeneficie, $idBusinessApp);
    
    // Execute the insert query
    if (mysqli_stmt_execute($stmt2)) {
        echo "<h1>Incident created successfully!</h1>" ;
    } else {
        echo "<h1>Error: Unable to create incident. Please try again later.</h1>";
    }
}

