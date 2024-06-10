<?php
session_start();
if (!isset($_SESSION['UserloggedIn']) || $_SESSION['UserloggedIn'] !== true) {
    header("location:../login.php?error=unauthorized");
    exit();
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User space</title>
    <link href="cssUserSpace/userSpaceStyle.css" rel="stylesheet" />
    <link href="cssUserSpace/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet">

</head>

<body>
   
    <div class="w-100 navbarDiv" style="height: 5rem; background-color: #043962; margin-bottom: 5rem;position: relative;">
        <h1>GALI SPOC</h1>
        <div class="nav-bar">
            
        <a href=""  data-toggle="modal" data-target=".profilSpace" class="iconDiv">
            <i class="ri-map-pin-user-fill"></i> 
            <span>user</span>
        </a>
        <a href="" class="iconDiv">
            <i class="ri-home-3-fill"></i>
            <span>home</span>

        </a>
      
        <a href="includes/logout.inc.php" class="iconDiv">
        <i class="ri-logout-box-fill"></i>
        <span>Logout</span>
        </a>

       </div>
       <img src="images/logo2.png" alt="">

    </div>
       <!-- history space -->
     
        <!-- end history space -->

    <!-- profil space -->
    <div class="modal fade profilSpace" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="page-content page-container" 
                 id="page-content">
                    <div class="padding">
                        <div class="row container d-flex justify-content-center">
                            <div class="col-xl-12 col-md-12">
                                <div class="card user-card-full">
                                    <div class="row m-l-0 m-r-0">
                                        <div class="col-sm-4 bg-c-lite-green user-profile">
                                            <div class="card-block text-center text-white">
                                                <div class="mb-25">
                                                    <img src="images/profile.png"
                                                        class="img-radius" alt="User-Profile-Image">
                                                       
                                                </div>
                                                <h6 class="f-w-600"><?php echo $_SESSION["nomBeneficie"]." ".$_SESSION["prenomBeneficie"]; ?></h6>
                                                <p><?php echo $_SESSION["statutBeneficie"]; ?></p>
                                                <i
                                                    class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="card-block">
                                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information personnelle</h6>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p class="m-b-10 f-w-600">Email</p>
                                                        <h6 class="text-muted f-w-400"><?php echo $_SESSION["emailBeneficie"]; ?></h6>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p class="m-b-10 f-w-600">Phone</p>
                                                        <h6 class="text-muted f-w-400">0682413913</h6>
                                                    </div>
                                                </div>
                                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Information du travail</h6>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p class="m-b-10 f-w-600">matricule</p>
                                                        <h6 class="text-muted f-w-400"><?php echo $_SESSION["matriculeBeneficie"]; ?></h6>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p class="m-b-10 f-w-600">societé</p>
                                                        <h6 class="text-muted f-w-400"><?php echo $_SESSION["societeBeneficie"]; ?></h6>
                                                    </div>
                                                </div>
                                                <ul class="social-link list-unstyled m-t-40 m-b-10">
                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom"
                                                            title="" data-original-title="facebook" data-abc="true"><i
                                                                class="mdi mdi-facebook feather icon-facebook facebook"
                                                                aria-hidden="true"></i></a></li>
                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom"
                                                            title="" data-original-title="twitter" data-abc="true"><i
                                                                class="mdi mdi-twitter feather icon-twitter twitter"
                                                                aria-hidden="true"></i></a></li>
                                                    <li><a href="#!" data-toggle="tooltip" data-placement="bottom"
                                                            title="" data-original-title="instagram" data-abc="true"><i
                                                                class="mdi mdi-instagram feather icon-instagram instagram"
                                                                aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end profil space -->

    <!-- create incident space  -->
    <div class="modal fade incidentSpace" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <section class="contact_section layout_padding-bottom">
                    <div class="container">
                        <div class="heading_container heading_center">
                            <h2>
                                Create an incident
                            </h2>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-lg-6 mx-auto">
                                <div class="form_container">
                                    <form action="includes/incidentForm.inc.php" method="post">
                                        <div>
                                            <input type="text" name="title" placeholder="Title" required  />
                                        </div>
                                        <div class="box ">
                                        <select name="businnesApp" required >
                                        <option value="" disabled selected>My incident affects :</option>
                                        <option value="7zip">7zip</option>
                                        <option value="Azure DevOps">Azure DevOps</option>
                                        <option value="Excel">Excel</option>
                                        <option value="Linux">Linux</option>
                                        <option value="MPA">MPA</option>
                                        <option value="Powerpoint">Powerpoint</option>
                                        <option value="Printer">Printer</option>
                                        <option value="Virtual Desktop">Virtual Desktop</option>
                                        <option value="VPN Remote access">VPN Remote access</option>
                                        <option value="Word">Word</option>
                                        </select>

                                        </div>
                                        <div>
                                        <div class="box urgency"  >
                                        <select name="urgency" required >
                                            <option value="" disabled selected>Urgency :</option>
                                            <option value="High">High</option>
                                            <option value="Low">Low</option>
                                            <option value="Meduim">Meduim</option> <!-- Attention : vous avez écrit "Meduim" au lieu de "Medium" -->

                                        </select>
                                        


                                        </div>                         
                                                   </div>
                                        <div>
                                            <input type="text" required  name="shortDescription" class="message-box" placeholder="Short description" />
                                        </div>
                                        <div class="btn_box ">
                                            <button name="submit">
                                                Submit
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
  
    <!-- end  incident space -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                    <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                        <div class="service-icon flex-shrink-0">
                            <i class="ri-profile-fill" style="font-size: 40px;"></i>
                        </div>
                        <h5 class="mb-3">Profil</h5>
                        <p>this section displays your personal information, such as name, email, and contact details, in one place for easy access and management</p>
                        <a class="btn px-3 mt-auto mx-auto" href="" data-toggle="modal" data-target=".profilSpace">Enter</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                        <div class="service-icon flex-shrink-0">
                            <i class="ri-add-circle-fill"></i>
                        </div>
                        <h5 class="mb-3">Create Incident</h5>
                        <p>Easily report incidents with relevant details for quick and efficient resolution.
</p>
                        <a class="btn px-3 mt-auto mx-auto" href="" data-toggle="modal" data-target=".incidentSpace">Enter</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                        <div class="service-icon flex-shrink-0">
                            <i class="ri-history-line"></i>
                        </div>
                        <h5 class="mb-3">See History</h5>
                        <p>
View your incident history for easy tracking and reference. This section displays a list of all the incidents you have reported</p>
                        <a class="btn px-3 mt-auto mx-auto" href="userSpaceHistory.php">Enter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Service End -->

   


    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>