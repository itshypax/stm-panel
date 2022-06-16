<?php
$page = $_SERVER['PHP_SELF'];
$sec = "45";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zeiten &middot; Straßenmeisterei Neuberg</title>
    <!-- Metas -->
    <?php include('../../assets/components/fb37meta.php'); ?>
    <!-- Metas end -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/own.css">
    <link rel="stylesheet" href="../../assets/css/fb37.css">
    <link rel="icon" type="image/ico" href="../../assets/images/favicon-fb37.ico">
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
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
    window.location.href = "https://wiesberg.net/fachbereiche/37/dashboard.php";
    </script>


<?php

}  else {

    include ('../../assets/steamauth/userInfo.php'); 
    include ('../../assets/components/fb37allowedids.php');
    
    // if (strstr($steamprofile['steamid'], $allowedid))
    if (in_array($steamprofile['steamid'], $admin)) {?>

  <?php

  include("../../assets/components/fb37dbconnect.php");

$dbconnect=mysqli_connect($hostname,$username,$password,$dbname);

if ($dbconnect->connect_error) {
	die("Fehler, Verbindung fehlgeschlagen:" . $dbconnect->connect_error);
}

$query = mysqli_query($dbconnect, "SELECT * FROM UserPlaytimes")
		or die (mysqli_error($dbconnect));

		$nrorows = $query->num_rows;

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

    <?php 

    		if (empty($nrorows)) {
	echo "<div class='alert alert-danger text-center' role='danger'><p>Es gibt noch keine Einträge!</p></div>";
} else {
  echo "<div class='alert alert-primary text-center' role='info'><p>Damit Nutzer in dieser Liste auftauchen <u>müssen</u> sie den Tag <strong>[ST]</strong> vor ihrem Namen haben!</p></div>";
}

?>

<input type="text" id="zeitenSuche" onkeyup="timeSearch()" placeholder="Mitarbeiter suchen...">

<table class="table" id="time-management">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Spielzeit</th>
      <th scope="col">Server</th>
      <th scope="col">Erstellt am</th>
    </tr>
  </thead>
  <tbody>

  <?php

while ($row = mysqli_fetch_array($query)) {

    $playtimeH = round($row['playtime'] / 60, 2);

    if ($row['online'] == 1) {
        $onlineSt = "Online";
    } else {
        $onlineSt = "Offline";
    }

    if ($row['server'] == "") {
        $serverSt = "-";
    } else {
        $serverSt = $row['server'];
    }

    $crAt = new DateTime($row['createdAt']);
    $crAt->add(new DateInterval('PT2H'));
    $upAt = new DateTime($row['updatedAt']);
    $upAt->add(new DateInterval('PT2H'));

    if ($onlineSt == "Online") {
      $OnlineBdg = 'Online';
      $spanClass = "text-bg-success";
      $lastOn = "Gerade online!";
    } else {
      $OnlineBdg = 'Offline';
      $spanClass = "text-bg-danger";
      $lastOn = "Zuletzt online: {$upAt->format('d.m.Y H:i')}";
    }

	echo
		"<tr>
		        <th scope='row'>{$row['id']}</th>
            <td>{$row['name']} <span class='badge {$spanClass}' title='{$lastOn}'>{$OnlineBdg}</span></td>
            <td>{$playtimeH} Std. ({$row['playtime']} Min.)</td>
            <td>{$serverSt}</td>
            <td>{$crAt->format('d.m.Y H:i')}</td>
    	</tr>";
}

?>

</tbody>
</table>
</div>

<?php include("../../assets/components/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="../../assets/js/tablesearch.js"></script>

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