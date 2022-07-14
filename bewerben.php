<?php

include("/assets/components/fb37dbconnect.php");

$dbconnect=mysqli_connect($hostname,$username,$password,$dbname);

$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
    $steamid = $_REQUEST['steamid'];
    $panelid = $_REQUEST['panelid'];
    $rlname = $_REQUEST['rlname'];
    $rlage = $_REQUEST['rlage'];
    $forumname = $_REQUEST['forumname'];
    $email = $_REQUEST['email'];
    $anmerkungen = $_REQUEST['anmerkungen'];
    $bewerbungstext = $_REQUEST['bewerbungstext'];
    $bwstatus = 'Ungesehen';
    $createdAt = date("Y-m-d H:i:s");
    mysqli_query($dbconnect,"INSERT INTO applicationsV2 (`steamid`,`panelid`,`rlname`,`rlage`,`forumname`,`email`,`anmerkungen`,`bewerbungstext`,`bwstatus`,`createdAt`) VALUES ('$steamid','$panelid','$rlname','$rlage','$forumname','$email','$anmerkungen','$bewerbungstext','$bwstatus','$createdAt')")
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
    <?php include('/assets/components/fb37meta.php'); ?>
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
    <script src="/assets/ckeditor/ckeditor.js"></script>
</head>
<body>

   <?php

require '/assets/steamauth/steamauth.php';

?>

<?php
if(!isset($_SESSION['steamid'])) {

    ?>

    <script type="text/javascript">
    window.location.href = "https://strassenmeisterei-neuberg.de/index.php";
    </script>

<?php

}  else {

    ?>

  <?php

  include ('/assets/steamauth/userInfo.php');
  include '/assets/components/registerpaneluser.php';
  
  include ('/assets/components/nav.php');

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
      
      $dbquery = mysqli_query($dbconnect, "SELECT * FROM applicationsV2 ORDER BY createdAt DESC")
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

    if ($rows['bwantwort'] == NULL) {
    $aCTitle = "Keine Bemerkung";
  } else {
    $aCTitle = $rows['bwantwort'];
  }

  $crDat = new DateTime($rows['createdAt']);
  $crDat->add(new DateInterval('PT2H'));
  $crDatf = $crDat->format('d.m.Y H:i');

  if ($rows['bwstatus'] == "Bearbeitung") {
    $spanCl = "text-bg-warning";
  } elseif ($rows['bwstatus'] == "Abgelehnt") {
    $spanCl = "text-bg-danger";
  } elseif ($rows['bwstatus'] == "Angenommen") {
    $spanCl = "text-bg-success";
  } elseif ($rows['bwstatus'] == "Einladung") {
    $spanCl = "text-bg-info";
  } else {
    $spanCl = "text-bg-dark";
  }

  if ($rows['deleted'] != 1) {

	echo
		"<tr>
            <td>{$crDatf}</td>
            <td style='text-align:center;'><a href='https://steamcommunity.com/profiles/{$rows['steamid']}' target='_blank'><i class='fa-brands fa-steam'></i></a></td>
            <td>{$rows['rlname']}</td>
            <td><span class='badge {$spanCl}' title='{$aCTitle}'>{$rows['bwstatus']}</span></td>
            <td><a href='/assets/components/bewerberprofil.php?id={$rows['id']}' title='Bewerbung bearbeiten'><button type='button' class='btn btn-outline-dark'><i class='fa-solid fa-wrench'></i></button></a></td>
    	</tr>";

} else {

  echo
		"<tr class='fst-italic'>
            <td>{$crDatf}</td>
            <td style='text-align:center;'><a href='https://steamcommunity.com/profiles/{$rows['steamid']}' target='_blank'><i class='fa-brands fa-steam'></i></a></td>
            <td>{$rows['rlname']}</td>
            <td><span class='badge {$spanCl}' title='{$aCTitle}'>{$rows['bwstatus']}</span></td>
            <td></td>
    	</tr>";

}


    }

?>

</tbody>
</table>
</div>


      <?php } else { ?>

    <?php 

    $counter = $dbconnect->query("SELECT * FROM applicationsV2 WHERE steamid = {$steamprofile['steamid']}");
    $bwnr = $dbconnect->query("SELECT * FROM applicationsV2 WHERE steamid = {$steamprofile['steamid']} ORDER BY createdAt DESC LIMIT 1");
    $delcon = $dbconnect->query("SELECT deleted FROM applicationsV2 WHERE steamid = {$steamprofile['steamid']} AND deleted = 1");
    $del = mysqli_fetch_array($delcon);

    if ($counter->num_rows == 0 || $counter->num_rows == $delcon->num_rows) {

    ?>

<div class="container bg-light shadow p-3 mb-5 rounded-3 my-5">
        <h4 class="fw-bold mb-4">Bei der Straßenmeisterei bewerben</h4>
        <form name="form" method="post" action="">
        <input type="hidden" name="new" value="1" />
        <input type="hidden" name="steamid" value="<?= $steamprofile['steamid'] ?>" />
        <input type="hidden" name="panelid" value="<?= $uPanelID ?>" />
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input id="floatingInput" class="form-control rounded-3" type="text" name="rlname" placeholder="TheLegend27" required>
                    <label for="floatingInput">(Reallife) Vorname</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    <input id="floatingInput" class="form-control rounded-3" type="text" name="rlage" placeholder="TheLegend27" required>
                    <label for="floatingInput">(Reallife) Alter</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    <input id="floatingInput" class="form-control rounded-3" type="text" name="forumname" placeholder="TheLegend27" required>
                    <label for="floatingInput">Forum Benutzername</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    <input id="floatingInput" class="form-control rounded-3" type="text" name="email" placeholder="TheLegend27" required>
                    <label for="floatingInput">E-Mail-Adresse</label>
                </div>
            </div>
        </div>
          <div class="mb-3">
            <label for="floatingInput" class="form-label">Anmerkungen</label>
            <textarea id="floatingInput" class="form-control rounded-3 no-resize" type="text" name="anmerkungen" placeholder="Gibt es sonst etwas was wir wissen sollten?" style="height:75px;"></textarea>
          </div>
          <hr class="my-4">
          <div class="mb-3">
            <label for="floatingInput">Bewerbungsschreiben</label>
            <textarea id="floatingInput" class="form-control rounded-3" name="bewerbungstext" placeholder="Kurzer, aber ausführlicher Vorstellungstext zu dir und deiner Person" style="height:250px;">
                <strong><small>Straßenmeisterei Neuberg | An der Bundesstraße 1 | Neuberg</small><br/><br>

                z.Hd. Verwaltung & Personaldirektion<br/>
                Straßenmeisterei Neuberg<br/>
                An der Bundesstraße 1<br/>
                Neuberg</strong>
            </textarea>
          </div>
          <div class="row">
            <div class="col">
                <p><input class="mb-2 btn btn-lg rounded-3 btn-primary" name="submit" type="submit" value="Bewerbung absenden" /></p>
                <small class="text-muted"><?php echo $status; ?></small>
            </div>
            <div class="col-8"></div>
          </div>
        </form>

         <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'bewerbungstext' );
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
      <th scope="col">Personalsachbearbeiter</th>
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

  if ($row['bwstatus'] == "Bearbeitung") {
    $spanClass = "text-bg-warning";
  } elseif ($row['bwstatus'] == "Abgelehnt") {
    $spanClass = "text-bg-danger";
  } elseif ($row['bwstatus'] == "Angenommen") {
    $spanClass = "text-bg-success";
  } elseif ($row['bwstatus'] == "Einladung") {
    $spanClass = "text-bg-info";
  } else {
    $spanClass = "text-bg-dark";
  }

   if ($row['bwantwort'] == NULL) {
    $bwawtext = "Es wurde noch kein Kommentar hinterlegt.";
   } else {
    $bwawtext = $row['bwantwort'];
   }

	echo
		"<tr>
            <td colspan='4' class='text-center fs-5'><span class='badge {$spanClass}' title='Status zuletzt gesetzt: {$edAtf}'>{$row['bwstatus']}</span></td>
            <td class='text-center fs-5'>{$row['bwbearbeiter']}</td>
    	</tr>
      <tr>
            <td colspan='6'><strong>Kommentar</strong><br/><br/> {$bwawtext}</td>
    	</tr>";
}
?>

</tbody>
</table>
</div>

<?php 
}
}
include("/assets/components/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="/assets/js/tablesearch.js"></script>

<?php } ?>

</body>
</html>