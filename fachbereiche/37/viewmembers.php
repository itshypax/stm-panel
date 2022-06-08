<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitgliederübersicht &middot; Straßenmeisterei Neuberg</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="../../assets/fonts/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/own.css">
    <link rel="stylesheet" href="../../assets/css/fb37.css">
    <link rel="icon" type="image/ico" href="../../assets/images/favicon-fb37.ico">
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
    
    foreach ($allowed_steamids as $allowedid) {
    // if (strstr($steamprofile['steamid'], $allowedid))
    if (in_array($steamprofile['steamid'], $allowed_steamids)) {?>

  <?php

  include("../../assets/components/fb37dbconnect.php");

$dbconnect=mysqli_connect($hostname,$username,$password,$dbname);

if ($dbconnect->connect_error) {
	die("Fehler, Verbindung fehlgeschlagen:" . $dbconnect->connect_error);
}

$query = mysqli_query($dbconnect, "SELECT * FROM memberManagement")
		or die (mysqli_error($dbconnect));

		$nrorows = $query->num_rows;

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

    <div class="container bg-light shadow p-3 mb-5 rounded" style="min-height:450px;">

<table class="table" id="member-table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Spitzname</th>
      <th scope="col">Name</th>
      <th scope="col">Dienstgrad</th>
      <th scope="col">Beitritt</th>
      <th scope="col">Tel. Nr.</th>
      <th scope="col">IBAN</th>
      <th scope="col">Gehalt</th>
      <th scope="col">Notiz</th>
      <th scope="col">Aktionen</th>
    </tr>
  </thead>
  <tbody>

  <?php

while ($row = mysqli_fetch_array($query)) {

    $btAt = new DateTime($row['beitritt']);
    $laAt = new DateTime($row['laufstieg']);

	echo
		"<tr>
		    <th scope=''row'>{$row['id']}</th>
            <td>{$row['spitzname']}</td>
            <td>{$row['icname']}</td>
            <td>{$row['dienstgrad']}</td>
            <td>{$btAt->format('d.m.Y')}</td>
            <td>{$row['telnr']}</td>
            <td>{$row['iban']}</td>
            <td>{$row['gehalt']}</td>
            <td>{$row['notiz']}</td>
            <td><a href='../../assets/components/fb37edit.php?id={$row['id']}' title='Eintrag bearbeiten'><button type='button' class='btn btn-outline-dark'><i class='fa-solid fa-wrench'></i></button></a> <a href='../../assets/components/fb37delete.php?id={$row['id']}' title='Eintrag löschen'><button type='button' class='btn btn-outline-danger'><i class='fa-solid fa-trash-can'></i></button></a></td>
    	</tr>";
}

?>

</tbody>
</table>
<hr class="my-4">
<a href="../../assets/components/fb37create.php"><button class="w-100 mb-2 btn btn-lg rounded-3 btn-success"><i class="fa-solid fa-plus"></i> Neuen Eintrag erstellen</button></a>
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