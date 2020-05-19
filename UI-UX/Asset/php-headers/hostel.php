<?php
	$pagename= "Hostel";
	$roll='';
    $username= '';
    $section_id= '';
	session_start();
    if(!isset($_SESSION['roll']))
    {
      session_destroy();
      header("Location: /Asset/php-headers/login-form.php");
    }
    else
    {
    	$roll= $_SESSION['roll'];
    	$username= $_SESSION["username"];
	}
	$main="Member";
?>
<?php
    if(isset($_SESSION['allocation']))
    {
        $status= "<b>".$_SESSION['allocation']."</b>";
        $dis='disabled';
    }
    else
    {
        $status= '';
        $dis= '';
    }
    
?>

<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/modules.php" ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/navigation.php" ?>


<?php
    $roll= $_SESSION['roll'];
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['form']))
        {
            switch ($_POST['form']) 
            {
                case "A":
                    echo "<script>console.log('submitted A');</script>";
                    break;
        
                case "B":
                    echo "<script>console.log('submitted B');</script>";
                    $_SESSION['food']= $_POST['food'];
                    $url= 'Rest URL/hostel/find/'
                    .$_SESSION['roll'].','.$_POST['hostel'].','.$_POST['side'];
                    $cURL= curl_init();
                    curl_setopt($cURL, CURLOPT_URL, $url);
                    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
                    $res= curl_exec($cURL);
                    curl_close($cURL);
                    if ((json_decode($res) -> {"status"})== 'Y') 
                    {
                        $_SESSION['allocation']= 'KP-'.$_POST['hostel']." ".(json_decode($res) -> {"room"}).
                        "-".(json_decode($res) -> {"bed"});

                    }
                    header("Refresh:0");
                    break;
        
                default:
                    echo "What are you doing?";
            } 
        }
    }
?>





<br>
<section class="hostel">
    <h2 class="hostel-top-h2">Choose Your Hostel</h2><br>
    <div class="row">
        <div class="col-sm-8">
        <form class="room-allocation">
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-6 col-form-label"><b style="float: right;">Email</b></label>
                <div class="col-sm-6">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo $_SESSION['mail'] ?>" style="background-color: transparent;">
                </div>
            </div>
            <div class="form-group row">
                <label for="staticRoll" class="col-sm-6 col-form-label"><b style="float: right;">Roll No</b></label>
                <div class="col-sm-6">
                <input type="text" readonly class="form-control-plaintext" id="staticRoll" value="<?php echo $_SESSION['roll'] ?>" style="background-color: transparent;">
                </div>
            </div>
        </form>
        </div>
        <div class="col-sm-4">
            <fieldset class="sidefield">
                <h3 style="color: tomato;">&emsp;Status</h3>
                <p>
                    <?php echo $status; ?>
                </p>
                &emsp;
                <a href="printonce.php" target="_blank">
                    <button type="button" class="btn btn-outline-danger">Collect Profile</button>
                </a>
                <br>&emsp;
            </fieldset>
        </div>
    </div>
    <br><br>
    <div class="user-room row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8 text-center">
        <h2 class="form-top">Choose using Room Number</h2>
        <br>
            <form name="a" class="form-inline row h-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <div class="col-sm-2">
            <select class="custom-select" id="inlineFormCustomSelect" name="hostel">
                <option selected>Choose Hostel&emsp;&emsp;</option>
                <option value="6">KP-6</option>
                <option value="7">KP-7</option>
            </select>
        </div>
            <div class="input-group col-sm-3">
                <div class="input-group-prepend">
                <div class="input-group-text">
                    <img src="/Asset/Image/room-black-24dp.svg" alt="">
                </div>
                </div>
                <input type="text" name="room" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Room No">
            </div>
         
        <div class="col-sm-2">
            <select class="custom-select" id="inlineFormCustomSelect" name="side">
                <option selected>Choose Side&emsp;&emsp;</option>
                <option value="any">Any</option>
                <option value="w">Window</option>
                <option value="a">Aisle</option>
                <option value="m">Middle</option>
            </select>
        </div>
        <div class="col-sm-2">
            <select class="custom-select" id="inlineFormCustomSelect" name="food">
                <option selected>Food Preference&emsp;&emsp;</option>
                <option value="veg">Veg</option>
                <option value="non-veg">Non-Veg</option>
            </select>
        </div>
            <input type="hidden" name="form" value="A">
            <div class="col-sm-3" style="float: right;">
                <button type="submit" class="btn btn-outline-danger btn-block" <?php echo $dis; ?>>Submit</button>
            </div>
        </form>
    </div>
    <div class="col-sm-2"></div>
    </div>
    <div class="text-below text-center">
        <p>
            <br>
            Random Rooms will not be allocated if preffered room is not available.
            <br>
            Please go through the option below if you don't have any preference.
        </p>
    </div>
    <br><br>

    <div class="user-room row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8 text-center">
        <h2 class="form-top">Choose Random Room</h2>
        <br>
        <form name="b" class="form-inline row h-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <div class="col-sm-2">
            <select class="custom-select" id="inlineFormCustomSelect" name="room">
                <option selected>Room Type&emsp;</option>
                <option value="Double-AC">Double Sharing AC</option>
                <option value="Triple-AC">Triple Sharing AC</option>
                <option value="Double-NAC">Double Sharing Non AC</option>
                <option value="Triple-NAC">Triple Sharing Non AC</option>
            </select>
        </div>
        <div class="col-sm-3">
            <select class="custom-select" id="inlineFormCustomSelect" name="hostel">
                <option selected>&emsp;Choose Specific Hostel&emsp;</option>
                <option value="6">KP-6</option>
                <option value="7">KP-7</option>
            </select>
        </div>
         
        <div class="col-sm-2">
            <select class="custom-select" id="inlineFormCustomSelect" name="side">
                <option selected>&emsp;Choose Side&emsp;&ensp;</option>
                <option value="any">Any</option>
                <option value="w">Window</option>
                <option value="a">Aisle</option>
                <option value="m">Middle</option>
            </select>
        </div>
        <div class="col-sm-2">
            <select class="custom-select" id="inlineFormCustomSelect" name="food">
                <option selected>Food Preference&emsp;&emsp;</option>
                <option value="veg">Veg</option>
                <option value="nnon-veg">Non-Veg</option>
            </select>
        </div>
            <input type="hidden" name="form" value="B">
            <div class="col-sm-3" style="float: right;"><button type="submit" class="btn btn-outline-danger btn-block" <?php echo $dis; ?>>Submit</button></div>
        </form>
    </div>
    <div class="col-sm-2"></div>
    </div>
</section>
<br><br>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/footer.php" ?>