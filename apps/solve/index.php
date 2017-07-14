<?php
$status = require('priority.php');
 ?>
 <?php
 $statuss = require('solve.php');
  ?>

<div class="col-sm-12">
  <div class="panel panel-default">
    <div class="panel-heading"><center><h3>ผลการดำเนินงาน</h3>
      </center>
    </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table id="mydata" class="table table-striped table-bordered table-hover table-bordered cart" >
          <thead >
     <tr>
         <th>รหัสแจ้งซ่อม</th>
        <th>วันที่ซ่อม</th>
        <th>ชื่อผู้แจ้ง</th>
        <th>ปัญหา</th>
        <th>วิธีแก้ปัญหา</th>
      </tr>
    </thead>
  <tbody>

<?php
$query = $db->prepare("SELECT * FROM solve INNER JOIN (trouble,person)
ON solve.id =trouble.id AND trouble.Pid =person.Pid
    -- ORDER BY sid DESC
");
$query->execute();
$i=0;
          if($query->rowCount()>0){
            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
              $i++;
          ?>
    <tr>
      <!-- <td><?= $i?></td> -->
            <td>TC000<?=$row->id?></td>
            <td><?=$row->sdate?></td>
            <td><?=$row->FirstName?>&nbsp;<?=$row->LastName?></td>
            <td><?=$row->detail?></td>
            <td><?=$row->howto?></td>


            <!-- <td>
              <a href="index.php?file=trouble/update&id=<?=$row->sid?>" title="แก้ไข">
                <i class='glyphicon glyphicon-edit'></i></a>
                             &nbsp;
              <a href="index.php?file=product/del&id=<?=$row->sid?>" title="ลบข้อมูล">
                <i class='glyphicon glyphicon-trash'></i></a>
            </td> -->
        </tr>

<?php } } ?>
    </tbody>
  </table>
</div>

<!-- แบ่งหน้า -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/bootstrap/js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap/js/jquery.dataTables.min.js"></script>
    <script src="assets/bootstrap/js/dataTables.bootstrap.min.js"></script>
    <script >
    $('#mydata').dataTable();
    </script>
  </div>
  </div>
  </div>
