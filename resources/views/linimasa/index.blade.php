<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Linimasa Proyek - siMonika</title>

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
            --success-color: #4cc9f0;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f5f7fa;
        }

        .main-content {
            transition: all 0.3s ease;
            margin-left: 250px;
            padding: 25px !important;
        }

        .card {
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border: none;
            margin-bottom: 24px;
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 16px 20px;
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
        }

        .card-body {
            padding: 20px;
        }

        .page-header {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 20px;
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            border-radius: 6px;
            padding: 8px 16px;
            font-weight: 500;
            transition: all 0.2s;
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
            background-color: #e9ecef;
            border-color: #e9ecef;
            color: #212529;
        }

        .btn-secondary:hover {
            background-color: #dde2e6;
            border-color: #dde2e6;
        }

        .btn-warning {
            background-color: #fd9644;
            border-color: #fd9644;
        }

        .btn-danger {
            background-color: #fc5c65;
            border-color: #fc5c65;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 0.8rem;
        }

        .btn i {
            margin-right: 5px;
        }

        .zoom-controls {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .zoom-btn {
            width: 36px;
            height: 36px;
            font-size: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            background-color: white;
            color: var(--primary-color);
            border: none;
        }

        .zoom-btn:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .table {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
            padding: 12px 16px;
            font-weight: 600;
        }

        .table tbody td {
            padding: 12px 16px;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
        }

        .status-selesai-cepat {
            background-color: #10b981;
            color: white;
        }

        .status-tepat-waktu {
            background-color: #a7f3d0;
            color: #065f46;
        }

        .status-terlambat {
            background-color: #ef4444;
            color: white;
        }

        .status-revisi {
            background-color: #fb923c;
            color: #7c2d12;
        }

        .status-proses {
            background-color: #3b82f6;
            color: white;
        }

        .status-todo {
            background-color: #6b7280;
            color: white;
        }

        .status-default {
            background-color: #e5e7eb;
            color: #1f2937;
        }

        #timeline {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            height: 600px;
            border: 1px solid #e9ecef;
            background-color: white;
        }

        .vis-item {
            border-radius: 4px;
            border-width: 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .vis-item.vis-selected {
            box-shadow: 0 0 0 2px var(--primary-color);
        }

        .vis-time-axis .vis-text {
            color: #4b5563;
            padding: 3px 0;
        }

        .vis-time-axis .vis-grid.vis-minor {
            border-color: #f3f4f6;
        }

        .vis-time-axis .vis-grid.vis-major {
            border-color: #e5e7eb;
        }

        .vis-labelset .vis-label {
            border-color: #f3f4f6;
            padding: 5px 8px;
        }

        .vis-labelset .vis-label .vis-inner {
            font-weight: 500;
        }

        .alert-empty {
            border-radius: var(--border-radius);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
            background-color: #f8f9fa;
            border: 1px dashed #cfd8dc;
        }

        .alert-empty i {
            font-size: 40px;
            color: #b0bec5;
            margin-bottom: 20px;
        }

        .modal-content {
            border-radius: 10px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 16px 20px;
        }

        .modal-footer {
            padding: 16px 20px;
            border-top: 1px solid #f0f0f0;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 6px;
            color: #4b5563;
        }

        .form-control, .form-select {
            border-radius: 6px;
            padding: 10px 12px;
            border-color: #e5e7eb;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }

        /* Animation effects */
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-action-group {
            display: flex;
            gap: 8px;
        }

        /* Timeline controls */
        .timeline-controls {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 10px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--box-shadow);
        }

        .timeline-legend {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.8rem;
        }

        .legend-color {
            width: 16px;
            height: 16px;
            border-radius: 4px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 15px !important;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .button-action {
                width: 100%;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .table-responsive {
                border-radius: var(--border-radius);
                overflow: hidden;
            }

            #timeline {
                height: 450px;
            }
        }
    </style>
</head>

<body>
    @include('templates.sidebar')

    <div class="main-content p-4 fade-in">
        <div class="page-header">
            <div>
                <h2 class="mb-0">Linimasa Proyek</h2>
                <p class="text-muted">Menampilkan timeline proyek yang dikerjakan oleh pegawai</p>
            </div>
            <div class="button-action">
                @if ($linimasa->isNotEmpty())
                    <button id="toggleView" class="btn btn-secondary">
                        <i class="bi bi-table"></i> Tampilkan Tabel
                    </button>
                @endif
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#linimasaCreateModal">
                    <i class="bi bi-plus-lg"></i> Tambah Linimasa
                </button>
            </div>
        </div>

        @if ($linimasa->isEmpty())
            <div class="alert-empty">
                <i class="bi bi-calendar-x"></i>
                <h5>Belum ada linimasa terdaftar</h5>
                <p class="text-muted">Silakan tambahkan linimasa proyek baru untuk memulai</p>
            </div>
        @else
            <div class="timeline-controls">
                <div class="timeline-legend">
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #10b981;"></div>
                        <span>Selesai Lebih Cepat</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #a7f3d0;"></div>
                        <span>Tepat Waktu</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #ef4444;"></div>
                        <span>Terlambat</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #fb923c;"></div>
                        <span>Revisi</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #3b82f6;"></div>
                        <span>Proses</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background-color: #6b7280;"></div>
                        <span>To Do Next</span>
                    </div>
                </div>
            </div>

            <div id="timelineContainer" style="position: relative;">
                <div id="timeline"></div>
                <div class="zoom-controls">
                    <button id="zoomIn" class="zoom-btn"><i class="bi bi-plus-lg"></i></button>
                    <button id="zoomOut" class="zoom-btn"><i class="bi bi-dash-lg"></i></button>
                </div>
            </div>

            <div id="tableContainer" class="d-none fade-in">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Pegawai</th>
                                        <th>Proyek</th>
                                        <th>Status</th>
                                        <th>Mulai</th>
                                        <th>Tenggat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($linimasa as $item)
                                        <tr>
                                            <td>{{ $item->pegawai->nama }}</td>
                                            <td>{{ $item->proyek->nama_proyek }}</td>
                                            <td>
                                                <span class="status-badge {{ 
                                                    match ($item->status_proyek) {
                                                        'Selesai Lebih Cepat' => 'status-selesai-cepat',
                                                        'Tepat Waktu' => 'status-tepat-waktu',
                                                        'Terlambat' => 'status-terlambat',
                                                        'Revisi' => 'status-revisi',
                                                        'Proses' => 'status-proses',
                                                        'To Do Next' => 'status-todo',
                                                        default => 'status-default',
                                                    }
                                                }}">
                                                    {{ $item->status_proyek }}
                                                </span>
                                            </td>
                                            <td>{{ $item->mulai }}</td>
                                            <td>{{ $item->tenggat }}</td>
                                            <td>
                                                <div class="btn-action-group">
                                                    <button class="btn btn-warning btn-sm btn-edit" data-id="{{ $item->id }}"
                                                        data-pegawai="{{ $item->pegawai->id }}" data-proyek="{{ $item->proyek->id }}"
                                                        data-status="{{ $item->status_proyek }}" data-mulai="{{ $item->mulai }}"
                                                        data-tenggat="{{ $item->tenggat }}" data-deskripsi="{{ $item->deskripsi ?? '' }}"
                                                        data-bs-toggle="modal" data-bs-target="#linimasaEditModal">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>

                                                    <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $item->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>

                                                    <form id="delete-form-{{ $item->id }}" action="{{ route('linimasa.destroy', $item->id) }}"
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
                    </div>
                </div>
            </div>
        @endif
    </div>

    @include('linimasa/create')
    @include('linimasa/edit')
    @include('linimasa/info')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let toggleButton = document.getElementById("toggleView");
            if (toggleButton) {
                toggleButton.addEventListener("click", function () {
                    document.getElementById("tableContainer").classList.toggle("d-none");
                    document.getElementById("timelineContainer").classList.toggle("d-none");
                    
                    if (this.textContent.includes("Tabel")) {
                        this.innerHTML = '<i class="bi bi-calendar-week"></i> Tampilkan Linimasa';
                    } else {
                        this.innerHTML = '<i class="bi bi-table"></i> Tampilkan Tabel';
                    }
                });
            }

            let container = document.getElementById("timeline");
            let zoomStep = 0.5;

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

            let items = new vis.DataSet([
                @foreach ($linimasa as $item)
                    {
                        id: {{ $item->id }},
                        content: "{{ $item->proyek->nama_proyek }}",
                        start: "{{ $item->mulai }}",
                        end: "{{ $item->tenggat }}",
                        group: {{ $item->pegawai->id }},
                        subgroup: {{ $loop->index + 1 }},
                        status: "{{ $item->status_proyek }}",
                        deskripsi: "{{ $item->deskripsi ?? 'Tidak ada deskripsi' }}",
                        pegawai: "{{ $item->pegawai->nama }}",
                        proyek: "{{ $item->proyek->nama_proyek }}",
                        style: "background-color: {{
                          match ($item->status_proyek) {
                              'Selesai Lebih Cepat' => '#10b981; color: white;',
                              'Tepat Waktu' => '#a7f3d0; color: #065f46;',
                              'Terlambat' => '#ef4444; color: white;',
                              'Revisi' => '#fb923c; color: #7c2d12;',
                              'Proses' => '#3b82f6; color: white;',
                              'To Do Next' => '#6b7280; color: white;',
                              default => '#e5e7eb; color: #1f2937;',
                          }
                        }}; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);"
                    },
                @endforeach
            ]);

            let groups = new vis.DataSet([
                @foreach ($pegawai as $p)
                    {
                        id: {{ $p->id }},
                        content: "{{ $p->nama }}"
                    },
                @endforeach
            ]);

            let options = {
                groupOrder: "content",
                stack: false,
                subgroupOrder: "subgroup",
                showCurrentTime: true,
                zoomable: true,
                orientation: { axis: "top" },
                margin: {
                    item: 10,
                    axis: 10
                }
            };

            let timeline = new vis.Timeline(container, items, groups, options);

            // Modal Info
            timeline.on("select", function (props) {
                if (props.items.length > 0) {
                    let itemId = props.items[0];
                    let item = items.get(itemId);

                    $("#infoNamaPegawai").text(item.pegawai);
                    $("#infoNamaProyek").text(item.proyek);
                    $("#infoMulai").text(item.start);
                    $("#infoTenggat").text(item.end);
                    $("#infoStatus").text(item.status);
                    $("#infoDeskripsi").text(item.deskripsi);

                    $("#modalInfoLinimasa").modal("show");
                }
            });

            // Validasi Tanggal Mulai dan Tenggat
            let mulaiInput = document.getElementById("mulai");
            let tenggatInput = document.getElementById("tenggat");

            function validateDateInput() {
                let mulai = new Date(mulaiInput.value);
                let tenggat = new Date(tenggatInput.value);

                if (mulai > tenggat) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan Input',
                        text: 'Tanggal mulai tidak boleh lebih besar dari tenggat!',
                    });

                    // Reset input yang bermasalah
                    mulaiInput.value = "";
                    return false;
                }
                return true;
            }

            mulaiInput.addEventListener("change", validateDateInput);
            tenggatInput.addEventListener("change", validateDateInput);

            // Submit Edit Linimasa
            let editForm = document.getElementById("editLinimasaForm");
            if (editForm) {
                editForm.addEventListener("submit", function (event) {
                    event.preventDefault();

                    if (!validateDateInput()) return;

                    let formData = new FormData(editForm);
                    let id = document.getElementById("edit_linimasa_id").value;

                    fetch("{{ url('linimasa') }}/" + id, {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                let modalElement = document.getElementById("linimasaEditModal");
                                let modalInstance = bootstrap.Modal.getInstance(modalElement);
                                if (modalInstance) {
                                    modalInstance.hide();
                                }

                                document.querySelectorAll(".modal-backdrop").forEach(el => el.remove());

                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil!",
                                    text: "Data Linimasa berhasil diperbarui!",
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Gagal!",
                                    text: data.message || "Terjadi kesalahan saat memperbarui data.",
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Gagal memperbarui data. Coba lagi!",
                            });
                        });
                });
            }

            // Pop Up Hapus
            document.querySelectorAll(".btn-delete").forEach(button => {
                button.addEventListener("click", function () {
                    let id = this.getAttribute("data-id");

                    Swal.fire({
                        title: "Yakin ingin menghapus?",
                        text: "Data linimasa yang dihapus tidak dapat dikembalikan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, Hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`{{ url('linimasa') }}/${id}`, {
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                                    "X-HTTP-Method-Override": "DELETE"
                                }
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Berhasil!",
                                            text: "Data Linimasa berhasil dihapus!",
                                            showConfirmButton: false,
                                            timer: 2000
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Gagal!",
                                            text: "Terjadi kesalahan saat menghapus data.",
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Gagal menghapus data. Coba lagi!",
                                    });
                                });
                        }
                    });
                });
            });
        });
    </script>

</body>

</html>