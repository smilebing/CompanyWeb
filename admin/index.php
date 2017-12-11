<?php
/**
 * Created by PhpStorm.
 * User: zhuda
 * Date: 2017/10/20
 * Time: 22:25
 */
?>

<?php
session_start();
if (isset($_SESSION['user_account'])) {
    header('Location:Home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- CSS -->
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/supersized.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/limonte-sweetalert2/6.10.1/sweetalert2.min.css">

    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.bootcss.com/limonte-sweetalert2/6.10.1/sweetalert2.min.js"></script>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <![endif]-->

</head>

<body style="background-color: #265a88">

<div class="page-container">
    <h1>Login</h1>
    <input type="text" id="username" class="username" placeholder="Username">
    <br>
    <input type="password" id="password" class="password" placeholder="Password">
    <br>
    <button onclick="login()">Sign in</button>
</div>

<!-- Javascript -->
<script src="../js/jquery-3.2.1.min.js"></script>


</body>

</html>

<script>
    function login() {
        var username = $("#username").val().trim();
        var password = $("#password").val().trim();

        if (username.length == 0 || password.length === 0) {
            swal({
                text: "请输入用户名和密码",
                type: "error",
                timer: 3000
            });
            return;
        }

        $.post('login.php', {'username': username, 'password': password}, function (data) {
            if (data.result === true) {
               window.location.href = "Home.php";
            }
            else {
                swal({
                    text: "用户名或者密码错误",
                    type: "error",
                    timer: 3000
                });
            }
        });
    }
</script>