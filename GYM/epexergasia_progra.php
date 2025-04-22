<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GYM UNIPI</title>
    <link rel="icon" href="images/titlelogo.jpg" type="image/icon type">
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
                    <a href="start_login_admin.php" class="logo">GYM <em> UNIPI</em> ADMIN</a>
                    <ul class="nav">
                        <li><a href="start_login_admin.php" class="active">ΑΡΧΙΚΗ</a></li>
                        <li class="main-button"><a href="start_not_login.php">ΑΠΟΣΥΝΔΕΣΗ</a></li>
                    </ul>
                    <a class='menu-trigger'><span>Menu</span></a>
                </nav>
            </div>
        </div>
    </div>
</header>

<?php
// Σύνδεση στη βάση δεδομένων
try {
    $conn = new PDO("mysql:host=localhost;dbname=gym_papei_ds", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Σφάλμα σύνδεσης: " . $e->getMessage());
}
$q=$_COOKIE["ideprogra"];
// Ανάκτηση όλων των προγραμμάτων από τη βάση
$stmt = $conn->prepare("SELECT * FROM προγραμμα where ID_ΠΡΟΓΡΑΜΜΑΤΟΣ=$q");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $conn->prepare("SELECT * FROM προγραμμαta");
$stmt->execute();
$result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $conn->prepare("SELECT * FROM γυμναστησ");
$stmt->execute();
$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- φόρμα για νέες αλλαγές στο υπάρχον πρόγραμμα -->
<div class="main-banner" id="top">
    <video autoplay muted loop id="bg-video">
        <source src="images/gym-video.mp4" type="video/mp4">
    </video>
    <div class="video-overlay header-text">
        <div class="caption">
            <form action="" method="POST">
            <?php foreach($result as $row){?>
                <p class="forma">Είδος: <select type="text" name="eidos" required>
                    <option></option>
                    <?php foreach($result1 as $row1){?>
                        <option><?= $row1["ΟΝΟΜΑ"] ?></option>
                        <?php }?>
                </select></p><br>
                <p class="forma">Ημέρα: <select type="text" name="hmera" required>
                    <option></option>
                    <option>ΔΕΥΤΕΡΑ</option>
                    <option>ΤΡΙΤΗ</option>
                    <option>ΤΕΤΑΡΤΗ</option>
                    <option>ΠΕΜΠΤΗ</option>
                    <option>ΠΑΡΑΣΚΕΥΗ</option>
                </select></p><br>
                <p class="forma">Ώρα: <input type="time" name="ora" value="<?= $row["ΩΡΑ"] ?>" required></p><br>
                <p class="forma">Γυμναστής: <select type="text" name="gymn" value="<?= $row["ΩΡΑ"] ?>" required></p><br>
                    <option></option>
                    <?php foreach($result2 as $row2){?>
                        <option><?= $row2["ΕΠΩΝΥΜΟ"] ?></option>
                    <?php }?>
                </select></p><br>
                <p class="forma">Αριθμός Ατόμων: <select type="text" name="arat" required>
                    <option>Ελεύθερο</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                    <option>13</option>
                    <option>14</option>
                    <option>15</option>
                </select></p><br>
                <input name="submit" type="submit" value="ΑΠΟΘΗΚΕΥΣΗ">
                <?php }?>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                $eidos = trim($_POST['eidos']);
                $hmera = trim($_POST['hmera']);
                $ora = trim($_POST['ora']);
                $gymn = trim($_POST['gymn']);
            
                foreach ($result2 as $row2) {
                    if ($gymn == $row2["ΕΠΩΝΥΜΟ"]) {
                        $gymn = $row2["ID_ΓΥΜΝΑΣΤΗ"];
                    }
                }
            
                $arat = trim($_POST['arat']);
            
                // Λήψη ΔΙΑΡΚΕΙΑΣ για το τρέχον πρόγραμμα
                $stmt = $conn->prepare("SELECT ΔΙΑΡΚΕΙΑ FROM προγραμμαta WHERE ΟΝΟΜΑ = :eidos");
                $stmt->bindParam(':eidos', $eidos, PDO::PARAM_STR);
                $stmt->execute();
                $result4 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                // Υπολογισμός λήξης βάσει της διάρκειας του προγράμματος
                foreach ($result4 as $row4) {
                    $lixi = strtotime($ora) + (strtotime($row4['ΔΙΑΡΚΕΙΑ']) - strtotime("00:00:00"));
                }
            
                $xrhsh = 0; 
            
                $result5 = []; 
                
                $stmt = $conn->prepare("SELECT ΔΙΑΡΚΕΙΑ FROM προγραμμαta WHERE ΟΝΟΜΑ = :eidoss");
                $stmt->bindParam(':eidoss', $eidos, PDO::PARAM_STR);
                $stmt->execute();
                $result5 = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $stmt = $conn->prepare("SELECT ΩΡΑ FROM προγραμμα WHERE ΗΜΕΡΟΜΗΝΙΑ = :hmera && ID_ΠΡΟΓΡΑΜΜΑΤΟΣ != $q");
                $stmt->bindParam(':hmera', $hmera, PDO::PARAM_STR);
                $stmt->execute();
                $result6 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                // Αν δεν επιστρέφονται αποτελέσματα, εξασφαλίζουμε ότι είναι κενός πίνακας
                if (!$result5) {
                    $result5 = [];
                }
                if (!$result6) {
                    $result6 = [];
                }
            
                // Έλεγχος για ίδιες ώρες
                if (!empty($result5)) {
                    foreach ($result5 as $row5) {
                        foreach ($result6 as $row6) {
                        $start_time = strtotime($row6["ΩΡΑ"]);}
                        $duration = !empty($row5['ΔΙΑΡΚΕΙΑ']) ? (strtotime($row5['ΔΙΑΡΚΕΙΑ']) - strtotime("00:00:00")) : 0;
                        $xronos = $start_time + $duration;
            
                        $ora_timestamp = strtotime($ora);
                        $lixi_timestamp = $lixi;
            
                        // Αν υπάρχει σύκρουση ώρας με άλλο πρόγραμμα, απαγορεύουμε την προσθήκη
                        if (($ora_timestamp >= $start_time && $ora_timestamp < $xronos) || 
                            ($lixi_timestamp > $start_time && $lixi_timestamp <= $xronos) || 
                            ($ora_timestamp <= $start_time && $lixi_timestamp >= $xronos)) {
                            $xrhsh = 0; // Υπάρχει σύγκρουση χρόνου
                            break;
                        } else {
                            $xrhsh = 1; // Δεν υπάρχει σύγκρουση χρόνου
                        }
                    }
                }
            
                
                if ($xrhsh == 1) {
                    try {
                        // Εισαγωγή νέων στοιχείων προγράμματος
                        $sql = "UPDATE προγραμμα SET ΕΙΔΟΣ = :eidos, ΗΜΕΡΟΜΗΝΙΑ = :hmera, ΩΡΑ = :ora, ΓΥΜΝΑΣΤΗΣ_ID_ΓΥΜΝΑΣΤΗ = :gymn, ΜΕΓΙΣΤΟΣ_ΑΡΙΘΜΟΣ_ΟΜΑΔΑΣ = :arat where ID_ΠΡΟΓΡΑΜΜΑΤΟΣ=$q";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindValue(':eidos', $eidos, PDO::PARAM_STR);
                        $stmt->bindValue(':hmera', $hmera, PDO::PARAM_STR);
                        $stmt->bindValue(':ora', $ora, PDO::PARAM_STR);
                        $stmt->bindValue(':gymn', $gymn, PDO::PARAM_STR);
                        $stmt->bindValue(':arat', $arat, PDO::PARAM_STR);
                        $stmt->execute();
                        echo "<script>window.location.href = 'http://localhost/GYM/orologio.php';</script>";
                        exit();
                        
                    } catch (PDOException $e) {
                        echo "<p class='forma'>Σφάλμα κατά την εισαγωγή: " . $e->getMessage() . "</p>"; // μήνυμα σφάλματος
                    }
                } else {
                    echo "<p class='forma'>Η ώρα συμπίπτει με άλλο πρόγραμμα.</p>"; // μήνυμα σφάλματος
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

<!-- Scripts -->
<script src="js/jquery-2.1.0.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scrollreveal.min.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/imgfix.min.js"></script>
<script src="js/mixitup.js"></script>
<script src="js/accordions.js"></script>
<script src="js/custom.js"></script>

</body>
</html>