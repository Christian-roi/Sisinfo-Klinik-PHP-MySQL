<?php

include_once('config.php');

global $mysqli;
$pesan = '';
$data = $_POST['data'] ?? [];
if(isset($data['userId']) && isset($data['userPassword']) && isset($data['userNama']) && isset($data['userRole'])){
    $usernama  = $data['userId'] ?? '';
    $cek = select('SELECT userId FROM user WHERE userId = "'.$usernama.'"');
    if(count($cek) > 0){
        $pesan = 'Maaf, Username sudah digunakan';
    }else{
        $konfirmasi = $_POST['konfirmasi'] ?? '';
        if($konfirmasi == $data['userPassword']){
            if(save('user', $data)){
                header('Location: ?page=login');
            }else{
                $pesan = 'Registrasi gagal';
            }
        }else{
            $pesan = 'Maaf, Password dan Konfirmasi Password tidak sama';
        }
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
                <h1 class="h3 mb-3 font-weight-normal text-center">Registrasi Akun</h1>
                <div class="form-group">
                    <label for="inputEmail" class="sr-only mb-2">Nama Lengkap</label>
                    <input name="data[userNama]" type="text" id="inputNama" class="form-control" placeholder="Nama Lengkap" required autofocus>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="sr-only mt-3">Username</label>
                    <input name="data[userId]" type="text" id="inputUsername" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="inputRole" class="sr-only mt-3">Jenis Pengguna</label>
                    <select name="data[userRole]" id="inputRole" class="form-control form-select" required>
                        <option value="">Pilih Jenis Pengguna</option>
                        <option value="dokter">Dokter</option>
                        <option value="pegawai">Pegawai</option>
                        <option value="apoteker">Apoteker</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only mt-3">Password</label>
                    <input name="data[userPassword]" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only mt-3">Konfirmasi Password</label>
                    <input name="konfirmasi" type="password" id="inputPassword" class="form-control" placeholder="Konfirmasi Password" required>
                </div>
                <button class="btn btn-md btn-primary btn-block" type="submit">Sign Up</button>
                <p class="mt-2 mb-3 text-muted">&copy; <?= date('Y') ?></p>
            </form>
        </div>
    </div>
</div>