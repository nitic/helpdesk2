<?php
$status = require('priority.php');
 ?>
 <?php
 $statuss = require('solve.php');
  ?>

<div class="col-sm-12">
  <div class="panel panel-default">
    <div class="panel-heading"><center><h3> รายการแจ้งซ่อม</h3></center>
    </div>
      <div class="panel-body">
        <div class="table-responsive">
        <table id="mydata" class="table table-striped table-bordered table-hover table-bordered cart" >
          <thead >
     <tr>
        <th>รหัส</th>
        <th>วันที่แจ้ง</th>
        <th>รายละเอียด</th>
        <th>ประเภท</th>
        <th>ความสำคัญ</th>
        <th>ชื่อผู้แจ้ง</th>
        <th>โทรศัพท์</th>
        <th>แก้ปัญหา</th>
        <th>เครื่องมือ</th>
      </tr>
    </thead>
  <tbody>

<?php

$query = $db->prepare("SELECT * FROM trouble INNER JOIN person
    ON trouble.Pid =person.Pid
  --  ORDER BY trouble.postdate DESC
  ");

$query->execute();
$i=0;
          if($query->rowCount()>0){

            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
              $i++;
    //           $a = $row->postdate;
    // $b = date('Y-m-d', strtotime($a));
          ?>
    <tr>
      <!-- <td><?= $i?></td> -->
            <td>TC000<?=$row->id?></td>
             <td><?=$row->postdate?></td>
            <td><?=$row->detail?></td>
            <td><?=$row->type?></td>
            <!-- <td><?=$statusss[$row->type];?></td> -->
            <td><?=$status[$row->priority];?></td>
            <td><?=$row->FirstName?>&nbsp;<?=$row->LastName?></td>
            <td><?=$row->Phone?></td>
            <td><?=$statuss[$row->status];?></td>
            <td>
            <a href="index.php?file=troubleStaff/update&id=<?=$row->id?>" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
            </td>
            <!-- <td>
              <a href="index.php?file=trouble/update&id=<?=$row->sid?>" title="แก้ไข">
                <i class='glyphicon glyphicon-edit'></i></a>
                             &nbsp;
              <a href="index.php?file=product/del&id=<?=$row->sid?>" title="ลบข้อมูล">
                <i class='glyphicon glyphicon-trash'></i></a>
            </td> -->
    </tr>
    <?php
    }
  }
  ?>
    </tbody>
  </table>


  <!-- แบ่งหน้า -->
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="assets/bootstrap/js/jquery.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="assets/bootstrap/js/bootstrap.min.js"></script>
      <script src="assets/bootstrap/js/jquery.dataTables.min.js"></script>
      <script src="assets/bootstrap/js/dataTables.bootstrap.min.js"></script>
      <script >
      $('#mydata').dataTable({
        "order": [[ 1, "desc" ]]
      });
      </script>
  </div>
</div>
</div>
  </div>
