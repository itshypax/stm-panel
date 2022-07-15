<?php
$arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg', 'application/pdf'];
  
if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
    echo "false";
    return;
}
  
if (!file_exists('fileupload')) {
    mkdir('fileupload', 0777);
}
  
$filename = $_FILES['file']['name'];
  
move_uploaded_file($_FILES['file']['tmp_name'], 'fileupload/'.$filename);
  
echo 'fileupload/'.$filename;
sleep(2);
header("Location: https://strassenmeisterei-neuberg.de/fileupload/$filename"); 
die;