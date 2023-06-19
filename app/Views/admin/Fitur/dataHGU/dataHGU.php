<?= $this->extend('/admin/Fitur/fileInti/dataCabang') ?>

<?= $this->section('dataCabang') ?>
<div class="containerAdmin">
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
                                    <a class="btn btn-warning" href="#" style="margin-right: 5px;"><i class="fa fa-edit"></i></a>
                                    <form action="#" method="post">
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" class="btn btn-danger" style="margin-right: 5px;"><i class="fa fa-trash"></i></button>
                                    </form>
                                    <a class="btn btn-primary" href="<?= site_url('tampilDataHGU/'.$value->id_cabang_kebun) ?>"><i class="fa fa-eye"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

<?= $this->endSection() ?>