<?php
ob_start(); // αρχή output
session_start(); // αρχή session
    # σύνδεση με τη βάση δεδομένων
    $servername="mysql:host=localhost;dbname=gym_papei_ds";
    $username="root";
    $password="";
    $conn=new PDO($servername,$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $k=$_COOKIE['loginid'];//επαναφορά cookie
    $stmt=$conn->prepare("SELECT * FROM γυμναστησ");//λήψη δεδομένων από τη βάση
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
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
    
    
    <!-- επικεφαλίδα σελίδας -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- Logo σελίδας -->
                        <a href="start_login_admin.php" class="logo">GYM <em> UNIPI</em> ADMIN</a>
                        <!-- Menu σελίδας -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="start_login_admin.php" class="active">ΑΡΧΙΚΗ</a></li>
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


    <!-- εμφάνιση στοιχείων προσωπικού σε μορφή πίνακα -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="images/gym-video.mp4" type="video/mp4" />
        </video>
        <div class="video-overlay header-text">
            <div class="caption">
                <p class="forma">Διαχείριση Προσωπικού</p>
                <div class="forma">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>ΟΝΟΜΑ</th>
                        <th>ΕΠΩΝΥΜΟ</th>
                        <th>ΕΙΔΙΚΟΤΗΤΑ</th>
                    </tr>
                    <?php foreach($result as $row){?>
                        <tr>
                            <td><?= $row["ID_ΓΥΜΝΑΣΤΗ"] ?>|</td>
                            <td><?= $row["ΟΝΟΜΑ"] ?>|</td>
                            <td><?= $row["ΕΠΩΝΥΜΟ"] ?>|</td>
                            <td><?= $row["ΕΙΔΙΚΟΤΗΤΑ"] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <!-- φόρμα για επιλογή id προς επεξεργασία ή διαγραφή και κουμπι για προσθήκη νέου γυμναστή -->
            <form action="" method="POST">
                <p class="forma">ΓΡΑΨΤΕ ΤΟ ID ΤΟΥ ΓΥΜΝΑΣΤΗ ΠΟΥ ΘΕΛΕΤΕ ΝΑ ΕΠΕΞΕΡΓΑΣΤΕΙΤΕ Η ΝΑ ΔΙΑΓΡΑΨΕΤΕ</p>
                <input type="text" name="idxr">
                <input name="Accept" type="submit" value='ΕΠΕΞΕΡΓΑΣΙΑ'>
                <input name="Accept" type="submit" value='ΔΙΑΓΡΑΦΗ'><br><br>
                <input name="Accept" type="submit" value='ΝΕΑ ΠΡΟΣΘΗΚΗ'>
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
                $t=0;
                if($Accept=='ΔΙΑΓΡΑΦΗ'){
                    foreach($result as $row){
                        if($idxr==$row["ID_ΓΥΜΝΑΣΤΗ"]){
                            $t=1;
                        }
                    }
                    if($t==1){
                        try{
                            $sql="DELETE FROM γυμναστησ WHERE ID_ΓΥΜΝΑΣΤΗ=$idxr";//διαγραφή δεδομένων από τη βάση
                            $stmt=$conn->prepare($sql);
                            $stmt->execute();
                            echo '<script>window.location.href = "http://localhost/GYM/prosopiko.php";</script>';//μεταφορά σε επόμενη σελίδα
                            exit();
                        }
                        catch(PDOException $e){
                            echo 'Connection failed: ' .$e->getMessage();//μήνυμα σφάλματος
                        }
                    }
                    else{
                        echo "<p class='forma'>Το ID δεν αντιστοιχεί σε κάποιον γυμναστή</p>";//μήνυμα σφάλματος
                    }
                }
                elseif ($Accept == 'ΕΠΕΞΕΡΓΑΣΙΑ') {
                    foreach ($result as $row) {
                        if ($idxr == $row["ID_ΓΥΜΝΑΣΤΗ"]) {
                            $t = 1;
                        }
                    }
                    if ($t == 1) {
                        setcookie("gymnid", $idxr, time() + 86400, "/"); //cookie για την αποθήκευση του id προς επεξεργασία
                        echo '<script>window.location.href = "http://localhost/GYM/epexergasia_gumnasth.php";</script>';//μεταφορά σε επόμενη σελίδα
                        exit();
                    } 
                    else {
                        echo "<p class='forma'>Το ID δεν αντιστοιχεί σε κάποιον γυμναστή</p>";//μήνυμα σφάλματος
                    }
                }
                elseif ($Accept == 'ΝΕΑ ΠΡΟΣΘΗΚΗ'){
                    echo '<script>window.location.href = "http://localhost/GYM/nea_prosthikh.php";</script>';//μεταφορά σε επόμενη σελίδα
                    exit();
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