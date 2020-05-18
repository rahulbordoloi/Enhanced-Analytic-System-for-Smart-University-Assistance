<head>
	<title>BeFriend | Admin Console</title>
	<link rel="shortcut icon" href="/Asset/Image/favicon.ico" type="image/x-icon">
  	<link rel="icon" href="/Asset/Image/favicon.ico" type="image/x-icon">
  	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
		session_start();
		session_destroy();
		session_unset();
		$a= array('46003015MDQ6VXNlcjQ2MDAzMDE1');
		foreach ($a as $val) 
		{
			if($_REQUEST['v']!=$val)
			{
				echo "<script>Swal.fire({title: 'Weekend was right', html:'You are a false alarm', icon:'error', onClose:()=>{window.location.href='/';}});</script>";
			}
		}
?>
<section>
<?php
		$str = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Asset/notice.json');
		$json = json_decode($str, true);
		if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['form']))
		{
			$log= array('school' => $_POST['school'], 'from' => $_POST['from'], 'notice' => $_POST['notice']);
			if ($json!=null) 
			{
				array_push($json, $log);
			}
			else
			{
				$json= array($log);
			}
			if (count($json)>10) 
			{
				array_shift($json);
			}
			$str= json_encode($json);
			$myfile = fopen($_SERVER['DOCUMENT_ROOT'].'/Asset/notice.json', "w") or die("Unable to open file!");
			fwrite($myfile, $str);
			fclose($myfile);
			header("Location: admin.php?v=".$_REQUEST['v']);
		}
?>
<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="#">
    <img src="/Asset/Image/logo.png" width="50" height="50" alt="">
    Admin Console <b>Befriend</b>
  </a>
</nav>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-5">
		<br>
		<span class="text-center"><h1><b>Update Notice</b></h1></span>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<div class="form-group">
			    <label>School or Society Name</label>
			    <input type="text" class="form-control" placeholder="School Name" name="school">
			</div>
			<div class="form-group">
			    <label>From</label>
			    <input type="text" class="form-control" placeholder="From" name="from">
			</div>
			<div class="form-group">
		    	<label>Notice</label>
		    	<textarea class="form-control" name="notice" rows="3"></textarea>
		  	</div>
		  	<button type="submit" class="btn btn-block btn-outline-dark">Put Notice</button>
		</form>
	</div>
	<div class="col-sm-5">
		<br>
		<span class="text-center"><h1><b>Add New Room or Vacant Room</b></h1></span>
		<form action="" method="POST">
			<div class="form-group">
			    <label>Hostel</label>
			    <input type="text" class="form-control" placeholder="Hostel Name">
			</div>
			<div class="form-group">
			    <label>Room Number</label>
			    <input type="text" class="form-control" placeholder="Room">
			</div>
		  	<button type="submit" class="btn btn-block btn-outline-dark">Update</button>
		</form>
	</div>
	
</div>
</section>
<br><br>
<div class="row">
	<div class="col-sm-3"></div>
	<div class="col-sm-6"><button class="btn btn-outline-danger btn-block" style="float: right;" onclick="window.location.href='/';">Logout</button></div>
	<div class="col-sm-3"></div>
</div>
</body>