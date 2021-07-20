  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ucwords($this->session->userdata('nama')); ?></p>
          <?php echo ucwords($this->session->userdata('user_status')); ?>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">DASHBOARD</li>
        <li class="active">
          <a href="<?php echo base_url(); ?>dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="header">MANAJEMEN DATA</li>
          <li><a href="<?php echo base_url(); ?>inventorybarang"><i class="fa fa-archive"></i> <span>Inventory Barang</span></a></li>
          <li><a href="<?php echo base_url(); ?>barangkeluar"><i class="fa fa-folder-open-o"></i> <span>Barang Keluar</span></a></li>
          <li><a href="<?php echo base_url(); ?>barangmasuk"><i class="fa fa-folder-open"></i> <span>Barang Masuk</span></a></li>

          <li class="header">LAPORAN</li>
          <!-- <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Stok Opname Gudang</span></a></li> -->
          <li><a href="<?php echo base_url(); ?>laporan/laporanmasuk"><i class="fa fa-book"></i> <span>Barang Masuk</span></a></li>
          <li><a href="<?php echo base_url(); ?>laporan/laporankeluar"><i class="fa fa-book"></i> <span>Barang Keluar</span></a></li>

        <li class="header">PENGATURAN</li>
          <li><a href="<?php echo base_url(); ?>jenis"><i class="fa fa-briefcase"></i> <span>Jenis Barang</span></a></li>
          <li><a href="<?php echo base_url(); ?>satuan"><i class="fa fa-bookmark"></i> <span>Satuan Barang</span></a></li>
          <!-- <li><a href="https://adminlte.io/docs"><i class="fa fa-users"></i> <span>Pengguna</span></a></li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>