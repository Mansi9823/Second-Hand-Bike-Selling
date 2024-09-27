<?php
   include('db_conn.php');
   session_start();
   if(isset($_SESSION['admin_id'])){
        $_SESSION['auth'] = true;
         $admin_id=$_SESSION['admin_id'];
         $fetch_details = mysqli_query($conn,"SELECT * FROM admin_user WHERE email = '$admin_id' ");
         $row = mysqli_fetch_array($fetch_details,MYSQLI_ASSOC);

       $_SESSION['admin_id']= $row['email'];
       $_SESSION['admin_name'] =$row['name'];
       $_SESSION['user_type'] = $row['user_type'];
       $_SESSION['user_id']= $row['slno'];
   }
    else{
      $_SESSION['auth'] = false;
    }
    //   mysqli_close($con);
  ?>