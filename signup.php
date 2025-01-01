<?php
include("include/config.php");
error_reporting(0);

if(isset($_POST['signup'])){
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['useremail'];
    $mobile = $_POST['usermobile'];
    $password = $_POST['loginpassword'];
    $hasedpassword = hash('sha256',$password);

    // print_r($_POST);

    $ret = "SELECT * FROM userdata WHERE (username=:uname || useremail=:uemail)";
    $queryt = $dbh -> prepare($ret);
    $queryt->bindParam(':uname',$username,PDO::PARAM_STR);
    $queryt->bindParam(':uemail',$email,PDO::PARAM_STR);
    $queryt-> execute();
    $results = $queryt -> fetchAll(PDO::FETCH_OBJ);

    if($queryt-> rowCount() == 0){
        //echo "xx";
        $sql = "INSERT INTO userdata(fullname,username,useremail,usermobile,loginpassword) VALUES (:fname,:uname,:uemail,:umobile,:upass)";
        $query = $dbh -> prepare($sql);
        $query->bindParam(':fname',$fullname,PDO::PARAM_STR);
        $query->bindParam(':uname',$username,PDO::PARAM_STR);
        $query->bindParam(':uemail',$email,PDO::PARAM_STR);
        $query->bindParam(':uname',$umobile,PDO::PARAM_STR);
        $query->bindParam(':upass',$hasedpassword,PDO::PARAM_STR);
        $query-> execute();
        $lastInsertId = $dbh->$lastInsertId();
        if($lastInsertId){
                echo "You have signup successfully";
        }else{
                echo "Have someting wrong. Please try again";
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Signup</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Stacked form</h2>
  <form action="#">
 
  <div class="form-group">
      <label for="fullname">Fullname:</label>
      <input type="text" class="form-control" id="fullname" placeholder="Enter fullname" name="fullname">
    </div>
    <div class="form-group">
      <label for="username">UserName:</label>
      <input type="text" class="form-control" id="username" placeholder="Enter UserName" name="username">
    </div>
    <div class="form-group">
      <label for="useremail">Email:</label>
      <input type="email" class="form-control" id="useremail" placeholder="Enter Email" name="useremail">
    </div>
    <div class="form-group">
      <label for="usermobile">Mobile:</label>
      <input type="usermobile" maxlength="10" pettern="{0-9}{10}" class="form-control" id="usermobile" placeholder="Enter Mobile" name="usermobile">
    </div>
    <div class="form-group">
      <label for="loginpassword">Password:</label>
      <input type="password" class="form-control" id="loginpassword" placeholder="Enter password" name="loginpassword">
    </div>
    <button type="submit" class="btn btn-success"
    name = "signup" id = "signup">Submit</button>
  </form>
</div>

</body>
</html>