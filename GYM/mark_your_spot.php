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
    
    <?php 
    //σύνδεση με τη βάση και λήψη των απαραίτητων πληροφοριών και δεδομένων
        $servername="mysql:host=localhost;dbname=gym_papei_ds";
        $username="root";
        $password="";
        $conn=new PDO($servername,$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt=$conn->prepare("SELECT * FROM προγραμμα where ΗΜΕΡΟΜΗΝΙΑ = 'ΔΕΥΤΕΡΑ' ORDER BY ΩΡΑ ASC");
        $stmt->execute();
        $result2=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt=$conn->prepare("SELECT * FROM προγραμμα where ΗΜΕΡΟΜΗΝΙΑ = 'ΤΡΙΤΗ' ORDER BY ΩΡΑ ASC");
        $stmt->execute();
        $result3=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt=$conn->prepare("SELECT * FROM προγραμμα where ΗΜΕΡΟΜΗΝΙΑ = 'ΤΕΤΑΡΤΗ' ORDER BY ΩΡΑ ASC");
        $stmt->execute();
        $result4=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt=$conn->prepare("SELECT * FROM προγραμμα where ΗΜΕΡΟΜΗΝΙΑ = 'ΠΕΜΠΤΗ' ORDER BY ΩΡΑ ASC");
        $stmt->execute();
        $result5=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt=$conn->prepare("SELECT * FROM προγραμμα where ΗΜΕΡΟΜΗΝΙΑ = 'ΠΑΡΑΣΚΕΥΗ' ORDER BY ΩΡΑ ASC");
        $stmt->execute();
        $result6=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt=$conn->prepare("SELECT DISTINCT ΕΙΔΟΣ FROM προγραμμα");
        $stmt->execute();
        $result7=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt=$conn->prepare("SELECT * FROM προγραμμα");
        $stmt->execute();
        $result8=$stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    
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
                            <li class="scroll-to-section"><a href="#top">ΡΑΝΤΕΒΟΥ</a></li>
                            <li class="scroll-to-section"><a href="#schedule">ΠΡΟΓΡΑΜΜΑ</a></li>
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



    <!-- φόρμα για επιλογή ραντεβού -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="images/gym-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
            <form id="registrationForm" action="" method="POST">
                <p class="forma">ΗΜΕΡΑ: <input type="date" name="date" required></p><br>
                <p class="forma">ΤΜΗΜΑ: <select type="text" name="tmhma" required>
                    <option></option>
                    <?php foreach($result7 as $row7){?>
                        <option><?= $row7["ΕΙΔΟΣ"] ?></option>
                    <?php }?>
                </select></p><br>
                <input type="submit" value="ΚΛΕΙΣΤΕ ΘΕΣΗ">
            </form>
            <?php
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $shmera=new DateTime();
                    if(isset($_POST['date'])){
                        $date=$_POST['date'];
                    }else{
                        $date = " ";
                    }
                    if(isset($_POST['tmhma'])){
                        $tmhma=$_POST['tmhma'];
                    }else{
                        $tmhma = " ";
                    }
                    //μετατροπή της αγγλικής ημέρας στα ελληνικά για ευθυγράμισση με τη βάση
                    if (date("l", strtotime($date)) === "Monday") {
                        $day='ΔΕΥΤΕΡΑ';
                    }
                    elseif(date("l", strtotime($date)) === "Tuesday"){
                        $day='ΤΡΙΤΗ';
                    }
                    elseif(date("l", strtotime($date)) === "Wednesday"){
                        $day='ΤΕΤΑΡΤΗ';
                    }
                    elseif(date("l", strtotime($date)) === "Thursday"){
                        $day='ΠΕΜΠΤΗ';
                    }
                    elseif(date("l", strtotime($date)) === "Friday"){
                        $day='ΠΑΡΑΣΚΕΥΗ';
                    }
                    elseif(date("l", strtotime($date)) === "Saturday"){
                        $day='ΣΑΒΒΑΤΟ';
                    }
                    elseif(date("l", strtotime($date)) === "Sunday"){
                        $day='ΚΥΡΙΑΚΗ';
                    }
                    $t=1;
                    $t2=0;
                    foreach($result8 as $row8){
                        if($row8["ΕΙΔΟΣ"]==$tmhma && $row8["ΗΜΕΡΟΜΗΝΙΑ"]==$day){
                            $t=0;
                            //λήψη δεδομένων από τη βάση
                            $stmt = $conn->prepare("SELECT * FROM προγραμμα WHERE ΕΙΔΟΣ = :tmhma AND ΗΜΕΡΟΜΗΝΙΑ = :day");
                            $stmt->bindParam(':tmhma', $tmhma, PDO::PARAM_STR);
                            $stmt->bindParam(':day', $day, PDO::PARAM_STR); // Αν η ημερομηνία είναι σε string μορφή (YYYY-MM-DD)
                            $stmt->execute();
                            $result9 = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $stmt=$conn->prepare("SELECT * FROM συμμετοχη");
                            $stmt->execute();
                            $result10=$stmt->fetchAll(PDO::FETCH_ASSOC);
                        }
                    }
                    $user_date = DateTime::createFromFormat('Y-m-d', $date); // Μετατροπή σε DateTime
                    if($user_date < $shmera){
                        ?><div class="forma"><?php echo 'Επιλέξτε ημερομηνία που δεν έχει παρέλθει!';?></div><?php
                        $t2=1;
                    }
                    if($t==1){
                        ?><div class="forma"><?php echo 'Το Τμήμα που επιλέξατε δεν είναι στο πρόγραμμα για τη μέρα: ', $day;?></div><?php
                    }
                    $kk=0;
                    if($t==0 && $t2==0){
                        foreach($result10 as $row10){
                            foreach($result9 as $row9){
                                if($row10["ΠΡΟΓΡΑΜΜΑ_ID_ΠΡΟΓΡΑΜΜΑΤΟΣ"]==$row9["ID_ΠΡΟΓΡΑΜΜΑΤΟΣ"]){
                                    $kk++;
                                }
                            }
                        }
                        foreach($result9 as $row9){ $idofprog=$row9["ID_ΠΡΟΓΡΑΜΜΑΤΟΣ"]; }
                        foreach($result9 as $row9){
                            if($kk>=$row9["ΜΕΓΙΣΤΟΣ_ΑΡΙΘΜΟΣ_ΟΜΑΔΑΣ"] && $row9["ΜΕΓΙΣΤΟΣ_ΑΡΙΘΜΟΣ_ΟΜΑΔΑΣ"]!=0){
                                ?><div class="forma"><?php echo 'Το Τμήμα που επιλέξατε δεν έχει διαθέσιμη θέση για τη ',$day,' στις ',$date,"!";?></div><?php //μήνυμα σφάλματος
                            }
                            else{
                                if (isset($_COOKIE["loginname"])) {
                                    $username = $_COOKIE["loginname"];//επαναφορά cookie
                                    $stmt = $conn->prepare("SELECT ID_ΧΡΗΣΤΗ FROM χρηστησ WHERE ΟΝΟΜΑ_ΧΡΗΣΤΗ = :username");//λήψη δεδομένων από τη βάση
                                    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                                    $stmt->execute();
                                    $result11 = $stmt->fetch(PDO::FETCH_ASSOC);
                                    if ($result11) {
                                        $idofuser = $result11["ID_ΧΡΗΣΤΗ"];
                                    } else {
                                        $idofuser = null; // Χειρισμός αν ο χρήστης δεν βρεθεί
                                    }
                                } else {
                                    $idofuser = null; // Χειρισμός αν το cookie δεν υπάρχει
                                }
                                $akur='ΟΧΙ';
                                //λήψη ραντεβού που έχουν ακυρωθεί τη παρούσα εβδομάδα
                                $week_start = date('Y-m-d 00:00:00', strtotime('monday this week'));
                                $week_end = date('Y-m-d 23:59:59', strtotime('sunday this week'));
                                $stmt = $conn->prepare("SELECT COUNT(*) AS cancelled_count FROM συμμετοχη WHERE ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ = :user_id AND ΑΚΥΡΩΜΕΝΟ = 'ΝΑΙ'AND ΗΜΕΡΑ BETWEEN :week_start AND :week_end");
                                $stmt->bindParam(':user_id', $idofuser, PDO::PARAM_INT);
                                $stmt->bindParam(':week_start', $week_start, PDO::PARAM_STR);
                                $stmt->bindParam(':week_end', $week_end, PDO::PARAM_STR);
                                $stmt->execute();
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($result['cancelled_count'] >= 2) {
                                    echo "<p class='forma'>Έχεις ήδη ακυρώσει 2 ραντεβού αυτή την εβδομάδα. Δεν μπορείς να κλείσεις άλλο.</p>"; //μήνυμα σφάλματος
                                }else{
                                    //προσθήκη ραντεβού στη βάση δεδομένων
                                    try{
                                        $sql='INSERT INTO συμμετοχη (ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ,ΠΡΟΓΡΑΜΜΑ_ID_ΠΡΟΓΡΑΜΜΑΤΟΣ,ΗΜΕΡΑ,ΑΚΥΡΩΜΕΝΟ) VALUES (:ixrhsth,:iprog,:hhmera,:akur)';
                                        $stmt=$conn->prepare($sql);
                                        $stmt->bindParam(':ixrhsth',$idofuser);
                                        $stmt->bindParam(':iprog',$idofprog);
                                        $stmt->bindParam(':hhmera',$date);
                                        $stmt->bindParam(':akur',$akur);
                                        $stmt->execute();
                                        echo '<script>window.location.href = "http://localhost/GYM/history.php";</script>';
                                        exit();
                                    }catch(PDOException $e){
                                        echo 'Connection failed: ' .$e->getMessage();
                                    }
                                }
                            }
                        }
                    }
                }
            ?>
            </div>
        </div>
    </div>
    
    <section class="section" id="schedule">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading dark-bg">
                        <h2> <em>ΠΡΟΓΡΑΜΜΑ</em></h2>
                        <img src="images/line-dec.png" alt="">
                        <p>Ακολουθεί το εβδομαδιαίο πρόγραμμα του γυμναστηρίου.</p><br>
                        <p>Επισύμανση: Τα ομαδικά τμήματα είναι έως 15(δεκαπέντε) άτομα.</p>
                    </div>
                </div>
            </div>
            <!-- Εμφάνιση του προγράμματος του γυμναστηρίου -->
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="schedule-table filtering">
                        <table>
                            <tbody>
                                    <tr>
                                        <td class="day-time">ΔΕΥΤΕΡΑ</td>
                                        <?php foreach($result2 as $row2){?> <td class="day-time"><?= $row2["ΕΙΔΟΣ"]?><br><?= $row2["ΩΡΑ"] ?></td><?php }?>
                                    </tr>
                                    <tr>
                                        <td class="day-time">ΤΡΙΤΗ</td>
                                        <?php foreach($result3 as $row3){?> <td class="day-time"><?= $row3["ΕΙΔΟΣ"]?><br><?= $row3["ΩΡΑ"] ?></td><?php }?>
                                    </tr>
                                    <tr>
                                        <td class="day-time">ΤΕΤΑΡΤΗ</td>
                                        <?php foreach($result4 as $row4){?> <td class="day-time"><?= $row4["ΕΙΔΟΣ"]?><br><?= $row4["ΩΡΑ"] ?></td><?php }?>
                                    </tr>
                                    <tr>
                                        <td class="day-time">ΠΕΜΠΤΗ</td>
                                        <?php foreach($result5 as $row5){?> <td class="day-time"><?= $row5["ΕΙΔΟΣ"]?><br><?= $row5["ΩΡΑ"] ?></td><?php }?>
                                    </tr>
                                    <tr>
                                        <td class="day-time">ΠΑΡΑΣΚΕΥΗ</td>
                                        <?php foreach($result6 as $row6){?> <td class="day-time"><?= $row6["ΕΙΔΟΣ"]?><br><?= $row6["ΩΡΑ"] ?></td><?php }?>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    
    <!-- επικοινωνία και χάρτης -->
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
                    
                    <!-- μήνυμα για copyright -->
                    
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