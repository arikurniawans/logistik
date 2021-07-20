 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Jenis Barang<br/>
        <small>menu pengaturan jenis barang logistik</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Jenis Barang</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box-tools pull-right">
        <a href="javascript:void(0);" class="btn btn-block btn-flat btn-success" data-toggle="modal" data-target="#modal-lg"><i class="fa fa-plus"></i> Tambah Data</a>
    </div><br/><br/>
      <!-- Default box -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tabel Jenis Barang</h3>
        </div>
        <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="5%">#</th>
                  <th>Nama Jenis Barang</th>
                  <th width="20%">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach($jenis as $data){ ?>
                    <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo strtoupper($data->jenis); ?></td>
                    <td>
                        <a href="javascript:void(0);" class="btn btn-flat btn-info btn-xs" data-toggle="modal" data-target="#editjenis<?php echo $data->id_jenis; ?>">Ubah</a>
                        <a href="javascript:void(0);" class="btn btn-flat btn-danger btn-xs" data-toggle="modal" data-target="#hapusjenis<?php echo $data->id_jenis; ?>">Hapus</a>
                    </td>
                    </tr>

                    <div class="modal fade" id="editjenis<?php echo $data->id_jenis; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <form action="<?php echo base_url(); ?>jenis/edit" method="post">
                            <div class="modal-header" style="background-color: #00a65a; color: white;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Ubah Data</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Nama Jenis Barang</label>
                                <input type="hidden" name="id" value="<?php echo $data->id_jenis; ?>"/>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="jenis" required value="<?php echo $data->jenis; ?>" placeholder="Ketikan nama jenis barang">
                                </div>
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-flat btn-success">Simpan Perubahan Data</button>
                                </div>
                            </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->

                    <div class="modal fade" id="hapusjenis<?php echo $data->id_jenis; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <form action="<?php echo base_url(); ?>jenis/delete" method="post">
                            <div class="modal-header" style="background-color: #d33724; color: white;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Hapus Data</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo $data->id_jenis; ?>"/>
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
            <form action="<?php echo base_url(); ?>jenis/create" method="post">
              <div class="modal-header" style="background-color: #00a65a; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Jenis Barang</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="jenis" required placeholder="Ketikan nama jenis barang">
                </div>
              </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-flat btn-success">Simpan Data</button>
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
    Swal.fire("Berhasil","Data jenis barang logistik berhasil ditambahkan","success");
<?php }else if($this->session->flashdata('message') == 'error') { ?>
    swal("Berhasil","Data jenis barang logistik gagal ditambahkan","error");
<?php } ?>

<?php if($this->session->flashdata('message2') == 'successfull') { ?>
    swal("Berhasil","Data jenis barang logistik berhasil diubah","success");
<?php }else if($this->session->flashdata('message2') == 'error') { ?>
    swal("Berhasil","Data jenis barang logistik gagal diubah","error");
<?php } ?>

<?php if($this->session->flashdata('message3') == 'successfull') { ?>
    swal("Berhasil","Data jenis barang logistik berhasil dihapus","success");
<?php }else if($this->session->flashdata('message3') == 'error') { ?>
    swal("Berhasil","Data jenis barang logistik gagal dihapus","error");
<?php } ?>
</script>