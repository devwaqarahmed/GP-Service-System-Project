<?php
   session_start();
   include("db.php");
   error_reporting(0);
   
   $current_patient_id=$_SESSION['id'];   
   if(!isset($_SESSION['username'])){
       header("location: patient_login.php");
   }
   
   
   
   
   
   
   if(isset($_POST['logout'])){
       session_destroy();
       header("location: patient_login.php");
   }
   
         
           
      
          
          if(isset($_POST['appoint'])){
          
          // Get the form data
          $patient_id=$_SESSION['id'];
          $doctor_id = $_POST['doctor_id'];
          $your_name = $_POST['your_name'];
          $appointment_date = $_POST['appointment_date'];
          $appointment_time = $_POST['appointment_time'];
          
          // Insert the data into the appointments table
          $sql = "INSERT INTO appointments ( `patient_id`, `patient_name`, `doctor_id`, `appointment_date`, `appointment_time`)
          VALUES ('$patient_id', '$your_name','$doctor_id' ,'$appointment_date', '$appointment_time')";
          
          if ($conn->query($sql) === TRUE) {
           echo "<script> alert('Appointment created successfully')</script>";
          } else {
           echo "Error: " . $sql . "<br>" . $conn->error;
          }
          }
   
          //cancel appointment
          if(isset($_POST['cancel'])){
            $cancel_query="DELETE FROM `appointments` WHERE patient_id='$current_patient_id'";
            $run_cancel_query=mysqli_query($conn,$cancel_query);
            if($run_cancel_query){
               echo "<script> alert('Appointment cancelled')</script>";
            }
            else{
               echo "<script> alert('Appointment cancel failed')</script>";
            }
   
          }
     
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Patient Panel</title>
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
                  <p>Patient Panel</p>
               </div>
            </div>
            </div>
            <div class="container-fluid bg-light p-5 py-5 border text-center">
            <?php echo "Welcome"." ".$_SESSION['username']." ".",Here you can manage your dashboard"."<br>"; ?>
            </div>
            <div class="container-fluid bg-light p-5 py-5 border">
            <h2 class="p-3 bg-dark bg-opacity-10">Medical Records</h2>
            <table class="table">
               <thead class="table-dark">
               <tr>
                  <th scope="col">Record ID</th>
                  <th scope="col">your ID</th>
                  <th scope="col">Record type</th>
                  <th scope="col">Date</th>
                  <th scope="col">Description</th>
               </tr>
               </thead>
               <?php
                  $records_query="SELECT * FROM `patient_records` WHERE patient_id= '$current_patient_id'";
                   $records_query_result=mysqli_query($conn,$records_query);
                     $records_row=mysqli_fetch_assoc($records_query_result);
                   
                     if($records_row){
                   ?>
               <tbody>
               <tr>
                  <td> <?php  echo $records_row['id']; ?></td>
                  <td> <?php  echo $current_patient_id ?></td>
                  <td> <?php  echo $records_row['record_type']; ?></td>
                  <td> <?php  echo $records_row['date']; ?></td>
                  <td> <?php  echo $records_row['description']; ?></td>
               </tr>
               </tbody>
               <?php }
                  else{
                     echo "No Records Made untill";
                  } ?>
            </table>
            </div>
            <!-- Available Appointments -->
            <div class="container-fluid bg-light p-5 py-5 border" >
            <h2 class="p-3 bg-dark bg-opacity-10">Available Doctor appointments</h2>
            <table class="table">
               <thead class="table-dark">
               <tr>
                  <th scope="col">Doctor ID</th>
                  <th scope="col">Doctor Name</th>
                  <th scope="col">Specialty</th>
               </tr>
               </thead>
               
               <!--Fetch all records from the doctors table-->
               <?php $sql = "SELECT * FROM doctors";
                  $result = mysqli_query($conn, $sql);
                  
                  // Check if any records were returned
                  if (mysqli_num_rows($result) > 0) {
                   // Display records in an HTML table
                  
                   while ($row = mysqli_fetch_assoc($result)) { ?>
               <tr>
                  <td> <?php  echo $row['id']; ?></td>
                  <td> <?php  echo $row['first_name']; ?></td>
                  <td> <?php  echo $row['speciality']; ?></td>
               </tr>
               <?php }
                  }
                     ?>
            </table>
            </div>
            <div class="container-fluid bg-light p-5 py-5 border">
            <h2 class="p-3 bg-dark bg-opacity-10">Appointment Details</h2>
            <table class="table">
               <thead class="table-dark">
               <tr>
                  <th scope="col">Appointment ID</th>
                  <th scope="col">your ID</th>
                  <th scope="col">Doctor ID</th>
                  <th scope="col">Appointment Date</th>
                  <th scope="col">Appointment Time</th>
                  <th scope="col">Action</th>
               </tr>
               </thead>
               <?php
                  $appointment_query="SELECT * FROM `appointments` WHERE patient_id= '$current_patient_id'";
                   $appointment_query_result=mysqli_query($conn,$appointment_query);
                     $appointment_row=mysqli_fetch_assoc($appointment_query_result);
                   
                     if($appointment_row){
                   ?>
               <tbody>
               <tr>
                  <td> <?php  echo $appointment_row['id']; ?></td>
                  <td> <?php  echo $current_patient_id ?></td>
                  <td> <?php  echo $appointment_row['doctor_id']; ?></td>
                  <td> <?php  echo $appointment_row['appointment_date']; ?></td>
                  <td> <?php  echo $appointment_row['appointment_time']; ?></td>
                  <td>
                     <form method="POST"> 
                        <input type="submit" class="btn btn-outline-warning" value="cancel" name="cancel">
                     </form>
                  </td>
               </tr>
               </tbody>
               <?php }
                  else{
                     echo "No Appointment Made untill";
                  } ?>
            </table>
            </div>
            <div class="container-fluid bg-light p-5 py-8 border">
            <form class="form br-light p-5 py-5 border" method="post" action="">
            <h2 class="p-3 bg-dark bg-opacity-10">Make Appointment</h2>

               <label for="doctor_id" class="text mt-3">Doctor ID:</label>
               <input type="text" id="doctor_id" class="form-control form-control-lg mt-2" name="doctor_id" required>

               <label for="your_name" class="text mt-3">Your Name:</label>
               <input type="text" id="doctor_id" class="form-control form-control-lg mt-2" name="your_name" required>

               <label for="appointment_date" class="text mt-3">Appointment Date:</label>
               <input type="date" id="appointment_date" class="form-control form-control-lg mt-2" name="appointment_date" required>

               <label for="appointment_time" class="text mt-3">Appointment Time:</label>
               <input type="time" id="appointment_time" class="form-control form-control-lg mt-2" name="appointment_time" required>

               <input type="submit" class="btn btn-outline-warning mt-3" value="Appoint" name="appoint" required>
            </form>
            </div>
            <!-- Update GP records -->
            <div class="container-fluid bg-light p-5 py-5 border" >
            <h5 class="p-3 bg-dark bg-opacity-10">If you want to change profile information click on update GP records</h5>
            <a href="update_patient_records.php?p_id=<?php echo $current_patient_id ?>">
            <button class="btn btn-outline-warning">Update  GP records</button></a><br><br>
            </div>
            <!--log out form-->
            <div class="container-fluid bg-light p-5 py-5 border">
            <form method="POST"> 
               <h5 class="p-3 bg-dark bg-opacity-10" >If you want to Log Out click here </h5>
               <input type="submit" class="btn btn-outline-warning" value="log out" name="logout">
            </form>
            </div>
            <!--De register form-->
            <div class="container-fluid bg-light p-5 py-5 border" >
            <h5 class="p-3 bg-dark bg-opacity-10">If you want to delete your patient account click on Delete Account</h5>
            <form method="POST"> 
               <input type="submit" class="btn btn-outline-warning" value="Delete account" name="deregister">
            </form>
            </div>
            <?php 
               if(isset($_POST['deregister'])){
                              $de_register_query="DELETE FROM `patients` WHERE id= '$current_patient_id' ";
                              $de_query_result=mysqli_query($conn,$de_register_query) or die(mysqli_error($conn));
                              if($de_query_result){
                                 echo "<script> alert('Account Deleted, Go to Homepage')</script>";
                                
                                 
                                 
                                 
                              }
                              else{
                                 echo "failed to delete";
               
                              }
                           }
                     ?>
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
