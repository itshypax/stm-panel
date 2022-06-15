<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard &middot; Straßenmeisterei Neuberg</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/own.css">
    <link rel="stylesheet" href="../../assets/css/fb37.css">
    <link rel="icon" type="image/ico" href="../../assets/images/favicon-fb37.ico">
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

    <div class="db-container">
            <div class="db-box shadow rounded">
                <?php
                    loginbutton(); //login button
                ?>
            </div>
    </div>

<?php

}  else {

    include ('../../assets/steamauth/userInfo.php'); 
    include ('../../assets/components/fb37allowedids.php');
    
    foreach ($allowed_steamids as $allowedid) {
    if (in_array($steamprofile['steamid'], $allowed_steamids)) {?>

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

  <div class="px-4 py-5 text-center container rounded-3" id="meisterei-hero">
      <img src="/assets/images/tcMPe2F2.png" alt="Straßenmeisterei" height="100px" width="auto">
    <h1 class="display-5 fw-bold">Straßenmeisterei Neuberg</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Zurzeit Online: <?php echo "{$num_currentOn}" ?></p>
    </div>
    </div>

    <div class="container bg-light shadow p-3 mb-5 rounded-3 my-5" style="min-height:450px;">
        <h1>Wichtige Links</h1>
        <hr class="my-4">
        <ul>
            <li><a href="https://docs.google.com/spreadsheets/d/1wCRuGmcE8S6YwTr-u_XfIDNv9D04-6zHe3BwLH4TC7o/edit?ouid=113465113714211559712&usp=sheets_home&ths=true">Infoboard</a></li></li>
            <li><a href="https://wiesberg.net/fachbereiche/37/bewerben.php">Direktlink für Bewerbungen</a></li></li>
        </ul>
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
}     
?>
</body>
</html>