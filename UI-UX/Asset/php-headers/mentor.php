<?php
	$pagename= "Virtual Mentor";
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
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/modules.php" ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/navigation.php" ?>
<br><br>
<audio src="/Asset/Audio/welcome.wav" id="my_audio" autoplay="autoplay"></audio>
<audio src="/Asset/Audio/nice.wav" id="nice"></audio>
<audio src="/Asset/Audio/bye.wav" id="bye"></audio>
<script type="text/javascript">
  window.onload=function(){
    document.getElementById("my_audio").play();
  }
</script>
<section class="row">
  <script type="text/javascript">
    var fingerprint= '';
    function generate() 
    {
      fingerprint= '<?php echo uniqid(); ?>';
      document.getElementById("fp").innerHTML = fingerprint;
      document.getElementById("nice").play();
    }
  </script>
  <div class="col-sm-4">
    <button type="button" class="btn btn-block btn-outline-info" onclick="generate();">
      Generate Fingerprint
    </button>
    <br><br>
    <textarea class="text-center" id="fp" disabled style="width: 100%; font-weight: bolder; font-size: 24px;">
      
    </textarea>
    <small>
      Without fingerprint, you can not place any request.
    </small>
  </div>
  <div class="col-sm-4">
    <button type="button" class="btn btn-block btn-outline-info" onclick="window.location.href='bonafide.php'">
      Request for Bona-fide
    </button>
    <br><br>
    <button type="button" class="btn btn-block btn-outline-info">
      Register for lost ID
    </button>
    <br><br>
    <button type="button" class="btn btn-block btn-outline-info">
      RTGS Raw Form
    </button>
  </div>
  <div class="col-sm-4">
    <a href="http://mail.google.com/mail/?view=cm&fs=1&tf=1&to=mentor@kiit.ac.in&su=">
      <button type="button" class="btn btn-block btn-outline-info">Mail Mentor</button>
    </a>
    <br><br>
    <form>
      <textarea style="width: 100%; height: 150px;">
        
      </textarea>
      <button type="button" class="btn btn-block btn-outline-info" onclick="collectreq();">Submit Other Queries</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript">
      function collectreq() {
        if(fingerprint != '')
        {
          Swal.fire(
            'Good job!',
            'We have taken the query in account <br> QID: '+fingerprint,
            'success'
          );
          document.getElementById("bye").play();
          window.location.href="/Asset/../member.php";
        }
      }
    </script>
  </div>
</section>

<br><br>
  <?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/footer.php" ?>