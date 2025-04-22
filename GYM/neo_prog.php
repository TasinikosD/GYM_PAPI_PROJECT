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

<!-- επικεφαλίδα σελίδας -->
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
    die("Σφάλμα σύνδεσης: " . $e->getMessage());//μήνυμα σφάλματος
}

// Ανάκτηση όλων των προγραμμάτων από τη βάση
$stmt = $conn->prepare("SELECT * FROM προγραμμαta");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- φόρμα για προσθήκη νέου προγράμματος -->
<div class="main-banner" id="top">
    <video autoplay muted loop id="bg-video">
        <source src="images/gym-video.mp4" type="video/mp4">
    </video>
    <div class="video-overlay header-text">
        <div class="caption">
            <form action="" method="POST">
                <p class="forma">Όνομα: <input type="text" name="name" required></p><br>
                <p class="forma">Περιγραφή:</p>
                <textarea name="description" rows="5" cols="40" required></textarea><br>
                <p class="forma">Διάρκεια: <select type="time" name="duration" required>
                    <option></option>
                    <option>01:00</option>
                    <option>01:30</option>
                    <option>02:00</option>
                    <option>02:30</option>
                    <option>03:00</option>
                </select></p><br>
                <input name="submit" type="submit" value="ΔΗΜΙΟΥΡΓΙΑ">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                $name = trim($_POST['name']);
                $description = trim($_POST['description']);
                $duration = trim($_POST['duration']);
                

                // Έλεγχος αν το όνομα προγράμματος υπάρχει ήδη
                $stmt = $conn->prepare("SELECT COUNT(*) FROM προγραμμαta WHERE ΟΝΟΜΑ = :name");
                $stmt->bindValue(':name', $name, PDO::PARAM_STR);
                $stmt->execute();
                $exists = $stmt->fetchColumn();

                if ($exists) {
                    echo "<p class='forma'>Αυτό το πρόγραμμα υπάρχει ήδη!</p>";//μήνυμα σφάλματος
                } else {
                    try {
                        // Εισαγωγή νέου προγράμματος
                        $sql = "INSERT INTO προγραμμαta (ΟΝΟΜΑ, ΠΕΡΙΓΡΑΦΗ, ΔΙΑΡΚΕΙΑ) VALUES (:name, :description, :duration)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
                        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
                        $stmt->bindValue(':duration', $duration, PDO::PARAM_STR);
                        $stmt->execute();

                        echo "<script>window.location.href = 'http://localhost/GYM/programmata.php';</script>";
                        exit();
                    } catch (PDOException $e) {
                        echo "<p class='forma' style='color:red;'>Σφάλμα κατά την εισαγωγή: " . $e->getMessage() . "</p>";
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
                <!-- μήνυμα για copyright -->
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
