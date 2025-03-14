<?php
ob_start(); // Αρχή output
session_start(); // Αρχή session

# σύνδεση με τη βάση δεδομένων
$servername="mysql:host=localhost;dbname=gym_papei_ds";
$username="root";
$password="";
$conn=new PDO($servername,$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

# λήψη όλων των στοιχείων του προγράμματος από τη βάση δεδομένων
$stmt=$conn->prepare("SELECT * FROM προγραμμα");
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
    <!-- css αρχεία  -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/templatemo-training-studio.css">
  </head>
  
  <body>
    <!-- επικεφαλίδα σελίδας -->
    <header class="header-area header-sticky">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav class="main-nav">
              <!-- logo σελίδας -->
              <a href="start_login_admin.php" class="logo">GYM <em> UNIPI </em>ADMIN</a>
              <!-- menu σελίδας -->
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

    <!-- εμφάνιση ορολόγιου προγράμματος σε λίστα -->
    <div class="main-banner" id="top">
      <video autoplay muted loop id="bg-video">
        <source src="images/gym-video.mp4" type="video/mp4" />
      </video>
      <div class="video-overlay header-text">
        <div class="caption">
          <p class="forma">Διαχείριση Ωρολόγιου Προγράμματος</p>

          <div class="forma">
          <table>
            <tr>
              <th>ID</th>
              <th>Είδος</th>
              <th>Ημερομηνία</th>
              <th>Ώρα</th>
              <th>Γυμναστής</th>
              <th>Αριθμός Ατόμων</th>
            </tr>
            <?php foreach($result as $row){
              $A=$row["ΓΥΜΝΑΣΤΗΣ_ID_ΓΥΜΝΑΣΤΗ"];
              $stmt = $conn->prepare("SELECT * FROM γυμναστησ WHERE ID_ΓΥΜΝΑΣΤΗ = :id");//λήψη δεδομένων από τη βάση
              $stmt->bindParam(':id', $A, PDO::PARAM_INT); 
              $stmt->execute();
              $result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
              foreach($result1 as $row1){?>
            <tr>
              <td><?= $row["ID_ΠΡΟΓΡΑΜΜΑΤΟΣ"] ?>|</td>
              <td><?= $row["ΕΙΔΟΣ"] ?>|</td>
              <td><?= $row["ΗΜΕΡΟΜΗΝΙΑ"] ?>|</td>
              <td><?= $row["ΩΡΑ"] ?>|</td>
              <td><?= $row1["ΕΠΩΝΥΜΟ"] ?>|</td>
              <td><?php if($row["ΜΕΓΙΣΤΟΣ_ΑΡΙΘΜΟΣ_ΟΜΑΔΑΣ"]==0){echo 'Ελεύθερο';}else{echo $row["ΜΕΓΙΣΤΟΣ_ΑΡΙΘΜΟΣ_ΟΜΑΔΑΣ"];} 
              ?></td>
            </tr>
            <?php }} ?>
          </table>
          </div>

            <!-- φόρμα για επιλογή id προς επεξεργασία ή διαγραφή και επιπλέον κουμπί προσθήκης -->
          <form action="" method="POST">
            <p class="forma">ΓΡΑΨΤΕ ΤΟ ID ΤΟΥ ΩΡΟΛΟΓΙΟΥ ΠΡΟΓΡΑΜΜΑΤΟΣ ΠΟΥ ΘΕΛΕΤΕ ΝΑ ΕΠΕΞΕΡΓΑΣΤΕΙΤΕ Η ΝΑ ΔΙΑΓΡΑΨΕΤΕ</p>
            <input type="text" name="idxr">
            <input name="Accept" type="submit" value='ΕΠΕΞΕΡΓΑΣΙΑ'>
            <input name="Accept" type="submit" value='ΔΙΑΓΡΑΦΗ'><br><br>
            <input name="Accept" type="submit" value='ΠΡΟΣΘΗΚΗ'>
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
                    if($idxr==$row["ID_ΠΡΟΓΡΑΜΜΑΤΟΣ"]){
                        $t=1;
                    }
                }
                if($t==1){
                    try{
                        $sql="DELETE FROM προγραμμα WHERE ID_ΠΡΟΓΡΑΜΜΑΤΟΣ=$idxr";//διαγραφή από τα προγράμματα
                        $stmt=$conn->prepare($sql);
                        $stmt->execute();
                        echo '<script>window.location.href = "http://localhost/GYM/orologio.php";</script>';
                        exit();
                    }
                    catch(PDOException $e){
                        echo 'Connection failed: ' .$e->getMessage();
                    }
                }
                else{
                    echo "<p class='forma'>Το ID δεν αντιστοιχεί σε κάποιο ωρολόγιο πρόγραμμα</p>";//μήνυμα σφάλματος
                }
            }
            elseif ($Accept == 'ΕΠΕΞΕΡΓΑΣΙΑ') {
                foreach ($result as $row) {
                    if ($idxr == $row["ID_ΠΡΟΓΡΑΜΜΑΤΟΣ"]) {
                        $t = 1;
                    }
                }
                if ($t == 1) {
                    setcookie("ideprogra", $idxr, time() + 86400, "/"); // cookie για αποθήκευση id προς επεξεργασία
                    echo '<script>window.location.href = "http://localhost/GYM/epexergasia_progra.php";</script>';
                    exit();
                } else {
                    echo "<p class='forma'>Το ID δεν αντιστοιχεί σε κάποιο ωρολόγιο πρόγραμμα</p>";//μήνυμα σφάλματος
                }
            }
            elseif ($Accept == 'ΠΡΟΣΘΗΚΗ') {
                echo '<script>window.location.href = "http://localhost/GYM/prosthprog.php";</script>';
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
    <!-- Scripts -->
    <script src="js/jquery-2.1.0.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>