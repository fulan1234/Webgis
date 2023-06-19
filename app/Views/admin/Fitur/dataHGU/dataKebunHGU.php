<?= $this->extend('/admin/Fitur/fileInti/dataKebun') ?>

<?= $this->section('dataKebun') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css">


<h1>Peta Indonesia</h1>
<div id="map"></div>

<div class="containerAdmin">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Checkbox</th>
                        <th>Kebun</th>
                        <th>Afdeling</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $key=>$value): ?>
                    <tr>
                        <td style="width: 10%;">
                            <?= $key ?>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="checkbox_value[]" value="<?= $value->gid; ?>">
                        </td>
                        <td>
                            <?= $value->kebun ?>
                        </td>
                        <td>
                            <?= $value->afdeling ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
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

<script>
    var map = L.map('map').setView({ lat : 0.0000, lon : 102.0000 }, 7);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
        }).addTo(map);
</script>

<?= $this->endSection() ?>

<button><i style="background:blue;"></i></button>