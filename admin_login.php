<?php
   session_start();
   include('db.php');
   error_reporting(0);
   
   
   if(isset($_POST['login'])){
       $admin_username=$_POST['admin_username'];
       $pass=$_POST['pass'];
      
   
   // Define SQL query to retrieve data from table
   $fetch_query = "SELECT * FROM `admin_login` WHERE `username` = '$admin_username' ";
   $query_result=mysqli_query($conn,$fetch_query);
   
   // Execute the query and store the result
   $query_rows=mysqli_fetch_assoc($query_result);
      if($query_result->num_rows > 0){
      $user_id=$query_rows['id'];
   
   }
   // $query_result = $conn->query($fetch_query) or die(mysqli_error($conn));{
   //   echo $query_result['id'];
   // }
   
   if($query_result->num_rows > 0){
   echo "logged in";
       $_SESSION['id'] = $user_id;
       $_SESSION['admin_username'] = $admin_username;
       header('location: admin_panel.php');
   
   }
   
   else{
   echo "<script> alert('incorrect username/password');</script>";
   }
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Admin Sign In</title>
      <meta content="" name="description">
      <meta content="" name="keywords">
      <!-- Favicons -->
      
      <link href="assets/other_assets/img/hospital.png" rel="icon">
      <link href="assets/other_assets/img/hospital.png" rel="hospital">
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
      <!-- Vendor CSS Files -->
      <link href="assets/other_assets/vendor/aos/aos.css" rel="stylesheet">
      <link href="assets/other_assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="assets/other_assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
      <link href="assets/other_assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
      <link href="assets/other_assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
      <link href="assets/other_assets/vendor/remixicon/remixicon.css" rel="stylesheet">
      <link href="assets/other_assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
      <!-- Main CSS File -->
      <link href="assets/other_assets/css/style.css" rel="stylesheet">
   </head>
   <body>
      <!-- ======= Header ======= -->
      <header id="header" class="fixed-top ">
         <div class="container d-flex align-items-center justify-content-lg-between">
            <h1 class="logo me-auto me-lg-0"><a href="index.php">GP Service System<span>.</span></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            <nav id="navbar" class="navbar order-last order-lg-0">
               <ul>
               <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
               <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->
         </div>
      </header>
      <!-- End Header -->
      <!-- ======= Hero Section ======= -->
      <section id="hero" class="d-flex align-items-center justify-content-center">
      </section>
      <!-- End Hero -->
      <main id="main">
         <!-- ======= Services Section ======= -->
         <section id="services" class="services">
            <div class="container" data-aos="fade-up">
               <div class="section-title">
                  <h2>GPSS</h2>
                  <p>Admin Sign In</p>
               </div>
            </div>
            </div>
            <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="mb-md-5 mt-md-4 pb-5">

            <div class="card-body px-0 text-center mt-4">
            <h2 class="fw-bold mb-2 text-uppercase">Sign In</h2>
            </div>
            <form action="" method="POST" class="form p-5 py-5">

             <div class="card-body px-0 mt-2">
               <label for="user_name">Username:</label>
               <input type="text" name="admin_username" class="form-control" placeholder="Username" required>
             </div>

               <div class="card-body px-0">
               <label for="password">Password:</label>
               <input type="password" class="form-control" name="pass" placeholder="Password" required>
               </div>

               <div class="card-body  text-center">
               <input type="submit" class="btn btn-outline-warning btn-lg px-5 text-body-center" value="Sign In" name="login">
               </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
         </section>
         <!-- End Services Section -->
      </main>
      <!-- End #main -->
      <!-- ======= Footer ======= -->
      <footer id="footer">
         <div class="footer-top">
            <div class="container">
               <div class="row">
                  <div class="col-lg-3 col-md-6">
                     <div class="footer-info">
                        <h3>GP Service System<span>.</span></h3>
                        <p>
                           AK108 Jillani Street <br>
                           NSY 535022, Pakistan<br><br>
                        </p>
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-6 footer-links">
                     <h4>Useful Links</h4>
                     <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="index.php">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="register_patient.php">Patient Sign Up</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="register_doctor.php">Doctor Sing Up</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="admin_login.php">Admin</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="container">
            <div class="copyright">
               &copy; Copyright <strong><span>Gp Service System</span></strong>. All Rights Reserved
            </div>
         </div>
      </footer>
      <!-- End Footer -->
      <div id="preloader"></div>
      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
      <!-- Vendor JS Files -->
      <script src="assets/other_assets/vendor/purecounter/purecounter_vanilla.js"></script>
      <script src="assets/other_assets/vendor/aos/aos.js"></script>
      <script src="assets/other_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/other_assets/vendor/glightbox/js/glightbox.min.js"></script>
      <script src="assets/other_assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
      <script src="assets/other_assets/vendor/swiper/swiper-bundle.min.js"></script>
      <script src="assets/other_assets/vendor/php-email-form/validate.js"></script>
      <!-- Main JS File -->
      <script src="assets/other_assets/js/main.js"></script>
   </body>
</html>
