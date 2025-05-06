<div class="modal fade" id="modalInfoLinimasa" tabindex="-1" aria-labelledby="modalInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalInfoLabel">
                    <i class="bi bi-info-circle me-2"></i>Detail Linimasa
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card shadow-sm mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="bi bi-card-text me-2"></i>Informasi Proyek</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label small text-muted">Pegawai</label>
                                    <h6 id="infoNamaPegawai" class="border-bottom pb-2"></h6>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small text-muted">Proyek</label>
                                    <h6 id="infoNamaProyek" class="border-bottom pb-2"></h6>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label small text-muted">Mulai</label>
                                        <h6 id="infoMulai" class="border-bottom pb-2"></h6>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label small text-muted">Tenggat</label>
                                        <h6 id="infoTenggat" class="border-bottom pb-2"></h6>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small text-muted">Status</label>
                                    <div>
                                        <span id="infoStatus" class="badge rounded-pill"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0"><i class="bi bi-clock-history me-2"></i>Timeline</h6>
                            </div>
                            <div class="card-body p-0">
                                <div class="timeline p-3">
                                    <div class="timeline-item">
                                        <div class="timeline-dot bg-primary"></div>
                                        <div class="timeline-content">
                                            <small class="text-muted" id="infoMulaiTimeline"></small>
                                            <p class="small mb-0">Proyek dimulai</p>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-dot bg-warning"></div>
                                        <div class="timeline-content">
                                            <small class="text-muted" id="infoTenggatTimeline"></small>
                                            <p class="small mb-0">Tenggat waktu</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="bi bi-file-text me-2"></i>Deskripsi</h6>
                    </div>
                    <div class="card-body">
                        <p id="infoDeskripsi" class="mb-0"></p>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer bg-light">
                <div class="d-flex justify-content-between w-100">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Tutup
                    </button>
                    <div>
                        <button id="btnEditLinimasa" class="btn btn-warning btn-edit"
                            data-id=""
                            data-pegawai=""
                            data-proyek=""
                            data-status=""
                            data-mulai=""
                            data-tenggat=""
                            data-deskripsi=""
                            data-bs-toggle="modal"
                            data-bs-target="#linimasaEditModal">
                            <i class="bi bi-pencil-square me-1"></i>Edit
                        </button>

                        <button id="btnDeleteLinimasa" class="btn btn-danger ms-2 btn-delete" data-id="">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </button>

                        <form id="delete-form" action="" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom styles for timeline */
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    padding-bottom: 15px;
}

.timeline-item:last-child {
    padding-bottom: 0;
}

.timeline-dot {
    position: absolute;
    left: -30px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    top: 5px;
}

.timeline-content {
    border-left: 1px dashed #ccc;
    padding-left: 15px;
}

.timeline-item:last-child .timeline-content {
    border-left: none;
}

/* Status badge styles */
#infoStatus.badge.rounded-pill {
    font-size: 0.85rem;
    padding: 0.35rem 0.75rem;
}

/* Status color styles */
#infoStatus.badge[data-status="pending"] {
    background-color: #ffc107;
    color: #212529;
}

#infoStatus.badge[data-status="in_progress"] {
    background-color: #0d6efd;
    color: #fff;
}

#infoStatus.badge[data-status="completed"] {
    background-color: #198754;
    color: #fff;
}

#infoStatus.badge[data-status="delayed"] {
    background-color: #dc3545;
    color: #fff;
}

/* Transition effects */
.modal.fade .modal-dialog {
    transition: transform .3s ease-out;
}

.modal.fade .modal-content {
    transition: opacity .2s linear;
}

.card {
    transition: box-shadow .2s;
}

.card:hover {
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}
</style>

<script>
// Script untuk mengisi modal info dan styling dinamis
$(document).ready(function() {
    $('#modalInfoLinimasa').on('show.bs.modal', function (event) {
        // Ambil data dari button yang di-klik
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var pegawai = button.data('pegawai-nama');
        var proyek = button.data('proyek-nama');
        var status = button.data('status');
        var mulai = button.data('mulai');
        var tenggat = button.data('tenggat');
        var deskripsi = button.data('deskripsi');
        var pegawaiId = button.data('pegawai');
        var proyekId = button.data('proyek');
        
        // Format tanggal
        var formatMulai = new Date(mulai).toLocaleDateString('id-ID', { 
            day: 'numeric', month: 'long', year: 'numeric' 
        });
        var formatTenggat = new Date(tenggat).toLocaleDateString('id-ID', { 
            day: 'numeric', month: 'long', year: 'numeric' 
        });
        
        // Isi data ke dalam modal
        $('#infoNamaPegawai').text(pegawai);
        $('#infoNamaProyek').text(proyek);
        $('#infoMulai').text(formatMulai);
        $('#infoTenggat').text(formatTenggat);
        $('#infoMulaiTimeline').text(formatMulai);
        $('#infoTenggatTimeline').text(formatTenggat);
        $('#infoDeskripsi').text(deskripsi || 'Tidak ada deskripsi');
        
        // Set status dengan badge sesuai jenisnya
        var statusBadge = $('#infoStatus');
        statusBadge.text(getStatusText(status));
        statusBadge.attr('data-status', status);
        
        // Set data untuk tombol edit
        $('#btnEditLinimasa').attr('data-id', id);
        $('#btnEditLinimasa').attr('data-pegawai', pegawaiId);
        $('#btnEditLinimasa').attr('data-proyek', proyekId);
        $('#btnEditLinimasa').attr('data-status', status);
        $('#btnEditLinimasa').attr('data-mulai', mulai);
        $('#btnEditLinimasa').attr('data-tenggat', tenggat);
        $('#btnEditLinimasa').attr('data-deskripsi', deskripsi || '');
        
        // Set data untuk tombol hapus
        $('#btnDeleteLinimasa').attr('data-id', id);
        $('#delete-form').attr('action', '/linimasa/' + id);
        
        // Menghitung progress dan due date
        checkDueDate(tenggat);
    });
    
    // Fungsi untuk teks status yang lebih baik
    function getStatusText(status) {
        switch(status) {
            case 'pending': return 'Menunggu';
            case 'in_progress': return 'Sedang Berjalan';
            case 'completed': return 'Selesai';
            case 'delayed': return 'Tertunda';
            default: return status;
        }
    }
    
    // Fungsi untuk mengecek tenggat waktu
    function checkDueDate(tenggat) {
        var today = new Date();
        var dueDate = new Date(tenggat);
        var daysLeft = Math.floor((dueDate - today) / (1000 * 60 * 60 * 24));
        
        // Hapus elemen sebelumnya jika ada
        $('.due-date-info').remove();
        
        var dueDateInfo = $('<div class="mt-3 text-center due-date-info"></div>');
        
        if (daysLeft < 0) {
            dueDateInfo.addClass('text-danger').text('Telah melewati tenggat ' + Math.abs(daysLeft) + ' hari');
        } else if (daysLeft === 0) {
            dueDateInfo.addClass('text-warning').text('Jatuh tempo hari ini!');
        } else if (daysLeft <= 3) {
            dueDateInfo.addClass('text-warning').text('Jatuh tempo dalam ' + daysLeft + ' hari');
        } else {
            dueDateInfo.addClass('text-success').text('Jatuh tempo dalam ' + daysLeft + ' hari');
        }
        
        $('#infoTenggat').after(dueDateInfo);
    }
    
    // Animasi untuk button delete
    $('#btnDeleteLinimasa').hover(
        function() {
            $(this).html('<i class="bi bi-exclamation-triangle-fill me-1"></i>Konfirmasi');
        },
        function() {
            $(this).html('<i class="bi bi-trash me-1"></i>Hapus');
        }
    );
    
    // Konfirmasi hapus
    $('#btnDeleteLinimasa').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#delete-form').submit();
            }
        });
    });
});
</script>