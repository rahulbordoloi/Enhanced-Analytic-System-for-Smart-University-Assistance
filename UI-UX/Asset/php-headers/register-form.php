<?php
	$pagename= 'Register';
	$section_id= '';
	$main="Member";  
?>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/modules.php" ?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	
</style>
</head>
<body>

<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/navigation.php" ?>
<script type="text/javascript">
	document.getElementById('query-cust').style.marginTop= "10px";
</script>
<?php
	$fname= $lname= $mail= $pwd= $pdw_c= $sec= $stream= $roll= $sem= "";
	$tagline= "";
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (strcmp($_POST['pwd_c'], $_POST['pwd'])!=0)
		{
		  echo "<script>alert(`Oops. Password Mismatch`)</script>";			
		}

		if (empty($_POST["fname"])) 
		{
		  echo "<script>alert(`Oops. You forgot to write First Name`)</script>";
		}
		else
		{
			$fname= test_input($_POST["fname"]);
		}
		if (empty($_POST["lname"])) 
		{
		  echo "<script>alert(`Oops. You forgot to write Last Name`)</script>";
		}
		else
		{
			$lname= test_input($_POST["lname"]);
		}
		if (empty($_POST["mail"])) 
		{
		  echo "<script>alert(`Oops. You forgot to write E-mail`)</script>";
		  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		  {
		    echo "<script>alert(`Oops. Wrong E-mail Format`)</script>";
		  }
		}
		else
		{
			$mail= test_input($_POST["mail"]);
		}
		if (empty($_POST["pwd"]))
		{
		  echo "<script>alert(`Oops. You forgot to write Password`)</script>";
		}
		else
		{
			$pwd= test_input($_POST["pwd"]);
		}
		if (empty($_POST["pwd_c"]))
		{
		  echo "<script>alert(`Oops. You forgot to write Password Again`)</script>";
		}
		else
		{
			$pwd_c= test_input($_POST["pwd_c"]);
		}
		if (empty($_POST["stream"]))
		{
		  echo "<script>alert(`Oops. You forgot to write Stream`)</script>";
		}
		else
		{
			$stream= test_input($_POST["stream"]);
		}
		if (empty($_POST["sec"]))
		{
		  echo "<script>alert(`Oops. You forgot to write Section`)</script>";
		}
		else
		{
			$sec= test_input($_POST["sec"]);
		}
		if (empty($_POST["roll"]))
		{
		  echo "<script>alert(`Oops. You forgot to write Roll No`)</script>";
		}
		else
		{
			$roll= test_input($_POST["roll"]);
		}
		if (empty($_POST["sem"]))
		{
		  echo "<script>alert(`Oops. You forgot to write Semester`)</script>";
		}
		else
		{
			$sem= test_input($_POST["sem"]);
		}
		$tagline= $_POST['tagline'];
		$reg= array(
			'fname' => $fname,
			'lname' => $lname,
			'email' => $mail,
			'pass'  => sha1($pwd),
			'sec' 	=> $sec,
			'stream' => $stream,
			'roll'	=> $roll,
			'sem'	=> $sem,
			'tagline' => $tagline
		);
		$url= 'Rest URL/reg';
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($reg));
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		$response = curl_exec($curl);
		curl_close($curl);
		session_start();
		$_SESSION['roll']= $roll;
		
		header("Location: image-up.php"); 
		exit;
	}
	function test_input($data)
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
?>

<br>
<fieldset class="container-fluid field-class">
	<h1 class="reg-h1 text-center">Register Yourself</h1>
	<br>
	<div class="row">
	<div class="col-sm-3 beside-reg">
	<img src="/Asset/Image/reg-icon.jpg" alt="Reg-Icon" height="200px">
	</div>
	<div class="col-sm-8">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		<div class="row">
		  <div class="col">
		    <input type="text" name="fname" class="form-control" id="fname" placeholder="First name" value="<?php echo $fname;?>">
		  </div>
		  <div class="col">
		    <input type="text" name="lname" class="form-control" id="lname" placeholder="Last name"value="<?php echo $lname;?>">
		  </div>
		</div>
		<br>
		<div class="row">
			<div class="form-group col-12">
		      <input type="email" name="mail" class="form-control" id="Email" placeholder="Email" value="<?php echo $mail;?>">
		    </div>
		</div>
		<div class="row">
			<div class="form-group col-md-6">
		     <input type="password" name="pwd" class="form-control" id="Password" placeholder="Password" value="<?php echo $pwd;?>">
		    </div>
		    <div class="form-group col-md-6">
		     <input type="password" name="pwd_c" class="form-control" id="Password_c" placeholder="Confirm Password" value="<?php echo $pdw_c;?>">
		    </div>
		</div>
		<div class="row">
			<div class="form-group col-md-4">
		     <select id="inputState" name="stream" class="form-control" value="<?php echo $stream;?>">
		       <option selected>Stream</option>
		       <option>CSE</option>
		       <option>CSCE</option>
		       <option>CSSE</option>
		       <option>IT</option>
		       <option>Mech</option>
		       <option>Civil</option>
		       <option>ECS</option>
		       <option>ETC</option>
		     </select>
		    </div>
		    <div class="form-group col-md-2">
		     <input type="text" name="sec" class="form-control" id="Section" placeholder="Num" maxlength="1" value="<?php echo $sec;?>">
		    </div>
		    <div class="form-group col-md-3">
		     <input type="text" name="roll" class="form-control" id="Roll" placeholder="Roll Number" maxlength="7" value="<?php echo $roll;?>">
		    </div>
		    <div class="form-group col-md-3">
		     <input type="text" name="sem" class="form-control" id="Sem" placeholder="Semester" maxlength="1" value="<?php echo $sem;?>">
		    </div>
		</div>
		<div class="row">
			<div class="form-group col-12">
		      <input type="text" name="tagline" class="form-control" id="tagline" placeholder="Tagline" value="<?php echo $tagline;?>">
		    </div>
		</div>
		<button type="submit" class="btn all-btn btn-block"><b>Sign in</b></button>
	</form>
	</div>
	<div class="col-sm-1 log-button text-center">
		<a href="<?php echo '/Asset/php-headers/login-form.php'?>">
			<br><h3 style="font-weight: bolder;"><br>L<br>O<br>G<br>I<br>N</h3>
		</a>
	</div>
	</div>
</fieldset>
<br><br>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/footer.php" ?>

</html>