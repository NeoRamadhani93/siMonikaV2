<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SiMonika</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- Sidebar -->
    @include('templates/sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-0">Dashboard Monitoring</h2>
                <p class="text-muted">Selamat datang, {{ $user->nama }}</p>
            </div>
            <div class="d-flex align-items-center">
                <i class="bi bi-clock me-2"></i>
                <span id="lastUpdate">Update Terakhir: {{ $lastUpdate->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm [WIB]') }}</span>
            </div>
        </div>

        <!-- Statistik Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card stat-card h-100">
                    <div class="card-body status-active">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2">Aplikasi Aktif</h6>
                                <h2 class="card-title-info mb-0">{{ $jumlahAplikasiAktif }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card h-100">
                    <div class="card-body status-unused">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-subtitle mb-2">Aplikasi Tidak Digunakan</h6>
                                <h2 class="card-title-info mb-0">{{ $jumlahAplikasiTidakDigunakan }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tambahkan include template charts -->
        @include('templates.charts')

        <div class="card">
            <div class="card-header border-0 bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Status Aplikasi</h5>
                </div>
            </div>
            <!-- Table -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Nama Aplikasi</th>
                                <th>Status</th>
                                <th>Jenis Aplikasi</th>
                                <th>Basis Aplikasi</th>
                                <th>Pengembang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($aplikasis) && $aplikasis->isNotEmpty())
                                @foreach ($aplikasis as $aplikasi)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="app-icon me-3 bg-primary bg-opacity-10 p-2 rounded">
                                                    <i class="bi bi-app text-primary"></i>
                                                </div>
                                                <span>{{ $aplikasi->nama }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($aplikasi->status_pemakaian == 'Aktif')
                                                <span class="status-badge status-active">Aktif</span>
                                            @else
                                                <span class="status-badge status-unused">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>{{ $aplikasi->jenis }}</td>
                                        <td>
                                            @if ($aplikasi->basis_aplikasi === 'Desktop')
                                                <i class="bi bi-laptop me-1"></i>
                                            @elseif ($aplikasi->basis_aplikasi === 'Mobile')
                                                <i class="bi bi-phone me-1"></i>
                                            @elseif ($aplikasi->basis_aplikasi === 'Website')
                                                <i class="bi bi-browser-chrome me-1"></i>
                                            @endif
                                            <span>{{ $aplikasi->basis_aplikasi }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $aplikasi->pengembang }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data aplikasi tersedia.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        <div class="pagination-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="{{ asset('js/index/chart.js') }}"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/index/pagination.js') }}"></script>
    <script src="{{ asset('js/index/last-update.js') }}"></script>
</body>

</html>
