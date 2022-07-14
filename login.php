<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login &middot; Straßenmeisterei Neuberg</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/own.css">
    <link rel="stylesheet" href="/assets/css/fb37.css">
    <link rel="icon" type="image/ico" href="/assets/images/favicon-fb37.ico">
</head>
<body>
    <?php

require '/assets/steamauth/steamauth.php';

?>

<?php
if(!isset($_SESSION['steamid'])) {

    loginbutton(); //login button

}  else {

    include ('/assets/steamauth/userInfo.php'); //To access the $steamprofile array
    //Protected content

    logoutbutton(); //Logout Button
}     
?>
</body>
</html>