<?php
   $showAlert = false;
   $showError = false;
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $email=$_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $exists=false;
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn,$existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows>0){
      // $exists = true;
      $showError = "Email Already Exists ";
    }
    else{
          // $exists=false;
        if(($password == $cpassword)){
          $hash = password_hash($password, PASSWORD_DEFAULT);
          $sql = "INSERT INTO `person` (`username`, `email`, `password`, `dt`) VALUES ('$username' , '$email', '$hash', current_timestamp());";
          $result = mysqli_query($conn,$sql);
          if($result){
            $showAlert = true; 
          }
        }
        else{
          $showError = "Passwords do not match  ";
        }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ddd4d4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h1 {
            font-family:'Amita', cursive;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            margin-top:5px;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        a {
            display: block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php

if ($showAlert) {
  // Signup successful
  echo "<script>alert('Signup successful! You can now log in.'); window.location.href = 'login.php';</script>";
}
if($showError){
echo "<script>alert('.$showError. Please try again.');</script>";
}
?>
    <div class="container">
      <h1 class="text-center">Signup to our website</h1>

        <form action="/food/signup.php" method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" maxlength="20" class="form-control" id="username" name="username" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" maxlength="20" class="form-control" id="email" name="email" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" maxlength="20" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
          <label for="cpassword">Confirm Password</label>
          <input type="password" class="form-control" id="cpassword" name="cpassword">
          <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
        </div>
        
        <button type="submit" class="btn btn-primary">Signup</button>
        </form>
        <a href="/food/login.php">Already have an account? Login</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
</body>
</html>

