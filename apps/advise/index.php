<?php
//require_once('class.phpmailer.php');
require_once('class.psupassport.php');

if(isset($_POST['index'])){

   $psupssort = new PSUPASSPORT();
   $ldap = $psupssort->restful_authenticate($_POST["user"], $_POST["pwd"]);
    if($ldap) {
         if($ldap->auth_status === "Authentication OK"){

               //select Person id
               $query = $db->prepare("SELECT * FROM person WHERE Dssid = :user");
               $query->execute([
                   'user'=>'0016704',  // <--- change
               ]);


               if($query->rowCount()>0){ #กรณีมีค่ามากว่า 0 = ล็อกอินผ่าน
                      $data = $query->fetch(PDO::FETCH_OBJ);
                      $person_id = $data->Pid;

                      //insert trouble table
                      $query = $db->prepare("INSERT INTO trouble (postdate, type, detail,priority,Pid,phone) VALUES (:postdate, :type, :detail,:priority,:Pid ,:phone );");
                      $result = $query->execute([
                        "postdate"=>date('Y-m-d H:i:s '),
                        "type" =>$_POST["type"],
                        "detail" =>$_POST["detail"],
                        "priority" =>$_POST["priority"],
                        "Pid" => $person_id,
                        "phone" =>$_POST["phone"],
                       ]);
                      if($result){
                       echo "<script>alert('บันทึก สำเร็จ');
                       window.location = 'index.php?file=trouble/index';
                       </script>";
                      }
                 }
           }
       }
   else{
       echo "<script>alert('Username หรือ Password ไม่ถูกต้องกรุณาป้อมใหม่อีกครั้ง');
       window.location = 'index.php?file=advise/index';
       </script>";
       exit();
     }

}

/*
function saveAndSendMail(){
   $query = $db->prepare("INSERT INTO trouble (postdate, type, detail,priority,phone) VALUES (:postdate, :type, :detail,:priority,:phone );");
   $result = $query->execute([
     "postdate"=>date('Y-m-d H:i:s '),
    "postdate" =>$_POST["postdate"],
     "type" =>$_POST["type"],
     "detail" =>$_POST["detail"],
     "priority" =>$_POST["priority"],
     "phone" =>$_POST["phone"],
    ]);

   if($result){
   	$mail = new PHPMailer();
   	$mail->IsHTML(true);
    $mail->CharSet = "utf-8";
   	$mail->IsSMTP();
   	$mail->SMTPAuth = true; // enable SMTP authentication
   	$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
   	$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
   	$mail->Port = 465; // set the SMTP port for the GMAIL server
   	$mail->Username = "###"; // GMAIL username
   	$mail->Password = "###"; // GMAIL password
   	$mail->From = "###"; // "name@yourdomain.com";
   	//$mail->AddReplyTo = "support@thaicreate.com"; // Reply
   	$mail->FromName = "HelpDesk";  // set from Name
   	$mail->Subject = "ระบบแจ้งซ่อมออนไลน์";
   	$mail->Body = "มีการแจ้งซ่อมใหม่...</b>".$_POST["detail"];

   	$mail->AddAddress("###","###"); // to Address

   	// $mail->AddAttachment("thaicreate/myfile.zip");
   	// $mail->AddAttachment("thaicreate/myfile2.zip");

   	//$mail->AddCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC
   	//$mail->AddBCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC

   	$mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low

   	$mail->Send();

     echo "<script>alert('บันทึก สำเร็จ');
    window.location = 'index.php?file=advise/index';
    </script>";


  }else{
    echo "บันทึก ไม่สำเร็จ! ".$query->errorInfo()[2];
    //print_r($query->errorInfo());
  }

}
*/
?>

 <div class="row">
 <div class="col-sm-2">
 </div>
 <div class="col-sm-7">
   <div class="panel panel-primary">
     <div class="panel-heading">บันทึกแจ้งซ่อม</div>
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
  <label for="phone" class="col-sm-3 control-label ">โทรศัพท์</label>
  <div class="col-sm-8">
    <input type="text" class="form-control" id="phone" name="phone">
  </div>
</div>

<img src="images/passport-logo.gif" border="0">
<div class="form-group">
  <label for="price" class="col-sm-3 control-label ">Username</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="user" id="user" />
  </div>
</div>

<div class="form-group">
  <label for="price" class="col-sm-3 control-label ">Password</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" name="pwd" id="pwd" />
  </div>
</div>

<!--<hr/>-->

<div class="form-group">
  <div class="col-sm-offset-3 col-sm-5">
    <button type="submit" class="btn  btn-primary" name="index">บันทึก</button>
    <button class="btn btn-default" type="reset" onclick="window.location= 'index.php?file=advise/index';">ยกเลิก </button>
  </div>
</div>
</form>

</div>
<br>
</div>
</div>
</div>
</div>
