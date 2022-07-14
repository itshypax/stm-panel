<?php

include("fb37dbconnect.php");

$dbconnect=mysqli_connect($hostname,$username,$password,$dbname);

$id=$_REQUEST['id'];
$result = mysqli_query($dbconnect, "SELECT * FROM memberManagement WHERE id='".$id."'") or die (mysqli_error($dbconnect));
$row = mysqli_fetch_assoc($result);

  $oldComment = $row['notiz'];
  $oldRank = $row['dienstgrad'];

  $beAt = new DateTime($row['beitritt']);
  $beAt->add(new DateInterval('PT2H'));
  $beAtf = $beAt->format('d.m.Y H:i');

$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
    $id=$_REQUEST['id'];
    $spitzname =$_REQUEST['spitzname'];
    $icname = $_REQUEST['icname'];
    $dienstgrad = $_REQUEST['dienstgrad'];
    $beitritt = $_REQUEST['beitritt'];
    $telnr = $_REQUEST['telnr'];
    $iban = $_REQUEST['iban'];
    $laufstieg = NULL;
    $gehalt = NULL;
    $notiz = $_REQUEST['notiz'];
    $kommentarart = $_REQUEST['kommentarart'];
    $jetzt = date("Y-m-d H:i:s");
    $changingUserName = $_REQUEST['changinguser'];
    mysqli_query($dbconnect,"UPDATE memberManagement SET spitzname='".$spitzname."', icname='".$icname."', dienstgrad='".$dienstgrad."', beitritt='".$beitritt."', telnr='".$telnr."', iban='".$iban."', laufstieg='".$laufstieg."', gehalt='".$gehalt."', notiz='".$notiz."' WHERE id='".$id."'")
    or die(mysql_error());
    $status = "Eintrag erfolgreich bearbeitet.";
    if ($oldComment != $notiz AND strlen($notiz) > 0) {
    mysqli_query($dbconnect,"INSERT INTO memberComments (mitarbeiterid, kommentartext, kommentarart, commentAt, commentUser) VALUES ('".$id."', '".$notiz."', '".$kommentarart."', '".$jetzt."', '".$changingUserName."')")
    or die(mysql_error());
    $status = "Kommentar erfolgreich gesetzt.";
    }
    if ($oldRank != $dienstgrad) {
    mysqli_query($dbconnect,"INSERT INTO rankLog (mitarbeiterid, newRank, rankAt, changedBy) VALUES ('".$id."', '".$dienstgrad."', '".$jetzt."', '".$changingUserName."')")
    or die(mysql_error());
    }
    header("Refresh:0");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitarbeiter bearbeiten &middot; Straßenmeisterei Neuberg</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="../fonts/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/own.css">
    <link rel="stylesheet" href="../css/fb37.css">
    <link rel="icon" type="image/ico" href="../images/favicon-fb37.ico">
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
    window.location.href = "https://strassenmeisterei-neuberg.de/index.php";
    </script>

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
        <h1 style="text-align:center;">Mitarbeiter bearbeiten</h1>
        <hr class="my-4">
        <div class="row">
            <div class="col">
                <div class="container bg-light shadow p-3 rounded-3 my-2 border border-primary">
                    <form name="form" method="post" action="">
        <input type="hidden" name="new" value="1" />
        <input name="id" type="hidden" value="<?php echo $row['id'];?>" />
        <input name="changinguser" type="hidden" value="<?php echo $uUsedName;?>" />
        <?php // Mindestens benötigte Berechtigung: Personaler
              if ($uPermLevel >= 2) { ?>
          <div class="form-floating mb-3">
            <input id="floatingInput" class="form-control rounded-3" type="text" name="spitzname" placeholder="TheLegend27" value="<?php echo $row['spitzname'];?>" required>
            <label for="floatingInput">Spitzname / OOC Name</label>
          </div>
          <div class="form-floating mb-3">
            <input id="floatingInput" class="form-control rounded-3" type="text" name="icname" placeholder="Paul Panzer" value="<?php echo $row['icname'];?>" required>
            <label for="floatingInput">Name / IC Name</label>
          </div>
          <div class="form-floating mb-3">
            <select id="floatingInput" class="form-control rounded-3" name="dienstgrad" placeholder="Oberstabsgeneral 17">
                <option value="Geschäftsführer" <?php if($row['dienstgrad']=="Geschäftsführer") echo 'selected="selected"'; ?>>Geschäftsführer</option>
                <option value="Vorstand" <?php if($row['dienstgrad']=="Vorstand") echo 'selected="selected"'; ?>>Vorstand</option>
                <option value="Straßenmeister" <?php if($row['dienstgrad']=="Straßenmeister") echo 'selected="selected"'; ?>>Straßenmeister</option>
                <option value="Kolonnenführer" <?php if($row['dienstgrad']=="Kolonnenführer") echo 'selected="selected"'; ?>>Kolonnenführer</option>
                <option value="Straßenwärter" <?php if($row['dienstgrad']=="Straßenwärter") echo 'selected="selected"'; ?>>Straßenwärter</option>
                <option value="Auszubildender" <?php if($row['dienstgrad']=="Auszubildender") echo 'selected="selected"'; ?>>Auszubildender</option>
                <option value="Praktikant" <?php if($row['dienstgrad']=="Praktikant") echo 'selected="selected"'; ?>>Praktikant</option>
            </select>
            <label for="floatingInput">Dienstgrad</label>
          </div>
          <div class="form-floating mb-3">
            <input id="floatingInput" class="form-control rounded-3" type="date" name="beitritt" placeholder="01.01.1900" value="<?php echo $row['beitritt'];?>" required>
            <label for="floatingInput">Beitrittsdatum</label>
          </div>
          <div class="form-floating mb-3">
            <input id="floatingInput" class="form-control rounded-3" type="text" name="telnr" placeholder="0800 666 666" value="<?php echo $row['telnr'];?>">
            <label for="floatingInput">Telefonnummer</label>
          </div>
          <div class="form-floating mb-3">
            <input id="floatingInput" class="form-control rounded-3" type="text" name="iban" placeholder="NH123123" value="<?php echo $row['iban'];?>">
            <label for="floatingInput">IBAN</label>
          </div>
          <hr class="my-4">
          <?php } ?>
          <div class="mb-3">
            <label for="floatingInput">Notizen</label>
            <textarea id="floatingInput" class="form-control rounded-3" name="notiz" placeholder="Netter Typ" style="height:100px;"></textarea>
          </div>
          <div class="form-floating mb-3">
            <select id="floatingInput" class="form-control rounded-3" name="kommentarart" placeholder="Allgemein">
              <option value="Allgemein" selected>Allgemein</option>
              <option value="Gehalt">Gehalt</option>
              <option value="Positiv">Positiv</option>
              <option value="Negativ">Negativ</option>
            </select>
            <label for="floatingInput">Kommentar Art</label>
          </div>
          <p><input class="mb-2 btn btn-lg rounded-3 btn-primary" name="submit" type="submit" value="Eintrag bearbeiten" /></p>
          <small class="text-muted"><?php echo $status; ?></small>
          <?php // Mindestens benötigte Berechtigung: Personaler
                if ($uPermLevel >= 2) { ?>
                        <br/>
                        <p><a href="../../assets/components/memdelete.php?id=<?=$row['id']?>" class="link-danger"><i class="fa-solid fa-trash-can"></i> Mitarbeiter löschen</a></p>
          <?php } ?> 
                    </form>
                </div>
                <div class="accordion accordion-flush mt-4" id="accordionFlushExample">
                <div class="accordion-item">
                <h4 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                Rangverlauf
                </button>
                </h4>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                <?php
                $log = mysqli_query($dbconnect,"SELECT * FROM `rankLog` WHERE `mitarbeiterid` = '".$id."'");

                $rowamount = $log->num_rows;

                if($rowamount == 0) {
                    echo "<div class='alert alert-primary my-4 pb-3' role='alert'>Es sind keine Logs vorhanden.</div>";
                } else {
                    while ($eintrag = mysqli_fetch_array($log)) {
                        $acAt = new DateTime($eintrag['rankAt']);
                        $acAt->add(new DateInterval('PT2H'));

                        if ($eintrag['changedBy'] != NULL) {
                          $changeUser = $eintrag['changedBy'];
                        } else {
                          $changeUser = "<i>Unbekannt</i>";
                        }
                        
                        echo
                        "
                        <small>Rang wurde von {$changeUser} zu <strong>{$eintrag['newRank']}</strong> geändert.<br/>– {$acAt->format('d.m.Y H:i')}</small><hr>
                        ";
                    }
                }
                ?>
                </div>
                </div>
            </div>
            </div>
            </div>
            <div class="col-9">
                <h4><?= $row['icname'] ?> (<?= $row['spitzname'] ?>)</h4>
                <p><strong>Eingestellt am:</strong><br/> <?= $beAtf ?></p>
                <p><strong>Dienstgrad:</strong><br/> <?= $row['dienstgrad'] ?></p>
                <p><strong>Telefon:</strong><br/> <?= $row['telnr'] ?></p>
                <p><strong>IBAN:</strong><br/> <?= $row['iban'] ?></p>
                <div class="my-5"></div>
                <hr class="my-3">
                <h5>Kommentare:</h5>
                <?php
                $comlog = mysqli_query($dbconnect,"SELECT * FROM `memberComments` WHERE `mitarbeiterid` = '".$id."'");

                $rowamounts = $comlog->num_rows;

                if($rowamounts == 0) {
                    echo "<div class='alert alert-primary my-4 pb-3' role='alert'>Es sind keine Kommentare vorhanden.</div>";
                } else {
                    while ($et = mysqli_fetch_array($comlog)) {
                        $comAt = new DateTime($et['commentAt']);
                        $comAt->add(new DateInterval('PT2H'));

                        if ($et['kommentarart'] == "Allgemein") {
                          $commentType = "<span>– Allgemein</span>";
                        } elseif ($et['kommentarart'] == "Gehalt") {
                          $commentType = "<span>– <i class='fa-solid fa-badge-dollar'></i> Gehalt</span>";
                        } elseif ($et['kommentarart'] == "Positiv") {
                          $commentType = "<span style='color:#09BC8A;'>– <strong>Positiv</strong></span>";
                        } else {
                          $commentType = "<span style='color:#E54B4B;'>– <strong>Negativ</strong></span>";
                        }

                        if ($et['commentUser'] != NULL) {
                          $commentUser = "<span>– von {$et['commentUser']}</span>";
                        } else {
                          $commentUser = "<span>– von <i>Unbekannt</i></span>";
                        }

                        // Mindestens benötigte Berechtigung: Admin
                        if ($uPermLevel >= 4) {

                        echo
                        "
                        <small style='white-space:pre-line;'>{$et['kommentartext']}<br/>– {$comAt->format('d.m.Y H:i')} {$commentType} {$commentUser}</small><br/>
                        <small><a href='../../assets/components/comdelete.php?id={$et['id']}&mid={$row['id']}' class='link-danger'><i class='fa-solid fa-trash-can'></i></a></small><hr>
                        ";

                        } else {
                          echo
                        "
                        <small style='white-space:pre-line;'>{$et['kommentartext']}<br/>– {$comAt->format('d.m.Y H:i')} {$commentType}</small><hr>
                        ";
                        }
                    }
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col mt-5">
                <p><a href="https://strassenmeisterei-neuberg.de/mitarbeiter.php"><i class="fa-solid fa-arrow-left-long-to-line"></i> Zurück zur Übersicht</a></p>
            </div>
        </div>
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
?>
</body>
</html>