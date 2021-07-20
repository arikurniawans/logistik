 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Barang masuk<br/>
        <small>menu manajemen data logistik barang masuk</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Barang Masuk</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box-tools pull-right">
    <a href="javascript:void(0);" class="btn btn-block btn-flat btn-success" data-toggle="modal" data-target="#modal-lg"><i class="fa fa-plus"></i> Tambah Data</a>
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
                  <th>Total Barang masuk</th>
                  <th style="text-align: center;" width="15%">Aksi</th>
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
                          <td>
                              <a href="<?php echo base_url(); ?>barangmasuk/show/<?php echo $data->surat_jalan; ?>" class="btn btn-flat btn-info btn-xs">Detail</a>
                              <a href="javascript:void(0);" data-toggle="modal" data-target="#hapustransaksi<?php echo $data->surat_jalan; ?>" class="btn btn-flat btn-danger btn-xs">Hapus</a>
                          </td>
                      </tr>

                      <div class="modal fade" id="hapustransaksi<?php echo $data->surat_jalan; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <form action="<?php echo base_url(); ?>barangmasuk/deletetransaksi" method="post">
                                            <div class="modal-header" style="background-color: #d33724; color: white;">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Hapus Data</h4>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="surat" value="<?php echo $data->surat_jalan; ?>"/>
                                                Apakah anda yakin akan menghapus data berikut ?
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-flat btn-danger">Hapus Data</button>
                                                </div>
                                            </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->

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

  <div class="modal fade" id="modal-lg">
          <div class="modal-dialog">
            <div class="modal-content">
            <form action="<?php echo base_url(); ?>barangmasuk/add" method="get">
              <div class="modal-header" style="background-color: #00a65a; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Filter Data Surat Jalan</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nomor Surat Jalan</label>
                  <select class="form-control select2" style="width: 100%;" name="nosurat" required>
                    <option selected="selected" value="">-Pilih No. Surat Jalan-</option>
                        <?php foreach($bk as $data){ ?>
                            <option value="<?php echo $data->surat_jalan; ?>">#<?php echo $data->surat_jalan; ?> - Penerima : <?php echo ucwords($data->penerima); ?></option>
                        <?php } ?>
                    </select>
                </div>
              </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-flat btn-success">Submit</button>
                </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


<script type='text/javascript'>
<?php if($this->session->flashdata('message') == 'successfull') { ?>
    Swal.fire("Berhasil","Data logistik barang masuk berhasil ditambahkan","success");
<?php }else if($this->session->flashdata('message') == 'error') { ?>
    swal("Berhasil","Data logistik barang masuk gagal ditambahkan","error");
<?php } ?>

<?php if($this->session->flashdata('message2') == 'successfull') { ?>
    swal("Berhasil","Data logistik barang masuk berhasil diubah","success");
<?php }else if($this->session->flashdata('message2') == 'error') { ?>
    swal("Berhasil","Data logistik barang masuk gagal diubah","error");
<?php } ?>

<?php if($this->session->flashdata('message3') == 'successfull') { ?>
    swal("Berhasil","Data logistik barang masuk berhasil dihapus","success");
<?php }else if($this->session->flashdata('message3') == 'error') { ?>
    swal("Berhasil","Data logistik barang masuk gagal dihapus","error");
<?php } ?>
</script>