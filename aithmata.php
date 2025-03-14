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
    <!-- Σύνδεση των αρχείων css με το php αρχείο  -->
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
    
    
    <!-- Δημιουργία της επικεφαλίδας της σελίδας -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- Δημιουργία του logo -->
                        <a href="start_login_admin.php" class="logo">GYM <em> UNIPI </em>ADMIN</a>
                        <!-- Δημιουργία του menou -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="start_login_admin.php">ΑΡΧΙΚΗ</a></li>
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


    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="images/gym-video.mp4" type="video/mp4" />
        </video>
        <div class="video-overlay header-text">
            <div class="caption">
                <?php
                    # σύνδεση με τη βάση δεδομένων
                    $servername="mysql:host=localhost;dbname=gym_papei_ds";
                    $username="root";
                    $password="";
                    $conn=new PDO($servername,$username,$password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    # λήψη όλων των στοιχείων των αιτημάτων από τη βάση δεδομένων
                    $stmt=$conn->prepare("SELECT * FROM αιτημα_εγγραφησ where ΚΑΤΑΣΤΑΣΗ='ΑΝΑΜΟΝΗ_ΑΠΟΔΟΧΗΣ'");
                    $stmt->execute();
                    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <p class="forma">Αιτήσεις Χρηστών</p>
                <div class="forma">
                    <!-- Εμφάνιση των στοιχείων που αντλήθηκαν από τη βάση -->
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Όνομα Χρήστη</th>
                        <th>Email</th>
                    </tr>
                    <?php foreach($result as $row){
                        $A=$row['ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ'];
                        $stmt=$conn->prepare("SELECT * FROM χρηστησ where ID_ΧΡΗΣΤΗ=$A");
                        $stmt->execute();
                        $result1=$stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach($result1 as $row1){?>
                    <tr>
                        <td><?= $row["ID_ΑΙΤΗΜΑΤΟΣ"] ?></td>
                        <td><?= $row1["ΟΝΟΜΑ_ΧΡΗΣΤΗ"] ?></td>
                        <td><?= $row1["EMAIL"] ?></td>
                    </tr>
                    <?php }} ?>
                </table>
                </div>
                <!-- Φόρμα για επιλογή αιτήματος προς απόρριψη ή αποδοχή και ορισμός ρόλου -->
                <form action="" method="POST">
                    <p class="forma">ΓΡΑΨΤΕ ΤΟ ID ΤΟΥ ΧΡΗΣΤΗ ΠΟΥ ΘΕΛΕΤΕ ΝΑ ΑΠΟΔΕΧΤΕΙΤΕ Η ΝΑ ΑΠΟΡΡΙΨΕΤΕ</p>
                    <input type="text" name="idxr" required>
                    <select name="epilogh">
                        <option>ΧΡΗΣΤΗΣ</option>
                        <option>ΔΙΑΧΕΙΡΙΣΤΗΣ</option>
                    </select>
                    <input name="Accept" type="submit" value='ΑΠΟΔΟΧΗ'>
                    <input name="Accept" type="submit" value='ΑΠΟΡΡΙΨΗ'>
                </form>
                <?php
                    # σύνδεση με τη βάση δεδομένων
                    $servername="mysql:host=localhost;dbname=gym_papei_ds";
                    $username="root";
                    $password="";
                    $conn=new PDO($servername,$username,$password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
                    if(isset($_POST['epilogh'])){
                        $epilogh=$_POST['epilogh'];
                    }else{
                        $epilogh = " ";
                    }
                    $t=0;
                    // Εισαγωγή των δεδομένων στη βάση 
                    if($Accept=='ΑΠΟΔΟΧΗ'){
                        foreach($result as $row){
                            if($idxr==$row["ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ"] && $idxr!=1){
                                $t=1;
                            }
                        }
                        if($t==1){
                            try{
                                $sql="UPDATE αιτημα_εγγραφησ SET ΚΑΤΑΣΤΑΣΗ='ΑΠΟΔΟΧΗ' WHERE ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ=$idxr";
                                $stmt=$conn->prepare($sql);
                                $stmt->execute();
                                $sql='INSERT INTO ρολοσ (ΡΟΛΟΣ,ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ) VALUES (:rolos,:id)';
                                $stmt=$conn->prepare($sql);
                                $stmt->bindParam(':rolos',$epilogh);
                                $stmt->bindParam(':id',$idxr);
                                $stmt->execute();
                                echo '<script>window.location.href = "http://localhost/GYM/aithmata.php";</script>';
                                exit();
                            }
                            catch(PDOException $e){
                                echo 'Connection failed: ' .$e->getMessage();
                            }
                        }
                        else{?>
                            <p class="forma">Το ID δεν αντιστοιχεί σε κάποιο χρήστη</p><?php
                        }
                    }
                    elseif($Accept=='ΑΠΟΡΡΙΨΗ'){
                        foreach($result as $row){
                            if($idxr==$row["ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ"] && $idxr!=1){
                                $t=1;
                            }
                        }
                        if($t==1){
                            try{
                                $sql="DELETE FROM αιτημα_εγγραφησ WHERE ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ=$idxr";
                                $stmt=$conn->prepare($sql);
                                $stmt->execute();
                                $sql="DELETE FROM χρηστησ WHERE ID_ΧΡΗΣΤΗ=$idxr";
                                $stmt=$conn->prepare($sql);
                                $stmt->execute();
                            }
                            catch(PDOException $e){
                                echo 'Connection failed: ' .$e->getMessage();
                            }
                        }
                        else{?>
                            <p class="forma">Το ID δεν αντιστοιχεί σε κάποιο χρήστη</p><?php
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
                    <!-- Μήνυμα copyright -->
                    <p>Copyright &copy; 2025 GYM PAPEI</p>
                    
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