<?php
include("page/config.php");
include_once("include/header.php");
$link = [
    ['label' => 'Home', 'url' => '?page=home'],
    ['label' => 'Pasien', 'url' => '?page=pasien'],
    ['label' => 'Dokter', 'url' => '?page=dokter'],
    ['label' => 'Pegawai', 'url' => '?page=pegawai'],
    ['label' => 'Kegiatan', 'url' => '?page=kegiatan'],
    ['label' => 'Laporan', 'url' => '?page=laporan'],
    ['label' => 'Obat', 'url' => '?page=obat'],
    ['label' => 'User', 'url' => '?page=user'],
];

$acl = [
    'admin' => [
        'home' => ['daftar'],
        'pasien' => ['edit', 'delete', 'add', 'daftar'],
        'dokter'  => ['edit', 'delete', 'add', 'daftar'],
        'pegawai' => ['edit', 'delete', 'add', 'daftar'],
        'kegiatan' => ['edit', 'delete', 'add', 'daftar'],
        'laporan' => ['edit', 'delete', 'add', 'daftar'],
        'obat' => ['edit', 'delete', 'add', 'daftar'],
    ],
    'dokter' => [
        'home' => ['daftar'],
        'pasien' => ['daftar'],
        'dokter' => ['daftar'],
        'kegiatan' => ['daftar'],
        'laporan' => ['daftar', 'add', 'edit', 'delete'],
        'obat' => ['daftar'],
    ],
    'pegawai' => [
        'home' => ['daftar'],
        'pasien' => ['daftar', 'add', 'edit'],
        'kegiatan' => ['daftar'],
        'laporan' => ['daftar', 'add'],
        'obat' => ['daftar'],
    ],
    'apoteker' => [
        'home' => ['daftar'],
        'pasien' => ['daftar'],
        'laporan' => ['daftar'],
        'obat' => ['daftar', 'add', 'edit', 'delete'],
    ],
    'sekuriti' => [
        'home' => ['daftar'],
        'user' => ['edit', 'delete', 'add', 'daftar'],
    ],
];
?>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">KlinikKu</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav px-3">
            <?php
            if (isset($_SESSION['nama']) != '') {
            ?>
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="?page=logout">
                        Sign Out (<?php echo $_SESSION['nama']; ?>)</a>
                </li>
            <?php
            } else {
            ?>
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="?page=login">Log In</a>
                </li>
            <?php
            }
            ?>
        </ul>
    </nav>

    <div class="container-fluid">
        <?php
        $page = $_GET['page'] ?? '';
        $filename = "page/$page.php";
        if (!empty($_SESSION['nama'])) {
        ?>
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="sidebar-sticky pt-3">
                        <ul class="nav flex-column">
                            <?php
                            $user = $_SESSION['role'];
                            $tmpl = '
                                        <li class="nav-item">
                                            <a class="nav-link" href="%s">%s</a>
                                        </li>
                                    ';
                            switch ($user) {
                                case 'admin':
                                    foreach ($link as $key => $value) {
                                        if (array_key_exists(strtolower($value['label']), $acl['admin'])) {
                                            printf($tmpl, $value['url'], $value['label']);
                                        }
                                    }
                                    break;
                                case 'dokter':
                                    foreach ($link as $key => $value) {
                                        if (array_key_exists(strtolower($value['label']), $acl['dokter'])) {
                                            printf($tmpl, $value['url'], $value['label']);
                                        }
                                    }
                                    break;
                                case 'pegawai':
                                    foreach ($link as $key => $value) {
                                        if (array_key_exists(strtolower($value['label']), $acl['pegawai'])) {
                                            printf($tmpl, $value['url'], $value['label']);
                                        }
                                    }
                                    break;
                                case 'apoteker':
                                    foreach ($link as $key => $value) {
                                        if (array_key_exists(strtolower($value['label']), $acl['apoteker'])) {
                                            printf($tmpl, $value['url'], $value['label']);
                                        }
                                    }
                                    break;
                                case 'sekuriti':
                                    foreach ($link as $key => $value) {
                                        if (array_key_exists(strtolower($value['label']), $acl['sekuriti'])) {
                                            printf($tmpl, $value['url'], $value['label']);
                                        }
                                    }
                                    break;
                            }
                            ?>
                        </ul>
                </nav>

                <?php
                ob_start();
                $page = ($_GET['page'] ?? '');
                $act = ($_GET['act'] ?? 'daftar');
                $role = ($_SESSION['role'] ?? '');
                $filename = "page/$page.php";
                if (is_file($filename)) {
                    $akses = ($acl[$role]) ?? []; //Cek akses pada role acl => $acl['member']
                    $pages = ($akses[$page]) ?? []; //Cek page dan act pada role acl => $acl['member']['stokbarang']
                    if (!empty($akses) && !empty($pages) && in_array($act, $pages)) {
                        include_once($filename);
                    } else {
                        echo '<div class="alert alert-danger mt-4">
                                    <h4>Akses Ditolak</h4>
                                    <p><i class="bi bi-exclamation-circle"></i> Anda tidak memiliki akses terhadap Halaman ini.</p>
                            </div>';
                        // print_r($akses);
                        // print_r($pages);
                        if ($page == 'logout') {
                            include_once($filename);
                        }
                    }
                }
                $content = ob_get_contents();
                ob_end_clean();
                ?>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 offset-2">
                    <?php
                    echo $content;
                    ?>
                </main>
            </div>
        <?php
        } elseif (empty($_SESSION['nama']) && $page == 'login') {
            include_once('page/login.php');
        } elseif (empty($_SESSION['nama']) && $page == 'registrasi') {
            include_once('page/registrasi.php');
        } else {
        ?>
            <!-- Isi halaman awal -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="jumbotron mt-5">
                            <h1 class="display-4">Selamat Datang</h1>
                            <p class="lead">Sistem Informasi KlinikKu</p>
                            <hr>
                            <p class="lead">
                                Jika anda belum memiliki akun, silahkan <strong><a href="?page=registrasi" class="btn btn-outline-info">Registrasi</a></strong> terlebih dahulu.
                            </p>
                            <p class="lead">
                                Jika anda sudah memiliki akun, silahkan <strong><a href="?page=login" class="btn btn-outline-primary">Login</a></strong> .
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <?php
    include_once('include/footer.php');
    ?>