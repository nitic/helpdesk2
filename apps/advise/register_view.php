<div class="gcss-wrapper body-wrapper">
		<nav class=breadcrumbs>
			<span class="icon-location"></span>
			<ul>
				<li><a class=home href=index.html><span>ผู้ดูแลระบบ</span></a></li>
				<li>ดึงข้อมูลผลการลงทะเบียน</li>
			</ul>
		</nav>
<main class="wrapper">
<div class="content">
<article style="height:200px">
				<p>
					<h3><span class="icon-user-check">ตรวจสอบผลการลงทะเบียน: </span></h3>
				</p>
				<div class="grid block4 float-left">
							<form id="register_form" method="post" class="fixlabel"  action="<?php echo base_url(); ?>register/review">
									<fieldset>
										<div class="item"><label for="category_title">เลือกหลักสูตร</label>
											<span class="g-input">
													<select id="syllabus_id" name="syllabus_id">
															 <?php foreach($cb_syllabus as $value): ?>
																	 <option value="<?php echo $value["id"]; ?>"
																	 <?php
																	     if (isset($syllabus_id)) {
																				 if($syllabus_id == $value["id"])
 																					 echo ' selected';
																	     }
																		?>
															><?php echo $value["name"].' '.$value["type"].' '.$value["year"]; ?></option>
															<?php endforeach; ?>

													</select>
											</span>
										</div>
										<div class="item">
												<div class="input-groups">
														<div class="width50">
																<label for="study_year">ภาคการศึกษา</label>
																<span class="g-input">
																	<select name="term_edu">
																			<option value="1" <?php if(isset($eduTerm)) if($eduTerm == 1) echo 'selected';?>>1</option>
																			<option value="2" <?php if(isset($eduTerm)) if($eduTerm == 2) echo 'selected';?>>2</option>
																			<option value="3" <?php if(isset($eduTerm)) if($eduTerm == 3) echo 'selected';?>>3</option>
																	 </select>
																</span>
														</div>
														<div class="width50">
															<label for="year_edu">ปีการศึกษา</label>
															<span class="g-input">
																<select name="year_edu">
																		<?php
																			for ($i=year_calculate(); $i >= 2557; $i--) {
																					$selected = '';
																					if(isset($eduYear)){
																						if($eduYear == $i)
																							$selected =  'selected';
																					}
																						echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
																			}
																		?>
																	</select>
															</span>
														</div>
												</div>
										</div>
									</fieldset>
									<fieldset class="submit">
										<button class="button save" type="submit" value="แสดงข้อมูล">แสดงข้อมูล</button>
									</fieldset>
						</form>
				</div>
</article>
<article>
      <?php if(isset($subject_data)):
						  if(!empty($subject_data)):
			?>
				<table id="table" class="border fullwidth">
					  <caption>
							<h3 class="float-left">
								<?php
							   echo $syllabus_name[0]['name']." (".$syllabus_name[0]['type']." ".$syllabus_name[0]['year'].") ปีการศึกษา ".$eduTerm."/".$eduYear;
				        ?></h3>
							<span class="float-right">
								<a class="button green" href="
								<?php
									echo base_url().'register/modal_register/'.$syllabus_id.'/'.$eduTerm.'/'.$eduYear.'/0';
								?>
								" rel="modal:open"><span class="icon-plus">เพิ๋มรายวิชาลงทะเบียน</span></a>
							</span>
						</caption>
						<thead>
							<tr>
								<th class=center>รหัสวิชา</th>
								<th class=center>ชื่อรายวิชา</th>
								<th class=center>Scetion</th>
								<th class=center>นศ.ลงทะเบียน</th>
								<th class=center>รหัส นศ.ที่ทำประเมิน</th>
								<th class=center>รายชื่อนักศึกษา</th>
								<th class=center>Action</th>
							</tr>
						</thead>
						   <tbody>
								<?php
                if(isset($subject_data)){
									foreach($subject_data as $id => $data) {
										echo '<tr>';
										echo '<td class="center">'.$data["code"].'</td>';
										echo '<td>'.$data["thainame"].'</td>';

										$edit_url = base_url().'register/modal_register/'.$syllabus_id.'/'.$eduTerm.'/'.$eduYear.'/'.$data["reg_id"];
										$delete_url = base_url().'register/delete/'.$syllabus_id.'/'.$eduTerm.'/'.$eduYear.'/'.$data["reg_id"];

										if(!empty($data["section"])){
												echo '<td class="center">'.$data["section"].'</td>';
												echo '<td class="center">'.$data["student_amount"].' คน</td>';
												echo '<td class="center">'.$data["student_code_eval"].'</td>';

												if(!empty($data["link"])){
													echo '<td class="center"><a href="http://lms.psu.ac.th/blocks/import_students/'.$data["link"].'" target="_blank"><span class="icon-users">รายชื่อ</span></a></td>';
												}
												else{
													 echo '<td class="center">(manual)</td>';
												}

												echo '<td class="center"><a class="button cyan" href="'.$edit_url.'" rel="modal:open"><span class="icon-pencil">แก้ไข</span></a> ';
												echo '<a class="button rosy confirm" href="'.$delete_url.'"><span class="icon-bin">ลบ</span></a> </td>';
										}
										else {
												echo '<td colspan=4 class=center>ไม่พบข้อมูลการลงทะเบียนในรายวิชานี้</td>';
												echo '<td class="center"><a class="button cyan" href="'.$edit_url.'" rel="modal:open"><span class="icon-pencil">แก้ไข</span></a> ';
												echo '<a class="button rosy confirm" href="'.$delete_url.'"><span class="icon-bin">ลบ</span></a> </td>';
										}

									    echo '</tr>';
									}
								}

								?>
							</tbody>
						</table>
					<?php else: ?>
						<div class="warning">
							 <b><span class="icon-notification">แจ้งผล</span></b> : ไม่พบข้อมูลการลงทะเบียนรายวิชาในภาคการศึกษานี้ กรุณาตรวจสอบการข้อมูลดึงข้อมูลก่อนที่เมนู "การลงทะเบียน" > "ดึงข้อมูลการลงทะเบียน"
						</div>
					<?php endif; ?>
          <?php else: ?>
						<div class="tip">
							 <b><span class="icon-magic-wand">คำแนะนำ</span></b> : ก่อนตรวจสอบผลการลงทะเบียนรายวิชา เริ่มต้นให้ทำการดึงข้อมูลการลงทะเบียนก่อน...
						</div>
					<?php endif; ?>
</article>
</div>
</main>
</div>


<script type="text/javascript">

$(function() {

 $(".confirm").click(function(){
			if(confirm("คุณยืนยันที่จะลบข้อมูลนี้ใช่หรือไม่?")){
					return true;
					$(this).dialog("close");
			}
			else{
					return false;
					$(this).dialog("close");
			}
	});

});


</script>
