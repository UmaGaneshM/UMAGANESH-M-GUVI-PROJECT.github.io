<?php
include 'insert.php';
session_start();
if(isset($_POST['submit'])){

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, md5($_POST['password']));

$select = mysqli_query($conn, "SELECT * FROM 'youtube' WHERE email = '$email' AND password = '$password'") or die('query failed');

if(mysqli_num_rows($select) > 0){
   $row = mysqli_fetch_assoc($select);
   $_SESSION['username'] = $row['username'];
   header('location:register.php');
}else{
   $message[] = 'incorrect email or password!';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign in</title>
  <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
  <style>
    .wrapper{ 
      width: 500px; 
      padding: 20px; 
    }
    .wrapper h2 {text-align: center}
    .wrapper form .form-group span {color: red;}
  </style>
</head>
<body>
  <main>
    <section class="container wrapper">
      <h2 class="display-4 pt-3">Login</h2>
          <p class="text-center">Please fill credentials to login.</p>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-group <?php (!empty($username_err))?'has_error':'';?>">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control" value="">
          
            </div>

            <div class="form-group <?php (!empty($password_err))?'has_error':'';?>">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control" value="">
              
            </div>
          </form>
    </section>
  </main>
  <div class="form-group col-lg-3 mx-auto mb-1">
    <a href="welcome.html" class="btn btn-primary btn-block py-2">

    
        <span class="font-weight-bold">login</span>

    </a>
</div>


<div class="form-group col-lg-4 mx-auto d-flex align-items-center my-4">
    <div class="border-bottom w-100 ml-5"></div>
    <span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
    <div class="border-bottom w-100 mr-5"></div>
</div>


<div class="text-center w-100">
  <p>Don't have an account? <a href="register.php">Sign in</a>.</p>
</div>

</body>
</html>