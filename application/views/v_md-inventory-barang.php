 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inventory Barang<br/>
        <small>menu manajemen data inventory barang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Inventory Barang</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box-tools pull-right">
        <form class="form-inline">
          <div class="form-group">
            <a href="<?php echo base_url(); ?>inventorybarang/cekstokopname" class="btn btn-block btn-flat btn-warning"><i class="fa fa-search"></i> Cek Stok Opname</a>
          </div>
          <div class="form-group">
            <a href="<?php echo base_url(); ?>inventorybarang/cetak" target="_blank" class="btn btn-block btn-flat btn-info"><i class="fa fa-print"></i> Cetak QR Code</a>
          </div>
          <div class="form-group">
          <a href="javascript:void(0);" class="btn btn-block btn-flat btn-success" data-toggle="modal" data-target="#modal-lg"><i class="fa fa-plus"></i> Tambah Data</a>
          </div>
        </form>
      </div>
    <br/><br/>
      <!-- Default box -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tabel Inventory Barang</h3>
        </div>
        <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="5%">#</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Jenis Barang</th>
                  <th>Stok</th>
                  <th>Satuan</th>
                  <th style="text-align: center;" width="15%">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach($inventory as $data){ ?>
                    <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo strtoupper($data->kode_barang); ?></td>
                    <td><?php echo strtoupper($data->nama_barang); ?></td>
                    <td><?php echo strtoupper($data->jenis); ?></td>
                    <td><?php echo $data->stok; ?></td>
                    <td><?php echo ucwords($data->satuan); ?></td>
                    <td>
                        <a href="<?php echo base_url(); ?>inventorybarang/show/<?php echo $data->id_barang; ?>" class="btn btn-flat btn-success btn-xs">Detail</a>
                        <a href="javascript:void(0);" class="btn btn-flat btn-info btn-xs" data-toggle="modal" data-target="#editinventory<?php echo $data->id_barang; ?>">Ubah</a>
                        <a href="javascript:void(0);" class="btn btn-flat btn-danger btn-xs" data-toggle="modal" data-target="#hapusinventory<?php echo $data->id_barang; ?>">Hapus</a>
                    </td>
                    </tr>

                    <div class="modal fade" id="editinventory<?php echo $data->id_barang; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <form action="<?php echo base_url(); ?>inventorybarang/edit" method="post" enctype="multipart/form-data">
                            <div class="modal-header" style="background-color: #00a65a; color: white;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Ubah Data</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Barang</label>
                                    <input type="hidden" name="id" value="<?php echo $data->id_barang; ?>"/>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="kode_barang" readonly value="<?php echo $data->kode_barang; ?>" required placeholder="Ketikan kode barang">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Barang</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="nama_barang" value="<?php echo $data->nama_barang; ?>" required placeholder="Ketikan nama barang">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Stok Barang</label>
                                    <input type="number" class="form-control" id="exampleInputEmail1" name="stok" value="<?php echo $data->stok; ?>" required placeholder="Ketikan stok barang">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Satuan Barang</label>
                                    <select class="form-control select2" style="width: 100%;" name="satuan_barang" required>
                                    <option selected="selected" value="<?php echo $data->id_satuan; ?>"><?php echo $data->satuan; ?></option>
                                        <?php foreach($satuan as $dtsatuan){ ?>
                                            <option value="<?php echo $dtsatuan->id_satuan; ?>"><?php echo $dtsatuan->satuan; ?> - <?php echo $dtsatuan->jenis; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Foto Barang</label>
                                    <input type="file" class="form-control" id="exampleInputEmail1" name="file_barang" accept="image/png, image/jpeg, image/jpg">
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

                    <div class="modal fade" id="hapusinventory<?php echo $data->id_barang; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <form action="<?php echo base_url(); ?>inventorybarang/delete" method="post">
                            <div class="modal-header" style="background-color: #d33724; color: white;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Hapus Data</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo $data->id_barang; ?>"/>
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
            <form action="<?php echo base_url(); ?>inventorybarang/create" method="post" enctype="multipart/form-data">
              <div class="modal-header" style="background-color: #00a65a; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Kode Barang</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="kode_barang" readonly value="<?php echo $autonumber; ?>">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Barang</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="nama_barang" required placeholder="Ketikan nama barang">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Stok Barang</label>
                  <input type="number" class="form-control" id="exampleInputEmail1" name="stok" required placeholder="Ketikan stok barang">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Satuan Barang / Jenis Barang</label>
                  <select class="form-control select2" style="width: 100%;" name="satuan_barang" required>
                  <option selected="selected" value="">-Pilih Satuan-</option>
                    <?php foreach($satuan as $data){ ?>
                        <option value="<?php echo $data->id_satuan; ?>"><?php echo $data->satuan; ?> - <?php echo $data->jenis; ?></option>
                    <?php } ?>
                </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Foto Barang</label>
                  <input type="file" class="form-control" id="exampleInputEmail1" name="file_barang" accept="image/png, image/jpeg, image/jpg" required>
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
    Swal.fire("Berhasil","Data inventory barang logistik berhasil ditambahkan","success");
<?php }else if($this->session->flashdata('message') == 'error') { ?>
    swal("Berhasil","Data inventory logistik gagal ditambahkan","error");
<?php } ?>

<?php if($this->session->flashdata('message2') == 'successfull') { ?>
    swal("Berhasil","Data inventory logistik berhasil diubah","success");
<?php }else if($this->session->flashdata('message2') == 'error') { ?>
    swal("Berhasil","Data inventory logistik gagal diubah","error");
<?php } ?>

<?php if($this->session->flashdata('message3') == 'successfull') { ?>
    swal("Berhasil","Data inventory logistik berhasil dihapus","success");
<?php }else if($this->session->flashdata('message3') == 'error') { ?>
    swal("Berhasil","Data inventory logistik gagal dihapus","error");
<?php } ?>
</script>