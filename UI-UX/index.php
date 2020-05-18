<html>
<head>
  <link rel="shortcut icon" href="Asset/Image/favicon.ico" type="image/x-icon">
  <link rel="icon" href="Asset/Image/favicon.ico" type="image/x-icon">
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="Asset/indexstyle.css?v=<?php echo time(); ?>">

  <title>BeFriend</title>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</head>
<script>
window.location.hash="no-back-button";
window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
window.onhashchange=function(){window.location.hash="no-back-button";}
</script> 
<body>
<header class="masthead">
  <section class="head-abs">
    <picture class="abs-pic">
      <img src="/Asset/Image/kiit.png" alt="KIIT Logo" height="100px" style="filter: grayscale(100%);">
      <br>
      <caption class="">School of Computer Engineering</caption>
    </picture>
  </section>
  <div class="container h-100">
    <div class="row h-100 align-items-center">
      <div class="col-12 text-center">
        <h1 class="head-h1">BeFriend</h1>
        <p class="head-p" style="padding-bottom: 250px;">
          A Web Friend in Need
        </p>
        <span ></span>
        <p class="head-p">
          A &ensp; Minor &ensp; Project &ensp; Associated &ensp; with<br>
        </p>
        <h2 class="head-h2">
          School &ensp; of &ensp; Computer &ensp; Engineering <br>
          Kaling &ensp; Institute &ensp; of &ensp; Industrial &ensp; Technology &ensp; DU
        </h2>
        <br>
        <a href="#rulebook" ><button type="button" class="btn btn-outline-light">
          &emsp;Get Started&emsp; <span class="material-icons">&emsp;&nbsp;</span>
        </button></a>
      </div>
    </div>
  </div>
</header>

<span id="rulebook"></span>
<br>
<section class="sec-1">
  <div class="container text-center">
    <h2 class="section-h2">How Can We Help Faster and Easier?</h2>
    <br>
    <div class="row">
      <div class="col-sm-4">
        <div class="card border-light mb-3" style="width: 18rem;">
          <img class="card-img-top" src="Asset/Image/doc.png" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Prospectus</h5>
            <p class="card-text">
              Prospectus helps us to explore more about the institution
            </p>
            <a href="https://cdn.kiit.ac.in/wp-content/uploads/2019/11/Prospectus-KIITEE-2020.pdf" class="btn btn-outline-dark" style="float:right;" download>Download</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card border-light mb-3" style="width: 18rem;">
          <img class="card-img-top" src="Asset/Image/brochure.png" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Brochure</h5>
            <p class="card-text">
              Collect all Information Here for KIITEE
            </p>
            <a href="https://cdn.kiit.ac.in/wp-content/uploads/2019/11/Information-Brochure-2020.pdf" class="btn btn-outline-dark" style="float:right;" download>Download</a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card border-light mb-3" style="width: 18rem;">
          <img class="card-img-top" src="Asset/Image/web.png" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Official Website</h5>
            <p class="card-text">
              Official website with enriched information
            </p>
            <a href="https://kiit.ac.in/" class="btn btn-outline-dark" style="float:right;" download>Visit</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<hr id="h">

<br>
<span id="non-member"></span>
<br>
<section class="vital row">
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-4">
      <p class="s2-instruction">Jump into specific section</p>
      <h1 class="s2-h1">Non Member <span class="highlight-text">Index</span></h1>
      <br>
      <p class="s2-p">
        <b onmouseover="makeActive('1')">Find All Schools</b>
        <br>
          &emsp; A GPS based Mini Map is provided for those who are not directly associated
          to our University. You don't even have to apply Dijkstra's Algorithm to compute the
          shortest path since that's our suty to guide you.
          <br>&ensp;
        <br>
        <b onmouseover="makeActive('2')">Ask the AI Expert</b>
        <br>
          &emsp; An Artificial Intelligence driven system to always help you as a mentor
          to choose the right path for your career. Based on the success rate, it's updated
          once every day to make the error percentage minimal.
          <br>&ensp;
        <br>
        <b onmouseover="makeActive('3')">Clarify your Doubts</b>
        <br>
          &emsp; Still if you have any queries, you can always contact to our members to
          clarify all your doubts. Ask anything regarding career life, accomodation facilities
          and many more. You just have to drop a query in given section
          <br>&ensp;
      </p>
      <h3 class="s2-bottom">
        <span id="e-sp" onclick="redirect();">Learn More &#8594;</span>
      </h3>
      <script>
        function redirect()
        {
          window.location.href="nonmember.php";
        }
      </script>
    </div>
    <div class="col-sm-1"></div>
    <picture class="col-sm-5 caurosal">
      <img class="c-imshow im-active" id="s1" src="Asset/Image/im1.png" alt="Dummy Image Set 1">
      <img class="c-imshow" id="s2" src="Asset/Image/dummy.png" alt="Dummy Image Set 2">
      <img class="c-imshow" id="s3" src="Asset/Image/dummy.png" alt="Dummy Image Set 3">
    </picture>
  </div>

  <script>
    var arr=['s1', 's2', 's3'];
    function makeActive(slide) 
    {
      for (let i = 0; i < arr.length; i++)
      {
        if(arr[i]== 's'+slide)
        {
          document.getElementById(arr[i]).className="c-imshow im-active";
          document.getElementById(arr[i]).style.transitionDuration="1s";
          console.log('s'+slide+' Activated');
        }
        else
        {
          document.getElementById(arr[i]).className="c-imshow";
        }
        
      }
    }
  </script>
</section>

<br><br>
<br>
<span id="member"></span>
<br>
<section class="vital row">
  <div class="row">
    <div class="col-sm-1"></div>
    <picture class="col-sm-5 caurosal">
      <img class="c-imshow im-active" id="s4" src="Asset/Image/im1.png" alt="Dummy Image Set 4">
      <img class="c-imshow" id="s5" src="Asset/Image/im2.png" alt="Dummy Image Set 5">
      <img class="c-imshow" id="s6" src="Asset/Image/im3.png" alt="Dummy Image Set 6">
    </picture>
    <div class="col-sm-1"></div>
    <div class="col-sm-4">
      <p class="s2-instruction">Jump into specific section</p>
      <h1 class="s2-h1">Member <span class="highlight-text">Index</span></h1>
      <br>
      <p class="s2-p">
        <b onmouseover="makeActiveNext('4')">Student Dashboard</b>
        <br>
          &emsp; A Student Dashboard always helps to get a complete details of a student
          beside that, a member can use the ToDo list rovided along with this. The everyday
          schedule can also be accessed by the student.
          <br>&ensp;
        <br>
        <b onmouseover="makeActiveNext('5')">Career Guidance</b>
        <br>
          &emsp; Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore numquam
          officiis nam voluptatum velit laboriosam quasi rerum amet, sit, ipsum repudiandae 
          earum adipisci dolorem libero laborum, eius quas sapiente incidunt.
          <br>&ensp;
        <br>
        <b onmouseover="makeActiveNext('6')">The Ultimate Hostel Guide</b>
        <br>
          &emsp; Hostel Guide is equally important for the first year students and those who
          are looking for a vacant room. It provides room details and vacancy and also allows
          members to choose a room.
          <br>&ensp;
        <br>
        <b onmouseover="makeActiveNext('7')">A JS Mentor Static Bot</b>
        <br>
          &emsp; To minimize the queries, a virtual mentor is introduced to solve frequently
          generated problems
          <br>&ensp;
        <br>
        <b onmouseover="makeActiveNext('8')">Whiteboard</b>
        <br>
          &emsp; To keep updated about all the societies and recent notices <i>Whiteboard</i>
          is ready to help you always.
          <br>&ensp;
      </p>
      <h3 class="s2-bottom">
        <span id="e-sp" onclick="redirect();">Learn More &#8594;</span>
      </h3>
      <script>
        function redirect()
        {
          window.location.href="member.php";
        }
      </script>
    </div>
    <div class="col-sm-1"></div>
  </div>

  <script>
    var arrM=['s4', 's5', 's6'];
    function makeActiveNext(slide) 
    {
      for (let i = 0; i < arrM.length; i++)
      {
        if(arrM[i]== 's'+slide)
        {
          document.getElementById(arrM[i]).className="c-imshow im-active";
          console.log('s'+slide+' Activated');
        }
        else
        {
          document.getElementById(arrM[i]).className="c-imshow";
        }
        
      }
    }
  </script>
</section>

<span class="text-center"><hr style="width: 250px;"></span>
<br><br><br>
<section class="row admin-console">
  <div class="col-sm-1"></div>
  <div class="col-sm-4">
    <div class="card border-danger text-center">
      <div class="card-header bg-danger">
        <b>Featured</b>
      </div>
      <div class="card-body">
        <h5 class="card-title s2-h1">Admin Management Console</h5>
        <p class="card-text">Log in here to get the power of Infinity Stones</p>
        <a href="/Asset/security.html" class="btn btn-danger btn-block">Jump</a>
      </div>
      <div class="card-footer text-muted">
        Hold Your Marker Tight
      </div>
    </div>
  </div>
  <div class="col-sm-2"></div>
  <div class="col-sm-4">
    <div class="card border-info text-center">
      <div class="card-header bg-info">
        <b>Featured</b>
      </div>
      <div class="card-body">
        <h5 class="card-title s2-h1">Alumni Chat</h5>
        <p class="card-text">Hey Starlord, you remember Gamora? Or it costed everyting
        for a job!</p>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
              $URL= "https://fathomless-springs-82772.herokuapp.com/chat.html?name={$_POST['name']}&room={$_POST['year']}";
              echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Name" name="name">
            <small class="form-text text-muted">Since we know you're not Starlord.</small>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Year" name="year">
          </div>
          <div>
            <button type="submit" class="btn btn-info" style="float: right;">Time Travel</button>
          </div>
        </form>
      </div>
      <div class="card-footer text-muted">
        <small>The project integrated here is prepared by 
          <a href="https://github.com/surya-trv-13"><b>TRV-13</b></a>
        </small>
      </div>
    </div>
  </div>
  <div class="col-sm-1"></div>
</section>

<hr id="h">
<span id="FAQ"></span>
<br>

<section class="FAQ">
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
      <h2 class="section-h2 text-center">FAQs You May Wish to Know</h2>
      <div class="accordion" id="faqExample">
          <div class="card">
              <div class="card-header p-2" id="headingOne">
                  <h5 class="mb-0">
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Q: How does this work?
                      </button>
                    </h5>
              </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqExample">
                  <div class="card-body">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum quia ratione, sed minus a voluptas dolor sequi magni nam dolorem quo qui fugiat doloremque sunt reiciendis? Quas beatae est vel?
                  </div>
              </div>
          </div>
          <div class="card">
              <div class="card-header p-2" id="headingTwo">
                  <h5 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Q: What is Bootstrap 4?
                  </button>
                </h5>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqExample">
                  <div class="card-body">
                      Bootstrap is the most popular CSS framework in the world. The latest version released in 2018 is Bootstrap 4. Bootstrap can be used to quickly build responsive websites.
                  </div>
              </div>
          </div>
          <div class="card">
              <div class="card-header p-2" id="headingThree">
                  <h5 class="mb-0">
                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Q. What is another question?
                      </button>
                    </h5>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqExample">
                  <div class="card-body">
                      The answer to the question can go here.
                  </div>
              </div>
          </div>
          <div class="card">
              <div class="card-header p-2" id="headingThree">
                  <h5 class="mb-0">
                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Q. What is the next question?
                      </button>
                    </h5>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqExample">
                  <div class="card-body">
                      The answer to this question can go here. This FAQ example can contain all the Q/A that is needed.
                  </div>
              </div>
          </div>
      </div>
    </div>
    <div class="col-sm-2"></div>
  </div>
</section>

<main class="abs-right">
  <picture>
    <img class="social" src="Asset/Image/facebook.png" alt="S Facebook">
  </picture>
  &emsp;
  <picture>
    <img class="social" src="Asset/Image/instagram.png" alt="S Instagram">
  </picture>
  &emsp;
  <picture>
    <img class="social" src="Asset/Image/linkedin.png" alt="S Linkedin">
  </picture>
  &emsp;
  <picture>
    <img class="social" src="Asset/Image/youtube.png" alt="S Youtube">
  </picture>
</main>

<?php include "Asset/php-headers/footer.php" ?>
</body>
</html>