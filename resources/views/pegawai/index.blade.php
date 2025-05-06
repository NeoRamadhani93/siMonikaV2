<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Pegawai - siMonika</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- Toastr & SweetAlert2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <!-- Sidebar -->
    @include('templates.sidebar')

    <!-- Main Content -->
    <div class="main-content p-4">
        <div class="container-fluid">
            <!-- Header with Stats -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm animate__animated animate__fadeIn">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h2 class="mb-1" style="color: black; font-weight: normal;">Kelola Pegawai</h2>
                                    <p class="text-muted">Manajemen data pegawai dan informasinya</p>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <button id="btnCreate" class="btn btn-primary shadow-sm" onclick="openCreateModal()">
                                        <i class="bi bi-plus-lg me-1"></i> Tambah Pegawai
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm bg-primary bg-gradient text-white mb-3 animate__animated animate__fadeIn animate__delay-1s">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Total Pegawai</h6>
                                    <h2 class="mt-2 mb-0">{{ $pegawai->count() }}</h2>
                                </div>
                                <div class="fs-1 opacity-50">
                                    <i class="bi bi-people"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm bg-success bg-gradient text-white mb-3 animate__animated animate__fadeIn animate__delay-2s">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Active Projects</h6>
                                    <h2 class="mt-2 mb-0">{{ $pegawai->flatMap->linimasa->where('status_proyek', 'in_progress')->count() }}</h2>
                                </div>
                                <div class="fs-1 opacity-50">
                                    <i class="bi bi-kanban"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm bg-info bg-gradient text-white mb-3 animate__animated animate__fadeIn animate__delay-3s">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Completed Projects</h6>
                                    <h2 class="mt-2 mb-0">{{ $pegawai->flatMap->linimasa->where('status_proyek', 'completed')->count() }}</h2>
                                </div>
                                <div class="fs-1 opacity-50">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Table Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm animate__animated animate__fadeIn animate__delay-4s">
                        <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="bi bi-list-ul me-2"></i>Daftar Pegawai</h5>
                            <div class="d-flex">
                                <div class="input-group me-2">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-search text-muted"></i>
                                    </span>
                                    <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Cari pegawai...">
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-funnel me-1"></i>Filter
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="filterDropdown">
                                        <li><a class="dropdown-item filter-item" href="#" data-filter="all">Semua</a></li>
                                        <li><a class="dropdown-item filter-item" href="#" data-filter="with-projects">Dengan Proyek</a></li>
                                        <li><a class="dropdown-item filter-item" href="#" data-filter="no-projects">Tanpa Proyek</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#" id="exportData"><i class="bi bi-download me-1"></i>Export Data</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <!-- Daftar Pegawai -->
                            @if ($pegawai->isEmpty())
                                <div class="text-center py-5">
                                    <div class="display-1 text-muted mb-3">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <h4 class="text-muted">Belum ada pegawai terdaftar</h4>
                                    <p class="mb-4">Mulai tambahkan pegawai untuk melacak proyek mereka</p>
                                    <button class="btn btn-primary" onclick="openCreateModal()">
                                        <i class="bi bi-plus-lg me-1"></i> Tambah Pegawai Sekarang
                                    </button>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle" id="pegawaiTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="ps-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                                    </div>
                                                </th>
                                                <th>Nama</th>
                                                <th>Nomor Telepon</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pegawai as $p)
                                            <tr data-has-projects="{{ $p->linimasa()->exists() ? 'true' : 'false' }}">
                                                <td class="ps-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input pegawai-check" type="checkbox" value="{{ $p->id }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-circle bg-primary text-white me-2">
                                                            {{ strtoupper(substr($p->nama, 0, 1)) }}
                                                        </div>
                                                        <div>{{ $p->nama }}</div>
                                                    </div>
                                                </td>
                                                <td>{{ $p->nomor_telepon }}</td>
                                                <td>{{ $p->email }}</td>
                                                <td>
                                                    @if($p->linimasa()->exists())
                                                        <span class="badge rounded-pill bg-success">Active</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Aksi
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                                            <li>
                                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailModal" 
                                                                   data-id="{{ $p->id }}" data-nama="{{ $p->nama }}" 
                                                                   data-telepon="{{ $p->nomor_telepon }}" data-email="{{ $p->email }}">
                                                                    <i class="bi bi-eye me-2 text-primary"></i>Lihat Detail
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item btn-edit" href="#"
                                                                   data-id="{{ $p->id }}" data-nama="{{ $p->nama }}" 
                                                                   data-telepon="{{ $p->nomor_telepon }}" data-email="{{ $p->email }}"
                                                                   data-bs-toggle="modal" data-bs-target="#pegawaiEditModal">
                                                                    <i class="bi bi-pencil-square me-2 text-warning"></i>Edit
                                                                </a>
                                                            </li>
                                                            @if (!$p->linimasa()->exists())
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <a class="dropdown-item btn-delete text-danger" href="#" data-id="{{ $p->id }}">
                                                                    <i class="bi bi-trash me-2"></i>Hapus
                                                                </a>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </div>

                                                    <form id="delete-form-{{ $p->id }}" action="{{ route('pegawai.destroy', $p->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer bg-white py-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <span class="text-muted small" id="selectedCount">0 pegawai dipilih</span>
                                        </div>
                                        <div class="col-md-6">
                                            <nav aria-label="Page navigation">
                                                <ul class="pagination justify-content-end mb-0">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                                            <i class="bi bi-chevron-left"></i>
                                                        </a>
                                                    </li>
                                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">
                                                            <i class="bi bi-chevron-right"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Analytics Section -->
            @if (!$pegawai->isEmpty())
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm animate__animated animate__fadeIn animate__delay-5s">
                        <div class="card-header bg-white p-3">
                            <h5 class="mb-0"><i class="bi bi-graph-up me-2"></i>Analisis Pegawai</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <canvas id="projectStatusChart"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <canvas id="employeeActivityChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Include Create & Edit modals -->
    @include('pegawai/create')
    @include('pegawai/edit')

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="detailModalLabel">Detail Pegawai</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <div class="avatar-circle-lg bg-primary text-white mx-auto mb-3" id="detailInitial"></div>
                        <h4 id="detailNama"></h4>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label small text-muted">Email</label>
                                        <p class="mb-0" id="detailEmail"></p>
                                    </div>
                                    <div>
                                        <label class="form-label small text-muted">Nomor Telepon</label>
                                        <p class="mb-0" id="detailTelepon"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <h6 class="fw-bold mb-3">Proyek Yang Dikerjakan</h6>
                            <div id="detailProjects">
                                <div class="alert alert-info">
                                    Memuat data proyek...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btnAddProject">
                        <i class="bi bi-plus-lg me-1"></i>Tambah Proyek
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bulk Action Modal -->
    <div class="modal fade" id="bulkActionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Aksi Massal</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Pilih aksi untuk <span id="bulkCount">0</span> pegawai terpilih:</p>
                    <div class="list-group">
                        <button class="list-group-item list-group-item-action" id="bulkAssign">
                            <i class="bi bi-folder-plus me-2"></i>Assign Proyek
                        </button>
                        <button class="list-group-item list-group-item-action" id="bulkExport">
                            <i class="bi bi-download me-2"></i>Export Data
                        </button>
                        <button class="list-group-item list-group-item-action text-danger" id="bulkDelete">
                            <i class="bi bi-trash me-2"></i>Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .main-content {
            transition: all 0.3s;
        }
        
        .card {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
        }
        
        .avatar-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .avatar-circle-lg {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 24px;
        }
        
        .table td, .table th {
            padding: 0.75rem;
        }
        
        .dropdown-item {
            padding: 0.5rem 1rem;
        }
        
        .page-link {
            color: #343a40;
            border-color: #dee2e6;
        }
        
        .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        /* Hover effects */
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                transform: translate3d(0, 40px, 0);
                opacity: 0;
            }
            to {
                transform: translate3d(0, 0, 0);
                opacity: 1;
            }
        }
        
        .bulkActions {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            background: #0d6efd;
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            display: none;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            
            // Initialize DataTable if data exists
            @if (!$pegawai->isEmpty())
                const dataTable = $('#pegawaiTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    pageLength: 10,
                    lengthChange: false,
                    dom: 't<"d-none"ip>',
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Cari pegawai..."
                    }
                });
                
                // Connect search box outside datatable
                $('#searchInput').on('keyup', function() {
                    dataTable.search(this.value).draw();
                });
                
                // Filter functionality
                $('.filter-item').on('click', function(e) {
                    e.preventDefault();
                    const filter = $(this).data('filter');
                    
                    if (filter === 'all') {
                        dataTable.search('').draw();
                    } else if (filter === 'with-projects') {
                        dataTable.column(4).search('Active').draw();
                    } else if (filter === 'no-projects') {
                        dataTable.column(4).search('Inactive').draw();
                    }
                });
            @endif
            
            // 🔹 Menampilkan Pop Up Error jika ada validasi yang gagal
            @if ($errors->any())
                let errorMessage = "";
                @foreach ($errors->all() as $error)
                    errorMessage += "{{ $error }}\n";
                @endforeach

                Swal.fire({
                    title: "Terjadi Kesalahan!",
                    icon: "error",
                    confirmButtonText: "Mengerti"
                });
            @endif
                
            // 🔹 Menampilkan Pop Up Sukses jika ada session success
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    position: 'center'
                });
            @endif

            // 🔹 Pop Up Konfirmasi Hapus
            document.querySelectorAll(".btn-delete").forEach(button => {
                button.addEventListener("click", function (e) {
                    e.preventDefault();
                    let id = this.getAttribute("data-id");

                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: "Data pegawai akan dihapus secara permanen!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, Hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`delete-form-${id}`).submit();
                        }
                    });
                });
            });
            
            // Detail Modal Functionality
            $('#detailModal').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget);
                const id = button.data('id');
                const nama = button.data('nama');
                const email = button.data('email');
                const telepon = button.data('telepon');
                
                // Set values
                $('#detailNama').text(nama);
                $('#detailEmail').text(email);
                $('#detailTelepon').text(telepon);
                
                // Set initial
                $('#detailInitial').text(nama.charAt(0).toUpperCase());
                
                // Fetch projects (simulate for demo)
                $('#detailProjects').html(getRandomProjects());
                
                // Add project button action
                $('#btnAddProject').attr('data-id', id);
            });
            
            // Generate some random project data for demo
            function getRandomProjects() {
                const statuses = ['bg-success', 'bg-warning', 'bg-info', 'bg-danger'];
                const statusText = ['Completed', 'In Progress', 'Planning', 'Delayed'];
                const projects = ['Website Redesign', 'Mobile App Development', 'Database Migration', 'API Integration'];
                
                const count = Math.floor(Math.random() * 3);
                
                if (count === 0) {
                    return `<div class="text-center py-3">
                                <div class="mb-3">
                                    <i class="bi bi-clipboard-x fs-3 text-muted"></i>
                                </div>
                                <p class="text-muted mb-0">Belum ada proyek yang dikerjakan</p>
                            </div>`;
                }
                
                let html = '';
                
                for (let i = 0; i < count; i++) {
                    const randomStatus = Math.floor(Math.random() * statuses.length);
                    const randomProject = Math.floor(Math.random() * projects.length);
                    
                    html += `<div class="card mb-2 border-0 shadow-sm">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">${projects[randomProject]}</h6>
                                            <span class="badge ${statuses[randomStatus]}">${statusText[randomStatus]}</span>
                                        </div>
                                        <div>
                                            <button class="btn btn-sm btn-link text-muted">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                }
                
                return html;
            }
            
            // Select All Functionality
            $('#selectAll').change(function() {
                const isChecked = $(this).prop('checked');
                $('.pegawai-check').prop('checked', isChecked);
                updateSelectedCount();
                showBulkActions();
            });
            
            // Individual checkbox change
            $('.pegawai-check').change(function() {
                updateSelectedCount();
                showBulkActions();
                
                // Check if all checkboxes are selected
                const allChecked = $('.pegawai-check:checked').length === $('.pegawai-check').length;
                $('#selectAll').prop('checked', allChecked);
            });
            
            // Update selected count
            function updateSelectedCount() {
                const count = $('.pegawai-check:checked').length;
                $('#selectedCount').text(count + ' pegawai dipilih');
                $('#bulkCount').text(count);
            }
            
            // Show bulk actions
            function showBulkActions() {
                const count = $('.pegawai-check:checked').length;
                
                if (count > 0) {
                    $('body').append('<div class="bulkActions animate__animated animate__fadeInUp">' +
                        count + ' pegawai dipilih ' +
                        '<button class="btn btn-sm btn-light ms-3" data-bs-toggle="modal" data-bs-target="#bulkActionModal">Aksi <i class="bi bi-chevron-right"></i></button>' +
                    '</div>');
                } else {
                    $('.bulkActions').remove();
                }
            }
            
            // Bulk actions functionality
            $('#bulkDelete').click(function() {
                const selectedIds = [];
                $('.pegawai-check:checked').each(function() {
                    selectedIds.push($(this).val());
                });
                
                Swal.fire({
                    title: "Hapus " + selectedIds.length + " pegawai?",
                    text: "Semua data terkait dengan pegawai ini akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Here you would submit the form or make AJAX request
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: selectedIds.length + ' pegawai telah dihapus',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            // Reload page after successful deletion
                            // window.location.reload();
                        });
                    }
                });
                
                $('#bulkActionModal').modal('hide');
            });
            
            // Initialize Charts if data exists
            @if (!$pegawai->isEmpty())
                // Project Status Chart
                const projectStatusCtx = document.getElementById('projectStatusChart').getContext('2d');
                const projectStatusChart = new Chart(projectStatusCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Completed', 'In Progress', 'Pending', 'Delayed'],
                        datasets: [{
                            label: 'Status Proyek',
                            data: [
                                {{ $pegawai->flatMap->linimasa->where('status_proyek', 'completed')->count() }},
                                {{ $pegawai->flatMap->linimasa->where('status_proyek', 'in_progress')->count() }},
                                {{ $pegawai->flatMap->linimasa->where('status_proyek', 'pending')->count() }},
                                {{ $pegawai->flatMap->linimasa->where('status_proyek', 'delayed')->count() }}
                            ],
                            backgroundColor: [
                                'rgba(40, 167, 69, 0.8)',
                                'rgba(13, 110, 253, 0.8)',
                                'rgba(255, 193, 7, 0.8)',
                                'rgba(220, 53, 69, 0.8)'
                            ],
                            borderColor: [
                                'rgba(40, 167, 69, 1)',
                                'rgba(13, 110, 253, 1)',
                                'rgba(255, 193, 7, 1)',
                                'rgba(220, 53, 69, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            },
                            title: {
                                display: true,
                                text: 'Status Proyek'
                            }
                        }
                    }
                });
                
                // Employee Activity Chart
                const employeeActivityCtx = document.getElementById('employeeActivityChart').getContext('2d');
                const employeeActivityChart = new Chart(employeeActivityCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                        datasets: [{
                            label: 'Proyek Ditugaskan',
                            data: [12, 19, 8, 15, 10, 13],
                            backgroundColor: 'rgba(13, 110, 253, 0.6)',
                            borderColor: 'rgba(13, 110, 253, 1)',
                            borderWidth: 1
                        }, {
                            label: 'Proyek Selesai',
                            data: [7, 11, 5, 8, 3, 9],
                            backgroundColor: 'rgba(40, 167, 69, 0.6)',
                            borderColor: 'rgba(40, 167, 69, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Aktivitas Proyek Pegawai (6 Bulan Terakhir)'
                            }
                        }
                    }
                });
            @endif
            
            // Export functionality (demo)
            $('#exportData, #bulkExport').click(function() {
                Swal.fire({
                    title: 'Ekspor Data',
                    text: 'Format file untuk ekspor data?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Excel',
                    cancelButtonText: 'CSV'
                }).then((result) => {
                    let format = result.isConfirmed ? 'Excel' : 'CSV';
                    
                    // Show loading animation
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Menyiapkan file ' + format,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Simulate process delay
                    setTimeout(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Ekspor Berhasil!',
                            text: 'File ' + format + ' telah diunduh',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }, 2000);
                });
                
                if ($(this).attr('id') === 'bulkExport') {
                    $('#bulkActionModal').modal('hide');
                }
            });
            
            // Bulk assign project
            $('#bulkAssign').click(function() {
                $('#bulkActionModal').modal('hide');
                
                const selectedCount = $('.pegawai-check:checked').length;
                
                Swal.fire({
                    title: 'Assign Proyek Baru',
                    html: `
                        <p class="text-start mb-3">Menugaskan proyek untuk ${selectedCount} pegawai terpilih</p>
                        <div class="mb-3">
                            <select class="form-select" id="swalProyek">
                                <option value="">Pilih Proyek</option>
                                <option value="1">Website Company Profile</option>
                                <option value="2">Mobile App Development</option>
                                <option value="3">ERP Implementation</option>
                                <option value="4">Network Infrastructure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-start d-block">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="swalTanggalMulai">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-start d-block">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="swalTanggalSelesai">
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Assign',
                    cancelButtonText: 'Batal',
                    focusConfirm: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Proyek Berhasil Ditugaskan!',
                            text: `${selectedCount} pegawai telah ditugaskan ke proyek baru`,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            });
            
            // UI Enhancement - Button hover effects
            $('#btnCreate').hover(
                function() {
                    $(this).removeClass('shadow-sm').addClass('shadow');
                },
                function() {
                    $(this).removeClass('shadow').addClass('shadow-sm');
                }
            );
        });
    </script>
</body>
</html>