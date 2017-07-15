<?php
$status = require('priority.php');
 ?>
 <?php
 $statuss = require('solve.php');
  ?>

<div class="col-sm-12">
  <div class="panel panel-default">
    <div class="panel-heading"><center><h3> รายการแจ้งซ่อม</h3>
      </center>
    </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table id="mydata" class="table table-striped table-bordered table-hover table-bordered cart" >
          <thead >
     <tr>
        <th>รหัส</th>
        <th>วันที่แจ้ง</th>
        <th>รายละเอียด</th>
        <th>ความสำคัญ</th>
        <th>ชื่อผู้แจ้ง</th>
        <th>โทรศัพท์</th>
        <th>สถานะ</th>
      </tr>
    </thead>
  <tbody>

<?php
$query = $db->prepare("SELECT * FROM trouble INNER JOIN person
    ON trouble.Pid = person.Pid
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
            <td><?=$row->postdate?></td>
            <td><?=$row->detail?></td>
            <td><?=$status[$row->priority];?></td>
            <td><?=$row->FirstName?>&nbsp;<?=$row->LastName?></td>
            <td><?=$row->Phone?></td>
            <td><?=$statuss[$row->status];?></td>

            <!-- <td>
              <a href="index.php?file=trouble/product_update&id=<?=$row->id_product?>" title="แก้ไข">
                <i class='glyphicon glyphicon-edit'></i></a>
                             &nbsp;
              <a href="index.php?file=product/product_del&id=<?=$row->id_product?>" title="ลบข้อมูล">
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
     <script>
     $(document).ready(function() {
        $('#mydata').dataTable( {
            "aaSorting": [[ 1, "desc" ]]
        } );
       } );

     </script>
  </div>
  </div>
  </div>
