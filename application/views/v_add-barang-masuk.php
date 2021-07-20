 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Barang Masuk<br/>
        <small>ubah data logistik barang masuk</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>barangmasuk"><i class="fa fa-folder-open"></i> Barang Masuk</a></li>
        <li class="active">Add Data</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box-tools pull-right">
        <a href="<?php echo base_url(); ?>barangmasuk" class="btn btn-block btn-flat btn-default"><i class="fa fa-step-backward"></i> Kembali</a>
    </div>
<form method="post" action="<?php echo base_url(); ?>barangmasuk/changetransaksi">
    <div class="box-tools pull-right">
        <button typw="submit" <?php if($batas == 0){ echo 'disabled'; } ?> class="btn btn-block btn-flat btn-info"><i class="fa fa-fw fa-save"></i> Simpan Data Barang Masuk</buttom>
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
                            <input type="hidden" name="nomor" value="<?php echo $nosurat; ?>"/>
                            <input type="text" class="form-control" id="exampleInputEmail1" disabled required value="<?php echo $nosurat; ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Penerima</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="nama" value="<?php echo $penerima; ?>" <?php if($batas == 0){ echo 'disabled'; } ?> required placeholder="Ketikan nama penerima">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tujuan</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="tujuan" value="<?php echo $tujuan; ?>" <?php if($batas == 0){ echo 'disabled'; } ?> required placeholder="Ketikan tujuan">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">No. Telepon</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="telp" value="<?php echo $no_telp; ?>" <?php if($batas == 0){ echo 'disabled'; } ?> required placeholder="Ketikan no. telepon">
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
                        <h3 class="box-title">Data Barang Keluar <small>(Data barang yang dikembalikan)</small></h3>
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
                                    <td><?php echo $keluar->jml_transaksi; ?></td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-flat btn-warning btn-xs" data-toggle="modal" data-target="#restokbarang<?php echo $keluar->id_cart; ?>">Restok Inventory</a>
                                    </td>
                                </tr>

                                    <div class="modal fade" id="restokbarang<?php echo $keluar->id_cart; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <form action="<?php echo base_url(); ?>barangmasuk/create" method="post">
                                            <div class="modal-header" style="background-color: #00a65a; color: white;">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Konfirmasi Pengembalian Barang</h4>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?php echo $keluar->id_cart; ?>"/>
                                                <input type="hidden" name="idbrg" value="<?php echo $keluar->id_brg; ?>"/>
                                                <input type="hidden" name="jumlah" value="<?php echo $keluar->jml_transaksi; ?>"/>
                                                <input type="hidden" name="surat" value="<?php echo $nosurat; ?>"/>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Status Barang</label>
                                                    <select class="form-control" style="width: 100%;" name="status" required>
                                                        <option selected="selected" value="b">Baik</option>
                                                        <option value="r">Rusak</option>
                                                        <option value="h">Hilang</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Catatan <small><font color="red">(Apabila tidak ada catatan harap mengisi tanda - )</font></small></label>
                                                    <textarea class="form-control" rows="3" name="catatan" required placeholder="Isi Catatan"></textarea>
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

<script type='text/javascript'>
<?php if($this->session->flashdata('message') == 'successfull') { ?>
    Swal.fire("Berhasil","Data barang masuk berhasil ditambahkan","success");
<?php }else if($this->session->flashdata('message') == 'error') { ?>
    swal("Berhasil","Data barang masuk gagal ditambahkan","error");
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
