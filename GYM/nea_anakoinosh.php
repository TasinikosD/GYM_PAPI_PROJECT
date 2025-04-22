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

    <?php
    # σύνδεση με τη βάση δεδομένων
    $servername="mysql:host=localhost;dbname=gym_papei_ds";
    $username="root";
    $password="";
    $conn=new PDO($servername,$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //επαναφορά cookie και λήψη δεδομένων από τη βάση
    $k=$_COOKIE['loginid'];
    $stmt=$conn->prepare("SELECT * FROM ανακοινωσεισ");
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>


    <!-- φόρμα για τη δημιουργία νλεας ανακοίνωσης -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="images/gym-video.mp4" type="video/mp4" />
        </video>
        <div class="video-overlay header-text">
            <div class="caption">
            <form action="" method="POST">
                <p class="forma">Τίτλος: <input type="text" name="title" required></p><br>
                <p class="forma">Κείμενο:</p>
                <textarea name="content" rows="15" cols="40" required></textarea><br>
                <input name="Accept" type="submit" value='ΔΗΜΙΟΥΡΓΙΑ'>
            </form>
            <?php
                if(isset($_POST['Accept'])){
                    $Accept=$_POST['Accept'];
                }else{
                    $Accept = " ";
                }
                if(isset($_POST['title'])){
                    $title=$_POST['title'];
                }else{
                    $title = " ";
                }
                if(isset($_POST['content'])){
                    $content=$_POST['content'];
                }else{
                    $content = " ";
                }
                $t=1;
                $datee = date("Y-m-d H:i:s");
                //έλεγχος για ύπαρξη ανακοίνωσης με ίδιο τίτλο
                if($title!=" "){
                    foreach($result as $row){
                        if($title==$row["ΤΙΤΛΟΣ"]){
                            $t=0;
                        }
                    }
                    if($t==1){
                        try{
                            //εισαγωγή δεδομένων στη βάση
                            $sql='INSERT INTO ανακοινωσεισ (ΤΙΤΛΟΣ,ΠΕΡΙΕΧΟΜΕΝΟ,ΗΜΕΡΟΜΗΝΙΑ,ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ) VALUES (:title,:content,:datee,:idx)';
                            $stmt=$conn->prepare($sql);
                            $stmt->bindParam(':title',$title);
                            $stmt->bindParam(':content',$content);
                            $stmt->bindParam(':datee',$datee);
                            $stmt->bindParam(':idx',$k);
                            $stmt->execute();
                            echo '<script>window.location.href = "http://localhost/GYM/anakoinosh.php";</script>';
                            exit();
                        }
                        catch(PDOException $e){
                            echo 'Connection failed: ' .$e->getMessage();
                        }
                    }
                    else{
                        echo "<p class='forma'>Αυτός ο τίτλος υπάρχει ήδη</p>";//μήνυμα σφάλματος
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