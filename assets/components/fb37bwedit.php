<?php

include("fb37dbconnect.php");

$dbconnect=mysqli_connect($hostname,$username,$password,$dbname);

$id=$_REQUEST['id'];
$result = mysqli_query($dbconnect, "SELECT * FROM applySystem WHERE id='".$id."'") or die (mysqli_error($dbconnect));
$row = mysqli_fetch_assoc($result);

$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
    $id=$_REQUEST['id'];
    $astatus =$_REQUEST['astatus'];
    $acomment = $_REQUEST['acomment'];
    $auser = $_REQUEST['auser'];
    mysqli_query($dbconnect,"UPDATE applySystem SET astatus='".$astatus."', acomment='".$acomment."', auser='".$auser."'")
    or die(mysql_error());
    $status = "Bewerbung erfolgreich bearbeitet.";
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

<div class="modal modal-signin position-static d-block py-5" tabindex="-1" role="dialog" id="modalSignin">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header p-5 pb-4 border-bottom-0">
        <!-- <h5 class="modal-title">Modal title</h5> -->
        <h2 class="fw-bold mb-0">Bewerbung bearbeiten</h2>
        <a href="../../fachbereiche/37/bewerben.php"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></a>
      </div>

      <div class="modal-body p-5 pt-0">
        <form name="form" method="post" action="">
        <input type="hidden" name="new" value="1" />
        <input name="id" type="hidden" value="<?php echo $row['id'];?>" />
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
          <div class="form-floating mb-3">
            <input id="floatingInput" class="form-control rounded-3" type="text" name="auser" placeholder="TheLegend27" value="<?php echo $row['auser'];?>" required>
            <label for="floatingInput">Sachbearbeiter</label>
          </div>
          <hr class="my-4">
          <div class="mb-3">
            <label for="floatingInput">Bemerkung</label>
            <textarea id="floatingInput" class="form-control rounded-3" name="acomment" placeholder="Einladung/Ablehnung/Bearbeitungstext" style="height:100px;"><?php echo $row['acomment'];?></textarea>
          </div>
          <p><input class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" name="submit" type="submit" value="Bewerbung bearbeiten" /></p>
          <small class="text-muted"><?php echo $status; ?></small>
        </form>
      </div>
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
}     
?>
</body>
</html>