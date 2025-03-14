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
                        <a href="start_not_login.php" class="logo">GYM <em> UNIPI</em></a>
                        <!-- μενού σελίδας -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">ΑΡΧΙΚΗ</a></li>
                            <li class="scroll-to-section"><a href="#our-classes">ΤΜΗΜΑΤΑ</a></li>
                            <li class="scroll-to-section"><a href="#contact-us">ΕΠΙΚΟΙΝΩΝΙΑ</a></li> 
                            <li class="main-button"><a href="login.php">ΣΥΝΔΕΣΗ</a></li>
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- εμφάνιση μηνύματος με επιλογή για εγγραφή  -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="images/gym-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>ΓΥΜΝΑΣΟΥ, ΔΥΝΑΜΩΣΟΥ, ΚΑΤΑΚΤΗΣΕ</h6>
                <h2>ΓΙΝΕ ΕΝΑΣ ΑΠΟ <em>ΕΜΑΣ</em></h2>
                <div class="main-button scroll-to-section">
                    <a href="become_a_member.php">ΓΙΝΕΤΕ ΜΕΛΟΣ</a>
                </div>
            </div>
        </div>
    </div>


    <!-- σύνδεση με βάση και άντληση δεδομένων για εμφάνιση των τμημάτων του γυμναστηρίου -->
    <section class="section" id="our-classes">
        <?php
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
        </div>
    </section>


    <!-- έξτρα μήνυμα για παρότρινση χρήστη προς την εγγραφή -->
    <section class="section" id="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <h2>ΜΗ ΤΟ <em>ΣΚΕΦΤΕΣΑΙ</em>, ΚΑΝΕ ΕΓΓΡΑΦΗ <em>ΤΩΡΑ</em>!</h2>
                        <p>Το εξειδικευμένο μας προσωπικό θα σας βοηθήσει να φτάσετε όλους τους στόχους σας</p>
                        <div class="main-button scroll-to-section">
                            <a href="become_a_member.php">ΓΙΝΕΤΕ ΜΕΛΟΣ</a>
                        </div>
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