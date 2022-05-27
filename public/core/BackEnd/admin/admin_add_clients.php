<?php
  session_start();
  include('inc/config.php');
  include('inc/checklogin.php');
  check_login();
  //hold logged in user session.
  $a_id = $_SESSION['a_id'];
  //register user
  
  if(isset($_POST['reg_user']))
  {
    $c_number = $_POST['c_number'];
    $c_name = $_POST['c_name'];
    $c_natidno = $_POST['c_natidno'];
    $c_phone = $_POST['c_phone'];
    $c_dob = $_POST['c_dob'];
    $c_adr = $_POST['c_adr'];
    $c_email = $_POST['c_email'];
    $c_pwd = sha1(md5($_POST['c_pwd']));

      //save passport images
      $c_dpic  = $_FILES["c_dpic"]["name"];
      move_uploaded_file($_FILES["c_dpic"]["tmp_name"],"../Uploads/Users/".$_FILES["c_dpic"]["name"]);//move uploaded image
      
      //sql to insert captured values
      $query="INSERT INTO crms_clients (c_number, c_name, c_natidno, c_phone, c_dob, c_adr, c_email, c_pwd, c_dpic) VALUES (?,?,?,?,?,?,?,?,?)";
      $stmt = $mysqli->prepare($query);
      $rc=$stmt->bind_param('sssssssss', $c_number, $c_name, $c_natidno, $c_phone, $c_dob, $c_adr, $c_email, $c_pwd, $c_dpic);
      $stmt->execute();

      if($stmt)
      {
                $success = "Client Account Created";
                
                //echo "<script>toastr.success('Have Fun')</script>";
      }
      else {
        $err = "Please Try Again Or Try Later";
      }
      
      
  }
  
?>

<!DOCTYPE html>
<html lang="en">

<?php include("inc/head.php");?>

<body class="">
 <!--Sidebar-->
 <?php include("inc/sidebar.php");?>
  
  <div class="main-content">
    <!-- Navbar -->
   <?php include("inc/nav.php");?>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header  pb-8 pt-5 pt-md-8" style="min-height: 300px; background-image: url(../../img/header-bg.jpg); background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-5"></span>
    </div>

    <div class="container-fluid mt--7">
        <!--Pie chart to show number of car categories-->
        <div class="row">
            <div class="card col-md-12">
                <h2 class="card-header">Add New Client</h2>
                <div class="card-body">
                    <!--Form-->
                    <form method="post" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" required name="c_name" class="form-control" id="c_name" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-md-6" style="">
                                <label for="exampleInputEmail1">Client Number</label>
                                    <?php 
                                        $length = 4;    
                                        $alph_num =  substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                        $num =  substr(str_shuffle('0123456789'),1,$length);

                                    ?>
                                <input type="text" required name="c_number" value="CRMS-C-<?php echo $alph_num;?>-<?php echo $num;?> " class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">National ID Number</label>
                                <input type="text" required name="c_natidno" class="form-control" id="c_natidno" aria-describedby="emailHelp">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Phone Number</label>
                                <input type="text" required name="c_phone" class="form-control" id="c_phone" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Residency</label>
                                <input type="text" required name="c_adr" class="form-control" id="c_adr" aria-describedby="emailHelp">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">DOB</label>
                                <input type="text" required name="c_dob" placeholder="DD - MM - YYYY"  class="form-control" id="c_dob" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Passport</label>
                                <input type="file"  required name="c_dpic" class="form-control btn btn-outline-success" id="c_dpic" aria-describedby="emailHelp">
                            </div>
                        </div> 

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" required name="c_email"  class="form-control" id="c_email" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" required name="c_pwd" class="form-control" id="c_pwd" aria-describedby="emailHelp">
                            </div>
                        </div>  

                        
                        <button type="submit" name="reg_user" class="btn btn-primary">Add Client</button>
                    </form>
                    <!-- ./ Form -->
                </div>    
            </div>
        </div>
      <!-- Footer -->
        <?php include("inc/footer.php");?>      
    </div>
  </div>
 
  <script src="assets/js/canvasjs.min.js"></script>
  <script src="assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <script src="assets/js/plugins/chart.js/dist/Chart.min.js"></script>
  <script src="assets/js/plugins/chart.js/dist/Chart.extension.js"></script>
  <!--   Argon JS   -->
  <script src="assets/js/argon-dashboard.min.js?v=1.1.2"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
</body>

</html>