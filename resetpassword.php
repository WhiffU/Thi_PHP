<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
</head>
<?php 
    require_once "connect.php";
    $error_forgetpass = "";
    function random_pass(){
            $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); 
            $combLen = strlen($comb) - 1; 
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $combLen);
            $pass[] = $comb[$n];
        }
        return implode($pass); 
    }
    if(isset($_POST['submit'])){
        $username=htmlspecialchars($_POST['username']);
        $phone=htmlspecialchars($_POST['phone']);
        $sql = sprintf("select * from abc12users where username='%s' and phone='%s'",$username,$phone);
        $result = $conn_createdb->query($sql);
        if($result->num_rows>0){
            $new_pass = random_pass();
            $password_hash = sha1($new_pass);
            $sql =  sprintf("update abc12users set password_hash='%s' where username='%s'",$password_hash,$username);
            $result = $conn_createdb->query($sql);
            if($result){
                echo "<body>";
                echo "<p>Your new password: $new_pass</p>";
                echo "</body>";
                return;
            }
        }else{
            $error_forgetpass .= "<p>Username or phone incorrect!</p>";
        }
    }
?>
<body>
    <p>Reset password</p>
    <?php  echo $error_forgetpass; ?>
    <form action="" method="post">
        Username: <input type="text" name="username"/ required>
        <br>
        Phone: <input type="number" name="phone" required>
        <br>
        <input type="submit" value="Reset password" name="submit">
    </form>
</body>
</html>