  <?php
$query = $db->prepare("SELECT * FROM person ");
$query->execute();
$person = $query->fetchAll(PDO::FETCH_OBJ);

  if(isset($_POST['index'])){

    $query = $db->prepare("INSERT INTO trouble (postdate, type, detail,priority,Pid,phone) VALUES (:postdate, :type, :detail,:priority,:Pid,:phone );");
    $result = $query->execute([
      "postdate"=>date('Y-m-d H:i:s '),
     //  "postdate" =>$_POST["postdate"],
      "type" =>$_POST["type"],
      "detail" =>$_POST["detail"],
      "priority" =>$_POST["priority"],
      "Pid" =>$_POST["Pid"],
      "phone" =>$_POST["phone"]

    ]);
    if($result){
      echo "<script>alert('บันทึก สำเร็จ ^_^');
      window.location = 'index.php?file=troubleStaff/index';
      </script>";
    }else{
      echo "บันทึก ไม่สำเร็จ! ".$query->errorInfo()[2];
      //print_r($query->errorInfo());
    }
  }
   ?>

  <div class="row">
    <div class="col-sm-2">
    </div>
        <div class="col-sm-7">
          <div class="panel panel-primary">
            <div class="panel-heading">บันทึกแจ้งซ่อมสำหรับเจ้าหน้าที</div>
              <div class="panel-body">
                <div class="col-sm-12 col-sm-offset "  >
 <br>
  <form class="form-horizontal" action="" method="post">

                  <div class="alert alert-warning" style="width: 230px; height: 130px;">
                    <h4>ความสำคัญ</h4>
      <p class="last">ด่วนมาก = ภายใน 1 วันทำการ <br/>ด่วน = 1-2 วันทำการ <br/>ธรรมดา = 2-3 วันทำการ</p>
                  </div>

                  <div class="form-group">
                                <label for="type" class="col-sm-3 control-label">ประเภท</label>
                                <div class="col-sm-8">
                                      <select class="form-control" name="type" >
                                        <option value="คอมพิวเตอร์" selected="selected">คอมพิวเตอร์</option>
                                        <option value="พรินเตอร์">พรินเตอร์</option>
                                        <option value="อินเตอร์เน็ต-เน็ตเวิร์ก">อินเตอร์เน็ต-เน็ตเวิร์ก</option>
                                        <option value="ไวรัส">ไวรัส</option>
                                        <option value="โสตทัศนูปกรณ์">โสตทัศนูปกรณ์</option>
                                        <option value="อื่นๆ">อื่นๆ</option>
                                      </select>
                                </div>
                                </div>

  <div class="form-group">
    <label for="detail" class="col-sm-3 control-label ">ปัญหา / อาการ</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="detail" name="detail" placeholder="อธิบายให้ระเอียดและชัดเจนมากที่สุด">
    </div>
  </div>

  <div class="form-group">
    <label for="priority" class="col-sm-3 control-label ">ความสำคัญ</label>
      <div class="col-sm-8">
  <label class="radio-inline"><input type="radio" name="priority" value="3" required="" checked="checked">ธรรมดา</label>
  <label class="radio-inline"><input type="radio" name="priority" value="2" required="">ด่วน</label>
  <label class="radio-inline"><input type="radio" name="priority" value="1" required="">ด่วนมาก</label>
      </div>
 </div>

 <div class="form-group">
 <label for="Pid" class="col-sm-3 control-label ">ชื่อ-สกุลผู้แจ้ง</label>
     <div class="col-sm-8">
   <select class="form-control" name="Pid" >
         <option value="">-- เลือกชื่อสกุลผู้แจ้ง --</option>
           <?php foreach ($person as $value):?>
           <option value="<?=$value->Pid?>"> <?=$value->FirstName?>&nbsp;<?=$value->LastName?>&nbsp;<?=$value->Phone?></option>
         <?php endforeach; ?>
   </select>
</div>
</div>

<div class="form-group">
  <label for="phone" class="col-sm-3 control-label ">โทรศัพท์</label>
  <div class="col-sm-8">
    <input type="text" class="form-control" id="phone" name="phone">
  </div>
</div>



 <!--<hr/>-->

 <div class="form-group">
   <div class="col-sm-offset-3 col-sm-5">
     <button type="submit" class="btn  btn-primary" name="index">บันทึก</button>
     <button class="btn btn-default" type="reset" onclick="window.location= 'index.php?file=staff/index';">ยกเลิก </button>
   </div>
 </div>
</form>



</div>
</div>
</div>
</div>
</div>
