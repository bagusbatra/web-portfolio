<!-- FOR STATUS -->
 <?php
include 'config/connect.php';

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

<div id="modal-container"></div>

<script>
  fetch("modals.html")
    .then(res => res.text())
    .then(data => {
      document.getElementById("modal-container").innerHTML = data;
    });
</script>

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
                                            <p>Deskripsi</p>
                                            <p>15 Maret 2002</p>
                                            <p>Bagus Batra Buana Hadi Is, A.Md.Kom</p>
                                            <p>Address</p>
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
                                            <p>Pekerjaan 1</p>
                                            <p>Pekerjaan 2</p>
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
                                <div class="stat-card">
                                     <div class="container">
                                        <div class="row pb-4 text-center">
                                            <h3 class="pb-3">Pengalaman Kerja</h3>
                                            <button class="btn btn-primary-modern" data-bs-toggle="modal" data-bs-target="#experienceModal">
                                                <i class="fas fa-plus me-2"></i> <a href="">Tambah</a>
                                            </button>
                                        </div>
                                        <div class="row g-3">
                                            <table class="mini-table">
                                            <tbody>
                                                <tr>
                                                    <td>Pekerjaan 1</td>
                                                    <td>2022 -2025</td>
                                                    <td class="text-end"><a href="#"><i class="fas fa-eye me-2"></i> Detail</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Pekerjaan 2</td>
                                                    <td>2022 -2025</td>
                                                    <td class="text-end"><a href="#"><i class="fas fa-eye me-2"></i> Detail</a></td>
                                                </tr>
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
                                                    <td>Kuliah</td>
                                                    <td>2022 -2025</td>
                                                    <td class="text-end"><a href="#"><i class="fas fa-eye me-2"></i> Detail</a></td>
                                                </tr>
                                                <tr>
                                                    <td>SMA</td>
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
                                                    <button class="btn btn-primary-modern">
                                                        <i class="fas fa-plus me-2"></i> <a href="">Tambah</a>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row g-3">
                                            <table class="certificate text-center">
                                                <thead>
                                                    <tr>
                                                        <td>Sertifikasi</td>
                                                        <td>Aksi</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Web Programming</td>
                                                        <td>
                                                            <a href=""> <i class="fas fa-eye me-2"></i></a>
                                                            <a href=""> <i class="fas fa-pencil me-2"></i></a>
                                                            <a href=""> <i class="fas fa-trash me-2"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Web Programming</td>
                                                        <td>
                                                            <a href=""> <i class="fas fa-eye me-2"></i></a>
                                                            <a href=""> <i class="fas fa-pencil me-2"></i></a>
                                                            <a href=""> <i class="fas fa-trash me-2"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="stat-card">
                                     <div class="container">
                                        <div class="row pb-4 text-center">
                                            <h3 class="pb-3">Hobi</h3>
                                            <button class="btn btn-primary-modern">
                                                <i class="fas fa-plus me-2"></i> <a href="">Tambah</a>
                                            </button>
                                        </div>
                                        <div class="row g-3">
                                            <table class="mini-table">
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Traveling</td>
                                                    <td class="text-end"><a href=""><i class="fas fa-eye me-2"></i> Detail</a></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Fotografi</td>
                                                    <td class="text-end"><a href=""><i class="fas fa-eye me-2"></i> Detail</a></td>
                                                </tr>
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
                                            <button class="btn btn-primary-modern">
                                                <i class="fas fa-plus me-2"></i> <a href="">Tambah</a>
                                            </button>
                                        </div>
                                        <div class="row g-3">
                                            <table class="mini-table">
                                            <tbody>
                                                <tr>
                                                    <td>Front End</td>
                                                    <td>
                                                        <div class="skill-wrapper">
                                                            <span class="skill-tag">HTML</span>
                                                            <span class="skill-tag">CSS</span>
                                                            <span class="skill-tag">JS</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-end"><a href=""><i class="fas fa-eye me-2"></i> Detail</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Back End</td>
                                                    <td>
                                                        <div class="skill-wrapper">
                                                            <span class="skill-tag">PHP</span>
                                                            <span class="skill-tag">CSS</span>
                                                            <span class="skill-tag">JS</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-end"><a href=""><i class="fas fa-eye me-2"></i> Detail</a></td>
                                                </tr>
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
    <div class="modal fade" id="aboutModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit About</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="aboutForm">
              <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" id="aboutName" placeholder="Masukkan nama">
              </div>
              <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" rows="4" id="aboutDesc" placeholder="Masukkan deskripsi singkat"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="saveAbout">Simpan</button>
          </div>
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
    <div class="modal fade" id="jobModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Job</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="jobForm">
              <div class="mb-3">
                <label class="form-label">Pekerjaan</label>
                <input type="text" class="form-control" id="jobTitle" placeholder="Masukkan nama pekerjaan">
              </div>
              <div class="mb-3">
                <label class="form-label">Detail</label>
                <textarea class="form-control" rows="3" id="jobDetail" placeholder="Masukkan deskripsi pekerjaan"></textarea>
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

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Admin JS -->
</body>
</html>
