<?php

include("fb37dbconnect.php");

$dbconnect=mysqli_connect($hostname,$username,$password,$dbname);

$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
    $spitzname =$_REQUEST['spitzname'];
    $icname = $_REQUEST['icname'];
    $dienstgrad = $_REQUEST['dienstgrad'];
    $beitritt = $_REQUEST['beitritt'];
    $telnr = $_REQUEST['telnr'];
    $iban = $_REQUEST['iban'];
    $laufstieg = $_REQUEST['laufstieg'];
    $gehalt = $_REQUEST['gehalt'];
    $notiz = $_REQUEST['notiz'];
    mysqli_query($dbconnect,"INSERT INTO memberManagement (`spitzname`,`icname`,`dienstgrad`,`beitritt`,`telnr`,`iban`,`laufstieg`,`gehalt`,`notiz`) VALUES ('$spitzname','$icname','$dienstgrad','$beitritt','$telnr','$iban','$laufstieg','$gehalt','$notiz')")
    or die(mysql_error());
    $status = "Eintrag erfolgreich erstellt.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eintrag erstellen &middot; Straßenmeisterei Neuberg</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="../fonts/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/own.css">
    <link rel="stylesheet" href="../css/fb37.css">
    <link rel="icon" type="image/ico" href="../images/favicon-fb37.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

   <?php

require '../../assets/steamauth/steamauth.php';

?>

<?php
if(!isset($_SESSION['steamid'])) {

    ?>

    <script type="text/javascript">
    window.location.href = "https://wiesberg.net/fachbereiche/37/index.php";
    </script>


<?php

}  else {

    include ('../../assets/steamauth/userInfo.php'); 
    include ('../../assets/components/fb37allowedids.php');
    include '../../assets/components/registerpaneluser.php';
    
    // if (strstr($steamprofile['steamid'], $allowedid))
    if (in_array($steamprofile['steamid'], $admin) OR in_array($steamprofile['steamid'], $verwalter) OR in_array($steamprofile['steamid'], $personaler) OR in_array($steamprofile['steamid'], $ausbilder)) {?>

  <?php

  include("../../assets/components/fb37dbconnect.php");

$dbconnect=mysqli_connect($hostname,$username,$password,$dbname);

if ($dbconnect->connect_error) {
	die("Fehler, Verbindung fehlgeschlagen:" . $dbconnect->connect_error);
}

  $currentOn = mysqli_query($dbconnect,"SELECT * FROM UserPlaytimes WHERE `online` = '1'");
  $num_currentOn = mysqli_num_rows($currentOn);
 

  include '../../assets/components/nav.php';
?>

  <div class="px-4 py-5 text-center" id="meisterei-hero">
      <img src="/assets/images/tcMPe2F2.png" alt="Straßenmeisterei" height="100px" width="auto">
    <h1 class="display-5 fw-bold">Straßenmeisterei Neuberg</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Zurzeit Online: <?php echo "{$num_currentOn}" ?></p>
    </div>
    </div>

<div class="container bg-light shadow p-3 mb-5 rounded my-5">
      <div class="modal-header p-5 pb-4 border-bottom-0">
        <!-- <h5 class="modal-title">Modal title</h5> -->
        <h2 class="fw-bold mb-0">Neuen Eintrag erstellen</h2>
        <a href="../../fachbereiche/37/mitarbeiter.php"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
      </div>

        <form name="form" method="post" action="">
        <input type="hidden" name="new" value="1" />
          <div class="form-floating mb-3">
            <input id="floatingInput" class="form-control rounded-3" type="text" name="spitzname" placeholder="TheLegend27" required>
            <label for="floatingInput">Spitzname / OOC Name</label>
          </div>
          <div class="form-floating mb-3">
            <input id="floatingInput" class="form-control rounded-3" type="text" name="icname" placeholder="Paul Panzer" required>
            <label for="floatingInput">Name / IC Name</label>
          </div>
          <div class="form-floating mb-3">
            <select id="floatingInput" class="form-control rounded-3" name="dienstgrad" placeholder="Oberstabsgeneral 17">
                <option selected>Dienstgrad auswählen...</option>
                <option value="Geschäftsführer">Geschäftsführer</option>
                <option value="Vorstand">Vorstand</option>
                <option value="Straßenmeister">Straßenmeister</option>
                <option value="Kolonnenführer">Kolonnenführer</option>
                <option value="Straßenwärter">Straßenwärter</option>
                <option value="Auszubildender">Auszubildender</option>
                <option value="Praktikant">Praktikant</option>
            </select>
            <label for="floatingInput">Dienstgrad</label>
          </div>
          <div class="form-floating mb-3">
            <input id="floatingInput" class="form-control rounded-3" type="date" name="beitritt" placeholder="01.01.1900" required>
            <label for="floatingInput">Beitrittsdatum</label>
          </div>
          <div class="form-floating mb-3">
            <input id="floatingInput" class="form-control rounded-3" type="text" name="telnr" placeholder="0800 666 666">
            <label for="floatingInput">Telefonnummer</label>
          </div>
          <div class="form-floating mb-3">
            <input id="floatingInput" class="form-control rounded-3" type="text" name="iban" placeholder="NH123123">
            <label for="floatingInput">IBAN</label>
          </div>
          <p><input class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" name="submit" type="submit" value="Eintrag erstellen" /></p>
          <small class="text-muted"><?php echo $status; ?></small>
        </form>
      </div>

<?php include("../../assets/components/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

 <?php
    return true;
    } else {
        ?>

        <div class="db-container">
            <div class="error-box shadow rounded">
                <h1 style="text-transform:uppercase;font-weight:bold;text-shadow: 0 .5rem 1rem rgba(0,0,0,.15);">FEHLER</h1>
                <p style="text-shadow: 0 .5rem 1rem rgba(0,0,0,.15);">Es sieht so aus als wärst du für diese Seite noch nicht freigeschaltet!</p>
                <br/><br/>
                <form action='' method='get'><button name='logout' type='submit'>Zurück zum Login</button></form>
            </div>
        </div>


        <?php
        return false;
    }
}
?>
</body>
</html>