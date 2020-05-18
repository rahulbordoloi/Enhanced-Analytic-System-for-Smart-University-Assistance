<?php
  $pagename= 'Member';
  $main="Member";
  $section_id= 'particles-js';
  session_start();
  if(!isset($_SESSION['username']))
  {
    session_destroy();
    $tasknum=0;
  }
?>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/modules.php" ?>

<!-- BODY -->

<body>


<!-- Absolute List Group -->
<div class="icon-abs-li-g" id="icon-abs-li-g" onclick="showMenu();">
  <span><h5>Whiteboard&ensp;</h5></span>
  <img src="/Asset/Image/head-side.png" height="50px" width="50px">
</div>
<section class="abs-li-g" id="abs-li-g">
  <ul class="list-group">
  <li class="list-group-item" onclick="hideMenu();">
    <a href="">Hide Sidebar<span style="float: right;">
      <img src="/Asset/Image/close.png" height="25px" width="25px">
    </span></a>
  </li>
  <li class="list-group-item">
    <a href="/Asset/php-headers/notice.php">Check Notice</a>
  </li>
  <li class="list-group-item">
    <a href="">Socities</a>
  </li>
</ul>
</section>

<script type="text/javascript">
  function showMenu()
  {
    document.getElementById('abs-li-g').style.display= 'block';
    document.getElementById('icon-abs-li-g').style.display= 'none';
  }
  function hideMenu()
  {
    document.getElementById('abs-li-g').style.display= 'none';
    document.getElementById('icon-abs-li-g').style.display= 'block';
  }
</script>
<!-- Absolute List Group End -->


<!-- Absolute Section -->
<section class="abs-pos-middle row align-items-center" id="n-phn">
  <script type="text/javascript">
    if(window.innerWidth <= 820)
    {
      document.getElementById('n-phn').style.display="none";
      document.getElementById('icon-abs-li-g').style.display="none";
    }
  </script>
  <div class="col-sm-3">
    <img class="d-block" src="/Asset/Image/logo.png" alt="Left Image" height="200px" width="200px">
  </div>
  <div class="col-sm-6">
    <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="custom-note">
            <h1>Check the Dashboard</h1>
            <hr>
            <p>
              Check the Dashboard for a complete details,
              don't forget to update tasks and check the daily schedule
              <br>
              <br>
              Log-in for a customized view
            </p>
          </div>
        </div>
        <div class="carousel-item">
          <div class="custom-note">
            <h1>Check the Dashboard</h1>
            <hr>
            <p>
              Check the Dashboard for a complete details,
              don't forget to update tasks and check the daily schedule
              <br>
              <br>
              Log-in for a customized view
            </p>
          </div>
        </div>
        <div class="carousel-item">
          <div class="custom-note">
            <h1>Bonafide of for any request</h1>
            <hr>
            <p>
              Visit the virtual mentor for a detailed guideline.
              So, why to visit Complience Cell again and again!
              <br>
              <br>
              Check your Guide.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-3 text-center">
    <span class="align-middle">&nbsp;
      <img src="/Asset/Image/sm-logo.png" alt="Logo">
    </span>
  </div>
  <script type="text/javascript">
    $('.carousel').carousel({
      interval: 5000
    })
  </script>
</section>


<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/navigation.php" ?>


<!-- <br><br><br> -->
<!-- https://api.ipify.org/?format=json -->
<?php
      if(!isset($_SESSION['roll']))
      {
        // Blah and Blah
      }
      else
      {
        $url= 'Rest URL/roll/'.$_SESSION["roll"];
        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, $url);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

        $list = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        $j=1;
        $tasknum= count((array)json_decode($list));
      }
?>
<main class="db-main" style="height: 100%">
<!-- DASHBOARD -->
<h1 class="text-center bg-dark" id="dashboard-section">Dashboard</h1>
<br>
<section class="row" id="Dashboard">
<div class="nav flex-column nav-pills col-sm-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Profile</a>
  <a class="nav-link" id="v-pills-tasks-tab" data-toggle="pill" href="#v-pills-tasks" role="tab" aria-controls="v-pills-messages" aria-selected="false">Task <span class="badge badge-light"><?php echo $tasknum; ?></span></a>
  <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Today's Schedule</a>
</div>
<div class="tab-content col-sm-9" id="v-pills-tabContent" style="padding-top: 10px;">
  <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    <!-- PROFILE CARD -->
    <div class="row">
    <div class="col-sm-6">
    <div class="card border-info">
      <?php
            if (isset($_SESSION['roll'])) 
            {
              try
              {
                $file_name= "IMG URL".$_SESSION['roll'].'.jpg';
              }
              catch(Exception $e)
              {
                $file_name= "IMG URL";
              }
            }
            else
            {
              $file_name= "IMG URL";
            }
      ?>
      <img class="card-img-top rounded mx-auto d-block" src="<?php echo $file_name; ?>" alt="Card image cap">
    <div class="card-body">
      <p class="card-text tagline">
        <?php
            if (isset($_SESSION['tagline'])) 
            {
              echo $_SESSION['tagline'];
            }
            else
            {
              echo 'Set a Tagline';
            }
          ?>
      </p>
    </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card border-info">
      <div class="card-body">
        <h5 class="card-title">
          <b>
            <?php
            if (isset($_SESSION['username'])) 
            {
              echo $_SESSION['username']." ".$_SESSION["lname"];
            }
            else
            {
              echo 'Name';
            }
          ?>
          </b>
        </h5>
        <p class="card-text">
          <?php
            if (isset($_SESSION['sec'])) 
            {
              echo $_SESSION['stream']." ".$_SESSION['sec']." ".$_SESSION['roll'];
            }
            else
            {
              echo 'Section';
            }
          ?>
        </p>
        <a href="#" class="btn btn-outline-info" disabled>
          View Complete Profile
        </a>
      </div>
    </div>
  </div>
  </div>
    <!-- PROFILE CARD ENDS -->
  </div>
  <div class="tab-pane fade" id="v-pills-tasks" role="tabpanel" aria-labelledby="v-pills-tasks-tab">
    <div class="row">
    <div class="col-sm-6">
    <div class="card border-info">
    <div class="card-header">
      <h5><b>Pending Works</b></h5>
    </div>
    <div class="card-scroll">
    <ul class="list-group list-group-flush">
      <?php
        if(isset($_SESSION['roll']))
        {
          while ($j <= $tasknum)
          {
      ?>
            <li class="list-group-item" id="<?php echo 'li'.$j; ?>" onclick="stripped('<?php echo $j; ?>')"> <?php echo json_decode($list)->{"task{$j}"}; ?> </li>
      <?php
            $j+=1;
          }
        }
      ?>
    </ul>
    </div>
    <script type="text/javascript">
      function stripped(num) 
      {
        var idname= "li"+num;
        console.log("Task "+num+" is going to be deleted while you refresh");
        document.getElementById(idname).style.textDecoration="line-through";
      }
    </script>
  </div>
  </div>
  <div class="col-sm-6">
  <div class="card border-info">
    <div class="card-header">
      <h5><b>Add Tasks</b></h5>
    </div>
    <br>
    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST")
      {
          if(!isset($_SESSION['roll']))
        {
          echo "<script>alert('Login First');</script>";
        }
        else
        {
          $url= 'Rest URL/roll/'.$_SESSION["roll"].'/'.str_replace(" ","_",$_POST["work"]);
          $cURLConnectionT= curl_init();
          curl_setopt($cURLConnectionT, CURLOPT_URL, $url);
          curl_setopt($cURLConnectionT, CURLOPT_RETURNTRANSFER, true);

          $taskSend= curl_exec($cURLConnectionT);
          curl_close($cURLConnectionT);
        }
      }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <div class="form-group" style="padding: 0px 10px 0px 10px">
      <input type="text" name="work" id="work" class="form-control" placeholder="Task">
    </div>
      <button class="btn btn-outline-info mb-3" type="button" onclick="DeleteTasks();" style="float: left; margin-left: 20px;">&nbsp;&emsp;Clear All Tasks&emsp;&nbsp;</button>

      <button class="btn btn-outline-info mb-3" type="submit" style="float: right; margin-right: 20px;">&nbsp;&emsp;Add Task&emsp;&nbsp;</button>
    </form>
  </div>
  </div>
  <script type="text/javascript">
    function DeleteTasks() 
    {
      var UrlToSend= "Rest URL/roll/del/<?php echo $_SESSION['roll'] ?>"
        xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", UrlToSend, false);
        xmlhttp.send();
    }
  </script>
  </div>
  </div>
  <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
    <section class="text-center schedule">
      <h2><?php echo date("l"); ?>'s Schedule</h2>
      <br>
      <table class="table table-bordered">
        <thead>
          <tr class="table-info">
            <th scope="col">08-09</th>
            <th scope="col">09-10</th>
            <th scope="col">10-11</th>
            <th scope="col">11-12</th>
            <th scope="col">12-01</th>
            <th scope="col">01-02</th>
            <th scope="col">03-04</th>
            <th scope="col">04-05</th>
            <th scope="col">05-06</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <?php
            if (!isset($_SESSION['sec']) || date('l')=='Saturday' || date('l')=='Sunday') 
            {
              for ($i=0; $i < 9; $i++) 
              {
          ?>
                <th scope="row">NA</th>
          <?php 
              }
            }
            else
            {
              $str = file_get_contents('Asset/schedule.json');
              $json = json_decode($str, true);
              $day= date('l');
              $sec= $_SESSION['stream'];
              $no= $_SESSION['sec'];
              foreach ($json[2]['data'] as $key => $value) 
              {
                if ($value['day'] == date('l') && $value['sec']== $sec && $value['no']== $no) 
                {
                  $res= $value;
                }
              }
              for ($i=0; $i < 9; $i++) 
              {
                $num= $i+1;
          ?>
                  <th scope="col"><?php echo $res['p'.$num]; ?></th>
          <?php
              }
            }
          ?>
          
          
        </tr>
        </tbody>
      </table>
    </section>
  </div>
</div>
</section>
<script type="text/javascript">
  function classdep(idname)
  { var arr= ['v-pills-profile-tab','v-pills-tasks-tab','v-pills-settings-tab']
    for (var i = arr.length - 1; i >= 0; i--)
    {
      if (arr[i] == idname)
      {
        document.getElementById(arr[i]).className = "nav-link btn-warning";        
      }
      else
      {
        document.getElementById(arr[i]).className = "nav-link";
      }
    }
  }
</script>
</main>

<!-- MINIMAP -->
<br><br><br><br>
<main class="mini-main" style="height: 100%;">
<h1 class="text-center bg-dark" id="minimap-section">Minimap</h1>
<br>
<section id="minimap">

</section>
</main>

<br><br><br>
<?php include $_SERVER['DOCUMENT_ROOT']."/Asset/php-headers/footer.php" ?>


<!-- ALL SCRIPTS -->
<script type="text/javascript">
  particlesJS("particles-js", {"particles":{"number":{"value":180,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#21084c"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.4,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":0,"color":"#ffffff","opacity":0.5,"width":1},"move":{"enable":true,"speed":4,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":130,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});
</script>
</html>