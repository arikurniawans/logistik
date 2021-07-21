<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $inventory; ?></h3>

              <p>Total Data Inventory</p>
            </div>
            <div class="icon">
              <i class="fa fa-archive"></i>
            </div>
            <a href="<?php echo base_url(); ?>inventorybarang" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $bk ;?></h3>

              <p>Total Data Barang Keluar</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder-open-o"></i>
            </div>
            <a href="<?php echo base_url(); ?>barangkeluar" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $bm; ?></h3>

              <p>Total Data Barang Masuk</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder"></i>
            </div>
            <a href="<?php echo base_url(); ?>barangmasuk" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $jenis; ?></h3>

              <p>Total Jenis Barang</p>
            </div>
            <div class="icon">
              <i class="fa fa-briefcase"></i>
            </div>
            <a href="<?php echo base_url(); ?>jenis" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
                  <!-- Default box -->
                  <div class="box box-success">
                    <div class="box-header with-border">
                      <h3 class="box-title">Grafik Total Data Barang Keluar / Masuk</h3>
                    </div>
                    <div class="box-body">
                        <div id ="mygraph"></div>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->

                  <!-- Default box -->
                  <div class="box box-success">
                    <div class="box-header with-border">
                      <h3 class="box-title">Data Stok Barang Batas Minimum</h3>
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
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; foreach($minbarang as $data){ ?>
                                <tr <?php if($data->stok == "0"){ ?>style="background-color: #F08080;" <?php } ?>>
                                  <td><?php echo $no++; ?></td>
                                  <td><?php echo strtoupper($data->kode_barang); ?></td>
                                  <td><?php echo strtoupper($data->nama_barang); ?></td>
                                  <td><?php echo strtoupper($data->jenis); ?></td>
                                  <td><?php echo $data->stok; ?></td>
                                  <td><?php echo ucwords($data->satuan); ?></td>
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

  <script>
        var chart; 
        $(document).ready(function() {
              chart = new Highcharts.Chart(
              {
                  
                 chart: {
                    renderTo: 'mygraph',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                 },   
                 title: {
                    text: 'Rekapitulasi Data Logistik POLRES Pesawaran'
                 },
                 subtitle: {
                      text: 'Periode Bulan : <?php echo $periode; ?>'
                },
                 tooltip: {
                    formatter: function() {
                        return '<b>'+
                        this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' % ';
                    }
                 },
                 plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            color: '#000000',
                            connectorColor: 'green',
                            formatter: function() 
                            {
                                return '<b>' + this.point.name + '</b>: ' + this.point.y +' Item';
                            }
                        }
                    }
                 },
                    series: [{
                    type: 'pie',
                    name: 'Jenis Transaksi',
                    data: [
                            <?php foreach($grafik as $dta){ ?>
                            [ 
                                '<?php echo "Barang ".ucwords($dta->jenis_transaksi); ?>', <?php echo $dta->jml_trans; ?>
                            ],
                            <?php } ?>
                    ]
                }]
              });
        }); 
        // Highcharts.numberFormat(this.point.y, 2)
    </script>