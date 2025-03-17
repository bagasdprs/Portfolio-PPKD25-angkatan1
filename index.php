<?php
require_once "php/koneksi.php";

$selectAbout = mysqli_query($conn, "SELECT * FROM setting WHERE id = 1");
$rowAbout = mysqli_fetch_assoc($selectAbout);

$services = mysqli_query($conn, "SELECT * FROM services");
$rows = mysqli_fetch_all($services, MYSQLI_ASSOC);

$selectResume = mysqli_query($conn, "SELECT * FROM resume");
$rowResume = mysqli_fetch_all($selectResume, MYSQLI_ASSOC);

$selectSkill = mysqli_query($conn, "SELECT * FROM skills");
$rowsSkill = mysqli_fetch_all($selectSkill, MYSQLI_ASSOC);

$projects = mysqli_query($conn, "SELECT * FROM project ORDER BY id DESC");
$projects = mysqli_fetch_all($projects, MYSQLI_ASSOC);

$queryBlog = mysqli_query($conn, "SELECT * FROM blog WHERE status = 1 ORDER BY id DESC LIMIT 3");
$blogs = mysqli_fetch_all($queryBlog, MYSQLI_ASSOC);


if (isset($_POST['sent'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  $checkEmail = mysqli_query($conn, "SELECT * FROM contact WHERE email = '$email'");
  $rowEmail = mysqli_fetch_assoc($checkEmail);

  if ($rowEmail) {
    header("location:index.php");
    die;
  } else {
    $insert = mysqli_query($conn, "INSERT INTO contact (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')");

    if ($insert) {
      header("location:index.php?#contact-section&contact=berhasil");
      die;
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Clark - Free Bootstrap 4 Template by Colorlib</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="assets/frontend/css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="assets/frontend/css/animate.css">

  <link rel="stylesheet" href="assets/frontend/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/frontend/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="assets/frontend/css/magnific-popup.css">

  <link rel="stylesheet" href="assets/frontend/css/aos.css">

  <link rel="stylesheet" href="assets/frontend/css/ionicons.min.css">

  <link rel="stylesheet" href="assets/frontend/css/flaticon.css">
  <link rel="stylesheet" href="assets/frontend/css/icomoon.css">
  <link rel="stylesheet" href="assets/frontend/css/style.css">
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light site-navbar-target" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.html">Bagas D.</a>
      <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav nav ml-auto">
          <li class="nav-item"><a href="#home-section" class="nav-link"><span>Home</span></a></li>
          <li class="nav-item"><a href="#about-section" class="nav-link"><span>About</span></a></li>
          <li class="nav-item"><a href="#resume-section" class="nav-link"><span>Resume</span></a></li>
          <li class="nav-item"><a href="#services-section" class="nav-link"><span>Services</span></a></li>
          <li class="nav-item"><a href="#skills-section" class="nav-link"><span>Skills</span></a></li>
          <li class="nav-item"><a href="#projects-section" class="nav-link"><span>Projects</span></a></li>
          <li class="nav-item"><a href="#blog-section" class="nav-link"><span>My Blog</span></a></li>
          <li class="nav-item"><a href="#contact-section" class="nav-link"><span>Contact</span></a></li>
        </ul>
      </div>
    </div>
  </nav>
  <section id="home-section" class="hero">
    <div class="home-slider  owl-carousel">
      <div class="slider-item ">
        <div class="overlay"></div>
        <div class="container">
          <div class="row d-md-flex no-gutters slider-text align-items-end justify-content-end" data-scrollax-parent="true">
            <div class="one-third js-fullheight order-md-last img" style="background-image:url(images/bg_1.png);">
              <div class="overlay"></div>
            </div>
            <div class="one-forth d-flex  align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
              <div class="text">
                <span class="subheading">Hello!</span>
                <h1 class="mb-4 mt-3">I'm <span>Bagas Dwiprasandi</span></h1>
                <h2 class="mb-4">A Freelance UI/UX Designer</h2>
                <p><a href="#" class="btn btn-primary py-3 px-4">Hire me</a> <a href="#" class="btn btn-white btn-outline-white py-3 px-4">My works</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="slider-item">
        <div class="overlay"></div>
        <div class="container">
          <div class="row d-flex no-gutters slider-text align-items-end justify-content-end" data-scrollax-parent="true">
            <div class="one-third js-fullheight order-md-last img" style="background-image:url(images/bg_2.png);">
              <div class="overlay"></div>
            </div>
            <div class="one-forth d-flex align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
              <div class="text">
                <span class="subheading">Hello!</span>
                <h1 class="mb-4 mt-3">I'm a <span>UI/UX Designer</span> based in Jakarta</h1>
                <p><a href="#" class="btn btn-primary py-3 px-4">Hire me</a> <a href="#" class="btn btn-white btn-outline-white py-3 px-4">My works</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-about img ftco-section ftco-no-pb" id="about-section">
    <div class="container">
      <div class="row d-flex">
        <div class="col-md-6 col-lg-5 d-flex">
          <div class="img-about img d-flex align-items-stretch">
            <div class="overlay"></div>
            <div class="img d-flex align-self-stretch align-items-center">
              <img src="assets/uploads/<?= $rowAbout['logo'] ?>" class="img d-flex align-self-stretch align-items-center">
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-7 pl-lg-5 pb-5">
          <div class="row justify-content-start pb-3">
            <div class="col-md-12 heading-section ftco-animate">
              <h1 class="big">ABOUT</h1>
              <h2 class="mb-4">About Me</h2>
              <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              <ul class="about-info mt-4 px-md-0 px-2">
                <li class="d-flex"><span>Name : </span> <span><?= $rowAbout['nama_website'] ?></span></li>
                <li class="d-flex"><span>Address : </span> <span><?= $rowAbout['alamat'] ?></span></li>
                <li class="d-flex"><span>Website URL : </span> <span><?= $rowAbout['alamat_website'] ?></span></li>
                <li class="d-flex"><span>Email : </span> <span><?= $rowAbout['email'] ?></span></li>
                <li class="d-flex"><span>Phone : </span> <span><?= $rowAbout['telpon'] ?></span></li>
              </ul>
            </div>
          </div>
          <div class="counter-wrap ftco-animate d-flex mt-md-3">
            <div class="text">
              <p class="mb-4">
                <span class="number" data-number="120">0</span>
                <span>Project complete</span>
              </p>
              <p><a href="#" class="btn btn-primary py-3 px-3">Download CV</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-no-pb" id="resume-section">
    <div class="container">
      <div class="row justify-content-center pb-5">
        <div class="col-md-10 heading-section text-center ftco-animate">
          <h1 class="big big-2">RESUME</h1>
          <h2 class="mb-4">Resume</h2>
          <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
        </div>
      </div>
      <div class="row">
        <?php
        foreach ($rowResume as $row) {
        ?>
          <div class="col-md-6 col-sm-5">
            <div class="resume-wrap ftco-animate">
              <span class="date"><?= $row['start_year'] . " - " . $row['last_year'] ?></span>
              <h2><?= $row['skill'] ?></h2>
              <span class="position"><?= $row['agency'] ?></span>
              <p class="mt-2"><?= $row['description'] ?></p>
            </div>
          <?php } ?>
          </div>
      </div>
    </div>
  </section>

  <section class="ftco-section" id="services-section">
    <div class="container">
      <div class="row justify-content-center py-5 mt-5">
        <div class="col-md-12 heading-section text-center ftco-animate">
          <h1 class="big big-2">SERVICES</h1>
          <h2 class="mb-4">Services</h2>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
        </div>
      </div>
      <div class="row">
        <?php
        foreach ($rows as $row) {
        ?>
          <div class="col-md-4 text-center d-flex ftco-animate">
            <a href="#" class="services-1">
              <span class="icon">
                <img src="assets/uploads/<?= $row['photo'] ?>" alt="" width="100">
              </span>
              <div class=" desc">
                <h3 class="mb-5"><?= $row['services_name'] ?></h3>
              </div>
            </a>
          </div>
        <?php } ?>

      </div>
    </div>
  </section>


  <section class="ftco-section" id="skills-section">
    <div class="container">
      <div class="row justify-content-center pb-5">
        <div class="col-md-12 heading-section text-center ftco-animate">
          <h1 class="big big-2">SKILLS</h1>
          <h2 class="mb-4">My Skills</h2>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
        </div>
      </div>

      <div class="row">
        <?php
        foreach ($rowsSkill as $row) {
        ?>
          <div class="col-md-6 animate-box">
            <div class="progress-wrap ftco-animate">
              <h3><?= $row['skill_name']; ?></h3>
              <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75"
                  aria-valuemin="0" aria-valuemax="100" style="width:<?= $row['percentage'] ?>% ">
                  <span><?= $row['percentage'] ?>%</span>
                </div>
              </div>
            </div>
          </div>
        <?php

        } ?>


      </div>
    </div>
  </section>

  <section class="ftco-section ftco-project" id="projects-section">
    <div class="container">
      <div class="row justify-content-center pb-5">
        <div class="col-md-12 heading-section text-center ftco-animate">
          <h1 class="big big-2">PROJECTS</h1>
          <h2 class="mb-4">Our Projects</h2>
          <p>Below is the result of work and a work that I made</p>
        </div>
      </div>
      <div class="row">
        <?php
        $colClass = ["col-md-4", "col-md-8"];
        $index = 0;
        ?>
        <?php
        foreach ($projects as $index => $project) : ?>
          <?php $col = $colClass[$index % 2]; ?>

          <div class="<?= $col ?> mb-3">
            <div class="project img ftco-animate d-flex justify-content-center align-items-center" style="background-image: url(<?= "assets/uploads/" . $project['photo'] ?>);">
              <div class="overlay"></div>
              <div class="text text-center p-4">
                <h3><a href="#"><?= $project['name_project'] ?></a></h3>
                <span><?= $project['category'] ?></span>
              </div>
            </div>
          </div>

        <?php endforeach
        ?>
      </div>
    </div>
  </section>


  <section class="ftco-section" id="blog-section">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-5">
        <div class="col-md-7 heading-section text-center ftco-animate">
          <h1 class="big big-2">BLOG</h1>
          <h2 class="mb-4">Our Blog</h2>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
        </div>
      </div>
      <div class="row d-flex">
        <?php foreach ($blogs as $blog) : ?>
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry justify-content-end">
              <a href="single.html" class="block-20" width="100" style="background-image: url(<?= "assets/uploads/" . $blog['photo'] ?>);">
              </a>
              <div class="text mt-3 float-right d-block">
                <div class="d-flex align-items-center mb-3 meta">
                  <p class="mb-0">
                    <?php $date = date("M d", strtotime($blog['created_at'])) ?>
                    <?php $year = date("Y", strtotime($blog['created_at'])) ?>
                    <span class="mr-2"><?= $date . " , " . $year ?></span>
                    <a href="#" class="mr-2"><?= $blog['author'] ?></a>
                    <a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a>
                  </p>
                </div>
                <h3 class="heading"><a href="single.html"><?= $blog['title'] ?></a></h3>
                <?= $blog['content'], 0, 100 ?>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-no-pt ftco-no-pb ftco-counter img" id="section-counter">
    <div class="container">
      <div class="row d-md-flex align-items-center">
        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
          <div class="block-18">
            <div class="text">
              <strong class="number" data-number="100">0</strong>
              <span>Awards</span>
            </div>
          </div>
        </div>
        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
          <div class="block-18">
            <div class="text">
              <strong class="number" data-number="1200">0</strong>
              <span>Complete Projects</span>
            </div>
          </div>
        </div>
        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
          <div class="block-18">
            <div class="text">
              <strong class="number" data-number="1200">0</strong>
              <span>Happy Customers</span>
            </div>
          </div>
        </div>
        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
          <div class="block-18">
            <div class="text">
              <strong class="number" data-number="500">0</strong>
              <span>Cups of coffee</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section ftco-hireme img margin-top" style="background-image: url(images/bg_1.jpg)">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-7 ftco-animate text-center">
          <h2>I'm <span>Available</span> for freelancing</h2>
          <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
          <p class="mb-0"><a href="#" class="btn btn-primary py-3 px-5">Hire me</a></p>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section contact-section ftco-no-pb" id="contact-section">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-3">
        <div class="col-md-7 heading-section text-center ftco-animate">
          <h1 class="big big-2">CONTACT</h1>
          <h2 class="mb-4">Contact Me</h2>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
        </div>
      </div>

      <div class="row d-flex contact-info mb-5">
        <div class="col-md-6 col-lg-3 d-flex ftco-animate">
          <div class="align-self-stretch box p-4 text-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <span class="icon-map-signs"></span>
            </div>
            <h3 class="mb-4">Address</h3>
            <p>198 West 21th Street, Suite 721 New York NY 10016</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 d-flex ftco-animate">
          <div class="align-self-stretch box p-4 text-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <span class="icon-phone2"></span>
            </div>
            <h3 class="mb-4">Contact Number</h3>
            <p><a href="tel://1234567920">+ 1235 2355 98</a></p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 d-flex ftco-animate">
          <div class="align-self-stretch box p-4 text-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <span class="icon-paper-plane"></span>
            </div>
            <h3 class="mb-4">Email Address</h3>
            <p><a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 d-flex ftco-animate">
          <div class="align-self-stretch box p-4 text-center">
            <div class="icon d-flex align-items-center justify-content-center">
              <span class="icon-globe"></span>
            </div>
            <h3 class="mb-4">Website</h3>
            <p><a href="#">yoursite.com</a></p>
          </div>
        </div>
      </div>

      <div class="row no-gutters block-9">
        <div class="col-md-6 order-md-last d-flex">
          <form action="#" method="post" class="bg-light p-4 p-md-5 contact-form">
            <div class="form-group">
              <input type="text" name="name" class="form-control" placeholder="Your Name" required>
            </div>
            <div class="form-group">
              <input type="text" name="email" class="form-control" placeholder="Your Email" required>
            </div>
            <div class="form-group">
              <input type="text" name="subject" class="form-control" placeholder="Subject" required>
            </div>
            <div class="form-group">
              <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Message" required></textarea>
            </div>
            <div class="form-group">
              <button type="submit" name="sent" value="Send Message" class="btn btn-primary py-3 px-5">Send Message</button>
            </div>
          </form>

        </div>

        <div class="col-md-6 d-flex">
          <div class="img" style="background-image: url(images/about.jpg);"></div>
        </div>
      </div>
    </div>
  </section>


  <footer class="ftco-footer ftco-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">About</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
              <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-linkedin"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-dribbble"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-github"></span></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4 ml-md-4">
            <h2 class="ftco-heading-2">Links</h2>
            <ul class="list-unstyled">
              <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Home</a></li>
              <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>About</a></li>
              <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Services</a></li>
              <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Projects</a></li>
              <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Services</h2>
            <ul class="list-unstyled">
              <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Web Design</a></li>
              <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Web Development</a></li>
              <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Business Strategy</a></li>
              <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Data Analysis</a></li>
              <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Graphic Design</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Have a Questions?</h2>
            <div class="block-23 mb-3">
              <ul>
                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+62 878 7521 0789</span></a></li>
                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">bagasdprs@gmail.com</span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">

          <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>
              document.write(new Date().getFullYear());
            </script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        </div>
      </div>
    </div>
  </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>

  <script src="assets/frontend/js/jquery.min.js"></script>
  <script src="assets/frontend/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="assets/frontend/js/popper.min.js"></script>
  <script src="assets/frontend/js/bootstrap.min.js"></script>
  <script src="assets/frontend/js/jquery.easing.1.3.js"></script>
  <script src="assets/frontend/js/jquery.waypoints.min.js"></script>
  <script src="assets/frontend/js/jquery.stellar.min.js"></script>
  <script src="assets/frontend/js/owl.carousel.min.js"></script>
  <script src="assets/frontend/js/jquery.magnific-popup.min.js"></script>
  <script src="assets/frontend/js/aos.js"></script>
  <script src="assets/frontend/js/jquery.animateNumber.min.js"></script>
  <script src="assets/frontend/js/scrollax.min.js"></script>

  <script src="assets/frontend/js/main.js"></script>

</body>

</html>