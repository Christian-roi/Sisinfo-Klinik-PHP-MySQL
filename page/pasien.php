<?php

echo '<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Data Pasien</h1>
            </div>';

if(isset($_GET['delete'])=='success'){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data berhasil dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
}
$namatabel = 'pasien';
$pk = 'idPasien';
$namafile = $namatabel . '.php';
$page = ($_GET['page'] ?? '');


kelolafile('foto', 'foto/pasien');


$act = $_GET['act'] ?? '';
$id  = $_GET['id'] ?? '';
$where = '';
$data  = [0 => []];
if ($id != '') {
    $where = "$pk = $id";
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
            header("Location: ?page=$page&delete=success");
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
    echo '<a href="?page=' . $page . '&act=add" class="btn btn-primary mb-3"><i class="bi bi-plus-square"></i> Tambah ' . ucwords($namatabel) . '</a>';

    tabel(
        [
            'idPasien' => 'ID Pasien',
            'namaPasien'  => 'Nama Pasien',
            'golDarah' => 'Jenis Kelamin',
            'usiaPasien' => 'Usia (Tahun)',
            'beratPasien' => 'Berat (Kg)',
            'tinggiPasien' => 'Tinggi (cm)',
            'golDarah' => 'Golongan Darah',
            'foto' => ['label' => 'Foto', 'tipe' => 'img'],
        ],
        $data,
        $pk
    );
}


function form($data)
{
    global $namatabel, $act;
?>
    <form method="post" class="text-center" enctype="multipart/form-data">
        <?php
        if ($act == 'add') {
            echo '<h1 class="h2">Tambah ' . ucwords($namatabel) . '</h1>';
        } else {
            echo '<h1 class="h2">Edit ' . ucwords($namatabel) . '</h1>';
        }
        ?>
        <div class="form-group row mb-3">
            <label for="namaPasien" class="col-sm-2 col-form-label offset-2">Nama Pasien</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="namaPasien" name="data[namaPasien]" value="<?= $data['namaPasien'] ?? '' ?>">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="jkelaminPasien" class="col-sm-2 col-form-label offset-2">Jenis Kelamin</label>
            <?php
            $jkelamin = ['Pria', 'Wanita'];
            foreach ($jkelamin as $jk) {
                $checked = ($data['jkelaminPasien'] ?? '') == $jk ? 'checked' : '';
                echo ' <div class="col-sm-auto justify-content-center">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input mr-5" name="data[jkelaminPasien]" value="' . $jk . '" ' . $checked . '>' . $jk . '
                                            </label>
                                        </div>
                                    </div>';
            }
            ?>
        </div>
        <div class="form-group row mb-3">
            <label for="usiaPasien" class="col-sm-2 col-form-label offset-2">Usia Pasien</label>
            <div class="col-sm-6">
                <input type="number" min="0" class="form-control" id="usiaPasien" name="data[usiaPasien]" value="<?= $data['usiaPasien'] ?? '' ?>">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="beratPasien" class="col-sm-2 col-form-label offset-2">Berat Pasien (Kg)</label>
            <div class="col-sm-6">
                <input type="number" min="0" class="form-control" id="beratPasien" name="data[beratPasien]" value="<?= $data['beratPasien'] ?? '' ?>">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="tinggiPasien" class="col-sm-2 col-form-label offset-2">Tinggi Pasien (cm)</label>
            <div class="col-sm-6">
                <input type="number" min="0" class="form-control" id="tinggiPasien" name="data[tinggiPasien]" value="<?= $data['tinggiPasien'] ?? '' ?>">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="golDarah" class="col-sm-2 col-form-label offset-2">Golongan Darah</label>
            <div class="col-sm-6">
                <select class="form-control form-select" id="golDarah" name="data[golDarah]">
                    <option value="">Pilih Golongan Darah</option>
                    <?php
                    $golDarah = ['A', 'B', 'AB', 'O'];
                    foreach ($golDarah as $gd) {
                        $selected = ($data['golDarah'] ?? '') == $gd ? 'selected' : '';
                        echo '<option value="' . $gd . '" ' . $selected . '>' . $gd . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="foto" class="col-sm-2 col-form-label offset-2">Foto</label>
            <div class="col-sm-6">
                <input type="file" class="form-control-file" id="foto" name="foto">
            </div>
        </div>
        <div class="form-group row mb-3">
            <div class="col-sm-6 offset-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="?page=<?= $namatabel ?>" class="btn btn-danger">Batal</a>
            </div>
        </div>
    </form>
<?php
}

?>