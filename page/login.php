<?php

include_once('config.php');

if (isset($_SESSION['nama']) && $_SESSION['nama'] != '') {
    echo '<h5>Role Anda adalah ' . ucwords($_SESSION['role']) . '</h5>';
} else {
    login();
}

function login()
{
    global $mysqli;
    $pesan = '';
    if (isset($_POST['data'])) {
        $data = $_POST['data'] ?? [];
        $username = $mysqli->real_escape_string($data['username']);
        $pass = $mysqli->real_escape_string($data['password']);
        $sql = "SELECT * FROM user WHERE userId = '$username' AND userPassword = '$pass'";
        $user = select($sql);
        if (count($user) > 0) {
            if ($user[0]['userId'] == $username && $user[0]['userPassword'] == $pass) {
                $_SESSION['nama'] = $user[0]['userNama'];
                $_SESSION['role'] = $user[0]['userRole'];
                header('Location: ?page=home');
            }
        } else {
            $pesan = 'Username atau Password salah';
        }
    }

?>
    <style>
        .form-signin {
            width: 50%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
    <div class="container">
        <div class="card bg-light mt-5" style="max-width:700px; margin:auto">
            <div class="card-body">
                <?php
                if ($pesan != '') {
                    echo '<div class="alert alert-danger" role="alert">' . $pesan . '</div>';
                }
                ?>
                <form class="form-signin mt-5" method="POST">
                    <h1 class="h3 mb-3 font-weight-normal text-center">Silahkan Login</h1>
                    <div class="form-group">
                        <label for="inputEmail" class="sr-only mb-2">Username</label>
                        <input name="data[username]" type="text" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword" class="sr-only mt-3">Password</label>
                        <input name="data[password]" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-md btn-primary btn-block" type="submit">Log In</button>
                        </div>
                        <div class="col-md-6">
                            <p class="mt-2">
                                Atau <a href="?page=registrasi">Registrasi disini</a>
                            </p>
                        </div>
                    </div>
                    <p class="mt-2 mb-3 text-muted">&copy; <?= date('Y') ?></p>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>