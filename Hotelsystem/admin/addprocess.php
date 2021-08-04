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
 extract($_POST);

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


 if(isset($adduser)){

if (isset($_FILES['file']))
  {
    $url = "../images/placeholder.webp";
    // get details of the uploaded file
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // sanitize file-name
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    // check if file has one of the following extensions
    $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');

    if (in_array($fileExtension, $allowedfileExtensions))
    {
      // directory in which the uploaded file will be moved
      $uploadFileDir = './gallery/';
      $dest_path = $uploadFileDir . $newFileName;
      
      $pt = $_SERVER['REQUEST_URI']; 

      $pt = explode('/', $pt);
      
      $dpt = $pt[1];
       
      $uploadFileDi =  "./$dpt/gallery/";
      $dest_pat = $uploadFileDi . $newFileName;
      
      
      
        $repl = substr($dest_pat, 1);
        
        $basename = "http://" . $_SERVER['SERVER_NAME'];
        
   
        $url = $basename.$repl;

      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        $message ='File is successfully uploaded.';
      }
      else 
      {
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
      }
    }
    else
    {
      $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    }
  }
  else
  {
      
   
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
  }

  $name = str_replace("'","`",$name); 
  $name = mysqli_real_escape_string($con,$name);
  
  $email = str_replace("'","`",$email); 
  $email = mysqli_real_escape_string($con,$email); 
          
  $username = str_replace("'","`",$username); 
  $username = mysqli_real_escape_string($con,$username); 
  
  $password = str_replace("'","`",$password); 
  $password = mysqli_real_escape_string($con,$password);
  $password = md5($password);

  $sqll = "SELECT * FROM tbl_user WHERE username='$username'";
    $runn = mysqli_query($con,$sqll);

    if (mysqli_num_rows($runn) > 0){
            echo '<script language="javascript">';
            echo 'alert("Usersname already exists, please try again with another one")';
            echo '</script>';
            echo '<meta http-equiv="refresh" content="0;url=index.php" />';
        
    }

    else{

    $sql ="INSERT INTO tbl_user(fname, email, username, password, usertype, image) VALUES ('$name','$email','$username','$password', '$usertype', '$url')";
    $run = mysqli_query($con,$sql);

    if($run==true)
    {
        echo '<script language="javascript">';
        echo 'alert("User Successfully Added")';
        echo '</script>';
        echo '<meta http-equiv="refresh" content="0;url=users.php" />';
    } else{
        
        echo '<script language="javascript">';
        echo 'alert("Adding User Failed!!!")';
        echo '</script>';
        echo '<meta http-equiv="refresh" content="0;url=adduser.php" />';
    }

    }


 } 

 
 else if(isset($addroom)){

  $countfiles = count($_FILES['file']['name']);

  $sql ="INSERT INTO tbl_room(name, description, price, services, amenities, status) VALUES ('$roomname','$content', '$price','$services','$amenities', '0')";
  $run = mysqli_query($con,$sql);

  for($i=0;$i<$countfiles;$i++){
    $filename = $_FILES['file']['name'][$i];
   
    move_uploaded_file($_FILES['file']['tmp_name'][$i],'./gallery/'.$filename);

    $basename = "http://" . $_SERVER['SERVER_NAME'];

    $url = $basename. "/admin/gallery/".$filename;

      $sqll = "SELECT * FROM tbl_room ORDER BY id DESC LIMIT 1";
      $runn = mysqli_query($con,$sqll);
      $array = mysqli_fetch_array($runn);

      $rmid = $array['id'];

      $sql1 ="INSERT INTO tbl_roomimages(room_Id, image) VALUES ('$rmid','$url')";
      $run1 = mysqli_query($con,$sql1);

     
   }

   if($run==true)
   {
       echo '<script language="javascript">';
       echo 'alert("Room Successfully Added")';
       echo '</script>';
       echo '<meta http-equiv="refresh" content="0;url=rooms.php" />';
   } else{
       
       echo '<script language="javascript">';
       echo 'alert("Adding Room Failed!!!")';
       echo '</script>';
       echo '<meta http-equiv="refresh" content="0;url=addroom.php" />';
   }



 }


 else if(isset($bookroom)){


  $sql ="INSERT INTO tbl_booking(room_Id, user_Id, checkin, checkout, adult, children, infant) VALUES ('$room_Id', '$user_Id','$checkin', '$checkout','$adult','$children', '$infant')";
  $run = mysqli_query($con,$sql);

  $sql1 = "UPDATE tbl_room SET status='2' WHERE id='$room_Id'";
  $run1 = mysqli_query($con,$sql1);


   if($run1==true)
   {
       echo '<script language="javascript">';
       echo 'alert("Room Successfully Booked")';
       echo '</script>';
       echo '<meta http-equiv="refresh" content="0;url=bookings.php" />';
   } else{
       
    header("Location:./bookroom.php?id=".$room_Id);
   }



 }
 

  ?>