<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Proyek - siMonika</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --danger-color: #e74a3b;
            --warning-color: #f6c23e;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
        }
        
        .main-content {
            transition: margin-left 0.3s;
            min-height: 100vh;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.25rem;
        }
        
        .table thead th {
            background-color: #f8f9fc;
            color: #5a5c69;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            border-bottom: 2px solid #e3e6f0;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
        }
        
        .btn-secondary {
            background-color: var(--secondary-color);
        }
        
        .btn-success {
            background-color: var(--success-color);
        }
        
        .btn-warning {
            background-color: var(--warning-color);
        }
        
        .btn-danger {
            background-color: var(--danger-color);
        }
        
        .action-buttons .btn {
            margin-right: 0.3rem;
            border-radius: 0.2rem;
            padding: 0.375rem 0.5rem;
        }
        
        .badge {
            font-weight: 600;
            padding: 0.35em 0.65em;
        }
        
        .stats-card {
            transition: transform 0.3s;
            cursor: pointer;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .page-header {
            border-bottom: 1px solid #e3e6f0;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    @include('templates.sidebar')

    <!-- Main Content -->
    <div class="main-content p-4">
        <!-- Page Header -->
        <div class="page-header d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Kelola Proyek</h1>
                <p class="text-muted">Manajemen data proyek dan informasinya</p>
            </div>
            <div class="d-flex">
                <button class="btn btn-primary me-2" id="btnCreate">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Proyek
                </button>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-gear me-1"></i> Kategori
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#kategoriCreateModal">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Kategori
                        </a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#kategoriViewModal">
                            <i class="bi bi-list me-2"></i>Lihat Kategori
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 stats-card">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Proyek</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $proyek->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-folder-fill fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 stats-card">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Kategori</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kategori->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-tags-fill fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- You can add more stats cards here as needed -->
        </div>

        <!-- Main Content Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Proyek</h6>
                <div>
                    <div class="input-group">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari proyek...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if ($proyek->isEmpty())
                    <div class="alert alert-warning text-center">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Belum ada proyek terdaftar.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover" id="proyekTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Proyek</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proyek as $index => $p)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $p->nama_proyek }}</td>
                                        <td>
                                            @if($p->kategori)
                                                <span class="badge bg-info text-white">
                                                    {{ $p->kategori->nama_kategori }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $p->deskripsi }}</td>
                                        <td class="text-center">
                                            <div class="action-buttons">
                                                <button class="btn btn-sm btn-info" title="Detail Proyek">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning btn-edit" 
                                                    data-id="{{ $p->id }}"
                                                    data-nama-proyek="{{ $p->nama_proyek }}" 
                                                    data-kategori-id="{{ $p->kategori_id }}"
                                                    data-deskripsi="{{ $p->deskripsi }}"
                                                    title="Edit Proyek">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>

                                                @if (!$p->linimasa()->exists())
                                                    <button class="btn btn-sm btn-danger btn-delete" 
                                                        data-id="{{ $p->id }}"
                                                        title="Hapus Proyek">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-secondary" 
                                                        disabled
                                                        title="Tidak dapat dihapus (memiliki linimasa)">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                @endif

                                                <form id="delete-form-{{ $p->id }}" 
                                                    action="{{ route('proyek.destroy', $p->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Tambah Proyek -->
    @include('proyek/create', ['kategori' => $kategori])

    <!-- Modal Edit Proyek -->
    @include('proyek/edit')

    <!-- Modals Kategori -->
    @include('proyek/kategori')

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Toastr & SweetAlert2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Initialize DataTable
            $('#proyekTable').DataTable({
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "Tidak ada data yang cocok",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data yang tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                },
                responsive: true,
                "pageLength": 10,
                "ordering": true
            });

            // Button create event
            document.getElementById("btnCreate").addEventListener("click", function () {
                var myModal = new bootstrap.Modal(document.getElementById('proyekCreateModal'));
                myModal.show();
            });

            // Search functionality
            $("#searchInput").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $("#proyekTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            // Edit button event
            document.querySelectorAll(".btn-edit").forEach(button => {
                button.addEventListener("click", function () {
                    let id = this.getAttribute("data-id");
                    let nama_proyek = this.getAttribute("data-nama-proyek");
                    let kategori_id = this.getAttribute("data-kategori-id");
                    let deskripsi = this.getAttribute("data-deskripsi");

                    editProyek(id, nama_proyek, kategori_id, deskripsi);
                });
            });

            // Clean up modal
            let proyekEditModal = document.getElementById("proyekEditModal");
            proyekEditModal.addEventListener("hidden.bs.modal", function () {
                let editForm = document.getElementById("editProyekForm");
                if (editForm) {
                    editForm.reset();
                }
                document.querySelectorAll(".modal-backdrop").forEach(el => el.remove());
                document.body.classList.remove("modal-open");
            });

            // Error handling
            @if ($errors->any())
                Swal.fire({
                    title: "Terjadi Kesalahan!",
                    text: "{{ implode('\n', $errors->all()) }}",
                    icon: "error",
                    confirmButtonText: "Mengerti"
                });
            @endif

            // Success notification
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

            // Delete confirmation
            document.querySelectorAll(".btn-delete").forEach(button => {
                button.addEventListener("click", function () {
                    let id = this.getAttribute("data-id");

                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: "Data proyek akan dihapus secara permanen!",
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

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });

        function editProyek(id, nama_proyek, kategori_id, deskripsi) {
            document.getElementById("edit_nama_proyek").value = nama_proyek;
            document.getElementById("edit_deskripsi").value = deskripsi;

            let kategoriSelect = document.getElementById("edit_kategori_id");
            if (kategoriSelect) {
                for (let option of kategoriSelect.options) {
                    if (option.value == kategori_id) {
                        option.selected = true;
                        break;
                    }
                }
            }

            let form = document.getElementById("editProyekForm");
            if (form) {
                form.action = "{{ url('proyek') }}/" + id;
            }

            new bootstrap.Modal(document.getElementById("proyekEditModal")).show();
        }
    </script>

</body>

</html>