<?php

include('../../config.php');
session_start();
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // cek user
    $user = mysqli_query($connection, "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'");
    $data = mysqli_fetch_assoc($user);
    $data_id = $data["id_user"];
    if (mysqli_num_rows($user) === 1) {
        // cek level
        if ($data["level"] == "admin") {
            $_SESSION["admin"] = $username;
            $_SESSION["id_admin"] = $data_id;
            echo "
            <script>
                document.location.href = '../admin/index.php'
                alert('Login Berhasil')
            </script>
            ";
        }else if ($data["level"] == "kasir") {
            $_SESSION["kasir"] = $username;
            $_SESSION["id_kasir"] = $data_id;
            echo "
            <script>
                document.location.href = '../kasir/index.php'
                alert('Login Berhasil')
            </script>
            ";
        }else if ($data["level"] == "user") {
            $_SESSION["user"] = $username;
            $_SESSION["id_user"] = $data_id;
            echo "
            <script>
                document.location.href = './user-index.php'
                alert('Login Berhasil')
            </script>
            ";
        }
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
</head>
<body>
    <div class="container">
        <div class="gambar">
            <img src="../../img/logo1.png" alt="">
        </div>
        <div class="form">
            <form action="" method="POST" class="formLogin">

                <input type="text" name="username" class="inputUser" placeholder="Username">   
                <input type="password" name="password" class="inputUser" placeholder="Password"></br>  
                <center><button type="submit" name="submit">
                    Login
                </button></center></br>
                <a href="">View Menu</a>
                <a>|</a>
                <a href="../auth/register.php">Register</a>    

            </form>
        </div>
    </div>
</body>
</html>