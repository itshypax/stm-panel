<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zeiten &middot; Straßenmeisterei Neuberg</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/own.css">
</head>
<body>
    <h1 class="text-center my-4">Mitarbeiter- & Arbeitszeitübersicht</h1>

    <div class="container">

    <?php

$dbconnect=mysqli_connect("web-snake01.native-webspace.com","hypaxnat_dbmeisterei2","serder34!!","hypaxnat_meistereitest");

if ($dbconnect->connect_error) {
	die("Fehler, Verbindung fehlgeschlagen:" . $dbconnect->connect_error);
}

$query = mysqli_query($dbconnect, "SELECT * FROM UserPlaytimes")
		or die (mysqli_error($dbconnect));

		$nrorows = $query->num_rows;

		if (empty($nrorows)) {
	echo "<div class='alert alert-danger text-center' role='danger'><p>Es gibt noch keine Einträge!</p></div>";
} ?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Spielzeit</th>
      <th scope="col">Status</th>
      <th scope="col">Server</th>
      <th scope="col">Erstellt am</th>
      <th scope="col">Zuletzt am</th>
    </tr>
  </thead>
  <tbody>

  <?php

while ($row = mysqli_fetch_array($query)) {

    $playtimeH = round($row['playtime'] / 60, 2);

    if ($row['online'] == 1) {
        $onlineSt = "Online";
        $onlineCl = "on";
    } else {
        $onlineSt = "Offline";
        $onlineCl = "off";
    }

    if ($row['server'] == "") {
        $serverSt = "-";
    } else {
        $serverSt = $row['server'];
    }

    $crAt = new DateTime($row['createdAt']);
    $upAt = new DateTime($row['updatedAt']);

	echo
		"<tr>
		    <th scope=''row'>{$row['id']}</th>
            <td>{$row['name']}</td>
            <td>{$playtimeH} Std. ({$row['playtime']} Min.)</td>
            <td class='{$onlineCl}'>{$onlineSt}</td>
            <td>{$serverSt}</td>
            <td>{$crAt->format('d.m.Y H:i:s')}</td>
            <td>{$upAt->format('d.m.Y H:i:s')}</td>
    	</tr>";
}

?>

</tbody>
</table>
</div>

</body>
</html>