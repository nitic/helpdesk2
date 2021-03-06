<?php
session_start();
date_default_timezone_set('Asia/Bangkok');
require_once('libs/Db.php');
// require_once('libs/function.php');
 ?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/bootstrap/fonts/font-awesome.min.css">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>HelpDesk : คณะการแพทย์แผนไทย</title>
    <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.gvChart-1.0.1.min.js"></script>
    <script type="text/javascript" src="js/datetimepicker_css.js"></script>
    <style type="text/css">
          body
          {
          background: linear-gradient(to right,#E6E6FA, #E6E6FA);
          }
    </style>

    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  </head>

  <body>

      <img src="bn.jpg" style="width: 100%; height: 100%;" />
    <br>
</ul>
      <!-- Main jumbotron for a primary marketing message or call to action -->
<br>

      <div class="container-fluid">
        <!-- ตัวอย่างแถวของคอลัมน์ -->
        <div class="row">
          <div class="col-md-2">

            <?php
               include_once('apps/menu_left.php'); ?>
         </div>

          <div class="col-md-10">
            <?php
            if(isset($_GET['file'])){
               $app_file = 'apps/'.$_GET['file'].'.php';
                if(is_file($app_file)){
                  include_once($app_file);
                }else{
                  echo 'ไม่พบเนื้อหา 404';
                }
            }else{
              include_once('apps/troubleStaff/index.php');
            }?>
         </div>

        </div>

        <hr>

        <footer><center>
          ลิขสิทธิ์ &copy; โดยงานเทคโนโลยีสารสนเทศ คณะการแพทย์แผนไทย มหาวิทยาลัยสงขลานครินทร์ <br />
          โทร.2716 ติดต่อ <a href="index2.php" style="color:#000;text-decoration:none">ผู้ดูแลระบบ</a>: niti.c@psu.ac.th</center><br>
      </div> <!-- /container -->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
      </footer>
  </body>
</html>
