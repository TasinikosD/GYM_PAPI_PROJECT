<?php
ob_start(); // Αρχή του output
session_start(); // Αρχή session
# σύνδεση με τη βάση δεδομένων
$servername="mysql:host=localhost;dbname=gym_papei_ds";
$username="root";
$password="";
$conn=new PDO($servername,$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>GYM UNIPI</title>
    <link rel="icon" href="images/titlelogo.jpg" type="image/icon type">
    <!-- Σύνδεση με τα αρχεία css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">

    <link rel="stylesheet" href="css/templatemo-training-studio.css">

    </head>
    
    <body>
    
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    
    
    <!-- Επικεφαλίδα σελίδας -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- Logo σελίδας -->
                        <a href="start_login_admin.php" class="logo">GYM <em> UNIPI</em></a>
                        <!-- Menou σελίδας -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="start_login_admin.html" class="active">ΑΡΧΙΚΗ</a></li>
                            <li class="main-button"><a href="start_not_login.php">ΑΠΟΣΥΝΔΕΣΗ</a></li>
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Εμφάνιση στοιχείων κρατήσεων -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="images/gym-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
            <?php
                    $stmt = $conn->prepare("SELECT * FROM συμμετοχη where ΑΚΥΡΩΜΕΝΟ='ΟΧΙ'");
                    $stmt->execute();
                    $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <p class="forma">Ιστορικό Κρατήσεων</p>
                <div class="forma">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>ΕΙΔΟΣ</th>
                        <th>ΩΡΑ</th>
                        <th>ΗΜΕΡΑ</th>
                        <th>ΓΥΜΝΑΣΤΗΣ</th>
                        <th>ΓΥΜΝΑΖΟΜΕΝΟΣ</th>
                    </tr>
                    <?php foreach($result1 as $row1){
                        //σύνδεση με βάση για άντληση και εμφάνιση στοιχείων της κάθε μη ακυρωμένης κράτησης
                        $xrxr1=$row1["ΠΡΟΓΡΑΜΜΑ_ID_ΠΡΟΓΡΑΜΜΑΤΟΣ"];
                        $idixr = $row1["ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ"];
                        $stmt = $conn->prepare("SELECT * FROM προγραμμα where ID_ΠΡΟΓΡΑΜΜΑΤΟΣ = :xrxr1");
                        $stmt->bindParam(':xrxr1', $xrxr1, PDO::PARAM_STR);
                        $stmt->execute();
                        $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
                        $xrxr2=$result2["ΓΥΜΝΑΣΤΗΣ_ID_ΓΥΜΝΑΣΤΗ"];
                        $stmt = $conn->prepare("SELECT * FROM γυμναστησ where ID_ΓΥΜΝΑΣΤΗ = :xrxr2");
                        $stmt->bindParam(':xrxr2', $xrxr2, PDO::PARAM_STR);
                        $stmt->execute();
                        $result3 = $stmt->fetch(PDO::FETCH_ASSOC);
                        $stmt = $conn->prepare("SELECT * FROM χρηστησ where ID_ΧΡΗΣΤΗ = :xridi");
                        $stmt->bindParam(':xridi', $idixr, PDO::PARAM_STR);
                        $stmt->execute();
                        $result6 = $stmt->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <tr>
                        <td><?= $row1["ID_ΣΥΜΜΕΤΟΧΗΣ"] ?>|</td>
                        <td><?= $result2["ΕΙΔΟΣ"] ?>|</td>
                        <td><?= $result2["ΩΡΑ"] ?>|</td>
                        <td><?= $row1["ΗΜΕΡΑ"] ?>|</td>
                        <td><?= $result3["ΕΠΩΝΥΜΟ"] ?></td>
                        <td><?= $result6["ΕΠΩΝΥΜΟ"] ?></td>
                        </tr>
                    <?php }?>
                </table>
                </div>
                <!-- Φόρμα για επιλογή id προς ακύρωση ραντεβού -->
                <form action="" method="POST">
                    <p class="forma">ΓΡΑΨΤΕ ΤΟ ID ΤΟΥ ΡΑΝΤΕΒΟΥ ΠΟΥ ΘΕΛΕΤΕ ΝΑ ΑΚΥΡΩΣΕΤΕ</p>
                    <input type="text" name="idxr" required>
                    <input name="Accept" type="submit" value='ΑΚΥΡΩΣΗ'>
                </form>
                <?php
                    if(isset($_POST['Accept'])){
                        $Accept=$_POST['Accept'];
                    }else{
                        $Accept = " ";
                    }
                    if(isset($_POST['idxr'])){
                        $idxr=$_POST['idxr'];
                    }else{
                        $idxr = " ";
                    }
                    //άντληση δεδομένων από τη βάση
                    $stmt = $conn->prepare("SELECT ΠΡΟΓΡΑΜΜΑ_ID_ΠΡΟΓΡΑΜΜΑΤΟΣ FROM συμμετοχη where ID_ΣΥΜΜΕΤΟΧΗΣ = :ora");
                    $stmt->bindParam(':ora', $idxr, PDO::PARAM_STR);
                    $stmt->execute();
                    $result4 = $stmt->fetch(PDO::FETCH_ASSOC);
                    $stmt = $conn->prepare("SELECT * FROM προγραμμα where ID_ΠΡΟΓΡΑΜΜΑΤΟΣ = :ora1");
                    $stmt->bindParam(':ora1', $result4["ΠΡΟΓΡΑΜΜΑ_ID_ΠΡΟΓΡΑΜΜΑΤΟΣ"], PDO::PARAM_STR);
                    $stmt->execute();
                    $result5 = $stmt->fetch(PDO::FETCH_ASSOC);
                    $t=0;
                    //ημερομηνία και ώρα Αθήνας + έλεγχος εάν η διαγραφή κράτησης γίνεται εντλος δλυο ωρών πριν το ραντεβού
                    date_default_timezone_set('Europe/Athens');
                    $shmera=new DateTime();
                    $shmera = $shmera->format('Y-m-d');
                    if($Accept=='ΑΚΥΡΩΣΗ'){
                        $currenttime = date('H:i:s');
                        foreach($result1 as $row1){
                            $date=$row1["ΗΜΕΡΑ"];
                            $user_date = DateTime::createFromFormat('Y-m-d', $date); // Μετατροπή σε DateTime
                            $user_date1 = $user_date->format('Y-m-d');
                            if($idxr==$row1["ID_ΣΥΜΜΕΤΟΧΗΣ"] && $user_date1 >= $shmera){
                                $t=1;
                            }
                        }
                        $shmera1=new DateTime();
                        $shmera1->setTimezone(new DateTimeZone('Europe/Athens'));
                        $currentTime = $shmera1->format('H:i:s');
                        $dbTime = DateTime::createFromFormat('H:i:s', $result5["ΩΡΑ"]);
                        $currentDateTime = DateTime::createFromFormat('H:i:s', $currentTime);
                        $interval = $dbTime->diff($currentDateTime);
                        //εισαγωγή ακύρωσης στη βάση δεδομένων
                        if($t==1 && $interval->h>=2){
                            try{
                                $sql="UPDATE συμμετοχη SET ΑΚΥΡΩΜΕΝΟ='ΝΑΙ' WHERE ID_ΣΥΜΜΕΤΟΧΗΣ=$idxr";
                                $stmt=$conn->prepare($sql);
                                $stmt->execute();
                            }
                            catch(PDOException $e){
                                echo 'Connection failed: ' .$e->getMessage();
                            }
                            header("Location: http://localhost/GYM/diax_krat.php");
                            exit();
                        }
                        elseif($user_date1 < $shmera){?>
                            <p class="forma">Επιλέξτε ημερομηνία που δεν έχει παρέλθει</p><?php  //μήνυμα σφάλματος
                        }
                        elseif($user_date1 >= $shmera && $interval->h<2){?>
                            <p class="forma">Η ακύρωση των ραντεβού επιτρέπεται μόνο έως και 2 ώρες πριν</p><?php //μήνυμα σφάλματος
                        }
                        else{?>
                            <p class="forma">Το ID δεν αντιστοιχεί σε κάποιο ραντεβού</p><?php //μήνυμα σφάλματος
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; 2025 GYM PAPEI</p>
                    <!-- μήνυμα copyright -->
                    
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="js/scrollreveal.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imgfix.min.js"></script> 
    <script src="js/mixitup.js"></script> 
    <script src="js/accordions.js"></script>
    
    <!-- Global Init -->
    <script src="js/custom.js"></script>

  </body>
</html>