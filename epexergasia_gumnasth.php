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
    
    
    <!-- επικεφαλίδα σελίδας -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- logo σελίδας -->
                        <a href="start_login_admin.php" class="logo">GYM <em> UNIPI</em> ADMIN</a>
                        <!-- μενού σελίδας -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="start_login_admin.php" class="active">ΑΡΧΙΚΗ</a></li>
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

    <?php
    # σύνδεση με τη βάση δεδομένων
    $servername="mysql:host=localhost;dbname=gym_papei_ds";
    $username="root";
    $password="";
    $conn=new PDO($servername,$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //ανάκτηση cookie
    $k=$_COOKIE["gymnid"];
    # λήψη όλων των στοιχείων του γυμναστή από τη βάση δεδομένων
    $stmt=$conn->prepare("SELECT * FROM γυμναστησ where ID_ΓΥΜΝΑΣΤΗ=$k");
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>


    <!-- φόρμα για αλλαγή στοιχείων γυμναστή με εμφάνιση των ήδη υπάρχουσων -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="images/gym-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
            <form id="registrationForm" action="" method="POST">
                <?php foreach($result as $row){?>
                <p class="forma">Όνομα: <input type="text" value="<?= $row["ΟΝΟΜΑ"] ?>" name="Όνομα" required></p><br>
                <p class="forma">Επώνυμο: <input type="text" value="<?= $row["ΕΠΩΝΥΜΟ"] ?>" name="Επώνυμο" required></p><br>
                <p class="forma">Ειδικότητα: <input type="text" value="<?= $row["ΕΙΔΙΚΟΤΗΤΑ"] ?>" name="Ειδικότητα" required></p><br>
                <input type="submit" value='ΕΝΗΜΕΡΩΣΗ'>
                <?php }?>
            </form>
            <?php
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    # λήψη στοιχείων που εισάγει ο χρήστης
                    if(isset($_POST['Όνομα'])){
                        $name=$_POST['Όνομα'];
                    }else{
                        $name = " ";
                    }
                    if(isset($_POST['Επώνυμο'])){
                        $surname=$_POST['Επώνυμο'];
                    }else{
                        $surname = " ";
                    }
                    if(isset($_POST['Ειδικότητα'])){
                        $Ειδικότητα=$_POST['Ειδικότητα'];
                    }else{
                        $Ειδικότητα = " ";
                    }
                    ?>
                    </div><?php
                    #εισαγωγή νέων στοιχείων γυμναστή  στη βάση δεδομένων
                    if($p==0 && $name!=" " && $surname!=" " && $Ειδικότητα!=" "){
                        try{
                            $sql="UPDATE γυμναστησ SET ΟΝΟΜΑ = :namee,ΕΠΩΝΥΜΟ = :surname ,ΕΙΔΙΚΟΤΗΤΑ = :eidikothta where ID_ΓΥΜΝΑΣΤΗ=$k";
                            $stmt=$conn->prepare($sql);
                            $stmt->bindParam(':namee',$name);
                            $stmt->bindParam(':surname',$surname);
                            $stmt->bindParam(':eidikothta',$Ειδικότητα);
                            $stmt->execute();
                            echo '<script>window.location.href = "http://localhost/GYM/prosopiko.php";</script>';
                            exit();
                        }catch(PDOException $e){
                            echo 'Connection failed: ' .$e->getMessage();
                        }
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