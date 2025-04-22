<?php
ob_start(); // Αρχή output
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
    <!-- σύνδεση με css αρχεία -->
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
    
    
    <!-- επικεφαλίδα σελίδας -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- logo σελίδας -->
                        <a href="start_login.php" class="logo">GYM <em> UNIPI</em></a>
                        <!-- μενού σελίδας -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="start_login.php" class="active">ΑΡΧΙΚΗ</a></li>
                            <li class="scroll-to-section"><a href="#contact-us">ΕΠΙΚΟΙΝΩΝΙΑ</a></li>
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

    <!-- εμφάνιση των κρατήσεων του χρήστη -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="images/gym-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
            <?php
                    # λήψη όλων των στοιχείων του χρήστη από τη βάση δεδομένων και ανάκτηση cookie
                    $username = $_COOKIE['loginname'];
                    $stmt = $conn->prepare("SELECT * FROM χρηστησ WHERE ΟΝΟΜΑ_ΧΡΗΣΤΗ = :username");
                    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $idxr=$result["ID_ΧΡΗΣΤΗ"];
                    $stmt = $conn->prepare("SELECT * FROM συμμετοχη WHERE ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ = :xrxr");
                    $stmt->bindParam(':xrxr', $idxr, PDO::PARAM_STR);
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
                        <th>ΑΚΥΡΩΜΕΝΟ</th>
                    </tr>
                    <?php foreach($result1 as $row1){
                        //ανάκτηση στοιχείων προς εμφάνιση 
                        $xrxr1=$row1["ΠΡΟΓΡΑΜΜΑ_ID_ΠΡΟΓΡΑΜΜΑΤΟΣ"];
                        $stmt = $conn->prepare("SELECT * FROM προγραμμα where ID_ΠΡΟΓΡΑΜΜΑΤΟΣ = :xrxr1");
                        $stmt->bindParam(':xrxr1', $xrxr1, PDO::PARAM_STR);
                        $stmt->execute();
                        $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
                        $xrxr2=$result2["ΓΥΜΝΑΣΤΗΣ_ID_ΓΥΜΝΑΣΤΗ"];
                        $stmt = $conn->prepare("SELECT * FROM γυμναστησ where ID_ΓΥΜΝΑΣΤΗ = :xrxr2");
                        $stmt->bindParam(':xrxr2', $xrxr2, PDO::PARAM_STR);
                        $stmt->execute();
                        $result3 = $stmt->fetch(PDO::FETCH_ASSOC);
                        ?>
                    <tr>
                        <td><?= $row1["ID_ΣΥΜΜΕΤΟΧΗΣ"] ?>|</td>
                        <td><?= $result2["ΕΙΔΟΣ"] ?>|</td>
                        <td><?= $result2["ΩΡΑ"] ?>|</td>
                        <td><?= $row1["ΗΜΕΡΑ"] ?>|</td>
                        <td><?= $result3["ΕΠΩΝΥΜΟ"] ?>|</td>
                        <td><?= $row1["ΑΚΥΡΩΜΕΝΟ"] ?></td>
                    </tr>
                    <?php }?>
                </table>
                </div>
                <!-- φόρμα για επιλογή id κράτησης προς ακύρωση από το χρήστη -->
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
                    // έλεγχος για ακύρωση της κράτησης εκτός δύο ωρών πριν από την ομάδα σε ώρα Αθήνας
                    $stmt = $conn->prepare("SELECT ΠΡΟΓΡΑΜΜΑ_ID_ΠΡΟΓΡΑΜΜΑΤΟΣ FROM συμμετοχη where ID_ΣΥΜΜΕΤΟΧΗΣ = :ora");
                    $stmt->bindParam(':ora', $idxr, PDO::PARAM_STR);
                    $stmt->execute();
                    $result4 = $stmt->fetch(PDO::FETCH_ASSOC);
                    $stmt = $conn->prepare("SELECT * FROM προγραμμα where ID_ΠΡΟΓΡΑΜΜΑΤΟΣ = :ora1");
                    $stmt->bindParam(':ora1', $result4["ΠΡΟΓΡΑΜΜΑ_ID_ΠΡΟΓΡΑΜΜΑΤΟΣ"], PDO::PARAM_STR);
                    $stmt->execute();
                    $result5 = $stmt->fetch(PDO::FETCH_ASSOC);
                    $t=0;
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
                        if($t==1 && $interval->h>=2){
                            try{
                                $sql="UPDATE συμμετοχη SET ΑΚΥΡΩΜΕΝΟ='ΝΑΙ' WHERE ID_ΣΥΜΜΕΤΟΧΗΣ=$idxr";
                                $stmt=$conn->prepare($sql);
                                $stmt->execute();
                            }
                            catch(PDOException $e){
                                echo 'Connection failed: ' .$e->getMessage();
                            }
                            header("Location: http://localhost/GYM/history.php");
                            exit();
                        }
                        elseif($user_date1 < $shmera){?>
                            <p class="forma">Επιλέξτε ημερομηνία που δεν έχει παρέλθει</p><?php // μήνυμα λάθους
                        }
                        elseif($user_date1 >= $shmera && $interval->h<2){?>
                            <p class="forma">Η ακύρωση των ραντεβού επιτρέπεται μόνο έως και 2 ώρες πριν</p><?php // μήνυμα λάθους
                        }
                        else{?>
                            <p class="forma">Το ID δεν αντιστοιχεί σε κάποιο ραντεβού</p><?php // μήνυμα λάθους
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    
    
    <!-- στοιχεία επικοινωνίας και χάρτης-->
    <section class="section" id="contact-us">
        <div class="container-fluid">
            <div class="section-heading">
                <h2> <em>ΕΠΙΚΟΙΝΩΝΙΑ</em></h2>
                <img src="images/line-dec.png" alt="">
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div id="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3146.521770723333!2d23.65040437650738!3d37.941601271943824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14a1bbe5bb8515a1%3A0x3e0dce8e58812705!2zzqDOsc69zrXPgM65z4PPhM6uzrzOuc6_IM6gzrXOuc-BzrHOuc-Oz4I!5e0!3m2!1sel!2sgr!4v1738427697598!5m2!1sel!2sgr" width=100% height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="contact-form">
                        <div class="contact-form">
                                <div class="contact-form">
                                    <h3>Τηλέφωνο: <a class='thlefono' href="tel:2104142076">210-4142076</a></h3>
                                    <h3>Email: <a class='email' href="https://mail.google.com/mail/u/0/#inbox?compose=DmwnWsmFRzJBWdZwGhFzRkTTgHQjFLfGNqWWDJBbJrsZLcJHqqFwBQgXQjGlQBzxfJlnCTLSjgWv">gramds@unipi.gr</a></h3>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; 2025 GYM PAPEI</p>
                    
                    <!-- μήνυμα copyright  -->
                    
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