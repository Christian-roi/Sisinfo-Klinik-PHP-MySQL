<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="card bg-primary">
            <div class="card-body">
                <?php
                $jumlah = select('pasien');
                $count = count($jumlah);
                ?>
                <h5 class="text-white font-weight-bold"><i class="bi bi-person-hearts"></i> Pasien</h5>
                <div class="h1 mb-0 text-white">
                    <span class="count"><?= $count ?></span>
                </div>
                <div class="progress progress-xs mt-3 mb-0 bg-flat-color-1" style="width: 40%; height: 5px;"></div>
            </div>
            <div class="card-footer bg-white">
                <a href="?page=pasien" class="btn btn-primary btn-block"><i class="bi bi-eye"></i> Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="card bg-success">
            <div class="card-body">
                <?php
                $jumlah = select('dokter');
                $count = count($jumlah);
                ?>
                <h5 class="text-white font-weight-bold"><i class="bi bi-heart-pulse"></i> Dokter</h5>
                <div class="h1 mb-0 text-white">
                    <span class="count"><?= $count ?></span>
                </div>
                <div class="progress progress-xs mt-3 mb-0 bg-flat-color-1" style="width: 40%; height: 5px;"></div>
            </div>
            <div class="card-footer bg-white">
                <a href="?page=dokter" class="btn btn-success btn-block"><i class="bi bi-eye"></i> Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="card bg-danger">
            <div class="card-body">
                <?php
                $jumlah = select('kegiatan');
                $count = count($jumlah);
                ?>
                <h5 class="text-white font-weight-bold"><i class="bi bi-clipboard2-pulse"></i> Layanan Kesehatan</h5>
                <div class="h1 mb-0 text-white">
                    <span class="count"><?= $count ?></span>
                </div>
                <div class="progress progress-xs mt-3 mb-0 bg-flat-color-1" style="width: 40%; height: 5px;"></div>
            </div>
            <div class="card-footer bg-white">
                <a href="?page=kegiatan" class="btn btn-danger btn-block"><i class="bi bi-eye"></i> Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="card bg-warning">
            <div class="card-body">
                <?php
                $jumlah = select('pegawai');
                $count = count($jumlah);
                ?>
                <h5 class="text-white font-weight-bold"><i class="bi bi-person-lines-fill"></i> Pegawai</h5>
                <div class="h1 mb-0 text-white">
                    <span class="count"><?= $count ?></span>
                </div>
                <div class="progress progress-xs mt-3 mb-0 bg-flat-color-1" style="width: 40%; height: 5px;"></div>
            </div>
            <div class="card-footer bg-white">
                <a href="?page=pegawai" class="btn btn-warning btn-block text-white"><i class="bi bi-eye"></i> Lihat</a>
            </div>
        </div>
    </div>
</div>