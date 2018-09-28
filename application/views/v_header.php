<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Rating System</title>
	<!-- Bootstrap -->
        <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet">
       	<link href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" rel="stylesheet">

    <!--/.fluid-container-->
        <script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/scripts.js"></script>


        <script>
          $(document).ready(function() {
            $('#example').DataTable()
          }); 
        </script>
</head>
<body>
	<nav class="navbar navbar-default">
  	<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed"  data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url() ;?>">Employee Rating System</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="<?php echo base_url() ?>pegawai">Pegawai</a></li>
        <li><a href="<?php echo base_url() ?>kriteria">Kriteria</a></li>
        <li><a href="<?php echo base_url() ?>penilaian">Penilaian</a></li>
        <li><a href="<?php echo base_url() ?>laporan">Laporan</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->session->userdata('ses_id');?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="login/logoutAction">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
	</nav>
  <?php if ($this->session->userdata('akses') != "admin"){
    echo "<p><b><center>Anda Login Sebagai User <br> User Tidak Mempunyai Hak Akses Untuk ADD, EDIT, dan DELETE data</center></b></p>";
  }
  ?>
<script type="text/javascript">
    $(document).ready(function () {
        var url = window.location;
        $('ul.nav a[href="'+ url +'"]').parent().addClass('active');
        $('ul.nav a').filter(function() {
             return this.href == url;
        }).parent().addClass('active');
    });
</script> 