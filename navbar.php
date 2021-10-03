<?php

if (isset($_POST['logout'])) {
    unset($_SESSION['CUST_ID']);
    unset($_SESSION['CUST_NAME']);
}

if (isset($_POST['auth'])) {
    // handle auth 
    if (isset($_POST['type']) && $_POST['type'] == 'signin') {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        foreach (select('user', '*', "email = '$email' and password = '$password' and role = 3") as $user) {
        }
        if (!empty($user)) {
            $_SESSION['CUST_ID'] = $user['id'];
            $_SESSION['CUST_NAME'] =  $user['name'];
            header('Location: index.php');
            die();
        } else {
            echo '<script>alert("Username / Password Salah")</script>';
        }
    } else {
        // daftar
        $signup = insert('user', [
            'name' => $_POST['nama'],
            'email' => $_POST['email'],
            'password' => md5($_POST['password']),
            'nomor_hp' => $_POST['nomor_hp'],
            'role' => 3
        ]);

        foreach (select('user', '*', "id = $signup") as $user) {
        }
        if (!empty($user)) {
            $_SESSION['CUST_ID'] = $user['id'];
            $_SESSION['CUST_NAME'] =  $user['name'];
            header('Location: index.php');
            die();
        } else {
            echo '<script>alert("Singup Failed")</script>';
        }
    }
}

$isAuth = !empty($_SESSION['CUST_ID']);

?>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="index.php">Book Ticket</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <div class="d-flex">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if ($isAuth) { ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="cart.php">Keranjang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="history.php">Riwayat Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#" id="btnLogout">Logout ( <?= $_SESSION['CUST_NAME'] ?> )</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#" id="btnLogin">Login</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Modal Signin -->
<div class="modal fade" id="modalSignin" tabindex="-1" aria-labelledby="modalSigninLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSigninLabel">Signin Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <input type="hidden" value="signin" name="type">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="auth">Signin</button>
                    <button type="button" class="btn btn-primary" data-bs-target="#modalSignup" data-bs-toggle="modal" data-bs-dismiss="modal">Signup</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Signup -->
<div class="modal fade" id="modalSignup" aria-hidden="true" aria-labelledby="modalSignupLabel" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSigninLabel">Signup Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <input type="hidden" value="signup" name="type">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailSignup" name="email" required>
                        <span id="emailDuplicateWarn" style="color:red;display:none;font-size:0.8em">Email sudah terdaftar</span>
                    </div>
                    <div class="mb-3">
                        <label for="nomor_telp" class="form-label">Nomor Telp</label>
                        <input type="text" class="form-control" id="nomor_telp" name="nomor_hp" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" id="btnSubmitSignup" class="btn btn-primary" name="auth">Signup</button>
                    <button type="button" class="btn btn-primary" data-bs-target="#modalSignin" data-bs-toggle="modal" data-bs-dismiss="modal">Signin</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="" style="display: none;">
    <form action="" method="POST">
        <button type="submit" name="logout" id="btnLogoutReal"></button>
    </form>
</div>

<script>
    $('#btnLogin').on('click', function() {
        $('#modalSignin').modal('show')
    })

    $('#btnLogout').on('click', function() {
        $('#btnLogoutReal').click();
    })

    $('#emailSignup').on('change', async function() {
        const val = $('#emailSignup').val()
        const req = await fetch('api.php?type=checkEmail&param=' + val)
        const res = await req.json()
        const el = $('#emailDuplicateWarn')
        const btn = $('#btnSubmitSignup')
        if (res.success) {
            el.hide();
            btn.attr('disabled', false);
        } else {
            el.show();
            btn.attr('disabled', true);
        }
    })
</script>