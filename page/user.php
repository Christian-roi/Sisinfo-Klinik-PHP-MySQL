<?php

echo '<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Kelola Pengguna</h1>
                        </div>';


$namatabel = 'user';
$pk = 'userId';
$namafile = $namatabel . '.php';
$page = ($_GET['page'] ?? '');

$act = $_GET['act'] ?? '';
$id  = $_GET['id'] ?? '';
$where = '';
$data  = [0 => []];
if ($id != '') {
    $where = "$pk = '$id'";
    $data = select("SELECT * FROM $namatabel WHERE $where");
}

switch ($act) {
    case 'add':
    case 'edit':
        if (isset($_POST['data'])) {
            $data_post = $_POST['data'];
            if (save($namatabel, $data_post, $where)) {
                header("Location: ?page=$page");
            }
            $data[0] = $data_post;
        }
        form($data[0]);
        break;
    case 'delete':
        if ($id != '') {
            delete($namatabel, $where);
            header("Location: ?page=$page");
        }
        break;
    default:
        daftar();
        break;
}


function daftar()
{
    global $namatabel, $pk, $page;
    $data = select($namatabel);
    echo '<a href="?page=' . $page . '&act=add" class="btn btn-primary mb-3 float-right"><i class="bi bi-plus-square"></i> Tambah ' . ucwords($namatabel) . '</a>';

    tabel(
        [
            'userNama'  => 'Nama Pengguna',
            'userId' => 'Username',
            'userPassword' => 'Password',
            'userRole' => 'Jenis Akun',
        ],
        $data,
        $pk
    );
}


function form($data)
{
    global $namatabel, $act;
?>
    <form method="post" class="text-center">
        <?php
        if ($act == 'add') {
            echo '<h1 class="h2 mb-2">Tambah ' . ucwords($namatabel) . '</h1>';
        } else {
            echo '<h1 class="h2 mb-2">Edit ' . ucwords($namatabel) . '</h1>';
        }
        ?>
        <div class="mb-3 row text-center">
            <div class="form-group row mb-3">
                <label for="userNama" class="col-sm-2 col-form-label offset-2">Nama Lengkap User</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="userNama" name="data[userNama]" value="<?= $data['userNama'] ?? '' ?>">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="userRole" class="col-sm-2 col-form-label offset-2">Jenis Akun</label>
                <div class="col-sm-6">
                    <select class="form-control form-select" id="userRole" name="data[userRole]">
                        <option value="">Pilih Role</option>
                        <?php
                            $role = ['admin', 'dokter', 'pegawai', 'apoteker', 'sekuriti'];
                            foreach ($role as $r) {
                                $selected = ($data['userRole'] ?? '') == $r ? 'selected' : '';
                                echo '<option value="' . $r . '" ' . $selected . '>' . ucwords($r) . '</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="userId" class="col-sm-2 col-form-label offset-2">Username</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="userId" name="data[userId]" value="<?= $data['userId'] ?? '' ?>">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="userPassword" class="col-sm-2 col-form-label offset-2">Password</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="userPassword" name="data[userPassword]" value="<?= $data['userPassword'] ?? '' ?>">
                </div>
            </div>
            <div class="form-group row mb-3">
                <div class="col-sm-6 offset-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="?page=<?= $namatabel ?>" class="btn btn-danger">Batal</a>
                </div>
            </div>
        </div>
    </form>
<?php
}
?>