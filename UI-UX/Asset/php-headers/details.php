<?php
	$pagename= "Student Details";
	$roll='';
	$username= '';
	$section_id= '';
	session_start();
    if(!isset($_SESSION['roll']))
    {
      session_destroy();
    }
    else
    {
    	$roll= $_SESSION['roll'];
    	$username= $_SESSION["username"];
	}
	$main="Member";
?>

<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/modules.php" ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/navigation.php" ?>
<br>
<?php
	$inp_roll= $_GET['inp-roll'];
?>
<style type="text/css">
	.bd-callout
	{
	    padding: 1.25rem;
	    margin: 50px 50px 0px 50px;
		background-color: #fff;
	    /*margin-bottom: 1.25rem;*/
	    border: 1px solid #eee;
	    border-left-width: .25rem;
    	/*border-left-color: #5bc0de;*/
    	border-left-color: #fec107;
	    border-radius: .25rem;
	}
	.card-img-top
	{
		margin: 10px 10px 10px 10px;
	}
	.detailed-card
	{
		margin: 50px 0px 0px 0px;
	}
	a
	{
		text-decoration: none;
		color: #000;
	}
</style>
<body>
<?php
	$url = 'Rest URL/data/'.$inp_roll;
	$cURLConnectionT= curl_init();
	curl_setopt($cURLConnectionT, CURLOPT_URL, $url);
	curl_setopt($cURLConnectionT, CURLOPT_RETURNTRANSFER, true);
	$detail= curl_exec($cURLConnectionT);
	$info = curl_getinfo($cURLConnectionT, CURLINFO_HTTP_CODE);
	curl_close($cURLConnectionT);
	$file_name= $inp_roll.'.jpg';
	$res= json_decode($detail);
	echo "<script>console.log(".$info.")</script>";
?>
<?php
	$url = 'http://api.ipstack.com/check?access_key=2036292166e7e11e4048808f150a974f';
	$cURLConnectionT= curl_init();
	curl_setopt($cURLConnectionT, CURLOPT_URL, $url);
	curl_setopt($cURLConnectionT, CURLOPT_RETURNTRANSFER, true);
	$taskSend= curl_exec($cURLConnectionT);
	curl_close($cURLConnectionT);

	$ip= json_decode($taskSend) -> {"ip"};
	$city= json_decode($taskSend) -> {"city"};
	$country= json_decode($taskSend) -> {"country_name"};
	$region= json_decode($taskSend) -> {"region_name"};
	$flag= json_decode($taskSend) -> {"location"} -> {"country_flag"};
	$FingerPrint= json_decode($taskSend) -> {"location"} -> {"geoname_id"};
?>
<!-- https://api.ipify.org/?format=json -->

<section class="">
	<h2 style="font-family: 'Simonetta', sans-serif; font-weight: bolder;">
		Your Friend
	</h2>
	<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-5">
	<?php
		if ($info != 404) 
		{
	?>
		<div class="card detailed-card" style="width: inherit; height: inherit;">
		  <img class="card-img-top" src="https://befriendminor.s3.us-east-2.amazonaws.com/Display/<?php echo $file_name; ?>" alt="Card image cap">
		  <div class="card-body">
		    <h5 class="card-title"><b><?php echo ($res -> {"fname"})." ".($res -> {"lname"}) ?></b></h5>
		    <p class="card-text">
		    	<b><em><?php echo ($res -> {"tagline"}); ?></em><br></b>
		    	Currently pursuing <b>B. Tech</b> from <b>KIIT-DU</b> in <b><?php echo ($res -> {"stream"}); ?></b>. Studies in <b><?php echo ($res -> {"stream"})."-".($res -> {"sec"}); ?></b>.<br><br>
		    	<b class="text-primary">E-Mail: </b>
		    	<a href="mailto:<?php echo ($res -> {"email"}); ?>"><?php echo ($res -> {"email"}); ?></a>
		    </p>
		  </div>
		</div>
	<?php
		}
		else
		{
	?>
	
			<picture class="detailed-card">
				<img src="Asset/Image/404.jpg">
			</picture>

	<?php		
		}
	?>
	</div>
	<div class="col-sm-4">
		<?php
			if ($roll!='') 
				$b_class="text-success";
			else
				$b_class="text-danger"
		?>
		<div class="bd-callout">
		<h6>You are accessing from <b class="<?php echo $b_class; ?>"><?php echo $ip; ?></b></h6>
		<h6><b class=""><?php echo $city.' '.$region.' '.$country; ?></b>
		<span style="float: right;">
			<img src="<?php echo $flag; ?>" height="30px" width="35px">
		</span></h6>
		<h6><b class="">FingerPrint: </b><?php echo $FingerPrint; ?></h6>

		</div>
		<div class="bd-callout">
		<h6>Roll No: <b class="text-dark"><?php echo $roll; ?></b></h6>
		<h6>Name: <b class="text-dark"><?php echo $username; ?></b></h6>
		</div>
	</div>
	</div>
</section>
<br>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/footer.php" ?>
</html>