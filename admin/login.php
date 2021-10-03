<?php
session_start();
include 'db.php';

if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    foreach (select('user', '*', "email = '$email' and password = '$password'") as $user) {
    }
    if (!empty($user)) {
        $_SESSION['_uid_'] = $user['id'];
        $_SESSION['_name_'] = $user['name'];
        header('Location: index.php');
        die();
    } else {
        echo '<script>alert("Username / Password Salah")</script>';
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Login Sistem Pembayaran SPP</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/login.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body class="text-center">
    <form class="form-signin" method="POST">
        <img class="mb-4" src="assets/book.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal mt-2">Sign in</h1>
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="signin">Sign in</button>
        <div class="g-signin2" style="padding-left: 12vh;margin-top: 25px;" data-onsuccess="onSignIn"></div>
        <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
    </form>
</body>

</html>