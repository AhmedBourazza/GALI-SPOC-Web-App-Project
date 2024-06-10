<?php
if (isset($_POST["submit"])) {
    $title=$_POST["title"];
    $businnesApp=$_POST["businnesApp"];
    $urgency=$_POST["urgency"];
    $shortDescription=$_POST["shortDescription"];
    include_once 'dbh.inc.php';
    include_once 'functions.inc.php';

    if(emptyInput2($title,$businnesApp,$urgency,$shortDescription)!==false)
    {
        header("location:../userSpace.php?error=emptyinput");
        exit();
    }
    createIncident($conn, $title, $businnesApp,$urgency,$shortDescription);
    


}





?>