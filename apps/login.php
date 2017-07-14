<?php

if(isset($_POST['logout'])){ //check ปุ่ม logout
  unset($_SESSION['user']); // reset ค่าใน session
  echo "<script>alert('ออกจากระบบ เรียบร้อย');
  window.location = 'index.php';
  </script>";
}

if(isset($_POST['login'])){  // check ปุ่ม login
  $query = $db->prepare("SELECT * FROM user WHERE username = :user AND password = :pass");
  $query->execute([
    'user'=>$_POST['username'],
    'pass'=>md5($_POST['password']),
  ]);
  if($query->rowCount()>0){ #กรณีมีค่ามากว่า 0 = ล็อกอินผ่าน
    $data = $query->fetch(PDO::FETCH_OBJ);
    if($data->status==1){
      $_SESSION['user'] = [
        'id'=>$data->id,
        'username'=>$data->username,
        'password'=>$data->password,
        'name'=>$data->name,
        'level_id'=>$data->level_id
      ];
    }else{
      echo "<script>
        alert('ผู้ใช้นี้ยังไม่ได้รับอนุญาตให้ใช้งาน !');
      </script>";
    }
  }else{
    # ล็อกอินไม่ผ่าน
    echo "ล็อกอินไม่ผ่าน";
  }

}
################################################################
/*
* การแสดงผล
*/
if(isset($_SESSION['user'])){//เช็คว่า session มีค่าไหม
 #### ดึงข้อมูลมาใหม่ #########
  $query = $db->prepare("SELECT * FROM user WHERE id=:id");
  $query->execute([
    'id'=>$_SESSION['user']['id']
  ]);//รัน sql
  $row = $query->fetch(PDO::FETCH_OBJ);
  #### แสดงค่าที่ดึงได้ #########
?>

 <!-- แสดงฟอร์มปุ่ม logout -->
  <form class="navbar-form navbar-right" method="post">
<span class="glyphicon glyphicon-user"></span>
    <?=$row->username?>
    <input type="submit" name="logout" class="btn btn-warning" value="ออกจากระบบ">
  </form>

  <?php
}else{ //กรณึยังไม่ได้ login หรือ $_SESSION['user'] ไม่มีค่าอะไรอยู่
?>

<form class="navbar-form navbar-right" action="" method="post">
  <!-- <span style="color:red">สำหรับผู้ดูแลระบบ</span> -->
  <div class="form-group">
    <input type="text" placeholder="username" class="form-control" name="username" id="username">
  </div>
  <div class="form-group">
    <input type="password" placeholder="password" class="form-control"  name="password">
  </div>
  <button type="submit" class="btn btn-success" name="login">login</button>
  <!-- <a href="?file=signup" class="btn btn-link">สมัครสมาชิก</a> -->
</form>

<?php } ?>
