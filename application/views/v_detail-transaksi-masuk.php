 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Barang Masuk<br/>
        <small>detail informasi data logistik barang masuk</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>barangmasuk"><i class="fa fa-folder-open-o"></i> Barang Masuk</a></li>
        <li class="active">Detail</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box-tools pull-right">
        <a href="<?php echo base_url(); ?>barangmasuk" class="btn btn-block btn-flat btn-default"><i class="fa fa-step-backward"></i> Kembali</a>
    </div><br/><br/>
      <!-- Default box -->
      <div class="box box-success">
                    <div class="box-header with-border">
                    <h3 class="box-title">Detail Informasi Barang Masuk (Pengembalian Barang)</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td width="20%"><b>No. Surat Jalan</b></td>
                                    <td width="2%">:</td>
                                    <td><?php echo $nomor; ?></td>
                                </tr>
                                <tr>
                                    <td width="20%"><b>Penerima</b></td>
                                    <td width="2%">:</td>
                                    <td><?php echo ucwords($penerima); ?></td>
                                </tr>
                                <tr>
                                    <td width="20%"><b>Telepon</b></td>
                                    <td width="2%">:</td>
                                    <td><?php echo $no_telp; ?></td>
                                </tr>
                                <tr>
                                    <td width="20%"><b>Tanggal Masuk</b></td>
                                    <td width="2%">:</td>
                                    <td><?php echo $tgl_masuk; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box box-success">
                    <div class="box-header with-border">
                    <h3 class="box-title">Tabel Barang Masuk</h3>
                    </div>
                    <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th width="5%">#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Masuk</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach($bk as $masuk){ ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $masuk->kode_barang; ?></td>
                                    <td><?php echo $masuk->nama_barang; ?></td>
                                    <td><?php echo $masuk->jml_transaksi; ?> (<?php echo $masuk->satuan; ?>)</td>
                                </tr>
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
