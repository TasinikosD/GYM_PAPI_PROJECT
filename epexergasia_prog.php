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
    <!-- σύνδεση με αρχεία css -->
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
    //ανάκτηση cookie και στοιχείων από τη βάση
    $k=$_COOKIE['progid'];
    $stmt=$conn->prepare("SELECT * FROM προγραμμαta where ID_ΠΡΟΓΡΑΜΜΑTA=$k");
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>


    <!-- φόρμα για εισαγωγή αλλαγών στο πρόγραμμα με εμφάνιση των παλεών -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="images/gym-video.mp4" type="video/mp4" />
        </video>
        <div class="video-overlay header-text">
            <div class="caption">
            <form action="" method="POST">
            <?php foreach($result as $row){?>
                <p class="forma">Όνομα: <input type="text" value="<?= $row["ΟΝΟΜΑ"]?>" name="name" required></p><br>
                <p class="forma">Περιγραφή:</p>
                <textarea name="description" rows="5" cols="40" required><?= $row["ΠΕΡΙΓΡΑΦΗ"]?></textarea><br>
                <p class="forma">Διάρκεια: <input type="time" value="<?= $row["ΔΙΑΡΚΕΙΑ"]?>" name="duration" required></p><br>
                <input name="submit" type="submit" value="ΑΠΟΘΗΚΕΥΣΗ">
                <?php }?>
            </form>
            <?php
                if(isset($_POST['Accept'])){
                    $Accept=$_POST['Accept'];
                }else{
                    $Accept = " ";
                }
                if(isset($_POST['name'])){
                    $name=$_POST['name'];
                }else{
                    $name = " ";
                }
                if(isset($_POST['description'])){
                    $description=$_POST['description'];
                }else{
                    $description = " ";
                }
                if(isset($_POST['duration'])){
                    $duration=$_POST['duration'];
                }else{
                    $duration = " ";
                }
                if($name!=" "){
                    foreach($result as $row){
                        try{
                            $sql = "UPDATE προγραμμαta SET ΟΝΟΜΑ = :name, ΠΕΡΙΓΡΑΦΗ = :description, ΔΙΑΡΚΕΙΑ = :duration where ID_ΠΡΟΓΡΑΜΜΑTA=$k"; //αναβάθμιση των στοιχείων στο πρόγραμμα
                            $stmt=$conn->prepare($sql);
                            $stmt->bindParam(':name',$name);
                            $stmt->bindParam(':description',$description);
                            $stmt->bindParam(':duration',$duration);
                            $stmt->execute();
                            echo '<script>window.location.href = "http://localhost/GYM/programmata.php";</script>';
                            exit();
                        }
                        catch(PDOException $e){
                            echo 'Connection failed: ' .$e->getMessage();
                        }
                    }
                }
            ?>
            </div>
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