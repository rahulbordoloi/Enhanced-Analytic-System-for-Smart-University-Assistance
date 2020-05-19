<?php
	$pagename= "Expert";
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
      $_SESSION['gpa']= array(9.23,9.04,9.15,9.11,7.09,8.86);
	}
	$main="Member";
?>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/modules.php" ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/navigation.php" ?>
<br><br>

<?php
  $min_sal=0;
  $max_sal=0;
  if ($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $_SESSION['gpa']= array(floatval($_POST['s1']), floatval($_POST['s2']), floatval($_POST['s3']), 
    floatval($_POST['s4']), floatval($_POST['s5']), floatval($_POST['s6']));
    $_SESSION['desg_u']= array(1,1,1,1,1);
    $_SESSION['desg_v']= array('q','w','e','r','t');
    $pred= array(
      '10' => $_POST['10'],
      '12' => $_POST['12'],
      'sp' => $_POST['sp'],
      'gpa' => array_sum($_SESSION['gpa'])/6,
      'eng' => $_POST['eng'],
      'logical' => $_POST['logical'],
      'quant' => $_POST['quant'],
      'domain'=> $_POST['domain'],
      'prog'=> $_POST['prog'],
      'conscientiousness' => floatval($_POST['conscientiousness'])/100,
      'agreeableness' => floatval($_POST['agreeableness'])/100,
      'extraversion' => floatval($_POST['extraversion'])/100,
      'nueroticism'=> floatval($_POST['nueroticism'])/100,
      'openess_to_experience' => floatval($_POST['openess_to_experience'])/100
    );
    $url= 'Rest URL/pred/career';
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($pred));
		curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $response = curl_exec($curl);
    try
    {
      $_SESSION['desg_u']=(json_decode($response) -> {"Designation"} -> {'Res'});
      $_SESSION['desg_v']=(json_decode($response) -> {"Designation"} -> {'R_Set'});
      $max_sal= (json_decode($response) -> {"Salary"} -> {'R_Set'})[0];
      $min_sal= (json_decode($response) -> {"Salary"} -> {'R_Set'})[4];
    }
    catch(Exception $e)
    {
      
    }
    curl_close($curl);
  }

?>


<section class="dataip">
  <div class="row">
  <div class="col-sm-1"></div>
  <div class="col-sm-5">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
      <div class="form-row">
        <div class="col">
          <label>10<sup>th</sup> Board</label>
          <input name="10" type="text" class="form-control" placeholder="10th Board Marks">
        </div>
        <div class="col">
          <label>12<sup>th</sup> Board</label>
          <input name="12" type="text" class="form-control" placeholder="12th Board Marks">
        </div>
      </div>
      <br>
      <div class="form-group">
        <label>Specialization</label>
        <select name="sp" id="" class="form-control">
          <option value='0'>Aeronautical Engineering</option><option value='1'>Applied Electronics And Instrumentation</option><option value='2'>Automobile/Automotive Engineering</option><option value='3'>Biomedical Engineering</option><option value='4'>Biotechnology</option><option value='5'>Ceramic Engineering</option><option value='6'>Chemical Engineering</option><option value='7'>Civil Engineering</option><option value='8'>Computer And Communication Engineering</option><option value='9'>Computer Application</option><option value='10'>Computer Engineering</option><option value='11'>Computer Networking</option><option value='12'>Computer Science</option><option value='13'>Computer Science & Engineering</option><option value='14'>Computer Science And Technology</option><option value='15'>Control And Instrumentation Engineering</option><option value='16'>Electrical And Power Engineering</option><option value='17'>Electrical Engineering</option><option value='18'>Electronics</option><option value='19'>Electronics & Instrumentation Eng</option><option value='20'>Electronics & Telecommunications</option><option value='21'>Electronics And Communication Engineering</option><option value='22'>Electronics And Computer Engineering</option><option value='23'>Electronics And Electrical Engineering</option><option value='24'>Electronics And Instrumentation Engineering</option><option value='25'>Electronics Engineering</option><option value='26'>Embedded Systems Technology</option><option value='27'>Industrial & Management Engineering</option><option value='28'>Industrial & Production Engineering</option><option value='29'>Industrial Engineering</option><option value='30'>Information & Communication Technology</option><option value='31'>Information Science</option><option value='32'>Information Science Engineering</option><option value='33'>Information Technology</option><option value='34'>Instrumentation And Control Engineering</option><option value='35'>Instrumentation Engineering</option><option value='36'>Internal Combustion Engine</option><option value='37'>Mechanical & Production Engineering</option><option value='38'>Mechanical And Automation</option><option value='39'>Mechanical Engineering</option><option value='40'>Mechatronics</option><option value='41'>Metallurgical Engineering</option><option value='42'>Other</option><option value='43'>Polymer Technology</option><option value='44'>Power Systems And Automation</option><option value='45'>Telecommunication Engineering</option>
        </select>
      </div>
      <br>
      <div class="form-row">
        <div class="col"><label>SGPA</label><input name="s1" type="text" class="form-control" placeholder="1st Sem"></div>
        <div class="col"><label>SGPA</label><input name="s2" type="text" class="form-control" placeholder="2nd Sem"></div>
        <div class="col"><label>SGPA</label><input name="s3" type="text" class="form-control" placeholder="3rd Sem"></div>
        <div class="col"><label>SGPA</label><input name="s4" type="text" class="form-control" placeholder="4th Sem"></div>
        <div class="col"><label>SGPA</label><input name="s5" type="text" class="form-control" placeholder="5th Sem"></div>
        <div class="col"><label>SGPA</label><input name="s6" type="text" class="form-control" placeholder="6th Sem"></div>
      </div>
      <br>
      <div class="form-row">
        <div class="col"><label>English</label><input name="eng" type="text" class="form-control" placeholder="English"></div>
        <div class="col"><label>Reasoning</label><input name="logical" type="text" class="form-control" placeholder="Logical"></div>
        <div class="col"><label>Aptitude</label><input name="quant" type="text" class="form-control" placeholder="Aptitude"></div>
        <div class="col"><label>Domain</label><input name="domain" type="text" class="form-control" placeholder="Domain"></div>
        <div class="col"><label>Programming</label><input name="prog" type="text" class="form-control" placeholder="Programming"></div>
      </div>
      <small class="form-text text-muted">
        Input "-1" for Not Applicable Blocks, especially Computer Programming
      </small>
      <br>
      <div class="form-row">
        <div class="col">
          <label for="customRange1">Conscientiousness</label>
          <input name="conscientiousness" type="range" class="custom-range" id="customRange1" style="background-color: transparent;">
        </div>
        <div class="col">
          <label for="customRange1">Agreeableness</label>
          <input name="agreeableness" type="range" class="custom-range" id="customRange1" style="background-color: transparent;">
        </div>
        <div class="col">
          <label for="customRange1">Extrtaversion</label>
          <input name="extraversion" type="range" class="custom-range" id="customRange1" style="background-color: transparent;">
        </div>
        <div class="col">
          <label for="customRange1">Nueroticism</label>
          <input name="nueroticism" type="range" class="custom-range" id="customRange1" style="background-color: transparent;">
        </div>
      </div>
      <br>
      <div class="form-group">
        <label for="customRange1">Openess to Experience</label>
        <input name="openess_to_experience" type="range" class="custom-range" id="customRange1" style="background-color: transparent;">
      </div>
      <button type="submit" class="btn btn-block btn-outline-info">Get Analysis</button>
    </form>
  </div>
  <div class="col-sm-1">
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  </div>
  <div class="col-sm-4">
    <div id="gpachartContainer" style="height: 300px; width: 100%;"></div>
    <br>
    <div id="barchartContainer" style="height: 300px; width: 100%;"></div>
    <script>
      window.onload = function () {

      var gpachart = new CanvasJS.Chart("gpachartContainer", {
          animationEnabled: true,  
          title:{
              text: "Grade Point Chart"
          },
          axisY: {
              title: "Grade Point Avg"
          },
          axisX: {
              title: "Semester Flow"
          },
          data: [{
              type: "spline",
              dataPoints: [
                  {x: 0, y: 1.11},
                  {x: 1, y: <?php echo $_SESSION['gpa'][0]; ?>},
                  {x: 2, y: <?php echo $_SESSION['gpa'][1]; ?>},
                  {x: 3, y: <?php echo $_SESSION['gpa'][2]; ?>},
                  {x: 4, y: <?php echo $_SESSION['gpa'][3]; ?>},
                  {x: 5, y: <?php echo $_SESSION['gpa'][4]; ?>},
                  {x: 6, y: <?php echo $_SESSION['gpa'][5]; ?>}
              ]
          }]
      });
      

      var barchart = new CanvasJS.Chart("barchartContainer", {
          animationEnabled: true,

          title:{
              text:"Suggested Suitable Jobs"
          },
          axisX:{
              interval: 1
          },
          axisY2:{
              interlacedColor: "rgba(1,77,101,.2)",
              gridColor: "rgba(1,77,101,.1)"
          },
          data: [{
              type: "bar",
              name: "companies",
              axisYType: "secondary",
              color: "#014D65",
              dataPoints: [
                  { y: <?php echo $_SESSION['desg_u'][0]*100; ?>, label: '<?php echo $_SESSION['desg_v'][0]; ?>' },
                  { y: <?php echo $_SESSION['desg_u'][1]*100; ?>, label: '<?php echo $_SESSION['desg_v'][1]; ?>' },
                  { y: <?php echo $_SESSION['desg_u'][2]*100; ?>, label: '<?php echo $_SESSION['desg_v'][2]; ?>' },
                  { y: <?php echo $_SESSION['desg_u'][3]*100; ?>, label: '<?php echo $_SESSION['desg_v'][3]; ?>' },
                  { y: <?php echo $_SESSION['desg_u'][4]*100; ?>, label: '<?php echo $_SESSION['desg_v'][4]; ?>' }
              ]
          }]
      });

      gpachart.render();
      barchart.render();

      }
  </script>
  <br>
  <fieldset>
      <h4><b>Salary Range:</b>  <?php echo $max_sal." to ".$min_sal; ?></h4>
  </fieldset>
  </div>
  <div class="col-sm-1"></div>
  </div>
</section>


<br><br>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/footer.php" ?>
<?php
  unset($_SESSION['desg_u']);
  unset($_SESSION['desg_v']);
  unset($_SESSION['gpa']);
  unset($max_sal);
  unset($min_sal);
?>
