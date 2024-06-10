<?php
session_start();
if (!isset($_SESSION['UserloggedIn']) || $_SESSION['UserloggedIn'] !== true) {
    header("location:../login.php?error=unauthorized");
    exit();
}
?>
<?php
    include_once 'includes/dbh.inc.php';
    $sql ="SELECT * FROM incident WHERE `matriculeBeneficie#`=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:userSpace.php?error=stmtfailed");
        exit();
    }
     
    $matriculeBeneficie = $_SESSION["matriculeBeneficie"];
    if (!mysqli_stmt_bind_param($stmt, "s", $matriculeBeneficie)) {
        header("location:userSpace.php?error=bindError");
        exit(); 
    }
    
    if (!mysqli_stmt_execute($stmt)) {
        header("location:userSpace.php?error=stmtexecutionerror");
        exit();   
     }
    
    $resultData = mysqli_stmt_get_result($stmt);
    
  
?>


    
    

 <!DOCTYPE html>
<html lang="en" title="Coding design">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UserSpace History</title>
    <link rel="stylesheet" href="cssUserSpace/userSpaceHistorysStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet">

</head>

<body>
    <div class="navbar" ><h1> Incidents History</h1><a href="userSpace.php"><i class="ri-home-3-fill"></i> <span>HOME</span></a>
</div>
    <main class="table">
        <section class="table__header">
            <h1></h1>
            <div class="input-group">
                <input type="search" placeholder="Search Data...">
                <img src="HistoryImages/search.png" alt="">
            </div>
           
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Id <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Title <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Urgency <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Order Date <span class="icon-arrow">&UpArrow;</span></th>
                        <th> state <span class="icon-arrow">&UpArrow;</span></th>
                        <th> BusinessApp <span class="icon-arrow">&UpArrow;</span></th>
                    </tr>
                </thead>
                <tbody>
                   
                  
                    <tr>
                    <?php 
                        while ($row=mysqli_fetch_assoc($resultData)) {   
                    ?>
                        <td><?php echo $row['numIncident'] ?></td>
                        <td><?php echo $row['titreIncident'] ?></td>
                        <td><?php echo $row['urgenceIncident'] ?></td>
                        <td><?php echo $row['dateIncident'] ?></td>
                        <td> <p class="status <?php echo $row['etatIncident'] ?>"><?php echo $row['etatIncident'] ?></p></td>
                        <td> <?php 
                        $sql2="SELECT * FROM businessapp WHERE idBusinessApp =?;";
                        $stmt2=mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt2,$sql2)){
                            header("Location:../error.php?error=stmt2failed");exit();
                        }
                        mysqli_stmt_bind_param($stmt2, "s", $row['idBusinessApp#']);
                        mysqli_stmt_execute($stmt2);
                        $resultData2 = mysqli_stmt_get_result($stmt2);
                        $r=mysqli_fetch_assoc($resultData2);
                        ?>
                        <strong>
                        <?php   echo $r['nomBusinessApp'] ; ?>
                    </strong>
                       </td>

                        </tr>
                    <?php
                        }           
                    ?>                
                </tbody>
            </table>
        </section>
    </main>
<script src="js/script.js"></script>
</body>

</html>