<?= $this->extend('/admin/Fitur/fileInti/dataCabang') ?>

<?= $this->section('dataCabang') ?>
<div class="containerAdmin">
<div>
    <a href="/createDataCabang" type="button" class="btn btn-success m-4"><i class="fa fa-plus"></i> Tambah Data</a>
</div>
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $key=>$value): ?>
                        <tr>
                            <td style="width: 10%;"><?= $key+1 ?></td>
                            <td><?= $value->nama_cabang_kebun?></td>
                            <td>
                                <div class="d-flex align-items-start">
                                    <a class="btn btn-warning" href="/editCabang/<?= $value->id_cabang_kebun ?>" style="margin-right: 5px;"><i class="fa fa-edit"></i></a>
                                    <form action="/deleteCabang/<?= $value->id_cabang_kebun ?>" method="post">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" class="btn btn-danger" style="margin-right: 5px;"><i class="fa fa-trash"></i></button>
                                    </form>
                                    <a class="btn btn-primary" href="<?= site_url('tampilDataKebun/'.$value->id_cabang_kebun) ?>"><i class="fa fa-eye"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<?= $this->endSection() ?>