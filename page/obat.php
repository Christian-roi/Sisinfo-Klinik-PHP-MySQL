<?php
echo '<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Data Obat</h1>
</div>';

$namatabel = 'obat';
$pk = 'idObat';
$namafile = $namatabel . '.php';
$page = ($_GET['page'] ?? '');
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
            // $data[0] = $data_post;
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
    echo '<a href="?page=' . $page . '&act=add" class="btn btn-primary mb-3"><i class="bi bi-plus-square"></i> Tambah ' . ucwords($namatabel) . '</a>';

    tabel(
        [
            'namaObat'  => 'Nama Obat',
            'jenisObat' => 'Jenis Obat',
            'hargaObat' => 'Harga Obat',
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
            <div class="form-group row mb-3">
                <label for="namaObat" class="col-sm-2 col-form-label offset-2">Nama Obat</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="namaObat" name="data[namaObat]" value="<?= $data['namaObat'] ?? '' ?>">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="jenisObat" class="col-sm-2 col-form-label offset-2">Jenis Obat</label>
                <div class="col-sm-6">
                    <select class="form-control form-select" id="jenisObat" name="data[jenisObat]">
                        <option value="">Pilih Jenis Obat</option>
                        <?php
                        $jenis = ['Tablet', 'Kapsul', 'Sirup', 'Salep/Olesan', 'Injeksi'];
                        foreach ($jenis as $jObat) {
                            $selected = ($data['jenisObat'] ?? '') == $jObat ? 'selected' : '';
                            echo "<option value='$jObat' $selected>$jObat</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="hargaObat" class="col-sm-2 col-form-label offset-2">Harga Obat</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="hargaObat" name="data[hargaObat]" value="<?= $data['hargaObat'] ?? '' ?>">
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