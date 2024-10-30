<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('/')?>" class="brand-link">
      <img src="<?php echo base_url('favicon.ico');?>" alt="PT Perta Sakti Abadi" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PT Perta Sakti Abadi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 text-center">
        <div class="info">
          <h4">
          <?php
            if(!empty(session()->get('nama'))) {
              echo session()->get('nama');
            } 
          ?>
          </h4>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- <li class="nav-header">EXAMPLES</li> -->
          <li class="nav-item">
            <a href="<?php echo base_url('/')?>" class="nav-link <?=$page === 'dashboard' ? ' active' : '';?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('pemasukan')?>" class="nav-link <?=$page === 'pemasukan' ? ' active' : '';?>">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p class="text">Pemasukan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('pengeluaran')?>" class="nav-link <?=$page === 'pengeluaran' ? ' active' : '';?>">
              <i class="nav-icon fas fa-money-bill"></i>
              <p class="text">Pengeluaran</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('laporan')?>" class="nav-link <?=$page === 'laporan' ? ' active' : '';?>">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p class="text">Laporan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('produk')?>" class="nav-link <?=$page === 'produk' ? ' active' : '';?>">
              <i class="nav-icon fas fa-oil-can"></i>
              <p class="text">Produk</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('profil')?>" class="nav-link <?=$page === 'profil' ? ' active' : '';?>">
              <i class="nav-icon fas fa-user"></i>
              <p class="text">Profil</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>