<?php
	session_start();
	$pagename= 'Image Upload';
	$section_id= '';
	$main="Member";
?>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/modules.php" ?>
<body>
<style type="text/css">
	fieldset.field-class
	{
		padding-left: 15%;
		padding-right: 15%;
		margin-top: 3%;
	}
	.reg-h1
	{
		font-family: 'Simonetta', Sans-serif;
		font-weight: bolder;
		background-color: #ffc107;
		border-radius: 35px;
		padding-bottom: 5px;
		padding-top: 7px;
		padding-bottom: 7px;
	}
</style>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/navigation.php" ?>

<?php
	use Aws\S3\Exception\S3Exception;
	use Aws\S3\S3Client;
	require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

	$config= ['s3' => [
		'key' => 'No Access',
		'secret' => 'No Access',
		'bucket' => 'No Access'
		]
	];

	$s3= S3Client::factory(array(
		'version' => 'latest',
		'region'  => 'us-east-2',
		'credentials' => array(
		'key' => $config['s3']['key'],
		'secret'  => $config['s3']['secret']
		)
	));


	if(isset($_FILES['image']))
	{
		$name= $_FILES['image']['name'];
		$file_tmp= $_FILES['image']['tmp_name'];
		$file_ext= strtolower(end(explode('.',$_FILES['image']['name'])));


		$extensions= array("jpg");

		if(in_array($file_ext,$extensions)=== false){
			echo "<script>extension not allowed, please choose a JPG file.</script>";
			header("Location: /Asset/php-headers/image-up.php");
		}

		$key= md5(uniqid());
		$tmp_file_name= "{$_SESSION['roll']}.{$file_ext}";
		$tmp_file_path= $_SERVER['DOCUMENT_ROOT']."/{$tmp_file_name}";

		move_uploaded_file($file_tmp, $tmp_file_path);

		try {
			
			$s3->putObject([
				'Bucket' => $config['s3']['bucket'],
				'Key' => "Display/{$tmp_file_name}",
				'Body' => fopen($tmp_file_path, 'rb'),
				'ACl' => 'public-read'
			]);


		} catch (S3Exception $e) {
			die("There was an error Uploading the File ".$name);
		}

		unlink($tmp_file_path);
		header("Location: /Asset/php-headers/login-form.php");
	}
?>
<fieldset class="container-fluid field-class">
	<h1 class="reg-h1 text-center">Upload Your Image</h1>
	<br>
	<div class="row">
	<div class="col-4"></div>
	<div class="col-4">
	<form style="background-color: #fff; padding: 20px 20px 20px 20px; border-radius: 25px;" action="" method="POST" enctype="multipart/form-data">
	  <div class="form-group">
	    <label for="fileToUpload"><?php echo $_SESSION['roll']?> Your Picture</label>
	    <input type="file" class="form-control-file" name="image" id="image">
	  </div>
	  <button type="submit" class="btn btn-warning btn-block"><b>Upload</b></button>
	</form>
	</div>
	<div class="col-4"></div>
	</div>
</fieldset>
</body>
</html>