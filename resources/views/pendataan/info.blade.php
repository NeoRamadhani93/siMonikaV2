<div class="modal fade" id="modalInfoPendataan" tabindex="-1" aria-labelledby="modalInfoPendataanLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalInfoPendataanLabel">Detail Pendataan Magang</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="info-pendataan-id">
                <div class="row">
                    <div class="col-12">
                        <p><strong>Universitas:</strong> <span id="infoUniversitas"></span></p>
                        <p><strong>Jumlah Orang:</strong> <span id="infoJumlahOrang"></span></p>
                        <p><strong>Tanggal Masuk:</strong> <span id="infoTanggalMasuk"></span></p>
                        <p><strong>Tanggal Keluar:</strong> <span id="infoTanggalKeluar"></span></p>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <div>
                    <button id="info-btn-edit" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i> Edit
                    </button>
                    <button id="info-btn-delete" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Handle tombol edit dari modal info
        document.getElementById("info-btn-edit").addEventListener("click", function() {
            let id = document.getElementById("info-pendataan-id").value;
            let universitas = document.getElementById("infoUniversitas").textContent;
            let jumlah_orang = document.getElementById("infoJumlahOrang").textContent;
            let tanggal_masuk = document.getElementById("infoTanggalMasuk").textContent;
            let tanggal_keluar = document.getElementById("infoTanggalKeluar").textContent;
            
            // Tutup modal info
            bootstrap.Modal.getInstance(document.getElementById("modalInfoPendataan")).hide();
            
            // Isi data ke form edit
            document.getElementById("edit-universitas").value = universitas;
            document.getElementById("edit-jumlah_orang").value = jumlah_orang;
            document.getElementById("edit-tanggal_masuk").value = tanggal_masuk;
            document.getElementById("edit-tanggal_keluar").value = tanggal_keluar;
            
            // Set action form
            let form = document.getElementById("pendataanEditForm");
            let baseAction = form.getAttribute("data-base-action");
            form.action = baseAction.replace(":id", id);
            
            // Tampilkan modal edit
            new bootstrap.Modal(document.getElementById("pendataanEditModal")).show();
        });
        
        // Handle tombol delete dari modal info
        document.getElementById("info-btn-delete").addEventListener("click", function() {
            let id = document.getElementById("info-pendataan-id").value;
            
            Swal.fire({
                title: "Yakin ingin menghapus?",
                text: "Data pendataan yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Buat form untuk delete
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
                    
                    // Tambahkan input ke form
                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    
                    // Tambahkan form ke DOM dan submit
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
</script>