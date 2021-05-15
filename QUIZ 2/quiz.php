<?php
session_start();
$server = "localhost";
$user = "root";
$pass = "";
$database = "quiz";

$conn = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($conn));

$show = mysqli_query($conn, "SELECT * from login limit 0, 10");
echo "ID".'  '."Username".'  '."Password". '<br/>';
while($data = mysqli_fetch_array($show)) {
    echo $data['id']. '.   '. $data['username']. '    '. $data['password']. '<br/>';
}

if( isset($_COOKIE['id']) && isset($_COOKIE['user']) ) {
    $id = $_COOKIE['id'];
    $user = $_COOKIE['user'];

    $result = mysqli_query($conn, "SELECT username from user where id = '$id'");
    $row = mysqli_fetch_assoc($result);

    if( $user === hash('sha256', $row['username']) ) {
        $_SESSION['login'] = true;
    }
}
if( isset($_SESSION["login"]) ){
    header("Location: index.php");
    exit;
}

if( isset($_POST["login"]) ) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * from login where username = '$username'");
    if( mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if( $password == $row["password"]) {
            $_SESSION["login"] = true;

            if( isset($_POST['ingat']) ) {
                setcookie('id', $row['id'], time() + (86400 * 30));
                setcookie('user', hash('sha256', $row['username']), time() + (86400 * 30));
            }
            header("Location: index.php");
            exit;
        }
        else {
            echo "<script> alert('Username and password is invalid.'); document.location='quiz.php'; </script>";
        }
    }
    else {
        echo "<script> alert('Username and password is invalid.'); document.location='quiz.php'; </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <title>QUIZ Pemrograman Website</title>
</head>
<body>

    <div class="container">
        <h1 class="text-center">Login</h1>
        <!-- Form  log in -->
        <div class="card " style="width: 25rem;">
            <div class="card-body">
              <form action="index.php">
                  <div class="mb-3">
                    <label for="uname">Username</label><br>
                    <input type="text" name="username" id="uname" class="form-control" placeholder="Masukkan username">
                  </div>
                  <div class="mb-3">
                      <label for="pass" class="form-label">Password</label>
                      <input type="password" class="form-control" name="password" placeholder="Masukkan password" id="pass">
                  </div>
                  <div class="mb-3 form-check">
                      <input type="checkbox" name="ingat" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                  <button type="submit" name="login" class="btn btn-primary" >Log In</button>
               </form>
            </div>
        </div>
    </div>

</body>
</html>
