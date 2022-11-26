<?php

include('../../config.php');
function register($data) {
    global $connection;

    $username = $data["username"];
    $password = $data["password"];
    $status = $data["status"];

    // cek username
    $name = mysqli_query($connection, "SELECT * FROM tb_user WHERE username = '$username'");
    if(mysqli_fetch_assoc($name)) {
        echo "
        <script>
            alert('username sudah terpakai')
        </script>
        ";
        return false;
    }

    // add data ke database
    mysqli_query($connection, "INSERT INTO tb_user VALUES (
        '',
        '$username',
        '$password',
        '$status'
        )
    ");

    return mysqli_affected_rows($connection);
}

if(isset($_POST["submit"])) {
    if(register($_POST) > 0) {
        echo"
        <script>
            alert('registrasi berhasil')
            document.location.href = '../user/index.php'
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestoBakery</title>
    <link rel="stylesheet" href="../../dist/output.css">
    <link rel="shortvut icon" href="../../img/logo2.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="gambar">
            <img src="../../img/logo1.png" alt="">
        </div>
        <div class="form">
            <form method="post" action="" class="formLogin">

                <input type="hidden" name="status" value="user">
                <input type="text" name="username" id="" class="inputUser" placeholder="Username">   
                <input type="password" name="password" id="" class="inputUser" placeholder="Password"></br>  
                <center><button type="submit" name="submit">
                    Register
                </button></center></br>
                <a href="">View Menu</a>
                <a>|</a>
                <a href="../user/index.php">Login</a>    

            </form>
        </div>
    </div>
</body>
</html>