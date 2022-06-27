<?php

include("../../assets/components/fb37dbconnect.php");

$reguserdb=mysqli_connect($hostname,$username,$password,$dbname);

if ($reguserdb->connect_error) {
	die("Fehler, Verbindung fehlgeschlagen:" . $reguserdb->connect_error);
}


$currentUserSteamID = $steamprofile['steamid'];
$reguserquery1 = mysqli_query($reguserdb,"SELECT * FROM panelUsers WHERE `steamid` = '".$currentUserSteamID."'");
$regusernum = mysqli_num_rows($reguserquery1);
$regusernameres = mysqli_fetch_array($reguserquery1);

if(isset($_POST['newu']) && $_POST['newu']==1){
    $uid=$_REQUEST['id'];
    $urpname =$_REQUEST['rpname'];
    mysqli_query($reguserdb,"UPDATE panelUsers SET rpname='".$urpname."' WHERE id='".$uid."'")
    or die(mysql_error());
    header("Refresh:0");
    header("Refresh:0");
}

if ($regusernum != 1) {
        $reguserdatetime = date("Y-m-d H:i:s");
        mysqli_query($reguserdb,"INSERT INTO panelUsers (`steamid`, `regAt` , `permLevel`) VALUES ('".$currentUserSteamID."', '".$reguserdatetime."', 0)");
        header("Refresh:0");
    } else {
        if($regusernameres['rpname'] == NULL) { 
            ?>
            <!-- Modal -->
            <div class="modal fade show" id="staticBackdropLive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" style="display: block; background-color: rgb(0 0 0 / .35);" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLiveLabel">RP Namen festlegen</h5>
                        </div>
                        <div class="modal-body">
                            <form name="form" method="post" action="">
                                <input type="hidden" name="newu" value="1" />
                                <input name="id" type="hidden" value="<?php echo $regusernameres['id'];?>" />
                                <div class="form-floating mb-3">
                                    <input id="floatingInput" class="form-control rounded-3" type="text" name="rpname" placeholder="TheLegend27" required>
                                    <label for="floatingInput">Vor- und Zuname</label>
                                </div>
                                <p><input class="mb-2 btn btn-lg rounded-3 btn-primary" name="submit" type="submit" value="Speichern" /></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }

        $uPermLevel = $regusernameres['permLevel'];
        $uUsedName = $regusernameres['rpname'];
        $uPanelID = $regusernameres['id'];
        
        if ($uPermLevel >= 4) {
            $urnkBadge = "<span class='badge text-bg-danger'>Admin</span>";
        } elseif ($uPermLevel == 3) {
            $urnkBadge = "<span class='badge text-bg-warning'>Verwaltung</span>";
        } elseif ($uPermLevel == 2) {
            $urnkBadge = "<span class='badge text-bg-info'>Personaler</span>";
        } elseif ($uPermLevel == 1) {
            $urnkBadge = "<span class='badge text-bg-success'>Ausbilder</span>";
        } else {
            $urnkBadge = "<span class='badge text-bg-secondary'>Gast</span>";
        }
    }

?>