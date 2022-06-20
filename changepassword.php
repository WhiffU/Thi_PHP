<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
</head>
<?php 
    require_once 'connect.php';
    $error_changepass = "";
    if(isset($_POST['submit'])){
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $new_password = htmlspecialchars($_POST['new_password']);
        $password_hash = sha1($password);
        $new_password_hash = sha1($new_password);

        $sql = sprintf("select * from abc12users where username='%s' and password_hash='%s'",$username,$password_hash);
        $result = $conn_createdb->query($sql);
        if($result->num_rows>0){
            $sql = sprintf("update abc12users set password_hash = '%s' where username='%s' and password_hash='%s'",$new_password_hash,$username,$password_hash);
            $result =$conn_createdb->query($sql);
            if($result){
                echo "<body>";
                echo "<p>Your new password is: $new_password</p>";
                echo "</body>";
                return;
            }
        }else{
                 $error_changepass .= "<p>Cannot change password!</p>";
            }

    }
?>
<body>
    <p>Change password form</p>
    <?php  echo $error_changepass; ?>
    <form action="" method="post">
        Username: <input type="text" name="username"/ >
        <br>
        Current Password: <input type="password" name="password">
        <br>
        New Password: <input type="password" name="new_password">
         <br>
        <input type="submit" value="Change" name="submit">
    </form>
</body>
</html>