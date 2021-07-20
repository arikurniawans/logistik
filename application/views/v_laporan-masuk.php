 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Barang Masuk<br/>
        <small>menu laporan data logistik barang masuk</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Laporan Barang Masuk</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box-tools pull-right">
            <form class="form-inline" action="<?php echo base_url(); ?>laporan/laporanmasuk" method="post">
                <div class="form-group">
                    <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="tgl1" id="datepicker1" autocomplete="off" placeholder="Periode 1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">s/d</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="tgl2" id="datepicker2" autocomplete="off" placeholder="Periode 2">
                    </div>
                </div>		
                <button type="submit" class="btn btn-flat btn-success"><i class="fa fa-filter"></i> Filter Data</button>
		</form>
    </div>
    <br/><br/>
      <!-- Default box -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tabel Barang Masuk</h3>
        </div>
        <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                  <th width="5%">#</th>
                  <th>Tanggal Masuk</th>
                  <th>Penerima</th>
                  <th>Tujuan</th>
                  <th>No. Surat Jalan</th>
                  <th>Total Barang Masuk</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach($barang as $data){ ?>
                      <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $data->tgl_masuk; ?></td>
                          <td><?php echo $data->penerima; ?></td>
                          <td><?php echo $data->tujuan; ?></td>
                          <td><?php echo $data->surat_jalan; ?></td>
                          <td><?php echo $data->jml_trans; ?> Item</td>

                <?php } ?>
                </tbody>
        </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->