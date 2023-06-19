<?= $this->extend('admin/layout/home') ?>

<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<?= $this->include('admin/fitur/dashboard/header') ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <!-- Small boxes (Stat box) -->
      <?= $this->include('admin/fitur/dashboard/boxInfo') ?>

        <!-- Main row -->
        <?= $this->include('admin/fitur/dashboard/mainRow') ?>
        <!-- /.row (main row) -->
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?= $this->endSection() ?>