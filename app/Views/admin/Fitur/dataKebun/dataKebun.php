<?= $this->extend('/admin/Fitur/fileInti/dataKebun') ?>

<?= $this->section('dataKebun') ?>
<?php 
if(!empty($dataKebun)){
?>
    <div style="margin-left: 50px;">
        <a
            href="<?= site_url('exportDataGeojson/'.$dataKebun) ?>"
            type="button"
            class="btn btn-success m-4">
            <i class="fa fa-download"></i>
            | Download Geojson</a>
    </div>
    <div class="containerAdmin" style="padding: 0;">
<?php
}else{
?>
<div class="containerAdmin">
<?php
}
?>
    <link
        rel="stylesheet"
        type="text/css"
        href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kebun</th>
                        <th>Afdeling</th>
                        <th>blok Sap</th>
                        <th>Komoditi</th>
                        <th>Tahun Tanam</th>
                        <th>Luas</th>
                        <th>Total poko</th>
                        <th>pokok per</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $key=>$value): ?>
                    <tr>
                        <td style="width: 10%;"><?= $key+1 ?></td>
                        <td><?= $value->kebun?></td>
                        <td><?= $value->afdeling?></td>
                        <td><?= $value->blok_sap?></td>
                        <td><?= $value->komoditi?></td>
                        <td><?= $value->tahuntanam?></td>
                        <td><?= $value->luas_ha?> ha</td>
                        <td><?= $value->total_poko?></td>
                        <td><?= $value->pokok_per_?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<script
    type="text/javascript"
    language="javascript"
    src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script
    type="text/javascript"
    language="javascript"
    src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script>
    $(function () {
        $("#example1")
            .DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [
                    "copy",
                    "csv",
                    "excel",
                    "pdf",
                    "print",
                    "colvis"
                ]
            })
            .buttons()
            .container()
            .appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });
</script>

<?= $this->endSection() ?>