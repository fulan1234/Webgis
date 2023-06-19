<nav class="mt-2">
    <ul
        class="nav nav-pills nav-sidebar flex-column"
        data-widget="treeview"
        role="menu"
        data-accordion="false">
        <li class="nav-item">
            <a href="<?= site_url('/maps') ?>" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>
                    Maps
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Data
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= site_url('/dataKebun') ?>" class=" nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Kebun</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('/dataCabang') ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Cabang</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>