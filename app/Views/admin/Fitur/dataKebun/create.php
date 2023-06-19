<?= $this->extend('admin/Fitur/fileInti/dataKebun') ?>

<?= $this->section('dataKebun') ?>
<div class="containerAdmin">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Input Data</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/storeDataKebun" method="POST" enctype="multipart/form-data">
            <input type="hidden">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Nama Daerah</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama Daerah" name="namaDaerah">
                </div>
                <div class="form-group">
                    <label for="">File geojson</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                            <label class="custom-file-label" for="exampleInputFile" placeholder="Choose File"></label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">File dbf</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="file_dbf">
                            <label class="custom-file-label" for="exampleInputFile"></label>
                        </div>
                    </div>
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