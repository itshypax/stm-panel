<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitgliederübersicht &middot; Straßenmeisterei Neuberg</title>
    <!-- Metas -->
    <?php include('assets/components/fb37meta.php'); ?>
    <!-- Metas end -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="/assets/fonts/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/own.css">
    <link rel="stylesheet" href="/assets/css/fb37.css">
    <link rel="icon" type="image/ico" href="/assets/images/favicon-fb37.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

   <?php

require 'assets/steamauth/steamauth.php';

?>

<?php
if(!isset($_SESSION['steamid'])) {

    ?>

    <script type="text/javascript">
    window.location.href = "https://strassenmeisterei-neuberg.de/index.php";
    </script>


<?php

}  else {

    include ('assets/steamauth/userInfo.php'); 
    include 'assets/components/registerpaneluser.php';
    
    // Mindestens benötigte Berechtigung: Ausbilder
    if ($uPermLevel >= $perm_level_instructor){?>

  <?php

  include("assets/components/fb37dbconnect.php");

$dbconnect=mysqli_connect($hostname,$username,$password,$dbname);

if ($dbconnect->connect_error) {
	die("Fehler, Verbindung fehlgeschlagen:" . $dbconnect->connect_error);
}

$query = mysqli_query($dbconnect, "SELECT * FROM memberManagement")
		or die (mysqli_error($dbconnect));

		$nrorows = $query->num_rows;

  $currentOn = mysqli_query($dbconnect,"SELECT * FROM UserPlaytimes WHERE `online` = '1'");
  $num_currentOn = mysqli_num_rows($currentOn);
 

  include 'assets/components/nav.php';
?>

  <div class="px-4 py-5 text-center container rounded-3" id="meisterei-hero">
      <img src="/assets/images/tcMPe2F2.png" alt="Straßenmeisterei" height="100px" width="auto">
    <h1 class="display-5 fw-bold">Straßenmeisterei Neuberg</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Zurzeit Online: <?php echo "{$num_currentOn}" ?></p>
    </div>
    </div>

    <div class="container bg-light shadow p-3 mb-5 rounded-3 my-5" style="min-height:450px;">

    <input type="text" class="mt-3 mb-5" id="mitgliederSuche" onkeyup="memberSearch()" placeholder="Mitglied suchen...">

<table class="table table-bordered table-striped table-hover" id="member-table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Dienstgrad</th>
      <th scope="col">Aktionen</th>
    </tr>
  </thead>
  <tbody>

  <?php

while ($row = mysqli_fetch_array($query)) {

    $btAt = new DateTime($row['beitritt']);
    $btAt->add(new DateInterval('PT2H'));
    $laAt = new DateTime($row['laufstieg']);
    $laAt->add(new DateInterval('PT2H'));

    $tdq = mysqli_query($dbconnect, "SELECT * FROM rankLog WHERE `mitarbeiterid` = '{$row['id']}' ORDER BY `rankAt` DESC LIMIT 1")
		or die (mysqli_error($dbconnect));

    $tdq_row = mysqli_fetch_array($tdq);

    $tdnorows = $tdq->num_rows;

    if ($tdnorows != 1){
        $rlEntry = new DateTime($row['beitritt']);
    } else {
        $rlEntry = new DateTime($tdq_row['rankAt']);
    }
    $jetzt = new DateTime("now");

    $rankDiff = $rlEntry->diff($jetzt);
    $rankDiffD = $rankDiff->format("%r%a");

    if ($row['dienstgrad'] == "Geschäftsführer") {
      $iconBefore = "<i style='color:#df691a;' class='fas fa-crown' title='Firmenleitung'></i> ";
      $rankTimeBadge = "<span class='badge bg-dark' title='Kein Aufstieg möglich.'>";
    } elseif ($row['dienstgrad'] == "Vorstand") {
      $iconBefore = "<i style='color:#df691a;' class='fas fa-crown' title='Firmenleitung'></i> ";
      $rankTimeBadge = "<span class='badge bg-dark' title='Kein Aufstieg möglich.'>";
    } elseif ($row['dienstgrad'] == "Verkehrswärter") {
      $iconBefore = "<i style='color:#df691a;' class='fa-solid fa-shield-plus' title='Teilzeit-Mitarbeiter'></i> ";
      $rankTimeBadge = "<span class='badge bg-secondary' title='Kein Aufstieg möglich.'>";
    } // Straßenmeister
    elseif ($row['dienstgrad'] == "Straßenmeister") {
      $iconBefore = "";
      $missingTime = 90 - $rankDiffD;
      $rankTimeBadge = "<span class='badge bg-secondary' title='Kein Aufstieg möglich.'>"; 
    } // Kolonnenführer
    elseif ($row['dienstgrad'] == "Kolonnenführer") {
      $iconBefore = "";
      $missingTime = 60 - $rankDiffD;
    if ($row['dienstgrad'] == "Kolonnenführer" AND $rankDiff->d < 60) {
      $rankTimeBadge = "<span class='badge bg-warning' title='Die Mindestzeit wurde noch nicht erreicht. (Fehlend: ".$missingTime.")'>";
    } elseif ($row['dienstgrad'] == "Kolonnenführer" AND $rankDiff->d >= 60 AND $rankDiff->d < 62) {
      $rankTimeBadge = "<span class='badge bg-success' title='Die Mindestzeit wurde erreicht.'>";
    } elseif ($row['dienstgrad'] == "Kolonnenführer" AND $rankDiff->d >= 62) {
      $rankTimeBadge = "<span class='badge bg-danger' title='Die Mindestzeit wurde um 2 oder mehr Tage überschritten.'>";
    } } // Straßenwärter
    elseif ($row['dienstgrad'] == "Straßenwärter") {
      $iconBefore = "";
      $missingTime = 30 - $rankDiffD;
    if ($row['dienstgrad'] == "Straßenwärter" AND $rankDiff->d < 30) {
      $rankTimeBadge = "<span class='badge bg-warning' title='Die Mindestzeit wurde noch nicht erreicht. (Fehlend: ".$missingTime.")'>";
    } elseif ($row['dienstgrad'] == "Straßenwärter" AND $rankDiff->d >= 30 AND $rankDiff->d < 32) {
      $rankTimeBadge = "<span class='badge bg-success' title='Die Mindestzeit wurde erreicht.'>";
    } elseif ($row['dienstgrad'] == "Straßenwärter" AND $rankDiff->d >= 32) {
      $rankTimeBadge = "<span class='badge bg-danger' title='Die Mindestzeit wurde um 2 oder mehr Tage überschritten.'>";
    } } // Auszubildender
    elseif ($row['dienstgrad'] == "Auszubildender") {
      $iconBefore = "";
      $missingTime = 7 - $rankDiffD;
    if ($rankDiffD < 7) {
      $rankTimeBadge = "<span class='badge bg-warning' title='Die Mindestzeit wurde noch nicht erreicht. (Fehlend: ".$missingTime.")'>";
    } elseif ($rankDiffD >= 9) {
      $rankTimeBadge = "<span class='badge bg-danger' title='Die Mindestzeit wurde um 2 oder mehr Tage überschritten.'>";
    } else{
      $rankTimeBadge = "<span class='badge bg-success' title='Die Mindestzeit wurde erreicht.'>";
    } } // Alles andere
    else {
      $missingTime = "";
      $iconBefore = "";
      $rankTimeBadge = "<span>";
    }

    if ($row['deleted'] != 1) {

	echo
		"<tr>
		    <th scope=''row'>{$row['id']}</th>
            <td>{$iconBefore}{$row['icname']}</td>
            <td>{$rankTimeBadge}{$row['dienstgrad']}</span></td>
            <td><a href='/assets/components/mitarbeiterprofil.php?id={$row['id']}' title='Mitarbeiter bearbeiten'><button type='button' class='btn btn-outline-dark'><i class='fa-solid fa-wrench'></i></button></a></td>
    	</tr>";
    }
}

?>

</tbody>
</table>
<hr class="my-4">
<a href="/assets/components/fb37create.php"><button class="mb-2 btn btn-lg rounded-3 btn-success"><i class="fa-solid fa-plus"></i> Neuen Eintrag erstellen</button></a>
</div>

<?php include("assets/components/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="/assets/js/tablesearch.js"></script>

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