 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Barang Keluar<br/>
        <small>buat data logistik barang keluar</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>barangkeluar"><i class="fa fa-folder-open-o"></i> Barang Keluar</a></li>
        <li class="active">Add Data</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box-tools pull-right">
        <a href="<?php echo base_url(); ?>barangkeluar" class="btn btn-block btn-flat btn-default"><i class="fa fa-step-backward"></i> Kembali</a>
    </div>
<form method="post" action="<?php echo base_url(); ?>barangkeluar/createtransaksi">
    <div class="box-tools pull-right">
        <button typw="submit" <?php if($batas == 0){ echo 'disabled'; } ?> class="btn btn-block btn-flat btn-info"><i class="fa fa-fw fa-save"></i> Simpan Data Barang Keluar</buttom>
    </div><br/><br/>
      <!-- Default box -->
      <div class="row">
            <div class="col-md-5">
                <div class="box box-success">
                    <div class="box-header with-border">
                    <h3 class="box-title">Data Penerima Barang Keluar <small>(Penanggung Jawab)</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nomor Surat jalan</label>
                            <input type="hidden" name="nomor" value="<?php echo $autonumber; ?>"/>
                            <input type="text" class="form-control" id="exampleInputEmail1" disabled required value="<?php echo $autonumber; ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Penerima</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" required name="nama" <?php if($batas == 0){ echo 'disabled'; } ?> required placeholder="Ketikan nama penerima">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tujuan</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" required name="tujuan" <?php if($batas == 0){ echo 'disabled'; } ?> required placeholder="Ketikan tujuan">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">No. Telepon</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" required name="telp" <?php if($batas == 0){ echo 'disabled'; } ?> required placeholder="Ketikan no. telepon">
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
</form>
            
            <div class="col-md-7">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Barang Keluar</h3>
                        <div class="box-tools pull-right">
                            <a href="javascript:void(0);" class="btn btn-block btn-flat btn-success" data-toggle="modal" data-target="#modal-lg"><i class="fa fa-plus"></i> Tambah Data</a>
                        </div>
                    </div>
                    <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th width="5%">#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Keluar</th>
                            <th style="text-align: center;" width="10%">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach($bk as $keluar){ ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $keluar->kode_barang; ?></td>
                                    <td><?php echo $keluar->nama_barang; ?></td>
                                    <td><?php echo $keluar->jml_transaksi; ?> (<?php echo $keluar->satuan; ?>)</td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-flat btn-danger btn-xs" data-toggle="modal" data-target="#hapusbarang<?php echo $keluar->id_cart; ?>">Hapus</a>
                                    </td>
                                </tr>

                                    <div class="modal fade" id="hapusbarang<?php echo $keluar->id_cart; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <form action="<?php echo base_url(); ?>barangkeluar/delete1" method="post">
                                            <div class="modal-header" style="background-color: #d33724; color: white;">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Hapus Data</h4>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?php echo $keluar->id_cart; ?>"/>
                                                <input type="hidden" name="idbrg" value="<?php echo $keluar->id_brg; ?>"/>
                                                <input type="hidden" name="jumlah" value="<?php echo $keluar->jml_transaksi; ?>"/>
                                                <input type="hidden" name="surat" value="<?php echo $autonumber; ?>"/>
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

            </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="modal fade" id="modal-lg">
          <div class="modal-dialog">
            <div class="modal-content">
            <form action="<?php echo base_url(); ?>barangkeluar/create" method="post">
              <div class="modal-header" style="background-color: #00a65a; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Barang</label>
                    <select class="form-control select2" style="width: 100%;" name="barang" required>
                    <option selected="selected" value="">-Pilih Barang-</option>
                        <?php foreach($barang as $data){ ?>
                            <option value="<?php echo $data->id_barang; ?>">[<?php echo $data->kode_barang; ?>] - <?php echo ucwords($data->nama_barang); ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Jumlah Barang Keluar</label>
                  <input type="number" class="form-control" id="exampleInputEmail1" name="jumlah" required placeholder="Ketikan jumlah barang">
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
    Swal.fire("Berhasil","Data barang keluar berhasil ditambahkan","success");
<?php }else if($this->session->flashdata('message') == 'error') { ?>
    swal("Berhasil","Data barang keluar gagal ditambahkan","error");
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
