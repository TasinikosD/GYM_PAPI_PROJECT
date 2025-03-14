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
    <!-- αρχεία css -->
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
    //σύνδεση με βάση και άντληση δεδομένων
        $servername="mysql:host=localhost;dbname=gym_papei_ds";
        $username="root";
        $password="";
        $conn=new PDO($servername,$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt=$conn->prepare("SELECT * FROM προγραμμαta");
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt=$conn->prepare("SELECT * FROM ανακοινωσεισ");
        $stmt->execute();
        $result1=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $i=0;
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
                            <li class="scroll-to-section"><a href="#top" class="active">ΑΡΧΙΚΗ</a></li>
                            <li class="scroll-to-section"><a href="#our-classes">ΤΜΗΜΑΤΑ</a></li>
                            <li class="scroll-to-section"><a href="#schedule">ΠΡΟΓΡΑΜΜΑ</a></li>
                            <li class="scroll-to-section"><a href="#contact-us">ΕΠΙΚΟΙΝΩΝΙΑ</a></li> 
                            <li class="scroll-to-section"><a href="history.php">ΙΣΤΟΡΙΚΟ ΚΡΑΤΗΣΕΩΝ</a></li> 
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

    <!-- ανακοινώσεις προς προβολή με επιλογή για προβολή όλων των ανακοινώσεων  -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="images/gym-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                    <div class="section-heading">
                        <h4 class="forma">ΝΕΑ / ΑΝΑΚΟΙΝΩΣΕΙΣ</h4>
                        <img src="images/line-dec.png" alt="waves"><br><br><br><br>
                        <?php 
                        $count = 0;
                        foreach($result1 as $row1){
                            if($count==2){ break;}?>
                            <h4 class="forma"><?= $row1["ΤΙΤΛΟΣ"] ?></h4>
                            <img class="forma" src="images/line-dec.png" alt="waves">
                            <p class="forma"><?= $row1["ΠΕΡΙΕΧΟΜΕΝΟ"] ?></p><br>
                            <p class="forma">Ημερομηνία δημοσίευσης: <?= $row1["ΗΜΕΡΟΜΗΝΙΑ"] ?></p><br><br>
                    <?php $count++;}?>
                    </div>
                    <h4><a href="analitikh_povolh_anakoinoseon.php" class="email">Προβολή όλων των ανακοινώσεων...</a></h4>
            </div>
        </div>
    </div>

    <!-- εμφάνιση των τμημάτων του γυμναστηρίου -->
    <section class="section" id="our-classes">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2> <em>ΤΜΗΜΑΤΑ</em></h2>
                        <img src="images/line-dec.png" alt="">
                    </div>
                </div>
            </div>
            <div style="text-align:center;" id="tabs">
              <div>
                <ul>
                    <?php foreach($result as $row){?>
                        <li><a><img src="images/tabs-first-icon.png" alt=""><?= $row["ΟΝΟΜΑ"] ?><p><?= $row["ΠΕΡΙΓΡΑΦΗ"] ?></p></a></li>
                    <?php }?>
                </ul>
               </div>
            </div>
            <div style="text-align:center;" class="main-button">
                <br><a href="mark_your_spot.php">ΚΛΕΙΣΤΕ ΤΗ ΘΕΣΗ ΣΑΣ ΤΩΡΑ !!!</a>
            </div>
        </div>
    </section>
    
    <!-- εμφάνιση σε μορφή πίνακα του προγράμματος -->
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
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="schedule-table filtering">
                        <table>
                            <tbody>
                                <?php 
                                //λήψη και εμφάνιση προγράμματος από τη βάση
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
                                ?>
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