<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users &middot; Straßenmeisterei Neuberg</title>
    <!-- Metas -->
    <?php include('../../../assets/components/fb37meta.php'); ?>
    <!-- Metas end -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="../../../assets/fonts/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/own.css">
    <link rel="stylesheet" href="../../../assets/css/fb37.css">
    <link rel="icon" type="image/ico" href="../../../assets/images/favicon-fb37.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

   <?php

require '../../../assets/steamauth/steamauth.php';

?>

<?php
if(!isset($_SESSION['steamid'])) {

    ?>

    <script type="text/javascript">
    window.location.href = "https://wiesberg.net/fachbereiche/37/index.php";
    </script>


<?php

}  else {

    include ('../../../assets/steamauth/userInfo.php'); 
    include '../../../assets/components/fb37dbconnect.php';
    include '../../../assets/components/registerpaneluser.php';
    
    // Mindestens benötigte Berechtigung: Admin
    if ($uPermLevel >= 4){?>

  <?php

  include("../../../assets/components/fb37dbconnect.php");

$dbconnect=mysqli_connect($hostname,$username,$password,$dbname);

if ($dbconnect->connect_error) {
	die("Fehler, Verbindung fehlgeschlagen:" . $dbconnect->connect_error);
}

$query = mysqli_query($dbconnect, "SELECT * FROM panelUsers")
		or die (mysqli_error($dbconnect));

    $nrorows = $query->num_rows;

  $currentOn = mysqli_query($dbconnect,"SELECT * FROM UserPlaytimes WHERE `online` = '1'");
  $num_currentOn = mysqli_num_rows($currentOn);
 

  include '../../../assets/components/nav.php';
?>

  <div class="px-4 py-5 text-center container rounded-3" id="meisterei-hero">
      <img src="/assets/images/tcMPe2F2.png" alt="Straßenmeisterei" height="100px" width="auto">
    <h1 class="display-5 fw-bold">Straßenmeisterei Neuberg</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Zurzeit Online: <?php echo "{$num_currentOn}" ?></p>
    </div>
    </div>

    <div class="container bg-light shadow p-3 mb-5 rounded-3 my-5" style="min-height:450px;">


<table class="table" id="pusers-table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">SteamID</th>
      <th scope="col">Name</th>
      <th scope="col">Rang</th>
      <th scope="col">Reg. Datum</th>
      <th scope="col">Aktionen</th>
    </tr>
  </thead>
  <tbody>

  <?php

  while ($row = mysqli_fetch_array($query)) {

    $crDat = new DateTime($row['regAt']);
  $crDat->add(new DateInterval('PT2H'));
  $crDatf = $crDat->format('d.m.Y H:i');

    if ($row['permLevel'] == 1) {
        $permText = "1 - Ausbilder";
    } elseif ($row['permLevel'] == 2) {
        $permText = "2 - Personaler";
    } elseif ($row['permLevel'] == 3) {
        $permText = "3 - Verwaltung";
    } elseif ($row['permLevel'] == 4) {
        $permText = "4 - Admin";
    } else {
        $permText = "0 - Gast";
    }

    if ($row['permLevel'] >= $uPermLevel) {

      echo
		"<tr>
		    <th scope=''row'>{$row['id']}</th>
            <td>{$row['steamid']}</td>
            <td>{$row['rpname']}</td>
            <td>{$permText}</td>
            <td>{$crDatf}</td>
            <td></td>
    	</tr>";

    } else {

	echo
		"<tr>
		    <th scope=''row'>{$row['id']}</th>
            <td>{$row['steamid']}</td>
            <td>{$row['rpname']}</td>
            <td>{$permText}</td>
            <td>{$crDatf}</td>
            <td><a href='user-edit.php?id={$row['id']}' title='Benutzer bearbeiten'><button type='button' class='btn btn-outline-dark'><i class='fa-solid fa-wrench'></i></button></a></td>
    	</tr>";
  }
}

?>

</tbody>
</table>

</div>

<?php include("../../../assets/components/footer.php"); ?>

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