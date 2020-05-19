<?php
  $pagename= 'Notice';
  $main="Member";
  $section_id= '';
  session_start();
  if(!isset($_SESSION['username']))
  {
    session_destroy();
    $tasknum=0;
  }
?>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/modules.php" ?>

<body>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/navigation.php" ?>
<br><br>
<section class="row">
	<div class="col-sm-7">
		<span class="text-center"><h3 style="font-family: 'Simonetta',sans-serif;"><b>Notice Board</b></h3></span>
	<?php
		$str = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Asset/notice.json');
		$json = json_decode($str, true);
	?>
		<div class="card-columns">
		<?php
			foreach ($json as $value) 
			{
		?>
			<div class="card p-3 text-right">
			  <blockquote class="blockquote mb-0">
			    <p><?php echo $value['notice'];?></p>
			    <footer class="blockquote-footer">
			      <small class="text-muted">
			        <?php echo $value['from'];?> <cite title="Source Title"><?php echo $value['school'];?></cite>
			      </small>
			    </footer>
			  </blockquote>
			</div>
		<?php
			}
		?>
		</div>
	</div>
	<div class="col-sm-4" style="overflow-y: scroll; max-height: 600px;">
		<span class="text-center"><h3 style="font-family: 'Simonetta',sans-serif;"><b>List of Socities</b></h3></span>
		<div class="card" style="width: inherit; float: right;">
			  <div class="card-body">
			    <h5 class="card-title"><b>KIIT E-Cell</b></h5>
			    <p class="card-text">The entrepreneurship cell of KIIT directly managed by School of Management</p>
			    <a href="#" class="btn btn-primary">Join Now</a>
			  </div>
		</div>
		<div class="card" style="width: inherit; float: right; margin-top: 10px;">
			  <div class="card-body">
			    <h5 class="card-title"><b>KIIT ACM</b></h5>
			    <p class="card-text">Association for Computing Machinery KIIT Students' Chapter</p>
			    <a href="#" class="btn btn-primary">Join Now</a>
			  </div>
		</div>
		<div class="card" style="width: inherit; float: right; margin-top: 10px;">
			  <div class="card-body">
			    <h5 class="card-title"><b>KAWS</b></h5>
			    <p class="card-text">Animal and Nature Society of KIIT Managed by School of Civil Engineering</p>
			    <a href="#" class="btn btn-primary">Join Now</a>
			  </div>
		</div>
	</div>
	<div class="col-sm-1"></div>
</section>
<br><br>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/footer.php" ?>