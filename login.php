<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
<?php 
    require_once "connect.php";
    session_start();
    $error_login ="";
    if(isset($_POST['submit'])){
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $password_hash = sha1($password);
        $sql = sprintf("select * from abc12users where username='%s' and password_hash='%s'",$username,$password_hash);
        $result=$conn_createdb->query($sql);
        // if($result->error){
        //     echo $result->error;
        // }
        if($result->num_rows>0){
            $_SESSION['username'] = $username;
            header('Location: login.php');
        }else{
            $error_login .= "<p>Username or password invalid!</p>";
        }
    }
  
?>
<body>
    <?php
        if(!isset($_SESSION['username'])){
    ?>
    <p>Login form</p>
    <form action="" method="post">
     Username: <input type="text" name="username"/>
    <br>
    Password: <input type="password" name="password">
    <br>
    <input type="submit" value="Login" name="submit">
    <?php
        echo $error_login; 
        
    ?>
    </form>
    <?php
        }else{
            echo "<p>Welcome, $_SESSION[username]</p>";
            // session_unset();
            // echo "<p><a href='login.php'>Log out</a></p>";
        }
    ?>
   
   
</body>
</html>