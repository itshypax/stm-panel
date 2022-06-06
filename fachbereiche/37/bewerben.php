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
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewerben &middot; Straßenmeisterei Neuberg</title>
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

    <div class="db-container">
            <div class="db-box shadow rounded">
                <?php
                    loginbutton(); //login button
                ?>
            </div>
    </div>

<?php

}  else {

    ?>

  <?php

  include ('../../assets/components/nav.php');
  include ('../../assets/steamauth/userInfo.php'); 

?>

  <div class="px-4 py-5 text-center" id="meisterei-hero">
      <img src="/assets/images/tcMPe2F2.png" alt="Straßenmeisterei" height="100px" width="auto">
    <h1 class="display-5 fw-bold">Straßenmeisterei Neuberg</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Bewerbungsportal</p>
    </div>
    </div>

    <?php 

    $strmt = $dbconnect->prepare("SELECT * FROM applySystem WHERE steamid = ?");
    $strmt->bind_param('s', $steamprofile['steamid']);
    $strmt->execute();

    if ($strmt->num_rows < 1) {

    ?>

<div class="modal modal-signin position-static d-block py-5" tabindex="-1" role="dialog" id="modalSignin">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header p-5 pb-4 border-bottom-0">
        <!-- <h5 class="modal-title">Modal title</h5> -->
        <h2 class="fw-bold mb-0">Bewerbung absenden</h2>
      </div>
      <p><?php $steamprofile['steamid'] ?> // <?php $_SESSION['steamid'] ?> // <a href="?update">update</a></p>
      <div class="modal-body p-5 pt-0">
        <form name="form" method="post" action="">
        <input type="hidden" name="new" value="1" />
        <input type="hidden" name="steamid2" value="<?php $steamprofile['steamid'] ?>" />
          <div class="form-floating mb-3">
            <input id="floatingInput" class="form-control rounded-3" type="text" name="name" placeholder="TheLegend27" required>
            <label for="floatingInput">Vor- und Zuname</label>
          </div>
          <div class="form-floating mb-3">
            <input id="floatingInput" class="form-control rounded-3" type="text" name="age" placeholder="Paul Panzer" required>
            <label for="floatingInput">Alter</label>
          </div>
          <hr class="my-4">
          <div class="mb-3">
            <label for="floatingInput">Schriftliche Bewerbung</label>
            <textarea id="floatingInput" class="form-control rounded-3" name="applytext" placeholder="Ich bins, Tim" rows="3"></textarea>
          </div>
          <p><input class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" name="submit" type="submit" value="Bewerbung absenden" /></p>
          <small class="text-muted"><?php echo $status; ?></small>
        </form>
      </div>
    </div>
  </div>
</div>

<?php } else { ?>

    <div>hallo</div>

<?php 
}
include("../../assets/components/footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

<?php } ?>

</body>
</html>