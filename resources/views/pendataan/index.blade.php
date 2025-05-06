<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pendataan - siMonika</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Toastr & SweetAlert2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vis-timeline/7.4.6/vis-timeline-graph2d.min.js"></script>

    <!-- Vis.js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/vis-timeline/7.4.6/vis-timeline-graph2d.min.css"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
            --warning-color: #f8961e;
            --danger-color: #f94144;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }

        .main-content {
            padding: 2rem;
            margin-left: 250px; /* Adjust based on your sidebar width */
            transition: all 0.3s;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 10px 10px 0 0 !important;
            padding: 1.25rem;
        }

        .btn {
            border-radius: 6px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }

        .btn-warning {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
        }

        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .page-header {
            position: relative;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
        }

        .page-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .table {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        .table thead {
            background-color: var(--primary-color);
            color: white;
        }

        .table thead th {
            border-bottom: none;
            padding: 1rem 1.5rem;
            font-weight: 500;
        }

        .table tbody tr {
            transition: background-color 0.3s;
        }

        .table tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        .table tbody td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
        }

        .badge {
            padding: 0.5rem 0.75rem;
            border-radius: 30px;
            font-weight: 500;
        }

        .zoom-controls {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
            display: flex;
            gap: 10px;
            background-color: white;
            border-radius: 8px;
            padding: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .zoom-btn {
            width: 32px;
            height: 32px;
            font-size: 18px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            color: #212529;
            cursor: pointer;
            transition: all 0.2s;
        }

        .zoom-btn:hover {
            background-color: #e9ecef;
        }

        #pendataanTimeline {
            height: 500px;
            margin-bottom: 2rem;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* View toggle button styles */
        .view-toggle-container {
            display: flex;
            align-items: center;
            background-color: #e9ecef;
            padding: 5px;
            border-radius: 30px;
            margin-right: 1rem;
        }

        .view-toggle-btn {
            padding: 0.5rem 1rem;
            border-radius: 30px;
            border: none;
            background: transparent;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
        }

        .view-toggle-btn.active {
            background-color: white;
            color: var(--primary-color);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    @include('templates.sidebar')

    <div class="main-content">
        <div class="container-fluid p-0">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="mb-1 fw-normal">Pendataan Mahasiswa</h2>
                                <p class="text-muted mb-0">Sistem pendataan aktivitas magang mahasiswa</p>
                            </div>
                            <div class="d-flex align-items-center">
                                @if ($pendataans->isNotEmpty())
                                <div class="view-toggle-container me-2">
                                    <button id="timelineViewBtn" class="view-toggle-btn active">
                                        <i class="bi bi-bar-chart-line"></i> Timeline
                                    </button>
                                    <button id="tableViewBtn" class="view-toggle-btn">
                                        <i class="bi bi-table"></i> Tabel
                                    </button>
                                </div>
                                @endif
                                <button class="btn btn-primary btn-icon" data-bs-toggle="modal" data-bs-target="#pendataanCreateModal">
                                    <i class="bi bi-plus-lg"></i> Tambah Data
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="row">
                <div class="col-12">
                    @if ($pendataans->isEmpty())
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <i class="bi bi-inbox-fill text-muted" style="font-size: 3rem;"></i>
                                <h4 class="mt-3">Belum Ada Data</h4>
                                <p class="text-muted">Belum ada data magang terdaftar. Silakan tambahkan data magang baru.</p>
                                <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#pendataanCreateModal">
                                    <i class="bi bi-plus-lg"></i> Tambah Data Magang
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="card mb-4" id="timelineCard">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Timeline Pendataan Magang</h5>
                                <span class="badge bg-primary">
                                    <i class="bi bi-info-circle"></i> Klik data untuk melihat detail
                                </span>
                            </div>
                            <div class="card-body p-0">
                                <div id="pendataanContainer" style="position: relative;">
                                    <div id="pendataanTimeline"></div>
                                    <div class="zoom-controls">
                                        <button id="zoomIn" class="zoom-btn"><i class="bi bi-plus-lg"></i></button>
                                        <button id="zoomOut" class="zoom-btn"><i class="bi bi-dash-lg"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card d-none" id="tableCard">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Tabel Pendataan Magang</h5>
                                <div class="input-group" style="width: 250px;">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" id="tableSearch" class="form-control border-start-0" placeholder="Cari data...">
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0" id="pendataanTable">
                                        <thead>
                                            <tr>
                                                <th>Universitas</th>
                                                <th>Jumlah Orang</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Tanggal Keluar</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pendataans as $pendataan)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar me-2 bg-light rounded-circle text-center" style="width: 36px; height: 36px; line-height: 36px;">
                                                                <i class="bi bi-building"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0">{{ $pendataan->universitas }}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-light text-dark">
                                                            <i class="bi bi-people-fill me-1"></i>{{ $pendataan->jumlah_orang }} orang
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <i class="bi bi-calendar-check text-success me-2"></i>
                                                            {{ $pendataan->tanggal_masuk }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <i class="bi bi-calendar-x text-danger me-2"></i>
                                                            {{ $pendataan->tanggal_keluar }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <button class="btn btn-sm btn-outline-primary btn-detail" 
                                                                data-id="{{ $pendataan->id }}"
                                                                data-universitas="{{ $pendataan->universitas }}"
                                                                data-jumlah_orang="{{ $pendataan->jumlah_orang }}"
                                                                data-tanggal_masuk="{{ $pendataan->tanggal_masuk }}"
                                                                data-tanggal_keluar="{{ $pendataan->tanggal_keluar }}">
                                                                <i class="bi bi-info-circle"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-warning btn-edit" 
                                                                data-id="{{ $pendataan->id }}"
                                                                data-universitas="{{ $pendataan->universitas }}"
                                                                data-jumlah_orang="{{ $pendataan->jumlah_orang }}"
                                                                data-tanggal_masuk="{{ $pendataan->tanggal_masuk }}"
                                                                data-tanggal_keluar="{{ $pendataan->tanggal_keluar }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#pendataanEditModal">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-danger btn-delete" data-id="{{ $pendataan->id }}">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                            <form id="delete-form-{{ $pendataan->id }}"
                                                                action="{{ route('pendataan.destroy', $pendataan->id) }}" method="POST"
                                                                style="display: none;">
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
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('pendataan.create')
    @include('pendataan.edit')
    @include('pendataan.info')

    <script>
        // View toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const timelineViewBtn = document.getElementById('timelineViewBtn');
            const tableViewBtn = document.getElementById('tableViewBtn');
            const timelineCard = document.getElementById('timelineCard');
            const tableCard = document.getElementById('tableCard');

            if (timelineViewBtn && tableViewBtn) {
                timelineViewBtn.addEventListener('click', function() {
                    timelineCard.classList.remove('d-none');
                    tableCard.classList.add('d-none');
                    timelineViewBtn.classList.add('active');
                    tableViewBtn.classList.remove('active');
                    timeline.redraw(); // Refresh timeline on view change
                });

                tableViewBtn.addEventListener('click', function() {
                    tableCard.classList.remove('d-none');
                    timelineCard.classList.add('d-none');
                    tableViewBtn.classList.add('active');
                    timelineViewBtn.classList.remove('active');
                });
            }

            // Table search functionality
            const tableSearch = document.getElementById('tableSearch');
            if (tableSearch) {
                tableSearch.addEventListener('keyup', function() {
                    const searchTerm = this.value.toLowerCase();
                    const table = document.getElementById('pendataanTable');
                    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                    for (let i = 0; i < rows.length; i++) {
                        const universitas = rows[i].getElementsByTagName('td')[0].textContent.toLowerCase();
                        if (universitas.includes(searchTerm)) {
                            rows[i].style.display = '';
                        } else {
                            rows[i].style.display = 'none';
                        }
                    }
                });
            }

            // Detail button functionality
            document.querySelectorAll('.btn-detail').forEach(button => {
                button.addEventListener('click', function() {
                    let id = this.getAttribute('data-id');
                    let universitas = this.getAttribute('data-universitas');
                    let jumlah_orang = this.getAttribute('data-jumlah_orang');
                    let tanggal_masuk = this.getAttribute('data-tanggal_masuk');
                    let tanggal_keluar = this.getAttribute('data-tanggal_keluar');

                    // Fill the info modal with data
                    document.getElementById('infoUniversitas').textContent = universitas;
                    document.getElementById('infoJumlahOrang').textContent = jumlah_orang;
                    document.getElementById('infoTanggalMasuk').textContent = tanggal_masuk;
                    document.getElementById('infoTanggalKeluar').textContent = tanggal_keluar;
                    document.getElementById('info-pendataan-id').value = id;

                    // Show the modal
                    new bootstrap.Modal(document.getElementById('modalInfoPendataan')).show();
                });
            });

            // Edit button functionality
            document.querySelectorAll(".btn-edit").forEach(button => {
                button.addEventListener("click", function() {
                    let id = this.getAttribute("data-id");
                    let universitas = this.getAttribute("data-universitas");
                    let jumlah_orang = this.getAttribute("data-jumlah_orang");
                    let tanggal_masuk = this.getAttribute("data-tanggal_masuk");
                    let tanggal_keluar = this.getAttribute("data-tanggal_keluar");

                    // Fill the edit form with data
                    document.getElementById("edit-universitas").value = universitas;
                    document.getElementById("edit-jumlah_orang").value = jumlah_orang;
                    document.getElementById("edit-tanggal_masuk").value = tanggal_masuk;
                    document.getElementById("edit-tanggal_keluar").value = tanggal_keluar;

                    // Set the form action
                    let form = document.getElementById("pendataanEditForm");
                    let baseAction = form.getAttribute("data-base-action");
                    form.action = baseAction.replace(':id', id);
                    
                    // Show the edit modal
                    new bootstrap.Modal(document.getElementById("pendataanEditModal")).show();
                });
            });

            // Delete button functionality
            document.querySelectorAll(".btn-delete").forEach(button => {
                button.addEventListener("click", function() {
                    let id = this.getAttribute("data-id");

                    Swal.fire({
                        title: "Yakin ingin menghapus?",
                        text: "Data pendataan yang dihapus tidak dapat dikembalikan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, Hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Create form for delete
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `{{ url('pendataan/delete') }}/${id}`;
                            
                            // CSRF token
                            const csrfToken = document.createElement('input');
                            csrfToken.type = 'hidden';
                            csrfToken.name = '_token';
                            csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                            
                            // Method spoofing
                            const methodField = document.createElement('input');
                            methodField.type = 'hidden';
                            methodField.name = '_method';
                            methodField.value = 'DELETE';
                            
                            // Add inputs to form
                            form.appendChild(csrfToken);
                            form.appendChild(methodField);
                            
                            // Add form to DOM and submit
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });

            // Timeline configuration
            let container = document.getElementById("pendataanTimeline");
            if (container) {
                let zoomStep = 0.5;

                // Zoom In
                document.getElementById('zoomIn').addEventListener('click', function () {
                    let currentRange = timeline.getWindow();
                    let start = currentRange.start.valueOf();
                    let end = currentRange.end.valueOf();
                    let interval = end - start;
                    let newInterval = interval * (1 - zoomStep);
                    let newStart = start + (interval - newInterval) / 2;
                    let newEnd = end - (interval - newInterval) / 2;
                    timeline.setWindow(newStart, newEnd);
                });

                // Zoom Out
                document.getElementById('zoomOut').addEventListener('click', function () {
                    let currentRange = timeline.getWindow();
                    let start = currentRange.start.valueOf();
                    let end = currentRange.end.valueOf();
                    let interval = end - start;
                    let newInterval = interval * (1 + zoomStep);
                    let newStart = start - (newInterval - interval) / 2;
                    let newEnd = end + (newInterval - interval) / 2;
                    timeline.setWindow(newStart, newEnd);
                });

                // Data for Timeline Items
                let items = new vis.DataSet([
                    @foreach ($pendataans as $pendataan)
                    {
                        id: {{ $pendataan->id }},
                        content: "<div class='timeline-item'><strong>{{ $pendataan->universitas ?? 'Tidak Diketahui' }}</strong><div><i class='bi bi-people-fill'></i> {{ $pendataan->jumlah_orang }} orang</div></div>",
                        start: "{{ $pendataan->tanggal_masuk }}",
                        end: "{{ $pendataan->tanggal_keluar }}",
                        group: {{ $loop->index + 1 }},
                        status: "Magang",
                        deskripsi: "Jumlah Orang: {{ $pendataan->jumlah_orang }}",
                        style: "background-color: rgba(67, 97, 238, 0.7); color: white; border-radius: 6px; padding: 5px;"
                    },
                    @endforeach
                ]);

                // Data for Groups
                let groups = new vis.DataSet([
                    @foreach ($pendataans as $pendataan)
                    {
                        id: {{ $loop->index + 1 }},
                        content: "{{ $pendataan->universitas }}"
                    },
                    @endforeach
                ]);

                // Timeline Options
                let options = {
                    groupOrder: "content",
                    stackSubgroups: true,
                    showCurrentTime: true,
                    zoomable: true,
                    orientation: { axis: "top" },
                    margin: {
                        item: 12,
                        axis: 12
                    },
                    editable: false,
                    tooltip: {
                        followMouse: true,
                        overflowMethod: 'flip'
                    },
                    timeAxis: { scale: 'day' },
                    height: '450px'
                };

                // Create Timeline
                let timeline = new vis.Timeline(container, items, groups, options);

                // Timeline Click Event
                timeline.on("select", function (props) {
                    if (props.items.length > 0) {
                        let itemId = props.items[0];
                        let item = items.get(itemId);

                        // Fill the info modal with data
                        document.getElementById("infoUniversitas").textContent = item.content.split("<strong>")[1].split("</strong>")[0];
                        document.getElementById("infoJumlahOrang").textContent = item.deskripsi.split(": ")[1];
                        document.getElementById("infoTanggalMasuk").textContent = item.start;
                        document.getElementById("infoTanggalKeluar").textContent = item.end;
                        document.getElementById("info-pendataan-id").value = itemId;

                        // Show the info modal
                        new bootstrap.Modal(document.getElementById("modalInfoPendataan")).show();
                    }
                });
            }

            // Form validation
            let tanggalMasukInput = document.getElementById("tanggal_masuk");
            let tanggalKeluarInput = document.getElementById("tanggal_keluar");
            let editTanggalMasukInput = document.getElementById("edit-tanggal_masuk");
            let editTanggalKeluarInput = document.getElementById("edit-tanggal_keluar");

            function validateDateInput(masukInput, keluarInput) {
                let tanggalMasuk = new Date(masukInput.value);
                let tanggalKeluar = new Date(keluarInput.value);

                if (tanggalMasuk > tanggalKeluar) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan Input',
                        text: 'Tanggal masuk tidak boleh lebih besar dari tanggal keluar!',
                        confirmButtonColor: '#4361ee'
                    });

                    // Reset input
                    masukInput.value = "";
                    return false;
                }
                return true;
            }

            if (tanggalMasukInput && tanggalKeluarInput) {
                tanggalMasukInput.addEventListener("change", function() {
                    if (tanggalKeluarInput.value) {
                        validateDateInput(tanggalMasukInput, tanggalKeluarInput);
                    }
                });

                tanggalKeluarInput.addEventListener("change", function() {
                    if (tanggalMasukInput.value) {
                        validateDateInput(tanggalMasukInput, tanggalKeluarInput);
                    }
                });
            }

            if (editTanggalMasukInput && editTanggalKeluarInput) {
                editTanggalMasukInput.addEventListener("change", function() {
                    if (editTanggalKeluarInput.value) {
                        validateDateInput(editTanggalMasukInput, editTanggalKeluarInput);
                    }
                });

                editTanggalKeluarInput.addEventListener("change", function() {
                    if (editTanggalMasukInput.value) {
                        validateDateInput(editTanggalMasukInput, editTanggalKeluarInput);
                    }
                });
            }

            // Show success message if redirected after success
            if (window.location.search.includes('success=true')) {
                toastr.success('Operasi berhasil dilakukan!', 'Sukses');
            }
        });
    </script>
</body>
</html>