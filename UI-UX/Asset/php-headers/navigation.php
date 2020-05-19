<!-- HEADER -->
<header class="text-center" id="header-p">
<section id="<?php echo $section_id?>">
  <div class="nav-top row">
    <div class="col-sm-2"></div>
    <div class="col-sm-3">
      <br>
      <h1>BeFriend</h1>
      <p><em>The Web Friend in Need</em></p>
    </div>
    <div class="col-sm-3">
      <br>
      <h2 style="background: #dcf5f2;"><?php echo $main; ?> <span class="text-info">Index</span> </h2>
    </div>
    <div class="col-sm-3">
      <img class="head-side" src="/Asset/Image/<?php echo $pagename.'.jpg'; ?>" alt="Head Side">
    </div>
    <div class="col-sm-1"></div>
  </div>
  <nav id="nav" class="navbar navbar-expand-sm text-body navbar-light sticky-top">
    <a class="navbar-brand" href="/">
      <img src="/Asset/Image/logo.png" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/member.php#dashboard-section">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/member.php#minimap-section">Minimap</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/Asset/php-headers/hostel.php">Hostel Allocation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/Asset/php-headers/career.php">Ask The Expert</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/Asset/php-headers/mentor.php">Virtual Mentor</a>
        </li>
        <li class="nav-item">
          <?php
            if (!isset($_SESSION['username'])) 
            {
              echo '<a class="nav-link" href="/Asset/php-headers/register-form.php">Register Yourself</a>';
            }
            else
            {
              echo '<a class="nav-link" href="/Asset/php-headers/end.php">'.$_SESSION['username'].' | Log-out</a>';
            }
          ?>
        </li>
      </ul>
    </div>
    <div class="d-flex justify-content-end" id="query-cust">
    <form class="form-inline" action="/Asset/php-headers/details.php" method="GET">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" id="at-icon">@</span>
      </div>
      <input type="text" class="form-control" name="inp-roll" placeholder="Roll Number"> &emsp;
      <button class="btn btn-outline-dark" type="submit"><b>Find Friend</b></button>
    </div>
  </form>
  </div>
  </nav>
</section>
</header>
<!-- HEADER END -->