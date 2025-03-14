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
    <!-- Σύνδεση με τα αρχεία css -->
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
    
    
    <!-- Επικεφαλίδα σελίδας -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- Logo σελίδας -->
                        <a href="start_not_login.php" class="logo">GYM <em> UNIPI</em></a>
                        <!-- Μενού σελίδας -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="start_not_login.php" class="active">ΑΡΧΙΚΗ</a></li>
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

    <!-- Φόρμα προς συμπλήρωση των στοιχείων του χρήστη -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="images/gym-video.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
            <form id="registrationForm" action="" method="POST">
                <p class="forma">Όνομα: <input type="text" name="Όνομα" required></p><br>
                <p class="forma">Επώνυμο: <input type="text" name="Επώνυμο" required></p><br>
                <p class="forma">Όνομα Χρήστη: <input type="text" name="usern" required></p><br>
                <p class="forma">Κωδικός Προσβασης: <input type="password" name="kwdikos" id="password" required></p>
                <div class="forma"> <input type="checkbox" onclick="myFunction()">Show Password </div>
                <!-- κάλεσμα javascript για εμφάνιση κωδικού και απόκρυψη κωδικού-->
                <script>function myFunction() {
                    var x = document.getElementById("password");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }</script>
                <br><p class="forma">E-mail: <input type="text" name="Email" required></p><br>
                <p class="forma">Τηλέφωνο: <input type="text" name="tel" required></p><br>
                <label class="forma" for="country">Χώρα: </label>
                <select id="country" name="country" required>
                    <option value="">Επιλογή Χώρας</option>
                </select>
                <label class="forma" for="city">Πόλη</label>
                <select id="city" name="city" required>
                    <option value="">Επιλογή Πόλης</option>
                </select><br>
                <p class="forma">Διεύθυνση: <input type="text" name="addr" required></p><br>
                <input type="submit" value='Εγγραφή'>
            </form>
            <script>
            // Χρήση rest api για την επιλογή χώρας
            async function fetchCountries() {
            try {
                const response = await fetch('https://countriesnow.space/api/v0.1/countries');
                const data = await response.json();
                const countries = data.data;
                const countrySelect = document.getElementById('country');
                if (!countrySelect) return;
                countries.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.country;
                    option.textContent = country.country;
                    countrySelect.appendChild(option);
                });
            } catch (error) {
                console.error("Error fetching countries:", error);
            }
            }
            // Χρήση rest api για την επιλογή πόλης
            async function fetchCities(countryName) {
            const citySelect = document.getElementById('city');
            if (!citySelect) return;
                citySelect.innerHTML = '<option value="">Επιλογή Πόλης</option>'; // Καθαρισμός προηγούμενων πόλεων
            if (!countryName) return; // άμα δεν επιλεχθεί χώρα επιστρέφει
            try {
                    const response = await fetch('https://countriesnow.space/api/v0.1/countries/cities', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ country: countryName }),
                });
                const data = await response.json();
                if (!data.data) throw new Error("No cities found");
                data.data.forEach(city => {
                const option = document.createElement('option');
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
                });
            } catch (error) {
                console.error("Error fetching cities:", error);
            }
        }
        // Event listeners
        document.addEventListener("DOMContentLoaded", function () {
            const countrySelect = document.getElementById('country');
            if (countrySelect) {
                countrySelect.addEventListener('change', (e) => {
                    fetchCities(e.target.value);
                });
            }
            fetchCountries();
        });
        </script>
            <?php
                # σύνδεση με τη βάση δεδομένων
                $servername="mysql:host=localhost;dbname=gym_papei_ds";
                $username="root";
                $password="";
                $conn=new PDO($servername,$username,$password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                # συνάρτηση για να δούμε εάν ένα string έχει μόνο χαρακτήρες
                function chars($str) {
                    return preg_match('/[^a-zA-ZΑ-Ωα-ω]/', $str) > 0;
                }
                # συνάρτηση για να δούμε εάν ένα string έχει έστω έναν αριθμό
                function code($str) {
                    return preg_match('~[0-9]+~', $str) > 0;
                }
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
                    if(isset($_POST['usern'])){
                        $usern=$_POST['usern'];
                    }else{
                        $usern = " ";
                    }
                    $length=0;
                    if(isset($_POST['kwdikos'])){
                        $pass=$_POST['kwdikos'];
                    }else{
                        $pass = " ";
                    }
                    if(isset($_POST['Email'])){
                        $mail=$_POST['Email'];
                    }else{
                        $mail = " ";
                    }
                    if(isset($_POST['tel'])){
                        $tel=$_POST['tel'];
                        $length=strlen($tel);
                    }else{
                        $tel = " ";
                    }
                    if(isset($_POST['addr'])){
                        $addr=$_POST['addr'];
                    }else{
                        $addr = " ";
                    }
                    if(isset($_POST['city'])){
                        $city=$_POST['city'];
                    }else{
                        $city = " ";
                    }
                    if(isset($_POST['country'])){
                        $country=$_POST['country'];
                    }else{
                        $country = " ";
                    }
                    $k=0;
                    $p=0;
                    # λήψη όλων των στοιχείων του χρήστη από τη βάση δεδομένων
                    $stmt=$conn->prepare("SELECT * FROM χρηστησ");
                    $stmt->execute();
                    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    $l=0;
                    $w=0;
                    $q=0;
                    # έλεγχος εάν υπάρχει ήδη το username , το email και το τηλέφωνο που δίνει ο χρήστης
                    if(!empty($result)){
                        foreach($result as $row){
                            if($usern==$row['ΟΝΟΜΑ_ΧΡΗΣΤΗ']){
                                $l=1;
                            }
                            if($mail==$row['EMAIL']){
                                $w=1;
                            }
                            if($tel==$row['ΤΗΛΕΦΩΝΟ']){
                                $q=1;
                            }
                        }
                    }
                    ?>
                    <div class="forma"><?php
                    # εμφάνιση μηνύματος για ήδη υπάρχων username
                    if($l==1 && $usern!=' '){
                        echo 'Το username που επιλέξατε χρησιμοποιείται από άλλο χρήστη<br>';
                    }
                    # εμφάνιση μηνύματος για ήδη υπάρχων email
                    if($w==1 && $mail!=' '){
                        echo 'Το email που επιλέξατε χρησιμοποιείται από άλλο χρήστη<br>';
                    }
                    if($q==1 && $tel!=' '){
                        echo 'Το τηλέφωνο που επιλέξατε χρησιμοποιείται από άλλο χρήστη<br>';
                    }
                    # εμφάνιση μηνύματος ύπαρξης αριθμού στο όνομα
                    if(chars($name)==TRUE && $name!=' '){
                        echo 'Το όνομα θα πρέπει να περιέχει μόνο χαρακτήρες<br>';
                        $k=$k+1;
                    }
                    # εμφάνιση μηνύματος ύπαρξης αριθμού στο επώνυμο
                    if(chars($surname)==TRUE && $surname!=' '){
                        echo 'Το επώνυμο θα πρέπει να περιέχει μόνο χαρακτήρες<br>';
                        $k=$k+1;
                    }
                    # εμφάνιση μηνύματος μη ύπαρξης αριθμού στο κωδικό ή μήκους κωδικού μικρότερου του 4 και μεγαλύτερου του 10
                    if($tel!=''){
                        if((code($tel)==FALSE || ($length!=10)==TRUE) && $surname!=' '){
                            echo 'Το τηλέφωνο δεν είναι έγκυρο<br>';
                            $k=$k+1;
                        }
                    }
                    # εμφάνιση μηνύματος μη ύπαρξης του χαρακτήρα @ στο email
                    if($mail!=''){
                        if(str_contains($mail, '@')==FALSE && $surname!=' '){
                            echo 'Το email θα πρέπει να περιέχει το χαρακτήρα @ για να είναι έγκυρο<br>';
                            $k=$k+1;
                        }
                    }
                    ?>
                    </div><?php
                    #εισαγωγή στοιχείων νέου χρήστη στη βάση δεδομένων
                    if($k==0 && $p==0 && $w==0 && $l==0 && $name!=" " && $mail!=" " && $surname!=" " && $usern!=" " && $pass!=" " && $tel!=" " && $addr!=" "){
                        try{
                            $sql='INSERT INTO χρηστησ (ΟΝΟΜΑ,ΕΠΩΝΥΜΟ,EMAIL,ΤΗΛΕΦΩΝΟ,ΔΙΕΥΘΥΝΣΗ,ΠΟΛΗ,ΧΩΡΑ,ΟΝΟΜΑ_ΧΡΗΣΤΗ,ΚΩΔΙΚΟΣ_ΠΡΟΣΒΑΣΗΣ) VALUES (:name,:surname,:mail,:tel,:addr,:city,:country,:usern,:pass)';
                            $stmt=$conn->prepare($sql);
                            $stmt->bindParam(':name',$name);
                            $stmt->bindParam(':surname',$surname);
                            $stmt->bindParam(':mail',$mail);
                            $stmt->bindParam(':tel',$tel);
                            $stmt->bindParam(':addr',$addr);
                            $stmt->bindParam(':city',$city);
                            $stmt->bindParam(':country',$country);
                            $stmt->bindParam(':usern',$usern);
                            $stmt->bindParam(':pass',$pass);
                            $stmt->execute();
                            $id_xrhsth = $conn->lastInsertId();
                            $katastash="ΑΝΑΜΟΝΗ_ΑΠΟΔΟΧΗΣ";
                            $sql = 'INSERT INTO αιτημα_εγγραφησ (ΚΑΤΑΣΤΑΣΗ, ΧΡΗΣΤΗΣ_ID_ΧΡΗΣΤΗ) VALUES (:katastash, :id_xrhsth)';
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':katastash', $katastash);
                            $stmt->bindParam(':id_xrhsth', $id_xrhsth);
                            $stmt->execute();
                            echo '<script>window.location.href = "http://localhost/GYM/start_not_login.php";</script>';
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
                    
                    <!-- Μήνυμα copyright -->
                    
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