<?php
 // starting the session
  session_start();
  if (isset($_SESSION['username'])&&$_SESSION['username']!=""&&$_SESSION['usertype']=="0"){
       
  }
  else
  {
   header("Location:./login.php");
  }

 $fullname = $_SESSION['fname'];
 $username = $_SESSION['username'];
 $image = $_SESSION['image'];

include "../functions/connect.php";
$sqll = "SELECT * FROM `tbl_booking`";
$runl = mysqli_query($con,$sqll);
while($rowl=mysqli_fetch_array($runl)){

    $checkout = $rowl['checkout'];
    $rem = strtotime($checkout." 24:00:00") - time();
    $day = floor($rem / 86400) + 1;
    if($day <= '0'){
        $bid = $rowl['id'];
        $rid = $rowl['room_Id'];

        $sql1 = "UPDATE tbl_room SET status='0' WHERE id='$rid'";
        mysqli_query($con,$sql1);

        $sql = "DELETE FROM tbl_booking WHERE id ='$bid'";
        mysqli_query( $con,$sql);
    }

}

  ?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Raddison Blu Hotel System</title>
    <!-- Favicon -->
    <link rel="icon" href="../images/rad.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Template CSS Files -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="./assets/css/line-awesome.css">
    <link rel="stylesheet" href="./assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="./assets/css/daterangepicker.css">
    <link rel="stylesheet" href="./assets/css/animate.min.css">
    <link rel="stylesheet" href="./assets/css/animated-headline.css">
    <link rel="stylesheet" href="./assets/css/jquery-ui.css">
    <link rel="stylesheet" href="./assets/css/jquery.filer.css">
    <link rel="stylesheet" href="./assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="./assets/css/styling.css">
    
</head>
<body class="section-bg">


<!-- ================================
       START USER CANVAS MENU
================================= -->
<div class="user-canvas-container">
    <div class="side-menu-close">
        <i class="la fa-times"></i>
    </div><!-- end menu-toggler -->
</div><!-- end user-canvas-container -->
<!-- ================================
       END USER CANVAS MENU
================================= -->

<!-- ================================
       START DASHBOARD NAV
================================= -->
<div class="sidebar-nav">
    <div class="sidebar-nav-body">
        <div class="side-menu-close">
            <i class="la fa-times"></i>
        </div><!-- end menu-toggler -->
        <div class="author-content">
            <div class="d-flex align-items-center">
                <div class="author-img avatar-sm">
                    <img src="<?php echo $image ?>" alt="testimonial image">
                </div>
                <div class="author-bio">
                    <h4 class="author__title"><?php echo $fullname ?></h4>
                </div>
            </div>
        </div>
        <div class="sidebar-menu-wrap">
            <ul class="sidebar-menu list-items">
                <li ><a href="./"><i class="fas fa-home"></i>&nbsp;Dashboard</a></li>
                <li ><a href="./users.php"><i class="fas fa-user"></i>&nbsp;Users</a></li>
                <li ><a href="./rooms.php"><i class="fas fa-door-open"></i>&nbsp;Rooms</a></li>
                <li class="page-active"><a href="./bookings.php"><i class="fas fa-book"></i>&nbsp;Bookings</a></li>
                
                <li><a href="./reviews.php"><i class="fas fa-comments"></i>&nbsp;Reviews</a></li>
                <li><a href="./logout.php"><i class="fas fa-power-off"></i>&nbsp;Logout</a></li>
            </ul>
        </div><!-- end sidebar-menu-wrap -->
    </div>
</div><!-- end sidebar-nav -->
<!-- ================================
       END DASHBOARD NAV
================================= -->
<!-- ================================
    START DASHBOARD AREA
================================= -->
<section class="dashboard-area">
    <div class="dashboard-nav">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="menu-wrapper">
                        <div class="logo mr-5">
                            <a href="index.html"><img src="../images/rad.png" alt="logo" width="80px" height="80px"></a>
                            <div class="menu-toggler">
                                <i class="la fa-bars"></i>
                                <i class="la fa-times"></i>
                            </div><!-- end menu-toggler -->
                            <div class="user-menu-open">
                                <i class="la fa-user"></i>
                            </div><!-- end user-menu-open -->
                        </div>
                        <div class="dashboard-search-box">
                            <div class="contact-form-action">
                                <form action="#">
                                    <div class="form-group mb-0">
                                        <input class="form-control" type="text" name="text" placeholder="Search">
                                        <button class="search-btn"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="nav-btn ml-auto">
                            <div class="notification-wrap d-flex align-items-center">
                               
                                <div class="notification-item">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" id="userDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm flex-shrink-0 mr-2"><img src="<?php echo $image ?>" alt="team-img"></div>
                                                <span class="font-size-14 font-weight-bold"><?php echo $username ?></span>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-reveal dropdown-menu-md dropdown-menu-right">
                                            <div class="dropdown-item drop-reveal-header user-reveal-header">
                                                <h6 class="title text-uppercase">Welcome!</h6>
                                            </div>
                                            <div class="list-group drop-reveal-list user-drop-reveal-list">
                                                <a href="user-dashboard-profile.html" class="list-group-item list-group-item-action">
                                                    <div class="msg-body">
                                                        <div class="msg-content">
                                                            <h3 class="title"><i class="fas fa-user"></i>My Profile</h3>
                                                        </div>
                                                    </div><!-- end msg-body -->
                                                </a>
                                                <a href="user-dashboard-booking.html" class="list-group-item list-group-item-action">
                                                    <div class="msg-body">
                                                        <div class="msg-content">
                                                            <h3 class="title"><i class="fas fa-shopping-cart"></i>My Booking</h3>
                                                        </div>
                                                    </div><!-- end msg-body -->
                                                </a>
                                                <a href="user-dashboard-reviews.html" class="list-group-item list-group-item-action">
                                                    <div class="msg-body">
                                                        <div class="msg-content">
                                                            <h3 class="title"><i class="fas fa-heart"></i>My Reviews</h3>
                                                        </div>
                                                    </div><!-- end msg-body -->
                                                </a>
                                                <div class="section-block"></div>
                                                <a href="index.html" class="list-group-item list-group-item-action">
                                                    <div class="msg-body">
                                                        <div class="msg-content">
                                                            <h3 class="title"><i class="fas fa-power-off"></i>Logout</h3>
                                                        </div>
                                                    </div><!-- end msg-body -->
                                                </a>
                                            </div>
                                        </div><!-- end dropdown-menu -->
                                    </div>
                                </div><!-- end notification-item -->
                            </div>
                        </div><!-- end nav-btn -->
                    </div><!-- end menu-wrapper -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-nav -->
    <div class="dashboard-content-wrap">
        <div class="dashboard-bread dashboard--bread">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="breadcrumb-content">
                            <div class="section-heading">
                                <h2 class="sec__title font-size-30">Bookings</h2>
                            </div>
                        </div><!-- end breadcrumb-content -->
                    </div><!-- end col-lg-6 -->
                </div><!-- end row -->
            </div>
        </div><!-- end dashboard-bread -->
        <div class="dashboard-main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-box">
      
                            <div class="form-content">
                                <div class="table-form table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Room Name</th>
                                            <th scope="col">Check In</th>
                                            <th scope="col">Check Out</th>
                                            <th scope="col">Adult</th>
                                            <th scope="col">Children</th>
                                            <th scope="col">Infants</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        
                                        $sql = "SELECT * FROM `tbl_booking` ORDER BY id DESC";
                                        $run = mysqli_query($con,$sql);

                                        while($row=mysqli_fetch_array($run)){
                                            $room_Id = $row['room_Id'];
                                            $sql1 = "SELECT * FROM `tbl_room` WHERE id = '$room_Id'";
                                            $run1 = mysqli_query($con,$sql1);

                                            while($row1=mysqli_fetch_array($run1)){
                                            echo '<tr class="odd gradeX" id="rec">';?>

                                        <tr>
                                            <td><?php echo $row1['name'] ?></td>
                                            <td><?php echo $row['checkin'] ?></td>
                                            <td><?php echo $row['checkout'] ?></td>
                                            <td><?php echo $row['adult'] ?></td>
                                            <td><?php echo $row['children'] ?></td>
                                            <td><?php echo $row['infant'] ?></td>
                                            <?php if($row1['status'] == '1'){ ?>
                                            <td><span class="badge badge-warning py-1 px-2">Pending</span></td>
                                            <?php }else if($row1['status'] =='2'){ ?>
                                            <td><span class="badge badge-danger py-1 px-2">Occupied</span></td>
                                            <?php }?>

                                            <?php if($row1['status'] == '1'){ ?>
                                            <td><a href="approvebooking.php?id=<?php echo $row['id'] ?>&rid=<?php echo $room_Id?>"><span><button type="button" class="btn btn-primary">Approve booking</button></span></a></td>
                                            <?php }else if($row1['status'] =='2'){ ?>
                                            <td><a href="cancelbooking.php?id=<?php echo $row['id'] ?>&rid=<?php echo $room_Id?>"><span><button type="button" class="btn btn-danger">Cancel booking</button></span></a></td>
                                            <?php }?>
                                        </tr>

                                        <?php } }?>
                                       
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- end form-box -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
    
                <div class="border-top mt-5"></div>
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="copy-right padding-top-30px">
                            <p class="copy__desc">
                                &copy; Copyright Dissertation 2020. Made with
                                <span class="fas fa-heart"></span>
                            </p>
                        </div><!-- end copy-right -->
                    </div><!-- end col-lg-7 -->
     
                </div><!-- end row -->
            </div><!-- end container-fluid -->
        </div><!-- end dashboard-main-content -->
    </div><!-- end dashboard-content-wrap -->
</section><!-- end dashboard-area -->
<!-- ================================
    END DASHBOARD AREA
================================= -->

<!-- start scroll top -->
<div id="back-to-top">
    <i class="la la-angle-up" title="Go top"></i>
</div>
<!-- end scroll top -->

<!-- Template JS Files -->
<script src="./assets/js/jquery-3.4.1.min.js"></script>
<script src="./assets/js/jquery-ui.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/bootstrap-select.min.js"></script>
<script src="./assets/js/moment.min.js"></script>
<script src="./assets/js/daterangepicker.js"></script>
<script src="./assets/js/owl.carousel.min.js"></script>
<script src="./assets/js/jquery.fancybox.min.js"></script>
<script src="./assets/js/jquery.countTo.min.js"></script>
<script src="./assets/js/animated-headline.js"></script>
<script src="./assets/js/chart.js"></script>
<script src="./assets/js/chart.extension.js"></script>
<script src="./assets/js/bar-chart.js"></script>
<script src="./assets/js/jquery.filer.min.js"></script>
<script src="./assets/js/jquery.ripples-min.js"></script>
<script src="./assets/js/main.js"></script>
</body>
</html>