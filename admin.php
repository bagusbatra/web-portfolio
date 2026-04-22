<!-- FOR STATUS -->
 <?php
include 'config/connect.php';

// job
$data = mysqli_query($conn, "SELECT * FROM job ORDER BY id ASC LIMIT 2");

$jobs = [];
while ($row = mysqli_fetch_assoc($data)) {
    $jobs[] = $row;
}

// about
$aboutQuery = mysqli_query($conn, "SELECT * FROM about LIMIT 1");
$about = mysqli_fetch_assoc($aboutQuery);

// ambil semua status
$statusList = mysqli_query($conn, "SELECT * FROM status");

// ambil status aktif (ambil terakhir)
$currentStatus = mysqli_query($conn, "
    SELECT s.* 
    FROM user_status us
    JOIN status s ON us.status_id = s.id
    ORDER BY us.id DESC LIMIT 1
");

$current = mysqli_fetch_assoc($currentStatus);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Bagus Batara</title>
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22 fill=%22%233b82f6%22>B</text></svg>">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/modals.css">
</head>

<body class="admin-body">

    <!-- Sidebar -->
    <div class="admin-sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="index.html" class="brand">B<span>.Dev</span></a>
            <button class="btn d-lg-none text-white" id="close-sidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-view="dashboard">
                        <i class="fas fa-th-large"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-view="projects">
                        <i class="fas fa-project-diagram"></i> Manajemen Proyek
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-view="articles">
                        <i class="fas fa-newspaper"></i> Manajemen Artikel
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-view="testimonials">
                        <i class="fas fa-comment-dots"></i> Testimoni
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-view="clients">
                        <i class="fas fa-user-tie"></i> Klien
                    </a>
                </li>
                <li class="nav-item mt-auto">
                    <a class="nav-link text-danger" href="index.html">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="admin-main">
        <div class="sidebar-overlay" id="sidebar-overlay"></div>
        <!-- Top Navbar -->
        <nav class="admin-topbar">
            <div class="container-fluid d-flex align-items-center justify-content-between">
                <button class="btn text-white d-lg-none" id="toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <h4 class="mb-0 fw-bold" id="view-title">Dashboard</h4>
                <div class="admin-user d-flex align-items-center gap-3">
                    <div class="text-end d-none d-sm-block">
                        <p class="mb-0 fw-bold small"><b>Bagus Batra</b></p>
                        <p class="mb-0 smaller">Administrator</p>
                    </div>
                    <img src="https://picsum.photos/seed/admin/40/40" alt="Admin" class="rounded-circle border border-secondary">
                </div>
            </div>
        </nav>

        <!-- Content Area -->
        <div class="admin-content p-4">
            <div id="view-container">
                <!-- Dashboard View (Default) -->
                <div id="dashboard-view" class="view-section">
                    <div class="row g-4 mb-4">
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="icon bg-primary-soft"><i class="fas fa-project-diagram text-primary"></i></div>
                                <div class="data">
                                    <h3>12</h3>
                                    <p>Total Proyek</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="icon bg-success-soft"><i class="fas fa-newspaper text-success"></i></div>
                                <div class="data">
                                    <h3>24</h3>
                                    <p>Artikel Terbit</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="icon bg-warning-soft"><i class="fas fa-eye text-warning"></i></div>
                                <div class="data">
                                    <h3>123</h3>
                                    <p>Testimoni</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card">
                                <div class="icon bg-info-soft"><i class="fas fa-envelope text-info"></i></div>
                                <div class="data">
                                    <h3>8</h3>
                                    <p>Pesan Baru</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- DATA PENTING -->
                     <div class="container-fluid p-3">
                        <div class="row g-3 mt-1 mb-3">
                            <div class="col-md-6">
                                <div class="stat-card">
                                    <div class="container">
                                        <div class="row pb-4">
                                        <h3>About Me</h3>
                                        </div>

                                        <div class="row g-3">
                                        <p><?= $about['desc'] ?? 'Belum ada deskripsi' ?></p>
                                        <p><?= $about['birthday'] ? date('d F Y', strtotime($about['birthday'])) : '-' ?></p>
                                        <p><?= $about['name'] ?? '-' ?></p>
                                        <p><?= $about['address'] ?? '-' ?></p>

                                        <button class="btn btn-primary-modern" data-bs-toggle="modal" data-bs-target="#aboutModal">
                                            <i class="fas fa-pencil me-2"></i> Edit
                                        </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <div class="container">
                                        <div class="row pb-4">
                                            <h3>Status</h3>
                                        </div>
                                        <div class="row g-3">
                                            <p id="statusDisplay">
                                            <i class="fas fa-circle text-success me-2"></i>
                                            <span id="statusText">
                                                <?= $current['status'] ?? 'Belum ada status' ?>
                                            </span>
                                            </p>
                                            <button class="btn btn-primary-modern" data-bs-toggle="modal" data-bs-target="#statusModal">
                                                <i class="fas fa-pencil me-2"></i> Edit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-card">
                                    <div class="container">
                                        <div class="row pb-4">
                                            <h3>Job</h3>
                                        </div>
                                        <div class="row g-3">
                                            <p><?= $jobs[0]['name'] ?? 'Kosong'; ?></p>
                                            <p><?= $jobs[1]['name'] ?? 'Kosong'; ?></p>

                                            <button class="btn btn-primary-modern" data-bs-toggle="modal" data-bs-target="#jobModal">
                                                <i class="fas fa-pencil me-2"></i> Edit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <!-- TENGAH -->
                        <div class="row g-3 mt-1 mb-3">
                            <div class="col-md-6">
                                <?php
                                $exp = mysqli_query($conn, "SELECT * FROM experience ORDER BY start_year DESC");
                                ?>

                                <div class="stat-card">
                                    <div class="container">

                                        <!-- HEADER -->
                                        <div class="row pb-4 text-center">
                                            <h3 class="pb-3">Pengalaman Kerja</h3>

                                            <!-- FIX BUTTON -->
                                            <button class="btn btn-primary-modern" data-bs-toggle="modal" data-bs-target="#modalCreateExp">
                                                <i class="fas fa-plus me-2"></i> Tambah
                                            </button>
                                        </div>

                                        <!-- TABLE -->
                                        <div class="row g-3 table-responsive">
                                            <table class="mini-table table">
                                                <tbody>

                                                <?php while($row = mysqli_fetch_assoc($exp)) { ?>

                                                    <tr>
                                                        <td><b><?= $row['position']; ?></b></td>
                                                        <td><?= $row['company']; ?></td>

                                                        <!-- FORMAT TAHUN -->
                                                        <td>
                                                            <?= $row['start_year']; ?> - 
                                                            <?= $row['end_year'] ? $row['end_year'] : 'Sekarang'; ?>
                                                        </td>

                                                        <!-- AKSI -->
                                                        <td class="text-end">

                                                            <!-- DETAIL -->
                                                            <a data-bs-toggle="collapse" href="#exp<?= $row['id']; ?>">
                                                                <i class="fas fa-eye me-2"></i> Detail
                                                            </a>

                                                            <!-- EDIT -->
                                                            <button 
                                                            class="btn btn-warning btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalEditExp"

                                                            data-id="<?= $row['id']; ?>"
                                                            data-position="<?= $row['position']; ?>"
                                                            data-company="<?= $row['company']; ?>"
                                                            data-start="<?= $row['start_year']; ?>"
                                                            data-end="<?= $row['end_year']; ?>"
                                                            data-jobdesk="<?= $row['jobdesk']; ?>"
                                                            >
                                                            Edit
                                                            </button>

                                                            <!-- DELETE -->
                                                            <button 
                                                            class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalDeleteExp"

                                                            data-id="<?= $row['id']; ?>"
                                                            data-position="<?= $row['position']; ?>"
                                                            >
                                                            Hapus
                                                            </button>

                                                        </td>
                                                    </tr>

                                                    <!-- DETAIL COLLAPSE -->
                                                    <tr class="collapse" id="exp<?= $row['id']; ?>">
                                                        <td colspan="4">
                                                            <ul class="mb-0">
                                                            <?php
                                                            $jobs = explode(',', $row['jobdesk']);
                                                            foreach ($jobs as $job) {
                                                                echo '<li>' . trim($job) . '</li>';
                                                            }
                                                            ?>
                                                            </ul>
                                                        </td>
                                                    </tr>

                                                <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- KANAN -->
                            <div class="col-md-6">
                                <div class="stat-card">
                                     <div class="container">
                                        <div class="row pb-4 text-center">
                                            <h3 class="pb-3">Edukasi</h3>
                                            <button class="btn btn-primary-modern" data-bs-toggle="modal" data-bs-target="#educationModal">
                                                <i class="fas fa-plus me-2"></i> <a href="">Tambah</a>
                                            </button>
                                        </div>
                                        <div class="row g-3">
                                            <table class="mini-table">
                                            <tbody>
                                                <tr>
                                                    <td>Politeknik Negeri Madiun</td>
                                                    <td>3.48/4.00</td>
                                                    <td>2022 -2025</td>
                                                    <td class="text-end"><a href="#"><i class="fas fa-eye me-2"></i> Detail</a></td>
                                                </tr>
                                                <tr>
                                                    <td>SMA</td>
                                                    <td>98/100</td>
                                                    <td>2022 -2025</td>
                                                    <td class="text-end"><a href="#"><i class="fas fa-eye me-2"></i> Detail</a></td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ROW 2 (FULL WIDTH) -->
                        <div class="row g-3 mt-1">
                            <div class="col-md-5">
                                <div class="stat-card">
                                        <div class="container">
                                        <div class="row pb-4 text-center align-items-center">
                                            <div class="row m-4">
                                                <div class="col text-end">
                                                    <h3 class="pb-3">Sertifikasi</h3>
                                                </div>
                                                <div class="col text-end">
                                                    <button class="btn btn-primary-modern" data-bs-toggle="modal" data-bs-target="#createCertModal">
                                                        <i class="fas fa-plus me-2"></i> Tambah
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3">
                                            <tbody>
                                            <?php
                                            $certi = mysqli_query($conn, "SELECT * FROM certified ORDER BY id DESC");

                                            $no = 0;
                                            while ($row = mysqli_fetch_assoc($certi)) {
                                                $no++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <a data-bs-toggle="collapse" href="#cert<?= $no ?>" class="fw-bold">
                                                        <?= $row['tittle']; ?>
                                                    </a>
                                                </td>

                                                <td class="text-end">
                                                    
                                                </td>
                                            </tr>

                                            <!-- ACCORDION DETAIL -->
                                            <tr class="collapse-row">
                                                <td colspan="2" class="p-0">
                                                    <div class="collapse" id="cert<?= $no ?>">
                                                        <div class="p-3 bg-dark">

                                                            <div class="row align-items-center g-3">

                                                                <!-- IMAGE -->
                                                                <div class="col-md-4 text-center">
                                                                    <img src="assets/uploads/certified/<?= $row['img']; ?>" 
                                                                        class="img-fluid cert-img">
                                                                </div>

                                                                <!-- DETAIL -->
                                                                <div class="col-md-8">
                                                                    <h5><?= $row['tittle']; ?></h5>
                                                                    <p><strong>Issuer:</strong> <?= $row['issuer']; ?></p>
                                                                    <p><strong>Tahun:</strong> <?= $row['year']; ?></p>
                                                                    <p><strong>Kategori:</strong> <?= $row['category']; ?></p>
                                                                    <p><?= $row['desc']; ?></p>
                                                                </div>

                                                                <div class="action-btn text-end">

                                                                        <!-- EDIT -->
                                                                        <button 
                                                                        class="btn btn-warning btn-sm btn-edit"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modalEditCert"

                                                                        data-id="<?= $row['id']; ?>"
                                                                        data-tittle="<?= $row['tittle']; ?>"
                                                                        data-issuer="<?= $row['issuer']; ?>"
                                                                        data-year="<?= $row['year']; ?>"
                                                                        data-desc="<?= $row['desc']; ?>"
                                                                        data-category="<?= $row['category']; ?>"
                                                                        >
                                                                        Edit
                                                                        </button>

                                                                        <!-- DELETE -->
                                                                        <button 
                                                                        class="btn btn-danger btn-sm btn-delete"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modalDeleteCert"

                                                                        data-id="<?= $row['id']; ?>"
                                                                        data-tittle="<?= $row['tittle']; ?>"
                                                                        >
                                                                        Hapus
                                                                        </button>

                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <?php } ?>
                                            </tbody>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="stat-card">
                                     <div class="container">
                                        <div class="row pb-4 text-center">
                                            <h3 class="pb-3">Hobi</h3>
                                            <button class="btn btn-primary-modern" data-bs-toggle="modal" data-bs-target="#hobiModal">
                                                <i class="fas fa-plus me-2"></i> Tambah
                                            </button>
                                        </div>
                                        <div class="row g-3">
                                            <table class="mini-table">
                                            <tbody>
                                                <?php
                                                $hobi = mysqli_query($conn, "SELECT * FROM hobi ORDER BY id ASC");

                                                $no = 1;
                                                while ($row = mysqli_fetch_assoc($hobi)) {
                                                ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $row['name']; ?></td>
                                                    <td class="text-end">
                                                        <a href="proses/hapus_hobi.php?id=<?= $row['id']; ?>" 
                                                            onclick="return confirm('Yakin ingin menghapus hobi ini?')"
                                                            class="text-danger">
                                                            <i class="fas fa-trash me-2"></i> Hapus
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="stat-card">
                                     <div class="container">
                                        <div class="row pb-4 text-center">
                                            <h3 class="pb-3">Skill</h3>
                                            <button class="btn btn-primary-modern" data-bs-toggle="modal" data-bs-target="#skillModal">
                                                <i class="fas fa-plus me-2"></i> Tambah
                                            </button>
                                        </div>
                                        <div class="row g-3">
                                            <table class="mini-table">
                                                <tbody>
                                                <?php
                                                $skill = mysqli_query($conn, "SELECT * FROM skill ORDER BY id DESC");

                                                $no = 0;
                                                while ($row = mysqli_fetch_assoc($skill)) {
                                                    $no++;
                                                ?>
                                                <tr>
                                                    <td><?= $row['name']; ?></td>

                                                    <!-- TAG (LIMIT 3) -->
                                                    <td>
                                                        <div class="skill-wrapper">
                                                            <?php
                                                            $skills = explode(',', $row['skill']);
                                                            $limited = array_slice($skills, 0, 3);

                                                            foreach ($limited as $s) {
                                                                echo "<span class='skill-tag'>" . trim($s) . "</span>";
                                                            }

                                                            if (count($skills) > 3) {
                                                                echo "<span class='skill-more'>+" . (count($skills)-3) . "</span>";
                                                            }
                                                            ?>
                                                        </div>
                                                    </td>

                                                    <!-- DETAIL -->
                                                    <td class="text-end">
                                                        <a data-bs-toggle="collapse" href="#detail<?= $no ?>">
                                                            <i class="fas fa-eye me-2"></i> Detail
                                                        </a>
                                                    </td>
                                                </tr>

                                                <!-- ACCORDION -->
                                                <tr class="collapse-row">
                                                    <td colspan="3" class="p-0">
                                                        <div class="collapse" id="detail<?= $no ?>">
                                                            <div class="p-3 bg-dark ">

                                                                <div class="skill-wrapper mb-2">
                                                                    <?php
                                                                    foreach ($skills as $s) {
                                                                        echo "<span class='skill-tag'>" . trim($s) . "</span>";
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="text-end">
                                                                    <a href="proses/hapus_skill.php?id=<?= $row['id']; ?>"
                                                                    onclick="return confirm('Hapus data ini?')"
                                                                    class="text-danger">
                                                                    <i class="fas fa-trash me-2"></i> Hapus
                                                                    </a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                </div>

                <!-- Projects View -->
                <div id="projects-view" class="view-section d-none">
                    <div class="d-flex justify-content-between align-items-center mb-4 view-header-actions">
                        <h5 class="mb-0">Daftar Proyek</h5>
                        <div class="d-flex gap-3 view-header-actions">
                            <div class="search-box">
                                <input type="text" class="form-control admin-input py-2" placeholder="Cari proyek...">
                            </div>
                            <button class="btn btn-primary-modern" data-bs-toggle="modal" data-bs-target="#projectModal">
                                <i class="fas fa-plus me-2"></i> Tambah Proyek
                            </button>
                        </div>
                    </div>
                    <div class="admin-card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-dark-custom mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Tahun</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="projects-table-body">
                                        <!-- Data will be populated by JS -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Articles View -->
                <div id="articles-view" class="view-section d-none">
                    <div class="d-flex justify-content-between align-items-center mb-4 view-header-actions">
                        <h5 class="mb-0">Daftar Artikel</h5>
                        <div class="d-flex gap-3 view-header-actions">
                            <div class="search-box">
                                <input type="text" class="form-control admin-input py-2" placeholder="Cari artikel...">
                            </div>
                            <button class="btn btn-primary-modern" data-bs-toggle="modal" data-bs-target="#articleModal">
                                <i class="fas fa-plus me-2"></i> Tulis Artikel
                            </button>
                        </div>
                    </div>
                    <div class="admin-card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-dark-custom mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="articles-table-body">
                                        <!-- Data will be populated by JS -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonials View -->
                <div id="testimonials-view" class="view-section d-none">
                    <div class="d-flex justify-content-between align-items-center mb-4 view-header-actions">
                        <h5 class="mb-0">Daftar Testimoni</h5>
                        <button class="btn btn-primary-modern">
                            <i class="fas fa-plus me-2"></i> Tambah Testimoni
                        </button>
                    </div>
                    <div class="admin-card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-dark-custom mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Pesan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="testimonials-table-body">
                                        <!-- Data will be populated by JS -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Clients View -->
                <div id="clients-view" class="view-section d-none">
                    <div class="d-flex justify-content-between align-items-center mb-4 view-header-actions">
                        <h5 class="mb-0">Daftar Klien</h5>
                        <button class="btn btn-primary-modern" data-bs-toggle="modal" data-bs-target="#clientModal">
                            <i class="fas fa-plus me-2"></i> Tambah Klien
                        </button>
                    </div>
                    <div class="admin-card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-dark-custom mb-0">
                                    <thead>
                                        <tr>
                                            <th>Logo</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="clients-table-body">
                                        <!-- Data will be populated by JS -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Other views will be handled similarly -->
            </div>
        </div>
    </div>

    <!-- Admin Modals -->
    <!-- Edit About Modal -->
    <div class="modal fade" id="aboutModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

            <form method="POST" action="proses/update_about.php">

                <div class="modal-header">
                <h5 class="modal-title">Edit About</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control"
                    value="<?= $about['name'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="desc" class="form-control"><?= $about['desc'] ?? '' ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="birthday" class="form-control"
                    value="<?= $about['birthday'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <input type="text" name="address" class="form-control"
                    value="<?= $about['address'] ?? '' ?>">
                </div>

                </div>

                <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>

            </div>
        </div>
    </div>

        <!-- Status Modal -->
    <!-- MODAL: STATUS -->
    <div class="modal fade" id="statusModal" tabindex="-1">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="modal-title">Edit Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <form method="POST" action="proses/update_status.php">
                <div class="modal-body">
                    <select class="form-select" id="statusSelect" name="status_id">
                    <option value="">-- Pilih Status --</option>
                    <?php while($row = mysqli_fetch_assoc($statusList)): ?>
                    <option value="<?= $row['id']; ?>">
                        <?= $row['status']; ?>
                    </option>
                    <?php endwhile; ?>
                </select>
                </div>

                <!-- FOOTER -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="saveStatus">Simpan</button>
                </div>
            </form>

            </div>
        </div>
    </div>

    <!-- Job Modal -->
    <div class="modal fade" id="jobModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="proses/update_job.php" method="POST">

                <div class="modal-header">
                <h5 class="modal-title">Edit Job</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                <input type="hidden" name="id1" value="<?= $jobs[0]['id'] ?? '' ?>">
                <input type="hidden" name="id2" value="<?= $jobs[1]['id'] ?? '' ?>">

                <div class="mb-3">
                    <label>Job 1</label>
                    <input type="text" name="job1" class="form-control"
                        value="<?= $jobs[0]['name'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label>Job 2</label>
                    <input type="text" name="job2" class="form-control"
                        value="<?= $jobs[1]['name'] ?? '' ?>">
                </div>

                </div>

                <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>
            </div>
        </div>
    </div>

    <!-- Project Modal -->
    <div class="modal fade" id="projectModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah / Edit Proyek</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="projectForm">
              <div class="mb-3">
                <label class="form-label">Judul Proyek</label>
                <input type="text" class="form-control" id="projectTitle" placeholder="Masukkan judul proyek">
              </div>
              <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text" class="form-control" id="projectCategory" placeholder="Contoh: Web Development">
              </div>
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tahun</label>
                    <input type="number" class="form-control" id="projectYear" placeholder="2024">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Status</label>
                    <input type="text" class="form-control" id="projectStatus" placeholder="Published / Archived">
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>

    <!-- HOBI MODAL -->
     <div class="modal fade" id="hobiModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="proses/tambah_hobi.php" method="POST">

                <div class="modal-header">
                <h5 class="modal-title">Tambah Hobi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                <div class="mb-3">
                    <label>Nama Hobi</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                </div>

                <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>
            </div>
        </div>
    </div>

    <!-- SKILL MODAL -->
     <div class="modal fade" id="skillModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="proses/tambah_skill.php" method="POST">

                <div class="modal-header">
                <h5 class="modal-title">Tambah Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                <div class="mb-3">
                    <label>Kategori</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Frontend" required>
                </div>

                <div class="mb-3">
                    <label>Tag Skill (pisahkan dengan koma)</label>
                    <input type="text" name="skill" class="form-control" placeholder="HTML, CSS, JavaScript" required>
                </div>

                </div>

                <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>
            </div>
        </div>
    </div>

    <!-- Article Modal -->
    <div class="modal fade" id="articleModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah / Edit Artikel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="articleForm">
              <div class="mb-3">
                <label class="form-label">Judul Artikel</label>
                <input type="text" class="form-control" id="articleTitle" placeholder="Masukkan judul artikel">
              </div>
              <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text" class="form-control" id="articleCategory" placeholder="Contoh: Teknologi">
              </div>
              <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="articleDate">
              </div>
              <div class="mb-3">
                <label class="form-label">Ringkasan</label>
                <textarea class="form-control" rows="3" id="articleSummary" placeholder="Masukkan ringkasan singkat"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Client Modal -->
    <div class="modal fade" id="clientModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah / Edit Klien</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="clientForm">
              <div class="mb-3">
                <label class="form-label">Nama Perusahaan</label>
                <input type="text" class="form-control" id="clientName" placeholder="Masukkan nama perusahaan">
              </div>
              <div class="mb-3">
                <label class="form-label">URL Logo</label>
                <input type="url" class="form-control" id="clientLogo" placeholder="Masukkan URL logo">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>

    <!-- CREATE CERTIFICATE -->
    <div class="modal fade" id="createCertModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4">
        
        <div class="modal-header">
            <h5 class="modal-title">Tambah Sertifikasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <form action="proses/cert_create.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">

            <div class="row">
                <div class="col-md-6 mb-3">
                <label>Title</label>
                <input type="text" name="tittle" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                <label>Issuer</label>
                <input type="text" name="issuer" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                <label>Year</label>
                <input type="number" name="year" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                <label>Category</label>
                <input type="text" name="category" class="form-control">
                </div>

                <div class="col-md-12 mb-3">
                <label>Image</label>
                <input type="file" name="img" class="form-control">
                </div>

                <div class="col-md-12 mb-3">
                <label>Description</label>
                <textarea name="desc" class="form-control" rows="3"></textarea>
                </div>
            </div>

            </div>

            <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>

        </div>
    </div>
    </div>

    <!-- UPDATE CERTIFICATE -->
    <div class="modal fade" id="modalEditCert" tabindex="-1">
    <div class="modal-dialog">
    <div class="modal-content">

    <form action="proses/cert_update.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="id" id="edit-id">

    <div class="modal-header">
    <h5>Edit Sertifikasi</h5>
    <button class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">

    <input type="text" name="tittle" id="edit-tittle" class="form-control mb-2">
    <input type="text" name="issuer" id="edit-issuer" class="form-control mb-2">
    <input type="number" name="year" id="edit-year" class="form-control mb-2">

    <textarea name="desc" id="edit-desc" class="form-control mb-2"></textarea>

    <input type="text" name="category" id="edit-category" class="form-control mb-2">

    </div>

    <div class="modal-footer">
    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    <button class="btn btn-warning">Update</button>
    </div>

    </form>

    </div>
    </div>
    </div>

    <!-- DELETE CERTIFICATE -->
    <div class="modal fade" id="modalDeleteCert" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-3">

    <h5>Yakin hapus?</h5>
    <p id="delete-tittle"></p>

    <a href="#" id="delete-link" class="btn btn-danger">
    Hapus
    </a>

    <button class="btn btn-secondary mt-2" data-bs-dismiss="modal">
    Batal
    </button>

    </div>
    </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content text-center p-3">
          <div class="modal-body">
            <h5 class="mb-2">Yakin ingin menghapus?</h5>
            <p class="text-muted small">Data yang dihapus tidak dapat dikembalikan.</p>
          </div>
          <div class="d-flex justify-content-center gap-2 mb-3">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-danger btn-sm" id="confirmDelete">Hapus</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalCreateExp" tabindex="-1">
    <div class="modal-dialog">
    <div class="modal-content">

    <form action="proses/exp_create.php" method="POST">

    <div class="modal-header">
    <h5>Tambah Pengalaman</h5>
    <button class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">

    <input type="text" name="position" class="form-control mb-2" placeholder="Posisi" required>

    <input type="text" name="company" class="form-control mb-2" placeholder="Perusahaan" required>

    <div class="row">
        <div class="col">
            <input type="number" name="start_year" class="form-control mb-2" placeholder="Tahun Mulai" required>
        </div>
        <div class="col">
            <input type="number" name="end_year" class="form-control mb-2" placeholder="Tahun Selesai (opsional)">
        </div>
    </div>

    <textarea name="jobdesk" class="form-control mb-2" placeholder="Jobdesk" required></textarea>

    </div>

    <div class="modal-footer">
    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    <button class="btn btn-primary">Simpan</button>
    </div>

    </form>

    </div>
    </div>
    </div>


    <div class="modal fade" id="modalEditExp" tabindex="-1">
    <div class="modal-dialog">
    <div class="modal-content">

    <form action="proses/exp_update.php" method="POST">

    <input type="hidden" name="id" id="edit-id">

    <div class="modal-header">
    <h5>Edit Pengalaman</h5>
    <button class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">

    <input type="text" name="position" id="edit-position" class="form-control mb-2">

    <input type="text" name="company" id="edit-company" class="form-control mb-2">

    <div class="row">
        <div class="col">
            <input type="number" name="start_year" id="edit-start" class="form-control mb-2">
        </div>
        <div class="col">
            <input type="number" name="end_year" id="edit-end" class="form-control mb-2">
        </div>
    </div>

    <textarea name="jobdesk" id="edit-jobdesk" class="form-control mb-2"></textarea>

    </div>

    <div class="modal-footer">
    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    <button class="btn btn-warning">Update</button>
    </div>

    </form>

    </div>
    </div>
    </div>


    <div class="modal fade" id="modalDeleteExp" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center p-3">

    <h5>Yakin hapus?</h5>
    <p id="delete-position"></p>

    <a href="#" id="delete-link-exp" class="btn btn-danger">
    Hapus
    </a>

    <button class="btn btn-secondary mt-2" data-bs-dismiss="modal">
    Batal
    </button>

    </div>
    </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Admin JS -->
</body>

<script>

// ================= EDIT =================
const editModal = document.getElementById('modalEditCert');

editModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;

    document.getElementById('edit-id').value = button.getAttribute('data-id');
    document.getElementById('edit-tittle').value = button.getAttribute('data-tittle');
    document.getElementById('edit-issuer').value = button.getAttribute('data-issuer');
    document.getElementById('edit-year').value = button.getAttribute('data-year');
    document.getElementById('edit-desc').value = button.getAttribute('data-desc');
    document.getElementById('edit-category').value = button.getAttribute('data-category');
});


// ================= DELETE =================
const deleteModal = document.getElementById('modalDeleteCert');

deleteModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;

    const id = button.getAttribute('data-id');
    const tittle = button.getAttribute('data-tittle');

    document.getElementById('delete-tittle').innerText = tittle;

    document.getElementById('delete-link').href = 
        "proses/cert_delete.php?id=" + id;
});

</script>

<script>

// ================= EDIT =================
const editExp = document.getElementById('modalEditExp');

editExp.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;

    document.getElementById('edit-id').value = button.getAttribute('data-id');
    document.getElementById('edit-position').value = button.getAttribute('data-position');
    document.getElementById('edit-company').value = button.getAttribute('data-company');
    document.getElementById('edit-start').value = button.getAttribute('data-start');
    document.getElementById('edit-end').value = button.getAttribute('data-end');
    document.getElementById('edit-jobdesk').value = button.getAttribute('data-jobdesk');
});


// ================= DELETE =================
const deleteExp = document.getElementById('modalDeleteExp');

deleteExp.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;

    const id = button.getAttribute('data-id');
    const position = button.getAttribute('data-position');

    document.getElementById('delete-position').innerText = position;

    document.getElementById('delete-link-exp').href =
        "proses/exp_delete.php?id=" + id;
});

</script>

</html>
