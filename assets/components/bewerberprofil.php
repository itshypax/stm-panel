<?php

include("fb37dbconnect.php");

$dbconnect=mysqli_connect($hostname,$username,$password,$dbname);

$id=$_REQUEST['id'];
$result = mysqli_query($dbconnect, "SELECT * FROM applySystem WHERE id='".$id."'") or die (mysqli_error($dbconnect));
$row = mysqli_fetch_assoc($result);

  $crDat = new DateTime($row['createdAt']);
  $crDat->add(new DateInterval('PT2H'));
  $crDatf = $crDat->format('d.m.Y H:i');

  $oldAstatus = $row['astatus'];
  $oldAcomment = $row['acomment'];
  $oldAuser = $row['auser'];

$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
    $id=$_REQUEST['id'];
    $astatus =$_REQUEST['astatus'];
    $acomment = $_REQUEST['acomment'];
    $auser = $_REQUEST['auser'];
    $changingUserName = $_REQUEST['changinguser'];
    mysqli_query($dbconnect,"UPDATE applySystem SET astatus='".$astatus."', acomment='".$acomment."', auser='".$auser."' WHERE id='".$id."'")
    or die(mysql_error());
    $logentryAt = date("Y-m-d H:i:s");
    if ($oldAstatus != $astatus) {
      $loginsert = "Der Status wurde durch ".$changingUserName." von <strong>".$oldAstatus."</strong> zu <strong>".$astatus."</strong> geändert.";
      mysqli_query($dbconnect,"INSERT INTO BewerbungsLog (`bewerbungsid`,`action`,`actionAt`) VALUES ('$id','$loginsert','$logentryAt')")
    or die(mysql_error());
    }
    if ($oldAcomment != $acomment) {
      $loginsert = "Die Bemerkung wurde durch ".$changingUserName." geändert.";
      mysqli_query($dbconnect,"INSERT INTO BewerbungsLog (`bewerbungsid`,`action`,`actionAt`) VALUES ('$id','$loginsert','$logentryAt')")
    or die(mysql_error());
    }
    if ($oldAuser != $auser) {
      $loginsert = "Der Bearbeiter wurde von ".$oldAuser." zu <strong>".$auser."</strong> geändert.";
      mysqli_query($dbconnect,"INSERT INTO BewerbungsLog (`bewerbungsid`,`action`,`actionAt`) VALUES ('$id','$loginsert','$logentryAt')")
    or die(mysql_error());
    }
    $status = "Bewerbung erfolgreich bearbeitet.";
    header("Refresh:0");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewerbung bearbeiten &middot; Straßenmeisterei Neuberg</title>
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
    window.location.href = "https://wiesberg.net/fachbereiche/37/index.php";
    </script>

<?php

}  else {

    include ('../../assets/steamauth/userInfo.php'); 
    include '../../assets/components/registerpaneluser.php';
    
    // Mindestens benötigte Berechtigung: Personaler
    if ($uPermLevel >= 2) {?>

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
        <h1 style="text-align:center;">Bewerbung bearbeiten</h1>
        <hr class="my-4">
        <div class="row">
            <div class="col">
                <?php
                require '../steamauth/SteamConfig.php';
                $stprofile = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$steamauth['apikey']."&steamids=".$row['steamid']);
                $stcontent = json_decode($stprofile, true);
                $stavatar = $stcontent['response']['players'][0]['avatarfull'];
                $stname = $stcontent['response']['players'][0]['personaname'];
                ?>
                <img src="<?= $stavatar ?>" alt="Steam-Avatar" class="rounded-circle my-2">
                <h4><strong>Bewerber:</strong> <?= $row['name'] ?></h4>
                <p><strong>Steam-Profil:</strong><br/> <a href="https://steamcommunity.com/profiles/<?= $row['steamid'] ?>"><i class="fa-brands fa-steam"></i> <?= $stname ?></a></p>
                <p><strong>Eingereicht am:</strong><br/> <?= $crDatf ?></p>
                <p><strong>Kontakt:</strong><br/> <?= $row['age'] ?></p>
                <p style="white-space:pre-line;"><strong>Bewerbung:</strong><br/> <?= $row['applytext'] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="container bg-light shadow p-3 rounded-3 my-2 border border-primary">
                    <form name="form" method="post" action="">
                        <input type="hidden" name="new" value="1" />
                        <input name="id" type="hidden" value="<?php echo $row['id'];?>" />
                        <input name="changinguser" type="hidden" value="<?php echo $uUsedName;?>" />
                        <div class="form-floating mb-3">
                            <select id="floatingInput" class="form-control rounded-3" name="astatus" placeholder="Ungesehen">
                                <option value="Ungesehen" <?php if($row['astatus']=="Ungesehen") echo 'selected="selected"'; ?>>Ungesehen</option>
                                <option value="Bearbeitung" <?php if($row['astatus']=="Bearbeitung") echo 'selected="selected"'; ?>>Bearbeitung</option>
                                <option value="Einladung" <?php if($row['astatus']=="Einladung") echo 'selected="selected"'; ?>>Einladung</option>
                                <option value="Abgelehnt" <?php if($row['astatus']=="Abgelehnt") echo 'selected="selected"'; ?>>Abgelehnt</option>
                                <option value="Angenommen" <?php if($row['astatus']=="Angenommen") echo 'selected="selected"'; ?>>Angenommen</option>
                            </select>
                            <label for="floatingInput">Status</label>
                        </div>
                        <input name="auser" type="hidden" value="<?php echo $uUsedName;?>" />
                        <hr class="my-4">
                        <div class="form-floating mb-3">
                            <textarea id="floatingInput" class="form-control rounded-3" name="acomment" placeholder="Einladung/Ablehnung/Bearbeitungstext" style="height:300px;"><?php echo $row['acomment'];?></textarea>
                            <label for="floatingInput">Bemerkung</label>
                        </div>
                        <p><input class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" name="submit" type="submit" value="Bewerbung bearbeiten" /></p>
                        <small class="text-muted"><?php echo $status; ?></small>
                        <br/>
                        <p><a href="../../assets/components/bwdelete.php?id=<?=$row['id']?>" class="link-danger"><i class="fa-solid fa-trash-can"></i> Eintrag löschen</a></p>
                    </form>
                </div>
                <div class="accordion accordion-flush mt-4" id="accordionFlushExample">
                <div class="accordion-item">
                <h4 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                Änderungsverlauf
                </button>
                </h4>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                <?php
                $log = mysqli_query($dbconnect,"SELECT * FROM `BewerbungsLog` WHERE `bewerbungsid` = '".$id."'");

                $rowamount = $log->num_rows;

                if($rowamount == 0) {
                    echo "<div class='alert alert-primary my-4 pb-3' role='alert'>Es sind keine Logs vorhanden.</div>";
                } else {
                    while ($eintrag = mysqli_fetch_array($log)) {
                        $acAt = new DateTime($eintrag['actionAt']);
                        $acAt->add(new DateInterval('PT2H'));
                        echo
                        "
                        <small>{$eintrag['action']}<br/>– {$acAt->format('d.m.Y H:i')}</small><hr>
                        ";
                    }
                }
                ?>
                </div>
                </div>
            </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col mt-5">
                <p><a href="https://wiesberg.net/fachbereiche/37/bewerben.php"><i class="fa-solid fa-arrow-left-long-to-line"></i> Zurück zur Übersicht</a></p>
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