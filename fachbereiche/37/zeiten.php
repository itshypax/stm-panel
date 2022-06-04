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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/fb37.css">
    <link rel="icon" type="image/ico" href="../../assets/images/favicon-fb37.ico">
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
</head>
<body>

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

?>

  <div class="my-4 text-center" id="top-text">
    <div class="my-3">
      <img src="/assets/images/tcMPe2F2.png" alt="Straßenmeisterei" height="52px" width="auto">
      <span class="text-uppercase fs-4 align-middle">Straßenmeisterei Neuberg</span>
    </div>
    <h5>Zurzeit Online: <?php echo "{$num_currentOn}" ?></h5>
    </div>

    <div class="container bg-light shadow p-3 mb-5 rounded">

    <?php 

    		if (empty($nrorows)) {
	echo "<div class='alert alert-danger text-center' role='danger'><p>Es gibt noch keine Einträge!</p></div>";
} else {
  echo "<div class='alert alert-primary text-center' role='info'><p>Damit Nutzer in dieser Liste auftauchen <u>müssen</u> sie den Tag <strong>[ST]</strong> vor ihrem Namen haben!</p></div>";
}

?>

<table class="table">
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
    $upAt = new DateTime($row['updatedAt']);

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
		    <th scope=''row'>{$row['id']}</th>
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

</body>
</html>