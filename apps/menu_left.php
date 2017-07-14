<ul class="nav nav-pills nav-stacked">

<?php  if(isset($_SESSION['user']) && $_SESSION['user']['level_id']==1){//เช็คว่า session มีค่าไหม
  ?>

  <div class="list-group">
    <div class="list-group">
      <a href="index2.php" class="list-group-item">
        <span class="fa fa-home" aria-hidden="true">&nbsp;&nbsp;หน้าแรก</span></a></li>

    <a href="index2.php?file=troubleStaff/index" class="list-group-item">
        <span  class="fa fa-file-text-o" aria-hidden="true">&nbsp;&nbsp;รายการแจ้งซ่อม</span></a></li>

    <a href="index2.php?file=staff/index" class="list-group-item">
        <span class="fa fa-commenting-o" aria-hidden="true">&nbsp;&nbsp;เพิ่มการแจ้งซ่อม</span></a></li>

    <a href="index2.php?file=chart/index" class="list-group-item">
        <span  class="fa fa-bar-chart" aria-hidden="true">&nbsp;&nbsp;รายงานสรุปผล</span></a></li>

    <a href="index2.php?file=solve/index" class="list-group-item">
        <span class="fa fa-hand-o-right" aria-hidden="true">&nbsp;&nbsp;ผลการดำเนินงาน</span></a></li>


  <?php }elseif(!isset($_SESSION['user'])){ ?>

    <div class="list-group">
      <a href="index.php" class="list-group-item">
        <span class="fa fa-home" aria-hidden="true">&nbsp;&nbsp;หน้าแรก</span></a></li>

    <a href="index.php?file=trouble/index" class="list-group-item">
      <span  class="fa fa-file-text-o" aria-hidden="true">&nbsp;&nbsp;รายการแจ้งซ่อม</span></a></li>

    <a href="index.php?file=advise/index" class="list-group-item">
        <span class="fa fa-commenting-o" aria-hidden="true">&nbsp;&nbsp;แจ้งซ่อม</span></a></li>

    <a href="index.php?file=chart/index" class="list-group-item">
        <span  class="fa fa-bar-chart" aria-hidden="true">&nbsp;&nbsp;รายงานสรุปผล</span></a></li>

    <a href="index.php?file=process/index" class="list-group-item">
        <span class="fa fa-hand-o-right" aria-hidden="true">&nbsp;&nbsp;ขั้นตอนการแจ้งซ่อม</span></a></li>
        <!-- <h3>แจ้งปัญหาโทร 2716</h3> -->
  <?php }?>
</ul>
