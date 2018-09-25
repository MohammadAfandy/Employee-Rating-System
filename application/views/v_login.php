<html>
  <head>
    <title>Employee Rating System</title>

<!-- Bootstrap -->
        <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet" id="bootstrap-css">
        <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" rel="stylesheet">

    <!--/.fluid-container-->
        <script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.js"></script>
        <script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assets/js/scripts.js"></script>
        <script type="text/javascript">
          $(document).ready(function(){       
          $('.form-checkbox').click(function(){
            if($(this).is(':checked')){
                $('#password').attr('type','text');
            }else{
                $('#password').attr('type','password');
            }
          });
        });
        </script>
<!------ Include the above in your HEAD tag ---------->
  </head>
<body id="LoginForm">
<div class="container">
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>LOGIN FORM</h2>
   <p>Please enter your username and password</p>
   </div>
    <form id="Login" method="post" action="login/loginAction">

        <div class="form-group">


            <input type="text" class="form-control" id="username" name="username" placeholder="Username">

        </div>

        <div class="form-group">

            <input type="password" class="form-control" id="password" name="password" placeholder="Password">

        </div>
        <i style="color:red;"><?php echo $this->session->flashdata('msg');?></i><br/>
        <input type="checkbox" class="form-checkbox"> Show password <br/>
        <button type="submit" class="btn btn-primary">Login</button>
    
    </form>
    User : user<br>
    Pass : user
    </div>
    
</div></div></div>


</body>
</html>
