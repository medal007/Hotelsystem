<?php
 // starting the session
  session_start();
  if (isset($_SESSION['username'])&&$_SESSION['username']!=""&&$_SESSION['usertype']=="0"){
       
  }
  else
  {
   header("Location:./login.php");
  }
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

  if($_GET['id'])
  {
  $id = $_GET['id'];
    
    $sql = "DELETE FROM tbl_roomimages WHERE room_Id ='$id'";
    $sql1 = "DELETE FROM tbl_room WHERE id ='$id'";
    $sql2 = "DELETE FROM tbl_booking WHERE room_Id ='$id'";

   mysqli_query( $con,$sql);
   mysqli_query( $con,$sql1);
   mysqli_query( $con,$sql2);
   
      echo '<script language="javascript">';
      echo 'alert("Data Deleted Successfully")';
      echo '</script>';
      header("Location:rooms.php");
  }

 ?>