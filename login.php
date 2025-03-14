<!DOCTYPE html>
<html>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>GYM UNIPI</title>
    <link rel="icon" href="images/titlelogo.jpg" type="image/icon type">
    <!-- σύνδεση με css files -->
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
                        <a href="start_not_login.php" class="logo">GYM <em> UNIPI</em></a>
                        <!-- Menu σελίδας -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="start_not_login.php" class="active">ΑΡΧΙΚΗ</a></li>
                            <li class="scroll-to-section"><a href="#contact-us">ΕΠΙΚΟΙΝΩΝΙΑ</a></li>
                            <li class="scroll-to-section"></li>
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Φόρμα για συμπλήρωση στοιχείων για login -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="images/gym-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <form action="" method="POST">
                    <p class="forma">ΟΝΟΜΑ ΧΡΗΣΤΗ: <input type="text" name="nameuser"></p><br>
                    <p class="forma">ΚΩΔΙΚΟΣ ΠΡΟΣΒΑΣΗΣ: <input type="password" name="code" id="password"></p><br>
                    <div class="forma"> <input type="checkbox" onclick="myFunction()">Show Password </div>
                    <!-- κάλεσμα javascript για εμφάνιση κωδικού και απόκρυψη κωδικού-->
                    <script>function myFunction() {
                    var x = document.getElementById("password");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }</script>
                    <br><br><input type="submit" value="ΣΥΝΔΕΣΗ">
                </form>
                <?php
                ob_start(); // αρχή output
                session_start(); // αρχή session
                # σύνδεση με τη βάση δεδομένων
                $servername="mysql:host=localhost;dbname=gym_papei_ds";
                $username="root";
                $password="";
                $conn=new PDO($servername,$username,$password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                # συνάρτηση για να δούμε εάν ένα string έχει μόνο χαρακτήρες
                function chars($str) {
                    return preg_match('/[^a-zA-ZΑ-Ωα-ω]/', $str) > 0;
                }
                # συνάρτηση για να δούμε εάν ένα string έχει έστω έναν αριθμό
                function code($str) {
                    return preg_match('~[0-9]+~', $str) > 0;
                }
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    # λήψη username και password που εισάγει ο χρήστης
                    if(isset($_POST['nameuser'])){
                        $user=$_POST['nameuser'];
                    }else{
                        $user = "";
                    }
                    $length=4;
                    if(isset($_POST['code'])){
                        $pass=$_POST['code'];
                        $length=strlen($pass);
                    }else{
                        $pass = "";
                    }
                    # λήψη όλων των στοιχείων του χρήστη από τη βάση δεδομένων
                    $stmt=$conn->prepare("SELECT * FROM χρηστησ");
                    $stmt->execute();
                    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    $t=0;
                    $a=0;
                    $tkr=0;
                    if(!empty($result)){
                        foreach($result as $row){
                            # έλεγψος των username και password της βάσης δεδομένων με αυτά που έχει δώσει ο χρήστης και login εάν ταιριάζουν
                            if($user==$row['ΟΝΟΜΑ_ΧΡΗΣΤΗ'] && $pass==$row['ΚΩΔΙΚΟΣ_ΠΡΟΣΒΑΣΗΣ']){
                                $idi=$row['ID_ΧΡΗΣΤΗ'];
                                $stmt=$conn->prepare("SELECT * FROM αιτημα_εγγραφησ");
                                $stmt->execute();
                                $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                                if(!empty($result)){
                                    foreach($result as $row){
                                        if($row['ΚΑΤΑΣΤΑΣΗ']=='ΑΠΟΔΟΧΗ'){ //έλεγχος για χρήστη που έχει γίνει αποδεκτός
                                            $stmt=$conn->prepare("SELECT * FROM ρολοσ");
                                            $stmt->execute();
                                            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                                            if(!empty($result)){
                                                foreach($result as $row){
                                                    if ($idi == $row['ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ']) {
                                                        if ($row['ΡΟΛΟΣ'] == 'ΔΙΑΧΕΙΡΙΣΤΗΣ') {
                                                            if (!isset($_COOKIE['loginid'])) {
                                                                setcookie("loginid", $idi, time() + 86400, '/'); //cookie για id admin
                                                            }
                                                            header("Location: http://localhost/GYM/start_login_admin.php");
                                                            exit();
                                                        } elseif ($row['ΡΟΛΟΣ'] == 'ΧΡΗΣΤΗΣ') {
                                                            if (isset($_COOKIE['loginname'])) {
                                                                setcookie("loginname", "", time() - 86400, '/'); // Διαγραφή του παλιού cookie
                                                            }
                                                            setcookie("loginname", $user, time() + 86400, '/'); //cookie για id user
                                                            header("Location: http://localhost/GYM/start_login.php");
                                                            exit();
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        else{
                                            $tkr=1;
                                        }
                                    }
                                }
                            }
                            elseif($user==$row['ΟΝΟΜΑ_ΧΡΗΣΤΗ'] && $pass!=$row['ΚΩΔΙΚΟΣ_ΠΡΟΣΒΑΣΗΣ']){
                                $tkr=2;
                            }
                            elseif($user!=$row['ΟΝΟΜΑ_ΧΡΗΣΤΗ']){
                                $tkr=1;
                            }
                        }
                        ?><div class="forma"><?php
                            if($tkr==1){
                                echo 'Δεν υπάρχει χρήστης με αυτό το Όνομα Χρήστη ή ο Διαχειριστής δεν έχει αποδεχτεί το αίτημα εγγραφής σας<br>'; //μήνυμα σφάλματος
                            }
                            if($tkr==2){
                                echo 'Λάθος κωδικός πρόσβασης<br>'; //μήνυμα σφάλματος
                            }
                        ?></div><?php
                        }
                    }?>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    
    
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