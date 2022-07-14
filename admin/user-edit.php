<?php

include("../assets/components/fb37dbconnect.php");

$dbconnect=mysqli_connect($hostname,$username,$password,$dbname);

$id=$_REQUEST['id'];
$result = mysqli_query($dbconnect, "SELECT * FROM panelUsers WHERE id='".$id."'") or die (mysqli_error($dbconnect));
$row = mysqli_fetch_assoc($result);

$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
    $id=$_REQUEST['id'];
    $rpname =$_REQUEST['rpname'];
    $permlevel = $_REQUEST['permlevel'];
    $jetzt = date("Y-m-d H:i:s");
    mysqli_query($dbconnect,"UPDATE panelUsers SET rpname='".$rpname."', permLevel='".$permlevel."' WHERE id='".$id."'")
    or die(mysql_error());
    $status = "Eintrag erfolgreich bearbeitet.";
    header("Refresh:0");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User bearbeiten &middot; Straßenmeisterei Neuberg</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="../assets/fonts/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/own.css">
    <link rel="stylesheet" href="../assets/css/fb37.css">
    <link rel="icon" type="image/ico" href="../assets/images/favicon-fb37.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

   <?php

require '../assets/steamauth/steamauth.php';

?>

<?php
if(!isset($_SESSION['steamid'])) {

    ?>

    <script type="text/javascript">
    window.location.href = "https://strassenmeisterei-neuberg.de/index.php";
    </script>

<?php

}  else {

    include ('../assets/steamauth/userInfo.php'); 
    include '../assets/components/registerpaneluser.php';
    
    // Mindestens benötigte Berechtigung: Ausbilder
    if ($uPermLevel >= 4 AND $uPermLevel > $row['permLevel']) {?>

  <?php

  include("../assets/components/fb37dbconnect.php");

$dbconnect=mysqli_connect($hostname,$username,$password,$dbname);

if ($dbconnect->connect_error) {
	die("Fehler, Verbindung fehlgeschlagen:" . $dbconnect->connect_error);
}

  $currentOn = mysqli_query($dbconnect,"SELECT * FROM UserPlaytimes WHERE `online` = '1'");
  $num_currentOn = mysqli_num_rows($currentOn);
 

  include '../assets/components/nav.php';
?>

  <div class="px-4 py-5 text-center container rounded-3" id="meisterei-hero">
      <img src="/assets/images/tcMPe2F2.png" alt="Straßenmeisterei" height="100px" width="auto">
    <h1 class="display-5 fw-bold">Straßenmeisterei Neuberg</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Zurzeit Online: <?php echo "{$num_currentOn}" ?></p>
    </div>
    </div>

    <div class="container bg-light shadow p-3 mb-5 rounded-3 my-5" style="min-height:450px;">
        <h1 style="text-align:center;">User bearbeiten</h1>
        <hr class="my-4">
        <div class="row">
            <div class="col">
                <div class="container bg-light shadow p-3 rounded-3 my-2 border border-primary">
                    <form name="form" method="post" action="">
        <input type="hidden" name="new" value="1" />
        <input name="id" type="hidden" value="<?php echo $row['id'];?>" />
          <div class="form-floating mb-3">
            <input id="floatingInput" class="form-control rounded-3" type="text" name="rpname" placeholder="TheLegend27" value="<?php echo $row['rpname'];?>" required>
            <label for="floatingInput">RP Name</label>
          </div>
          <div class="form-floating mb-3">
            <select id="floatingInput" class="form-control rounded-3" name="permlevel" placeholder="Oberstabsgeneral 17">
                <option value="3" <?php if($row['permLevel']==3) echo 'selected="selected"'; ?>>3 - Verwaltung</option>
                <option value="2" <?php if($row['permLevel']==2) echo 'selected="selected"'; ?>>2 - Personaler</option>
                <option value="1" <?php if($row['permLevel']==1) echo 'selected="selected"'; ?>>1 - Ausbilder</option>
                <option value="0" <?php if($row['permLevel']==0) echo 'selected="selected"'; ?>>0 - Gast</option>
            </select>
            <label for="floatingInput">Rang</label>
          </div>
          <p><input class="mb-2 btn btn-lg rounded-3 btn-primary" name="submit" type="submit" value="User bearbeiten" /></p>
          <small class="text-muted"><?php echo $status; ?></small>
                    </form>
                </div>
            </div>
        <div class="row">
            <div class="col mt-5">
                <p><a href="https://strassenmeisterei-neuberg.de/admin/user-management.php"><i class="fa-solid fa-arrow-left-long-to-line"></i> Zurück zur Übersicht</a></p>
            </div>
        </div>
    </div>
</div>

<?php include("../assets/components/footer.php"); ?>

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