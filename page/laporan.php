<?php
echo '<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Laporan Medis</h1>
    </div>';


$namatabel = 'laporan';
$pk = 'idLaporan';
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
    echo '<a href="?page=' . $page . '&act=add" class="btn btn-primary mb-3"><i class="bi bi-plus-square"></i> Tambah ' . ucwords($namatabel) . '</a>';

    tabel(
        [
            'idLaporan'  => 'ID Laporan',
            'tglLaporan'  => 'Tanggal Pemeriksaan',
            'namaPasien' => 'Nama Pasien',
            'namaDokter'  => 'Dokter Pemeriksa',
            'namaKegiatan'  => 'Kegiatan',
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
                    <select class="form-control form-select" data-live-search="true" id="namaPasien" name="data[namaPasien]" required>
                        <option value="">Pilih Pasien</option>
                        <?php
                        $data_pasien = select('pasien');
                        foreach ($data_pasien as $pasien) {
                            $selected = ($data['namaPasien'] ?? '') == $pasien['namaPasien'] ? 'selected' : '';
                            echo '<option value="' . $pasien['namaPasien'] . '" ' . $selected . '>' . $pasien['namaPasien'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="namaDokter" class="col-sm-2 col-form-label offset-2">Dokter Pemeriksa</label>
                <div class="col-sm-6">
                    <select class="form-control form-select" id="namaDokter" name="data[namaDokter]" required>
                        <option value="">Pilih Dokter</option>
                        <?php
                        $data_dokter = select('dokter');
                        foreach ($data_dokter as $dokter) {
                            $selected = ($data['namaDokter'] ?? '') == $dokter['namaDokter'] ? 'selected' : '';
                            echo '<option data-tokens="' . $dokter['namaDokter'] . '" value="' . $dokter['namaDokter'] . '" ' . $selected . '>' . $dokter['namaDokter'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="tglLaporan" class="col-sm-2 col-form-label offset-2">Tanggal Pemeriksaan</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="tglLaporan" name="data[tglLaporan]" value="<?= $data['tglLaporan'] ?? '' ?>" required>
                </div>
            </div>
            <?php
                if (isset($data['namaDokter'])) {
                    $nmdokter = $data['namaDokter'] ?? '';
                    $bagian = select('SELECT * FROM dokter WHERE namaDokter = "' . $nmdokter . '"') ?? [];
                    $kegiatan = $bagian[0]['bagian'] ?? '';
                    $data['namaKegiatan'] = $kegiatan;
                    execute('UPDATE laporan SET namaKegiatan = "' . $kegiatan . '" WHERE namaDokter = "' . $nmdokter . '"');
                }
            ?>
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
