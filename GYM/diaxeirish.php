<?php
ob_start(); // Αρχή output
session_start(); // Αρχή session

# σύνδεση με τη βάση δεδομένων
$servername="mysql:host=localhost;dbname=gym_papei_ds";
$username="root";
$password="";
$conn=new PDO($servername,$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

# λήψη όλων των στοιχείων του χρήστη από τη βάση δεδομένων
$stmt=$conn->prepare("SELECT * FROM χρηστησ where ID_ΧΡΗΣΤΗ <> 1");
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
    <!-- σύνδεση με αρχεία css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/templatemo-training-studio.css">
  </head>
  
  <body>
    <!-- Επικεφαλίδα σελίδας -->
    <header class="header-area header-sticky">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav class="main-nav">
              <!-- Logo σελίδας -->
              <a href="start_login_admin.php" class="logo">GYM <em> UNIPI </em>ADMIN</a>
              <!-- Μενού σελίδας -->
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

    <!-- Εμφάνιση των δεδομένων των χρηστών -->
    <div class="main-banner" id="top">
      <video autoplay muted loop id="bg-video">
        <source src="images/gym-video.mp4" type="video/mp4" />
      </video>
      <div class="video-overlay header-text">
        <div class="caption">
          <p class="forma">Διαχείριση Χρηστών</p>

          <div class="forma">
          <table>
            <tr>
              <th>ID</th>
              <th>Όνομα</th>
              <th>Επώνυμο</th>
              <th>Όνομα Χρήστη</th>
              <th>Email</th>
              <th>Τηλέφωνο</th>
              <th>Ρόλος</th>
              <th>Χώρα</th>
              <th>Πόλη</th>
              <th>Διεύθυνση</th>
            </tr>
            <!-- Άντληση και εμφάνιση πληροφοριών από τη βάση -->
            <?php foreach($result as $row){
              $A=$row['ID_ΧΡΗΣΤΗ'];
              $stmt=$conn->prepare("SELECT * FROM ρολοσ where ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ=$A");
              $stmt->execute();
              $result1=$stmt->fetchAll(PDO::FETCH_ASSOC);
              foreach($result1 as $row1){?>
            <tr>
              <td><?= $row["ID_ΧΡΗΣΤΗ"] ?>|</td>
              <td><?= $row["ΟΝΟΜΑ"] ?>|</td>
              <td><?= $row["ΕΠΩΝΥΜΟ"] ?>|</td>
              <td><?= $row["ΟΝΟΜΑ_ΧΡΗΣΤΗ"] ?>|</td>
              <td><?= $row["EMAIL"] ?>|</td>
              <td><?= $row["ΤΗΛΕΦΩΝΟ"] ?>|</td>
              <td><?= $row1["ΡΟΛΟΣ"] ?>|</td>
              <td><?= $row["ΧΩΡΑ"] ?>|</td>
              <td><?= $row["ΠΟΛΗ"] ?>|</td>
              <td><?= $row["ΔΙΕΥΘΥΝΣΗ"] ?></td>
            </tr>
            <?php }} ?>
          </table>
          </div>
          <!-- Φόρμα για επιλογή id χρήστη προς επεξεργασία ή διαγραφή από τον admin -->
          <form action="" method="POST">
            <p class="forma">ΓΡΑΨΤΕ ΤΟ ID ΤΟΥ ΧΡΗΣΤΗ ΠΟΥ ΘΕΛΕΤΕ ΝΑ ΕΠΕΞΕΡΓΑΣΤΕΙΤΕ Η ΝΑ ΔΙΑΓΡΑΨΕΤΕ</p>
            <input type="text" name="idxr" required>
            <input name="Accept" type="submit" value='ΕΠΕΞΕΡΓΑΣΙΑ'>
            <input name="Accept" type="submit" value='ΔΙΑΓΡΑΦΗ'>
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
                    if($idxr==$row["ID_ΧΡΗΣΤΗ"] && $idxr!=1){
                        $t=1;
                    }
                }
                if($t==1){
                    try{
                        $sql="DELETE FROM αιτημα_εγγραφησ WHERE ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ=$idxr"; //διαγραφή αιτήματος χρήστη κατά την εγγραφή του
                        $stmt=$conn->prepare($sql);
                        $stmt->execute();
                        $sql="DELETE FROM χρηστησ WHERE ID_ΧΡΗΣΤΗ=$idxr"; //διαγραφή στοιχείων χρήστη
                        $stmt=$conn->prepare($sql);
                        $stmt->execute();
                        $sql="DELETE FROM ρολοσ WHERE ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ=$idxr";  //διαγραφή ρόλου χρήστη
                        $stmt=$conn->prepare($sql);
                        $stmt->execute();
                        $k=$_COOKIE['loginid'];
                        if($idxr==$k){
                            echo '<script>window.location.href = "http://localhost/GYM/start_not_login.html";</script>'; //επιστροφή στην αρχική μη συνδεδεμένη σελίδα εάν ο admin κάνει delete τον εαυτό του
                            exit();
                        }
                        else{
                            echo '<script>window.location.href = "http://localhost/GYM/diaxeirish.php";</script>';
                            exit();
                        }
                    }
                    catch(PDOException $e){
                        echo 'Connection failed: ' .$e->getMessage();
                    }
                }
                else{
                    echo "<p class='forma'>Το ID δεν αντιστοιχεί σε κάποιο χρήστη</p>";  //μήνυμα σφάλματος
                }
            }
            elseif ($Accept == 'ΕΠΕΞΕΡΓΑΣΙΑ') {
                foreach ($result as $row) {
                    if ($idxr == $row["ID_ΧΡΗΣΤΗ"] && $idxr != 1) {
                        $t = 1;
                    }
                }
                if ($t == 1) {
                    setcookie("ideuser", $idxr, time() + 86400, "/"); // ορισμός cookie για να γίνει η επεξεργασία του συγκεκριμένου id στην επόμενη σελίδα
                    echo '<script>window.location.href = "http://localhost/GYM/epexergasia.php";</script>';
                    exit();
                } else {
                    echo "<p class='forma'>Το ID δεν αντιστοιχεί σε κάποιο χρήστη</p>";
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
