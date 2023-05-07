<?php
   session_start();
   include("db.php");
   error_reporting(0);
   
   $current_admin_id=$_SESSION['id'];   
   if(!isset($_SESSION['admin_username'])){
       header("location: admin_login.php");
   }
   
    //cancel appointment
    if(isset($_POST['cancel'])){
        $current_ap_id=$_POST['current_id'];
        $cancel_query="DELETE FROM `appointments` WHERE id='$current_ap_id'";
        $run_cancel_query=mysqli_query($conn,$cancel_query);
        if($run_cancel_query){
           echo "<script> alert('Appointment cancelled')</script>";
        }
        else{
           echo "<script> alert('Appointment cancel failed')</script>";
        }
   
      }
   
      if(isset($_POST['logout'])){
        session_destroy();
        header("location: admin_login.php");
    }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Admin Panel</title>
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
   <body class="body">
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
                  <p>Admin Panel</p>
               </div>
            </div>
            </div>
            <div class="container-fluid bg-light p-5 py-5 border">
            <h2 class="p-3 bg-dark bg-opacity-10">All Appointments</h2>
            <table class="table">
               <thead class="table-dark">
               <tr>
                  <th scope="col">Appointment ID</th>
                  <th scope="col">Patient ID</th>
                  <th scope="col">Doctor ID</th>
                  <th scope="col">Appointment Date</th>
                  <th scope="col">Appointment Time</th>
                  <th scope="col">Action</th>
               </tr>
               </thead>
               <?php
                  $appointment_query="SELECT * FROM `appointments`";
                   $appointment_query_result=mysqli_query($conn,$appointment_query);
                     while($appointment_row=mysqli_fetch_assoc($appointment_query_result)){
                  
                         
                  
                     
                   
                   
                   ?>
               <tbody>
               <tr>
                  <td> <?php  echo $appointment_row['id']; ?></td>
                  <td> <?php  echo $appointment_row['patient_id']; ?></td>
                  <td> <?php  echo $appointment_row['doctor_id']; ?></td>
                  <td> <?php  echo $appointment_row['appointment_date']; ?></td>
                  <td> <?php  echo $appointment_row['appointment_time']; ?></td>
                  <td>
                     <form method="POST">
                        <input type="submit" class="btn btn-outline-warning" value="cancel" name="cancel">
                        <input type="hidden" class="btn btn-outline-warning" value="<?php echo $current_ap_id=$appointment_row['id'];?>" name="current_id">
                     </form>
                  </td>
               </tr>
               </tbody>
               <?php } 
                  ?>
            </table>
            </div>
            <!--log out form-->
            <div class="container-fluid bg-light p-5 py-5 border">
            <form method="POST"> 
            <h5 class="p-3 bg-dark bg-opacity-10" >If you want to Log Out click here </h5>
               <input type="submit" class="btn btn-outline-warning" value="log out" name="logout">
            </form>
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
