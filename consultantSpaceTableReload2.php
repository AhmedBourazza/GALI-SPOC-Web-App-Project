<?php
    include_once 'includes/dbh.inc.php';
    session_start();
    $sql ="SELECT * FROM incident WHERE etatIncident='Taking'  AND `numConsultant#`= {$_SESSION['numConsultant']};;";
    $resultData = mysqli_query($conn, $sql);
?>
<?php 
                     while ($row=mysqli_fetch_assoc($resultData)) {   
                    ?>
                                    <tr   data-incident-id="<?php echo $row['numIncident']; ?>" data-toggle="modal" data-target="#exampleModal-<?php echo $row['numIncident']; ?>">
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
                                    <td class="stateChanging">
                                        <?php echo $row['etatIncident'] ?>
                                    </td>
                                </tr>
                             
                                <?php
                                
                        }          
                    ?>