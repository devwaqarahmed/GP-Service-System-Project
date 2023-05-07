<?php
   session_start();
   include("db.php");
   error_reporting(0);
   
   if(!isset($_SESSION['username'])){
       header("location: doctor_login.php");
   }
     
   
   
   if(isset($_POST['logout'])){
       session_destroy();
       header("location: doctor_login.php");
   }
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Doctor Panel</title>
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
               <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
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
                  <p>Doctor Panel</p>
            </div>
            </div>
            </div>
            <div class="container-fluid bg-light p-5 py-5 border text-center">
            <?php echo "Welcome"." ".$_SESSION['username']." ".", Here you can manage your dashboard"; ?>
            </div>
            <div class="container-fluid bg-light p-5 py-5 border">
            <h2 class="p-3 bg-dark bg-opacity-10">Your Patients</h2>
            <?php
            $current_doctor_id=$_SESSION['id'];
               //get all patients
               $get_patients="SELECT * FROM `appointments` WHERE doctor_id= '$current_doctor_id'";
               $patient_result=mysqli_query($conn,$get_patients);
               $patient_row=mysqli_fetch_assoc($patient_result);{
               
                ?>
               <table class="table">
               <thead class="table-dark">
               <tr>
                  <th scope="col">Patient Id</th>
                  <th scope="col">Patient Name</th>
                  <th scope="col">Appointment date</th>
                  <th scope="col">appointment time</th>
                  <th scope="col">Action</th>
               </tr>
               </thead>
               <tbody>
               <tr>
                  <td> <?php echo $patient_row['patient_id']; ?></td>
                  <td> <?php echo $patient_row['patient_name']; ?></td>
                  <td> <?php echo $patient_row['appointment_date']; ?></td>
                  <td> <?php echo $patient_row['appointment_time']; ?></td>
                  <td><a href="add_medical_records.php?current_patient_id=<?php echo  $patient_row['id'];?>">
                  <button class="btn btn-outline-warning">Add medical record</button></a></td>
               </tr>
               </tbody>
               <?php } ?>  
            </table>
            </div>
            <div class="container-fluid bg-light p-5 py-5 border">
            <h2 class="p-3 bg-dark bg-opacity-10">Your Appointments</h2>
            <table class="table">
               <thead class="table-dark">
               <tr>
                  <th scope="col">Id</th>
                  <th>Patient ID</th>
                 
                  <th>Appointment Date</th>
                  <th>Appointment Time</th>
               </tr>
               </thead>
               <?php
                  //get all appointments
                  $get_appointments="SELECT * FROM `appointments` WHERE doctor_id= '$current_doctor_id'";
                  $appointments_result=mysqli_query($conn,$get_appointments);
                  $appointments_row=mysqli_fetch_assoc($appointments_result);{
                  
                   ?>
               <tbody>
               <tr>
                  <td> <?php echo $appointments_row['id']; ?></td>
                  <td> <?php echo $appointments_row['patient_id']; ?></td>
                
                  <td> <?php echo $appointments_row['appointment_date']; ?></td>
                  <td> <?php echo $appointments_row['appointment_time']; ?></td>
               </tr>
               </tbody>
               <?php } ?>   
            </table>
            </div>
   </body>
</html>
<div class="container-fluid bg-light p-5 py-5 border">
<form method="POST"> 
<h5 class="p-3 bg-dark bg-opacity-10" >If you want to Log Out click here </h5>
<input type="submit" class="btn btn-outline-warning" value="log out" name="logout">
</form>
</div>
</section><!-- End Services Section -->
</main><!-- End #main -->
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
