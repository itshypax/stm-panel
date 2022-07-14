<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard &middot; Straßenmeisterei Neuberg</title>
    <!-- Metas -->
    <?php include('../../assets/components/fb37meta.php'); ?>
    <!-- Metas end -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="../fonts/fontawesome/css/all.css" rel="stylesheet">
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
    include '../../assets/components/registerpaneluser.php';
    
    // Mindestens benötigte Berechtigung: Ausbilder
    if ($uPermLevel >= 1) {?>

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
        <div class="row mx-5">
            <div class="col text-end">
                <a href="https://docs.google.com/spreadsheets/d/1528O36-sMU8Y23unSzT2P0txCbueWtpZ81JDfSHulSw/edit"><button type="button" class="btn btn-secondary btn-lg"><i class="fa-solid fa-sitemap"></i> Infoboard</button></a>
            </div>
            <div class="col text-center">
                <a href="https://docs.google.com/spreadsheets/d/10JHvnnE-INOkff6KmVSsuc_W-7tzAggPp0jpLnZA1wY/edit#gid=1683770108"><button type="button" class="btn btn-danger btn-lg"><i class="fa-solid fa-money-bill-transfer"></i> Gehaltsabrechnung</button></a>
            </div>
            <div class="col text-start">
                <a href="https://docs.google.com/spreadsheets/d/1__-olXRjSnqEPJc4PAy6Is33YGeODX1rzs7upK_2uxA/edit#gid=0"><button type="button" class="btn btn-secondary btn-lg"><i class="fa-solid fa-tower-broadcast"></i> Einsatzkoordination</button></a>
            </div>
        </div>
        <div class="row mt-3 mx-5">
            <div class="col text-end">
                <a href="https://docs.google.com/document/d/16hvXf7KRhOcJUWDcBLXsAthDNOvRfrh8s83BhzYUSus/edit"><button type="button" class="btn btn-secondary btn-lg"><i class="fa-solid fa-section"></i> Dienstverordnung</button></a>
            </div>
            <div class="col text-start">
                <a href="https://docs.google.com/spreadsheets/d/1MvyoCA-J1HpzAGn1V8wy0DiODL5BB-Y4mBUUsfJH20c/edit#gid=0"><button type="button" class="btn btn-secondary btn-lg"><i class="fa-solid fa-car-side-bolt"></i> Fahrzeugwartung</button></a>
            </div>
        </div>
        <div class="row mt-3 mx-5">
            <div class="col text-center">
                <a href="https://discord.gg/hUMYjKUvRW"><button type="button" class="btn btn-primary btn-lg"><i class="fa-brands fa-discord"></i> Discord</button></a>
            </div>
        </div>
    </div>

    <?php include("../../assets/components/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <?php
    return true;
    } else {
        ?>

        <script type="text/javascript">
        window.location.href = "https://wiesberg.net/fachbereiche/37/bewerben.php";
        </script>

        <?php
        return false;
    }
}
?>
</body>
</html>