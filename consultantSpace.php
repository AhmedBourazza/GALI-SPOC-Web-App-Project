<?php
session_start();
if (!isset($_SESSION['consultantloggedIn']) || $_SESSION['consultantloggedIn'] !== true) {
    header("location:../login.php?error=unauthorized");
    exit();
}

?>
<?php

    include_once 'includes/dbh.inc.php';
    $sql ="SELECT * FROM incident WHERE etatIncident='Pending' ;";
    $resultData = mysqli_query($conn, $sql);
   
 
?>





<!DOCTYPE html>
<html lang="en" title="Coding design">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>consultant space</title>
    <link rel="stylesheet" href="cssConsultantSpace/consultantStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet">
    <link href="cssUserSpace/bootstrap.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" alt="">
            </div>
            <span class="logo_name">GALI SPOC</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#">
                        <i class="ri-dashboard-line"></i>
                        <span class="link-name">Dahsboard</span>
                    </a></li>
                <li><a href="#">
                        <i class="ri-file-list-line"></i>
                        <span class="link-name">Recent incidents</span>
                    </a></li>
                <li><a href="consultantSpaceTakingIncident.php">
                        <i class="ri-user-received-line"></i>
                        <span class="link-name">Taking Incidents</span>
                    </a></li>
                <li><a href="#">
                        <i class="ri-history-line"></i>
                        <span class="link-name">History of incident</span>
                    </a></li>
              
                
            </ul>

            <ul class="logout-mode">
                <li><a href="includes/logout.inc.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>
                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <section class="dashboard">
        <div class="top">

            <!--<img src="images/profile.jpg" alt="">-->
        </div>
        <div class="dash-content">
            <div class="overview">
                <div class="title firstTitle">
                    <i class="ri-dashboard-line"></i>
                    <span class="text">Dashboard</span>
                </div>
                <div class="boxes">
                    <div class="box box1">
                        <i class="ri-file-list-line"></i>
                        <span class="text">Total Incidents</span>
                        <span id="totalincidents" class="number"> <?php  
                            $Rsql ="SELECT COUNT(*) AS total_rows FROM incident WHERE etatIncident='Pending' ;";
                            $rt = mysqli_query($conn, $Rsql);
                            $numberPending =mysqli_fetch_assoc($rt);
                            echo $numberPending["total_rows"];
                        
                        ?></span>
                    </div>
                    <div class="box box2">
                        <i class="ri-user-received-line"></i>
                        <span class="text">taking incidents</span>
                        <span id="takingincidents" class="number"><?php  
                            $Rsql2 ="SELECT COUNT(*) AS total_rows FROM incident WHERE etatIncident='Taking'  AND `numConsultant#`= {$_SESSION['numConsultant']};";
                            $rt2 = mysqli_query($conn, $Rsql2);
                            $numberTaking =mysqli_fetch_assoc($rt2);
                            echo $numberTaking["total_rows"];
                        
                        ?></span>
                    </div>
                    <div class="box box3">
                        <i class="ri-user-follow-line"></i>
                        <span class="text">Solved Incidents</span>
                        <span id="solvedincidents" class="number"><?php  
                            $Rsql3 ="SELECT COUNT(*) AS total_rows FROM incident WHERE etatIncident='Solved';";
                            $rt3 = mysqli_query($conn, $Rsql3);
                            $numberSolved =mysqli_fetch_assoc($rt3);
                            echo $numberSolved["total_rows"];
                        
                        ?></span>
                    </div>
                </div>
            </div>
            <div class="activity">
                <div class="title">
                    <i class="ri-file-list-line"></i>
                    <span class="text">Recent Encident</span>
                </div>
                <div class="activity-data">

                </div>
                <main class="table">
                    <section class="table__header">
                        <h1></h1>
                        <div class="input-group">
                            <input type="search" placeholder="Search Data...">
                            <img src="HistoryImages/search.png" alt="">
                        </div>
                        <div id="reloadBtn"><i class="ri-restart-line"></i></div> 

                    </section>
                    <section class="table__body">
                        <table>
                            <thead>
                                <tr>
                                    <th> Id <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Title <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Urgency <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Order Date <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> Service <span class="icon-arrow">&UpArrow;</span></th>
                                    <th> BusinessApp <span class="icon-arrow">&UpArrow;</span></th>
                                </tr>

                            </thead>
                            <tbody class="Mytbody">
  
                               <!-- <tr  data-toggle="modal" data-target="#exampleModal">-->
                                    <?php 
                       while ($row=mysqli_fetch_assoc($resultData)) {   
                    ?>
                                    <tr  data-incident-id="<?php echo $row['numIncident']; ?>" data-toggle="modal" data-target="#exampleModal-<?php echo $row['numIncident']; ?>">
                                    <td>
                                        <?php echo $row['numIncident'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['titreIncident'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['urgenceIncident'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['dateIncident'] ?>
                                    </td>
                                    <td>
                                        <?php 
                       $sql3 = "SELECT s.idService, s.intituleService, s.typeService
                       FROM businessapp b
                       JOIN service s ON b.`idService#` = s.idService
                       WHERE b.idBusinessApp = " . $row['idBusinessApp#'];
                       $result = mysqli_query($conn, $sql3);
                       $r2=mysqli_fetch_assoc($result);
                        ?>
                                        <strong>
                                            <?php   echo $r2['intituleService'] ; ?>
                                        </strong>
                                    </td>

                                    <td>
                                        <?php 
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
            </div>
           <script>
    $(document).ready(function() {
        function reloadTable() {
            $(".Mytbody").load("consultantSpaceTableReload.php", function() {
                getIncidentsAndGenerateModals(); 
            });
        }

        function updateCounts() {
            $("#totalincidents").load("ajaxPHP/ttlincident.php");
            $("#takingincidents").load("ajaxPHP/tknincident.php");
            $("#solvedincidents").load("ajaxPHP/slvdincident.php");
        }
        function generateModals(incidents) {
    console.log("Generating modals...");

    incidents.forEach(function(row) {
        var modalId = "exampleModal-" + row.numIncident;
        if (!$("#" + modalId).length) {
            var modalHtml = `
                <div class="modal fade" id="${modalId}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                    


                        <div class="modal-content">
                        <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Incident Details</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                            <div class="container-xxl">
                                <div class="container py-5">
                                    <div class="row g-5">
                                        <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                                            <h6 class="text-secondary mb-3">Title</h6>
                                            <h1 class="">${row.titreIncident}</h1>
                                            <p class="mb-3">${row.descriptionIncident}</p>
                                            <div class="d-flex align-items-center">
                                                <i class="ri-customer-service-line bg-primary p-3 text-white"></i>
                                                <div class="ps-4">
                                                    <h6 class="mb-0">Call the reporter!</h6>
                                                    <h3 class="text-primary m-0">${row.numTeleBeneficie}</h3>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center mt-1">
                                                <i class="ri-mail-line bg-primary p-3 text-white"></i>
                                                <div class="ps-4">
                                                    <h6 class="mb-0">Text the reporter!</h6>
                                                    <h5 class="text-primary m-0">${row.emailBeneficie}</h5>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row g-4 align-items-center">
                                                <div class="col-sm-6">
                                                    <div class="bg-primary p-4 mb-4 wow fadeIn" data-wow-delay="0.3s">
                                                        <i class="fa fa-users fa-2x text-white mb-3"></i>
                                                        <h6 class="text-white text-center mb-0" data-toggle="counter-up">
                                                            Business App
                                                        </h6>
                                                        <p class="text-white text-center mb-0">${row.nomBusinessApp}</p>
                                                    </div>
                                                    <div class="bg-secondary p-4 wow fadeIn" data-wow-delay="0.5s">
                                                        <i class="fa fa-ship fa-2x text-white mb-3"></i>
                                                        <h6 class="text-white text-center mb-2" data-toggle="counter-up">
                                                            Service
                                                        </h6>
                                                        <p class="text-white text-center mb-0">${row.intituleService}</p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="bg-success p-4 wow fadeIn" data-wow-delay="0.7s">
                                                        <i class="fa fa-star fa-2x text-white mb-3"></i>
                                                        <h6 class="text-white mb-2" data-toggle="counter-up"> type service</h6>
                                                        <p class="text-white mb-0">${row.typeService}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary take-incident" data-incident-id="${row.numIncident}">Take incident</button>
                                </div>
                            </div>
                       
                    </div>
                </div>
            `;
            $("body").append(modalHtml); // Append the modal HTML to the body of the page.
        }
    });
}

        function getIncidentsAndGenerateModals() {
            $.ajax({
                url: 'getIncidents.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    generateModals(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching incidents:", error);
                }
            });
        }

        $("#reloadBtn").click(function() {
            reloadTable();
            updateCounts();
        });

        reloadTable();
        updateCounts();

        setInterval(function() {
            reloadTable();
            updateCounts();
        }, 1000);
    });
</script>





            

            <script>
    $(document).ready(function() {
        $("#reloadBtn2").click(function() {
            $(".Mytbody2").load("consultantSpaceTableReload2.php");
        });
    });
    $(document).ready(function() {
        function reloadTable() {
            $(".Mytbody2").load("consultantSpaceTableReload2.php");
        }
        reloadTable();
        setInterval(reloadTable, 1000); 
   
   
   
   });
</script>


       
        </div>
        
    </section>

   

<!--------------incident more inforamtion --------------->
<?php 
mysqli_data_seek($resultData, 0);

while ($row=mysqli_fetch_assoc($resultData)) {   
?>
<div class="modal fade" id="exampleModal-<?php echo $row['numIncident']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Incident Details</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <div class="container-xxl">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-secondary mb-3">Title</h6>
                    <h1 class=""><?php echo $row['titreIncident']; ?></h1>
                    <p class="mb-3"><?php echo $row['descriptionIncident']; ?></p>
                    <div class="d-flex align-items-center">
                        <i class="ri-customer-service-line bg-primary p-3 text-white"></i>
                        <div class="ps-4">
                            <h6 class="mb-0">Call the reporter!</h6>
                            <h3 class="text-primary m-0">
                                <?php
                                  $newsql = "SELECT * FROM beneficie WHERE matriculeBeneficie = " . $row['matriculeBeneficie#'];
                                  $newresult = mysqli_query($conn, $newsql);
                                  $user = mysqli_fetch_assoc($newresult);
                                echo $user["numTeleBeneficie"];
                                ?>

                            </h3>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mt-1">
                    <i class="ri-mail-line bg-primary p-3 text-white"></i>
                        <div class="ps-4">
                            <h6 class="mb-0">Text the reporter!</h6>
                            <h5 class="text-primary m-0 ">
                                <?php
                                  $newsql = "SELECT * FROM beneficie WHERE matriculeBeneficie = " . $row['matriculeBeneficie#'];
                                  $newresult = mysqli_query($conn, $newsql);
                                  $user = mysqli_fetch_assoc($newresult);
                                echo $user["emailBeneficie"];
                                ?>

                            </h5>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="row g-4 align-items-center">
                        <div class="col-sm-6">
                            <div class="bg-primary p-4 mb-4 wow fadeIn" data-wow-delay="0.3s">
                                <i class="fa fa-users fa-2x text-white mb-3"></i>
                                <h6 class="text-white text-center mb-0" data-toggle="counter-up">
                                Business App
                                </h6>
                                <p class="text-white text-center mb-0"><?php 
                                        $sql4="SELECT * FROM businessapp WHERE idBusinessApp =?;";
                                        $stmt4=mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($stmt4,$sql4)){
                                            header("Location:../error.php?error=stmt2failed");exit();
                                        }
                                        mysqli_stmt_bind_param($stmt4, "s", $row['idBusinessApp#']);
                                        mysqli_stmt_execute($stmt4);
                                        $resultData4 = mysqli_stmt_get_result($stmt4);
                                        $r4=mysqli_fetch_assoc($resultData4);
                                        echo $r4["nomBusinessApp"];
                                    ?></p>
                            </div>
                            <div class="bg-secondary p-4 wow fadeIn" data-wow-delay="0.5s">
                                <i class="fa fa-ship fa-2x text-white mb-3"></i>
                                <h6 class="text-white text-center mb-2" data-toggle="counter-up">
                                Service
                                </h6>
                                <p class="text-white text-center mb-0"><?php
                                    $sql5 = "SELECT s.idService, s.intituleService, s.typeService
                                    FROM businessapp b
                                    JOIN service s ON b.`idService#` = s.idService
                                    WHERE b.idBusinessApp = " . $row['idBusinessApp#'];
                                    $result5 = mysqli_query($conn, $sql5);
                                    $r5=mysqli_fetch_assoc($result5);
                                    echo $r5["intituleService"];
                                   ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="bg-success p-4 wow fadeIn" data-wow-delay="0.7s">
                                <i class="fa fa-star fa-2x text-white mb-3"></i>
                                <h6 class="text-white mb-2" data-toggle="counter-up"> type service</h6>
                                <p class="text-white mb-0">
                                    <?php
                                     echo $r5["typeService"];
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary take-incident" data-incident-id="<?php echo $row['numIncident']; ?>">Take incident</button>
            </div>       
         </div>
    </div>
</div>
<?php
}
?>












<script>
$(document).ready(function() {
    $(document).on('click', '.take-incident', function() {
        var incidentId = $(this).data("incident-id");

        // Send Ajax request to the server to update the incident
        $.ajax({
            url: "ajaxPHP/updateIncident.php",
            method: "POST",
            data: { incidentId: incidentId },
            success: function(response) {
                // Update the modal content or perform any other actions
                console.log("Incident updated successfully");
                $(`#exampleModal-${incidentId}`).on('hidden.bs.modal', function () {
                            $(this).remove();
                        }).modal('hide');
            },
            error: function(xhr, status, error) {
                console.error("Error updating incident:", error);
            }
        });
    });
});

</script>


<!--------------end incident more inforamtion --------------->



    <script src="js/script.js"></script>
    <script src="js/script2.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    
</body>

</html>