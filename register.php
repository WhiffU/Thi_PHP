<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
</head>
<?php 
    require_once "connect.php";
     $usn_errors = "";
     $psw_errors = "";
     $validated = true;
    if(isset($_POST['submit'])){
        if($_POST['username'] == '' || empty($_POST['username'])){
            $usn_errors .= "<p>Username required!</p>";
            $validated = false;
        }
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $phone = htmlspecialchars($_POST['phone']);

        //Kiem tra username ton tai chua
        $sql = sprintf("select * from abc12users where username = '%s'", $username);
        $result = $conn_createdb->query($sql);
        if($result->num_rows >0){
            $usn_errors .= "<p>Username existed!</p>";
             $validated = false;
        }  
        if($_POST['password'] == '' || empty($_POST['password'])){
            $psw_errors .= "<p>Password required!</p>";
             $validated = false;
        }
        if($validated == true){
            $password_hash=sha1($password);
            $sql=sprintf("insert into abc12users(username,password_hash,phone) values('%s','%s','%s')",$username,$password_hash,$phone);
            $result = $conn_createdb->query($sql);
            if($result===true){
                echo "<p>Register succeed!</p>";
                echo "<p>Username: $username</p>";
                echo "<p>Phone: $phone</p>";
                echo "<p><a href='login.php'>Login</a></p>";
                return;
            }else{
                echo "<p>Register failed!</p>";
            }
        }
    }
?>
<body>
    <p>Register form</p>
    <form action="" method="post">
        Username: <input type="text" name="username"/>
        <?php 
            echo $usn_errors;
        ?>
        <br>
        Password: <input type="password" name="password">
         <?php 
            echo $psw_errors;
        ?>
        <br>
        Phone: <input type="number" name="phone">
        <br>
        <input type="submit" value="Registration" name="submit">
    </form>
</body>
</html>