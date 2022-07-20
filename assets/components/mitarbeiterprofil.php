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
  $beAtf = $beAt->format('d.m.Y');

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
    $jetzt = date("Y-m-d H:i:s");
    $changingUserName = $_REQUEST['changinguser'];
    mysqli_query($dbconnect,"UPDATE memberManagement SET spitzname='".$spitzname."', icname='".$icname."', dienstgrad='".$dienstgrad."', beitritt='".$beitritt."', telnr='".$telnr."', iban='".$iban."', laufstieg='".$laufstieg."', gehalt='".$gehalt."', notiz='".$notiz."' WHERE id='".$id."'")
    or die(mysql_error());
    $status = "Eintrag erfolgreich bearbeitet.";
    if ($oldRank != $dienstgrad) {
    mysqli_query($dbconnect,"INSERT INTO rankLog (mitarbeiterid, newRank, rankAt, changedBy) VALUES ('".$id."', '".$dienstgrad."', '".$jetzt."', '".$changingUserName."')")
    or die(mysql_error());
    }
    header("Refresh:0");
}

if(isset($_POST['new']) && $_POST['new']==2){
    $id=$_REQUEST['id'];
    $notiz = $_REQUEST['notiz'];
    $kommentarart = $_REQUEST['kommentarart'];
    $jetzt = date("Y-m-d H:i:s");
    $changingUserName = $_REQUEST['changinguser'];
    mysqli_query($dbconnect,"INSERT INTO memberComments (mitarbeiterid, kommentartext, kommentarart, commentAt, commentUser) VALUES ('".$id."', '".$notiz."', '".$kommentarart."', '".$jetzt."', '".$changingUserName."')")
    or die(mysql_error());
    $status = "Kommentar erfolgreich gesetzt.";
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
    if ($uPermLevel >= $perm_level_instructor) {?>

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
          <div class="col-9"></div>
          <div class="col text-end">
            <span style="margin-right:12px;"><button type="button" class="btn btn-outline-secondary" title="Notiz hinzufügen" data-bs-toggle="modal" data-bs-target="#userNoteModal"><i class="fa-solid fa-notebook"></i></button></span> <button type="button" class="btn btn-outline-secondary" title="Mitarbeiterprofil bearbeiten" data-bs-toggle="modal" data-bs-target="#userEditModal"><i class="fa-solid fa-pencil"></i></button>
          </div>
        </div>
          <!-- MODAL BEGIN -->

          <div class="modal fade" id="userEditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userEditModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="userEditModalLabel">Mitarbeiterprofil bearbeiten</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form name="form" method="post" action="">
                    <input type="hidden" name="new" value="1" />
                    <input name="id" type="hidden" value="<?php echo $row['id'];?>" />
                    <input name="changinguser" type="hidden" value="<?php echo $uUsedName;?>" />
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
                        <option value="Verkehrswärter" <?php if($row['dienstgrad']=="Verkehrswärter") echo 'selected="selected"'; ?>>Verkehrswärter</option>
                        <option value="Straßenwärter" <?php if($row['dienstgrad']=="Straßenwärter") echo 'selected="selected"'; ?>>Straßenwärter</option>
                        <option value="Auszubildender" <?php if($row['dienstgrad']=="Auszubildender") echo 'selected="selected"'; ?>>Auszubildender</option>
                        <option value="Praktikant" <?php if($row['dienstgrad']=="Praktikant") echo 'selected="selected"'; ?>>Praktikant</option>
                      </select>
                      <label label for="floatingInput">Dienstgrad</label>
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
                  </div>
                  <div class="modal-footer">
                    <p><input class="mb-2 btn btn-lg rounded-3 btn-primary" name="submit" type="submit" value="Bearbeiten" /></p>
                    <small class="text-muted"><?php echo $status; ?></small>
          <?php // Mindestens benötigte Berechtigung: Personaler
                if ($uPermLevel >= $perm_level_hr) { ?>
                        <br/>
                        <p><a href="../../assets/components/memdelete.php?id=<?=$row['id']?>" class="link-danger"><i class="fa-solid fa-trash-can"></i> Mitarbeiter löschen</a></p>
          <?php } ?> 
                    </form>
                  </div>
                </div>
              </div>
          </div>

          <!-- MODAL END -->

          <!-- MODAL BEGIN -->

          <div class="modal fade" id="userNoteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userNoteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="userNoteModalLabel">Notiz hinzufügen</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form name="form" method="post" action="">
                    <input type="hidden" name="new" value="2" />
                    <input name="id" type="hidden" value="<?php echo $row['id'];?>" />
                    <input name="changinguser" type="hidden" value="<?php echo $uUsedName;?>" />
                    <div class="mb-3">
                      <label for="floatingInput">Notizen</label>
                      <textarea id="floatingInput" class="form-control rounded-3" name="notiz" placeholder="" style="height:100px;"></textarea>
                    </div>
                    <div class="form-floating mb-3">
                      <select id="floatingInput" class="form-control rounded-3" name="kommentarart" placeholder="Allgemein">
                        <option value="Allgemein" selected>Allgemein</option>
                        <option value="Gehalt">Gehalt</option>
                        <option value="Positiv">Positiv</option>
                        <option value="Negativ">Negativ</option>
                        <option value="Urlaub">Urlaub</option>
                      </select>
                      <label for="floatingInput">Art</label>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <p><input class="mb-2 btn btn-lg rounded-3 btn-primary" name="submit" type="submit" value="Hinzufügen" /></p>
                    <small class="text-muted"><?php echo $status; ?></small>
                    </form>
                  </div>
                </div>
              </div>
          </div>

          <!-- MODAL END -->
        <div class="row">
            <div class="col">
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
              <form>
                <div class="row">
                  <div class="col mb-3">
                    <label for="icname" class="form-label">Vor- und Zuname</label>
                    <input type="text" class="form-control" id="icname" value="<?= $row['icname'] ?>" readonly>
                  </div>
                  <div class="col mb-3">
                    <label for="oocname" class="form-label">Spitzname (OOC)</label>
                    <input type="text" class="form-control" id="oocname" value="<?= $row['spitzname'] ?>" readonly>
                  </div>
                </div>
                <div class="row">
                  <div class="col mb-3">
                    <label for="einstelldatum" class="form-label">Einstelldatum</label>
                    <input type="text" class="form-control" id="einstelldatum" value="<?= $beAtf ?>" readonly>
                  </div>
                  <div class="col mb-3">
                    <label for="dienstgradd" class="form-label">Dienstgrad</label>
                    <input type="text" class="form-control" id="dienstgradd" value="<?= $row['dienstgrad'] ?>" readonly>
                  </div>
                </div>
                <div class="row">
                  <div class="col mb-3">
                    <label for="telnro" class="form-label">Telefonnummer</label>
                    <input type="text" class="form-control" id="telnro" value="<?= $row['telnr'] ?>" readonly>
                  </div>
                  <div class="col mb-3">
                    <label for="ibann" class="form-label">IBAN</label>
                    <input type="text" class="form-control" id="ibann" value="<?= $row['iban'] ?>" readonly>
                  </div>
                </div>
              </form>
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
                          $commentType = "";
                        } elseif ($et['kommentarart'] == "Gehalt") {
                          $commentType = ".c-type-mon";
                        } elseif ($et['kommentarart'] == "Positiv") {
                          $commentType = ".c-type-pos";
                        } elseif ($et['kommentarart'] == "Negativ") {
                          $commentType = ".c-type-neg";
                        } elseif ($et['kommentarart'] == "Urlaub") {
                          $commentType = ".c-type-url";
                        } else {
                          $commentType = "";
                        }

                        if ($et['commentUser'] != NULL) {
                          $commentUser = "<span>– von {$et['commentUser']}</span>";
                        } else {
                          $commentUser = "<span>– von <i>Unbekannt</i></span>";
                        }

                        // Mindestens benötigte Berechtigung: Verwaltung
                        if ($uPermLevel >= $perm_level_manager) {

                        echo
                        "
                        <div class='c-type {$commentType} w-100' style='overflow:hidden;'>
                        <small style='white-space:pre-line;'>{$et['kommentartext']}<br/>– {$comAt->format('d.m.Y H:i')} {$commentUser} – <a href='../../assets/components/comdelete.php?id={$et['id']}&mid={$row['id']}' class='link-danger'>Notiz löschen</a></small><hr></div>
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