<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Aplikasi Stok Opname Logistik</title>
<script type="text/javascript">
window.print();
window.onfocus=function(){ window.close();}
</script>
<style>
div.gallery {
    border: 2px solid #ccc;
}

div.gallery:hover {
    border: 2px solid #777;
}

div.gallery img {
    width: 100%;
    height: auto;
}

div.desc {
    padding: 15px;
    margin-top: -20px;
    text-align: center;
}

* {
    box-sizing: border-box;
}

.responsive {
    padding: 0 4px;
    padding-bottom: 9px;
    float: left;
    width: 24.99999%;
}

@media only screen and (max-width: 700px){
    .responsive {
        width: 49.99999%;
        margin: 6px 0;
    }
}

@media only screen and (max-width: 500px){
    .responsive {
        width: 100%;
    }
}

.clearfix:after {
    content: "";
    display: table;
    clear: both;
}
</style>
</head>
<body>
<?php foreach ($inventory as $data) { ?>
<div class="responsive">
  <div class="gallery">
      <img src="<?php echo base_url(); ?>qrlogistik/<?php echo $data->qr_code; ?>"  width="600" height="400">
    <div class="desc"><?php echo strtoupper($data->kode_barang); ?></div>
  </div>
</div>
<?php } ?>
</body>
</html>
