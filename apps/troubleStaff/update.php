<?php
$status = require('status.php');

if(isset($_POST['ok'])){
  $query = $db->prepare("UPDATE trouble SET
    status = :status

    WHERE trouble.id = :id; ");

  $result = $query->execute([
    "id" =>$_GET["id"],
    "status" =>$_POST["status"]
  ]);

  $lastId = $db->lastInsertId();
  $query = $db->prepare("INSERT INTO solve (id, howto,sdate,sname) VALUES (:id,:howto,:sdate,:sname );");
  $result = $query->execute([

    "id" =>$_GET["id"],
    "howto" =>$_POST["howto"],
    "sdate" =>$_POST["sdate"],
    "sname" =>$_POST["sname"],

  ]);
  if($result){
    echo "<script>alert('บันทึก สำเร็จ >_<');
    window.location = 'index.php?file=troubleStaff/index';
    </script>";
  }else{
    echo "บันทึก ไม่สำเร็จ! ".$query->errorInfo()[2];
    //print_r($query->errorInfo());
  }
}
//echo $_GET['id'];
$isNewRecord = false;
//ดึงข้อมูลตำแหน่ง

if($isNewRecord){
  $record=[
    'id'=>'',
    'status'=>'',
  ];

}else{
  $query = $db->prepare("SELECT * FROM trouble WHERE id =:id");
  $query->execute(['id'=>$_GET['id']]);
  if($query->rowCount()>0){
    $data = $query->fetch(PDO::FETCH_OBJ);
    $record=[
      'id'=>$data->id,
      'status'=>$data->status,
      'detail'=>$data->detail,
    ];
  }
}

 ?>

 <div class="row">
    <div class="col-sm-2">
    </div>
        <div class="col-sm-7">
          <div class="panel panel-primary">
            <div class="panel-heading">TC000<?=$data->id?></div>
              <div class="panel-body">
                <div class="col-sm-12 col-sm-offset "  >
  <br>
<form class="form-horizontal" action="" method="post">

    <!-- <div class="form-group">
      <label for="detail" class="col-sm-3 control-label ">
      <span style="font-size:13px;color:#ff0000">ปัญหา / อาการ :<?=$data->detail?></span></label>
    </div> -->

    <div class="form-group">
      <label for="detail" class="col-sm-3 control-label ">ปัญหา/อาการ :</label>
        <div class="col-sm-7">
      <span><?=$data->detail?></span>
    </div>
      </div>

    <div class="form-group">
      <label for="sdate" class="col-sm-3 control-label ">วันที่</label>
        <div class="col-sm-7">
      <input class="form-control"  name="sdate" type="date" id="sdate" >
    </div>
      </div>

  <div class="form-group">
    <label for="howto" class="col-sm-3 control-label ">วิธีการแก้ปัญหา</label>
      <div class="col-sm-7">
      <textarea class="form-control" name="howto" id="howto"></textarea>
  </div>
    </div>

  <div class="form-group">
      <label for="status" class="col-sm-3 control-label ">สถานะ</label>
          <div class="col-sm-7">
      <select class="form-control" name='status'>
        <option value="">เลือกสถานะ</option>
        <?php
          foreach($status as $k => $v){//ดึงข้อมูลมาใส่ใน $row
            $selected = '';
            if($k==$data->status){
              $selected = 'selected';
            }
            echo '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
        }
        ?>
      </select>
    </div>
</div>

<div class="form-group">
  <label for="sname" class="col-sm-3 control-label ">ลงชื่อ</label>
  <div class="col-sm-7">
    <input type="text" class="form-control" id="sname" name="sname">
  </div>
</div>

      <br/>
      <div class="form-group">
        <div class="col-sm-offset-5 col-sm-8">
        <button class="btn btn-info" type="submit" name="ok">บันทึก</button>
        <button class="btn btn-default" type="reset" onclick="window.location= 'index.php?file=troubleStaff/update';">ยกเลิก </button>
    </div>
</div>
    </form>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
