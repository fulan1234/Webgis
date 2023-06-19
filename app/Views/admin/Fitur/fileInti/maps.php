<?= $this->extend('admin/layout/home') ?>

<?= $this->section('head') ?>
<?= $this->include('admin/fitur/maps/cssMap') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <?= $this->include('admin/fitur/maps/maps') ?>
            <?= $this->renderSection('dataMaps') ?>
        </div>
        
    </section>

</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<?= $this->include('admin/fitur/maps/jsMap') ?>
<?= $this->endSection() ?>