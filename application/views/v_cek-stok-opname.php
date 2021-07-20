 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cek Stok Opname<br/>
        <small>menu cek stok opname data logistik barang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>inventorybarang"><i class="fa fa-archive"></i> Inventory Barang</a></li>
        <li class="active">Cek Stok Opname</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="box-tools pull-right">
        <a href="<?php echo base_url(); ?>inventorybarang" class="btn btn-block btn-flat btn-default"><i class="fa fa-step-backward"></i> Kembali</a>
    </div>
    <br/><br/>
      <div class="row">
            <div class="col-md-7">
                  <!-- Default box -->
                  <div class="box box-success">
                    <div class="box-header with-border">
                      <h3 class="box-title">Detail Informasi Barang</h3>
                    </div>
                    <div class="box-body">
                          <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td width="20%"><b>Kode Barang</b></td>
                                    <td width="2%">:</td>
                                    <td><p id="kodebrg">-</p></td>
                                </tr>
                                <tr>
                                    <td width="20%"><b>Nama Barang</b></td>
                                    <td width="2%">:</td>
                                    <td><p id="namabrg">-</p></td>
                                </tr>
                                <tr>
                                    <td width="20%"><b>Jenis Barang</b></td>
                                    <td width="2%">:</td>
                                    <td><p id="jenisbrg">-</p></td>
                                </tr>
                                <tr>
                                    <td width="20%"><b>Stok Terakhir</b></td>
                                    <td width="2%">:</td>
                                    <td><p id="stok">-</p></td>
                                </tr>
                                <tr>
                                    <td width="20%"><b>Foto Barang</b></td>
                                    <td width="2%">:</td>
                                    <td><img id="foto_brg" class="img-responsive img-thumbnail" src="<?php echo base_url(); ?>assets/dist/img/no-photo.svg" alt="Foto Logistik" width="60%"/></td>
                                </tr>
                            </tbody>
                          </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
            </div>

            <div class="col-md-5">
                  <!-- Default box -->
                  <div class="box box-success">
                    <div class="box-header with-border">
                      <h3 class="box-title">Scan QR Code Cek Stok Opname</h3>
                    </div>
                    <div class="box-body">
                        <center><video id="preview" width="100%" height="100%"></video></center>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
            </div>
      </div>

       <!-- Default box -->
       <div class="box box-success">
                    <div class="box-header with-border">
                      <h3 class="box-title">Data Stok Opname Barang</h3>
                    </div>
                    <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                              <th>Kode Barang</th>
                              <th>Nama Barang</th>
                              <th>Stok</th>
                              <th>Jenis Barang</th>
                              <th>Jumlah Item</th>
                              <th>Kategori Proses</th>
                              <th>Kondisi Barang</th>
                              <th>Keterangan</th>
                            </tr>
                            </thead>
                            <tbody id="show_data">
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

  <script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        //alert(content);
        // Swal.fire("Berhasil Scan",content,"success");
        // console.log(content);
        if(content !== ""){
          $.post('<?php echo base_url(); ?>inventorybarang/cekstok', {kode: content}, function(response){
						//console.log(response);
            const obj = JSON.parse(response);
            console.log(obj.foto);
            document.getElementById("kodebrg").innerHTML = obj.kode;
            document.getElementById("namabrg").innerHTML = obj.nama_barang;
            document.getElementById("jenisbrg").innerHTML = obj.jenis;
            document.getElementById("foto_brg").src = '<?php echo base_url(); ?>file_logistik/'+obj.foto;
            document.getElementById("stok").innerHTML = obj.stok+" ("+obj.satuan+")";
				  });

          $.post('<?php echo base_url(); ?>inventorybarang/cektransaksi', {kode: content}, function(responsetrans){
						//console.log(response);
            //const objtrans = JSON.parse(responsetrans);
            //console.log(responsetrans);
            $('#show_data').html(responsetrans);
				  });
          
        }else{
          console.log("Belum ada data scan !");
        }
      });

      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          Swal.fire("Gagal Scan","Kamera tidak ditemukan / belum aktif !","error");
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });

function ucwords(str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}

function kondisiBarang(str){
  var kondisi;
  if(str == 'b'){
    kondisi = 'Baik';
  }else if(str == 'r'){
    kondisi = 'Rusak';
  }else if(str == 'h'){
    kondisi = 'Hilang';
  }
  return kondisi;
}

</script>