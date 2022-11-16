    <?php

    echo '<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Data Pegawai</h1>
        </div>';


    $namatabel = 'pegawai';
    $pk = 'idPegawai';
    $namafile = $namatabel . '.php';
    $page = ($_GET['page'] ?? '');


    kelolafile('foto', 'foto/pegawai');


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
                'namaPegawai'  => 'Nama Pegawai',
                'idPegawai' => 'NIP Pegawai',
                'jkelaminPegawai' => 'Jenis Kelamin',
                'bagian' => 'Bagian',
                'nohpPegawai' => 'No. HP',
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
                <label for="namaPegawai" class="col-sm-2 col-form-label offset-2">Nama Pegawai</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="namaPegawai" name="data[namaPegawai]" value="<?= $data['namaPegawai'] ?? '' ?>">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="jkelaminPegawai" class="col-sm-2 col-form-label offset-2">Jenis Kelamin</label>
                <?php
                $jkelamin = ['Pria', 'Wanita'];
                foreach ($jkelamin as $jk) {
                    $checked = ($data['jkelaminPegawai'] ?? '') == $jk ? 'checked' : '';
                    echo ' <div class="col-sm-auto justify-content-center">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input mr-5" name="data[jkelaminPegawai]" value="' . $jk . '" ' . $checked . '>' . $jk . '
                                                </label>
                                            </div>
                                        </div>';
                }
                ?>
            </div>
            <div class="form-group row mb-3">
                <label for="bagian" class="col-sm-2 col-form-label offset-2">Bagian</label>
                <div class="col-sm-6">
                    <select class="form-control form-select" id="bagian" name="data[bagian]">
                        <option value="">Pilih Bagian</option>
                        <?php
                        $bagian = select("SELECT * FROM kegiatan");
                        foreach ($bagian as $b) {
                            $selected = ($data['bagian'] ?? '') == $b['namaKegiatan'] ? 'selected' : '';
                            echo '<option value="' . $b['namaKegiatan'] . '" ' . $selected . '>' . $b['namaKegiatan'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="nohpPegawai" class="col-sm-2 col-form-label offset-2">No.Hp Pegawai</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nohpPegawai" name="data[nohpPegawai]" value="<?= $data['nohpPegawai'] ?? '' ?>">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="nipPegawai" class="col-sm-2 col-form-label offset-2">Foto</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" id="foto" name="foto">
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
