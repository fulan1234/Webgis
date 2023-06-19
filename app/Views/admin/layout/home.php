<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->include('admin/template/header'); ?>
          <?= $this->renderSection('head') ?>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img
                    class="animation__shake"
                    src="/assets/dist/img/AdminLTELogo.png"
                    alt="AdminLTELogo"
                    height="60"
                    width="60">
            </div>

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="index3.html" class="brand-link">
                    <img
                        src="/Gambar/logo.png"
                        alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3"
                        style="opacity: .8; height:500px; background-color:white;">
                    <span class="brand-text font-weight-light">PTPN 7</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img
                                src="/assets/dist/img/user2-160x160.jpg"
                                class="img-circle elevation-2"
                                alt="User Image">
                        </div>
                        <div class="info" style="background-color: #343a40;">
                            <a href="#" class="d-block">User</a>
                        </div>
                    </div>

                    <!-- SidebarSearch Form -->
                    <div class="form-inline">
                        <div class="input-group" data-widget="sidebar-search">
                            <input
                                class="form-control form-control-sidebar"
                                type="search"
                                placeholder="Search"
                                aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sidebar">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <?= $this->include('admin/template/navbar'); ?>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <?= $this->renderSection('content') ?>

            <footer class="main-footer">
                <strong>Copyright &copy; 2023
                    <a href="https://adminlte.io">PTPN 7</a>.</strong>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <?= $this->include('admin/template/footer'); ?>

        <?= $this->renderSection('script') ?>
    </body>
</html>