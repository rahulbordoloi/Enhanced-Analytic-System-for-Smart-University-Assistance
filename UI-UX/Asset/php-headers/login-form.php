<?php
	$pagename= 'Login';
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
	$pwd= $roll= "";
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (empty($_POST["pwd"]))
		{
		  echo "<script>alert(`Oops. You forgot to write Password`)</script>";
		}
		else
		{
			$pwd= test_input($_POST["pwd"]);
		}
		if (empty($_POST["roll"]))
		{
		  echo "<script>alert(`Oops. You forgot to write Roll No`)</script>";
		}
		else
		{
			$roll= test_input($_POST["roll"]);
		}
		$log= array(
			'roll'	=> $roll,
			'pass'  => sha1($pwd)
		);
		$url= 'Rest URL/log';
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($log));
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		$response = curl_exec($curl);
		if ((json_decode($response) -> {"status"}) == "NO")
		{
			echo "<script>alert('Wrong Credentials')</script>";
			curl_close($curl);
			header("Location: /Asset/php-headers/login-form.php"); 	
		}
		else
		{
			session_start();
			$_SESSION["username"]= (json_decode($response) -> {"username"});
			$_SESSION["lname"]= (json_decode($response) -> {"lname"});
			$_SESSION["mail"]= (json_decode($response) -> {"mail"});
			$_SESSION["stream"]= (json_decode($response) -> {"stream"});
			$_SESSION["roll"]= (json_decode($response) -> {"roll"});
			$_SESSION["sec"]= (json_decode($response) -> {"sec"});
			$_SESSION["sem"]= (json_decode($response) -> {"sem"});
			$_SESSION["tagline"]= (json_decode($response) -> {"tagline"});
			try {
				$_SESSION['allocation']= (json_decode($response) -> {"alloc"});
			} catch (\Throwable $th) {

			}
			header("Location: /member.php"); 
		}
		
	}
	function test_input($data)
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
?>

<br><br>
<fieldset class="container-fluid field-class">
	<h1 class="reg-h1 text-center">Log-in</h1>
	<br>
	<div class="row">
	<div class="col-sm-3 beside-reg">
	<img src="/Asset/Image/reg-icon.jpg" alt="Log-Icon" height="200px">
	</div>
	<div class="col-sm-9">
		<br>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		<div class="row">
			<div class="form-group col-md-6">
		      <input type="text" name="roll" class="form-control" id="Roll" placeholder="Roll Number" maxlength="7" value="<?php echo $roll;?>">
		    </div>
		</div>
		<div class="row">
			<div class="form-group col-md-6">
		     <input type="password" name="pwd" class="form-control" id="Password" placeholder="Password" value="<?php echo $pwd;?>">
		    </div>
		 </div>
		<div class="row"> 
		<div class="col-md-6" style="padding-top: 10px;">
			<button type="submit" class="btn btn-warning btn-block"><b>Log in</b></button>
		</div>
		<div class="col-md-6" style="padding-top: 10px;">
			<a href="<?php echo '/Asset/php-headers/register-form.php'?>">
			<button type="button" class="btn btn-warning btn-block"><b>Register Here</b></button>
			</a>
		</div>
		</div>
	</form>
	</div>
	</div>
</fieldset>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/footer.php" ?>
</body>
</html>