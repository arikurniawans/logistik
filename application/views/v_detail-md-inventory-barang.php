 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inventory Barang<br/>
        <small>detail informasi data inventory barang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>inventorybarang"><i class="fa fa-archive"></i> Inventory Barang</a></li>
        <li class="active">Detail</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box-tools pull-right">
        <a href="<?php echo base_url(); ?>inventorybarang" class="btn btn-block btn-flat btn-default"><i class="fa fa-step-backward"></i> Kembali</a>
    </div><br/><br/>
      <!-- Default box -->
      <div class="row">
            <div class="col-md-7">
                <div class="box box-success">
                    <div class="box-header with-border">
                    <h3 class="box-title">Detail Informasi Barang</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td width="30%"><b>Kode Barang</b></td>
                                        <td width="2%">:</td>
                                        <td><?php echo strtoupper($kode); ?></td>
                                </tr>
                                <tr>
                                    <td width="30%"><b>Nama Barang</b></td>
                                        <td width="2%">:</td>
                                        <td><?php echo ucwords($nama_barang); ?></td>
                                </tr>
                                <tr>
                                    <td width="30%"><b>Jenis Barang</b></td>
                                        <td width="2%">:</td>
                                        <td><?php echo $jenis; ?></td>
                                </tr>
                                <tr>
                                    <td width="30%"><b>Stok / Satuan Barang</b></td>
                                        <td width="2%">:</td>
                                        <td><?php echo $stok." (".$satuan.")"; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            
            <div class="col-md-5">
                <div class="box box-success">
                    <div class="box-header with-border">
                    <h3 class="box-title">Foto Barang</h3>
                    </div>
                    <div class="box-body">
                        <center><img class="img-responsive img-thumbnail" src="<?php echo base_url(); ?>file_logistik/<?php echo $foto_barang; ?>" alt="Foto Logistik" width="60%"></center>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box box-success">
                    <div class="box-header with-border">
                    <h3 class="box-title">QR Code Barang</h3>
                    </div>
                    <div class="box-body">
                    <center><img class="img-responsive img-thumbnail" src="<?php echo base_url(); ?>qrlogistik/<?php echo $qr_code; ?>" alt="Foto Logistik" width="60%"></center>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
