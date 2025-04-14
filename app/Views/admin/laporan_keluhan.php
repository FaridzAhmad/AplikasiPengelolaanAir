<?= $this->extend('admin/dashboard') ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Keluhan Customer</h6>
    </div>
    <div class="card-body">
        <!-- Filter Bulan -->
        <div class="mb-3">
            <label for="filterBulan" class="form-label">Pilih Bulan:</label>
            <input type="month" id="filterBulan" class="form-control w-25">
        </div>

        <!-- Tombol Export -->
        <div class="mb-3">
            <button id="exportCSV" class="btn btn-primary">Export CSV</button>
            <button id="exportExcel" class="btn btn-success">Export Excel</button>
            <button id="exportPDF" class="btn btn-danger">Export PDF</button>
            <button id="exportPrint" class="btn btn-secondary">Print</button>
        </div>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table id="laporanTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>ID Meteran</th>
                        <th>Keluhan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($keluhan as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= date('Y-m-d', strtotime($row['created_at'])); ?></td> <!-- Pastikan format tanggal -->
                        <td><?= $row['id_meteran']; ?></td>
                        <td><?= $row['keluhan']; ?></td>
                        <td><?= $row['status']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- jsPDF dan autoTable untuk Export PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>


<script>
$(document).ready(function () {
    let table = $('#laporanTable').DataTable();

    // Filter berdasarkan bulan
    $('#filterBulan').on('change', function () {
        let bulan = $(this).val().substring(0, 7); // Format YYYY-MM
        table.column(1).search(bulan).draw();
    });

    // Export CSV
    $('#exportCSV').on('click', function () {
        exportTable('csv');
    });

    // Export Excel
    $('#exportExcel').on('click', function () {
        exportTable('excel');
    });

    // Export PDF
    $('#exportPDF').on('click', function () {
        const { jsPDF } = window.jspdf;
        let doc = new jsPDF();

        // Judul Laporan
        doc.text("Laporan Keluhan", 14, 10);

        // Ambil data tabel
        let data = [];
        $('#laporanTable tbody tr').each(function () {
            let rowData = [];
            $(this).find('td').each(function () {
                rowData.push($(this).text().trim());
            });
            data.push(rowData);
        });

        // Buat tabel PDF
        doc.autoTable({
            head: [['No', 'Tanggal', 'ID Meteran', 'Keluhan', 'Status']], // Header tabel
            body: data, // Data dari tabel
            startY: 20
        });

        // Simpan PDF
        doc.save("laporan_keluhan.pdf");
    });

    // Print
    $('#exportPrint').on('click', function () {
        window.print();
    });

    // Fungsi Export
    function exportTable(type) {
        let tableData = [];
        let rows = $('#laporanTable tr').each(function () {
            let rowData = [];
            $(this).find('td, th').each(function () {
                rowData.push($(this).text().trim());
            });
            tableData.push(rowData);
        });

        let csvContent = "data:text/" + type + ";charset=utf-8," + tableData.map(e => e.join(",")).join("\n");
        let encodedUri = encodeURI(csvContent);
        let link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "laporan_keluhan." + type);
        document.body.appendChild(link);
        link.click();
    }
});
</script>

<?= $this->endSection() ?>
