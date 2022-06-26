<?php

include("../../assets/components/fb37dbconnect.php");

$dbconnect=mysqli_connect($hostname,$username,$password,$dbname);

$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
    $steamid = $_REQUEST['steamid2'];
    $name = $_REQUEST['name'];
    $age = $_REQUEST['age'];
    $applytext = $_REQUEST['applytext'];
    $astatus = 'Ungesehen';
    $createdAt = date("Y-m-d H:i:s");
    mysqli_query($dbconnect,"INSERT INTO applySystem (`steamid`,`name`,`age`,`applytext`,`astatus`,`createdAt`) VALUES ('$steamid','$name','$age','$applytext','$astatus','$createdAt')")
    or die(mysql_error());
    $status = "Bewerbung erfolgreich eingereicht!";
    header("Refresh:0");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewerben &middot; Straßenmeisterei Neuberg</title>
    <!-- Metas -->
    <?php include('../../assets/components/fb37meta.php'); ?>
    <!-- Metas end -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="../../assets/fonts/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/own.css">
    <link rel="stylesheet" href="../../assets/css/fb37.css">
    <link rel="icon" type="image/ico" href="../../assets/images/favicon-fb37.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
    <script src="//cdn.ckeditor.com/4.19.0/basic/ckeditor.js"></script>
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

    ?>

  <?php

  include ('../../assets/steamauth/userInfo.php');
  include '../../assets/components/registerpaneluser.php';
  
  include ('../../assets/components/nav.php');

?>

  <div class="px-4 py-5 text-center container rounded-3" id="meisterei-hero">
      <img src="/assets/images/tcMPe2F2.png" alt="Straßenmeisterei" height="100px" width="auto">
    <h1 class="display-5 fw-bold">Straßenmeisterei Neuberg</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Bewerbungsportal</p>
    </div>
    </div>

    <?php
    // Mindestens benötigte Berechtigung: Personaler
    if ($uPermLevel >= 2) {
      
      $dbquery = mysqli_query($dbconnect, "SELECT * FROM applySystem ORDER BY createdAt DESC")
		or die (mysqli_error($dbconnect));
      ?>


      <div class="container bg-light shadow p-3 mb-5 rounded-3 my-5" style="min-height:450px;">

      <input type="text" id="bewerberSuche" onkeyup="applicationSearch()" placeholder="Bewerber suchen...">

<table class="table" id="apply-management">
  <thead>
    <tr>
      <th scope="col">Datum</th>
      <th scope="col"></th>
      <th scope="col">Name</th>
      <th scope="col">Status</th>
      <th scope="col">Aktionen</th>
    </tr>
  </thead>
  <tbody>

  <?php

while ($rows = mysqli_fetch_array($dbquery)) {

    if ($rows['acomment'] == NULL) {
    $aCTitle = "Keine Bemerkung";
  } else {
    $aCTitle = $rows['acomment'];
  }

  $crDat = new DateTime($rows['createdAt']);
  $crDat->add(new DateInterval('PT2H'));
  $crDatf = $crDat->format('d.m.Y H:i');

  if ($rows['astatus'] == "Bearbeitung") {
    $spanCl = "text-bg-warning";
  } elseif ($rows['astatus'] == "Abgelehnt") {
    $spanCl = "text-bg-danger";
  } elseif ($rows['astatus'] == "Angenommen") {
    $spanCl = "text-bg-success";
  } elseif ($rows['astatus'] == "Einladung") {
    $spanCl = "text-bg-info";
  } else {
    $spanCl = "text-bg-dark";
  }

  if ($rows['deleted'] != 1) {

	echo
		"<tr>
            <td>{$crDatf}</td>
            <td style='text-align:center;'><a href='https://steamcommunity.com/profiles/{$rows['steamid']}' target='_blank'><i class='fa-brands fa-steam'></i></a></td>
            <td>{$rows['name']}</td>
            <td><span class='badge {$spanCl}' title='{$aCTitle}'>{$rows['astatus']}</span></td>
            <td><a href='../../assets/components/bewerberprofil.php?id={$rows['id']}' title='Bewerbung bearbeiten'><button type='button' class='btn btn-outline-dark'><i class='fa-solid fa-wrench'></i></button></a></td>
    	</tr>";

} else {

  echo
		"<tr class='fst-italic'>
            <td>{$crDatf}</td>
            <td style='text-align:center;'><a href='https://steamcommunity.com/profiles/{$rows['steamid']}' target='_blank'><i class='fa-brands fa-steam'></i></a></td>
            <td>{$rows['name']}</td>
            <td><span class='badge {$spanCl}' title='{$aCTitle}'>{$rows['astatus']}</span></td>
            <td><a href='../../assets/components/bwreopen.php?id={$rows['id']}' title='Bewerbung wiederherstellen'><button type='button' class='btn btn-outline-success'><i class='fa-solid fa-repeat'></i></button></a></td>
    	</tr>";

}


    }

?>

</tbody>
</table>
</div>


      <?php } else { ?>

    <?php 

    $counter = $dbconnect->query("SELECT * FROM applySystem WHERE steamid = {$steamprofile['steamid']}");
    $bwnr = $dbconnect->query("SELECT * FROM applySystem WHERE steamid = {$steamprofile['steamid']} ORDER BY createdAt DESC LIMIT 1");
    $delcon = $dbconnect->query("SELECT deleted FROM applySystem WHERE steamid = {$steamprofile['steamid']} AND deleted = 1");
    $del = mysqli_fetch_array($delcon);

    if ($counter->num_rows == 0 || $counter->num_rows == $delcon->num_rows) {

    ?>

<div class="container bg-light shadow p-3 mb-5 rounded-3 my-5">
        <h4 class="fw-bold mb-4">Bei der Straßenmeisterei bewerben</h4>
        <form name="form" method="post" action="">
        <input type="hidden" name="new" value="1" />
        <input type="hidden" name="steamid2" value="<?= $steamprofile['steamid'] ?>" />
          <div class="form-floating mb-3">
            <input id="floatingInput" class="form-control rounded-3" type="text" name="name" placeholder="TheLegend27" value="<?php echo $uUsedName;?>" required>
            <label for="floatingInput">Vor- und Zuname (IC)</label>
          </div>
          <div class="form-floating mb-3">
            <input id="floatingInput" class="form-control rounded-3" type="text" name="age" placeholder="0800 666 666" aria-describedby="contactHelpBlock" required>
            <label for="floatingInput">Kontaktmöglichkeiten</label>
            <div id="contactHelpBlock" class="form-text">
            Bestenfalls gibst du den Link zu deinem Foren-Profil und deine Ingame Telefonnummer an.
            </div>
          </div>
          <hr class="my-4">
          <div class="mb-3">
            <label for="floatingInput">Schriftliche Bewerbung</label>
            <textarea id="floatingInput" class="form-control rounded-3" name="applytext" placeholder="Kurzer, aber ausführlicher Vorstellungstext zu dir und deiner Person" style="height:250px;"></textarea>
          </div>
          <p><input class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" name="submit" type="submit" value="Bewerbung absenden" /></p>
          <small class="text-muted"><?php echo $status; ?></small>
        </form>

        <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'applytext' );
            </script>
</div>

<?php } else { ?>

    <div class="container bg-light shadow p-3 mb-5 rounded-3 my-5" style="min-height:450px;">

    <?php

    while ($row = mysqli_fetch_array($bwnr)) { ?>

    <h4>Aktuelle Bewerbung</h4>

    <hr class="my-4">

<table class="table" id="apply-status">
  <thead>
    <tr class="text-center">
      <th scope="col" colspan='4'>Status</th>
      <th scope="col">Letzter Bearbeiter</th>
    </tr>
  </thead>
  <tbody>

  <?php

  if ($row['editedAt'] == NULL) {
    $edAtf = "Noch nicht bearbeitet";
  } else {
    $edAt = new DateTime($row['editedAt']);
    $edAt->add(new DateInterval('PT2H'));
    $edAtf = $edAt->format('d.m.Y H:i');
  }

  if ($row['astatus'] == "Bearbeitung") {
    $spanClass = "text-bg-warning";
  } elseif ($row['astatus'] == "Abgelehnt") {
    $spanClass = "text-bg-danger";
  } elseif ($row['astatus'] == "Angenommen") {
    $spanClass = "text-bg-success";
  } elseif ($row['astatus'] == "Einladung") {
    $spanClass = "text-bg-info";
  } else {
    $spanClass = "text-bg-dark";
  }

	echo
		"<tr>
            <td colspan='4' class='text-center fs-5'><span class='badge {$spanClass}' title='Status zuletzt gesetzt: {$edAtf}'>{$row['astatus']}</span></td>
            <td class='text-center fs-5'>{$row['auser']}</td>
    	</tr>
      <tr>
            <td colspan='6' style='white-space:pre-line' ><strong>Kommentar</strong><br/><br/> {$row['acomment']}</td>
    	</tr>";
}
?>

</tbody>
</table>
</div>

<?php 
}
}
include("../../assets/components/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="../../assets/js/tablesearch.js"></script>

<?php } ?>

</body>
</html>