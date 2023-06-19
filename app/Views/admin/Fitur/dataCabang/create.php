<?= $this->extend('admin/Fitur/fileInti/dataCabang') ?>

<?= $this->section('dataCabang') ?>
<div class="containerAdmin">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Input Data</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/storeDataCabang" method="POST" enctype="multipart/form-data">
            <input type="hidden">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Nama Tempat</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama Daerah" name="nama_cabang_kebun">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>