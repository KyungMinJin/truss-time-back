<script>
	
	function appendOptionLast(name, num){
  		var elOptNew = document.createElement('option');
  		var hour = String(parseInt(parseInt(num)/100));
  		var temp = parseInt(num) % 100;
  		var min = ":30"
  		if(temp == 0){
  			min = ":00"
  		}
  		elOptNew.text = hour+min;
  		elOptNew.value = num;
  		var elSel = document.getElementsByName(name)[0];
  		try {
   			elSel.add(elOptNew,null); // standards compliant; doesn't work in IE
 		}catch(e) {
 			elSel.add(elOptNew); // IE
  		}
 	}

	function bucho(start,bubu){
		var sel_end = document.getElementsByName(start.split("_")[0]+"_end")[0];
		if(bubu==0){
			sel_end.style.display="none";
			while(sel_end.length > 1){
				sel_end.remove(sel_end.length - 1);
			}
		}
		else{
			sel_end.style.display="";
			while(sel_end.length > 1){
				sel_end.remove(sel_end.length - 1);
			}
			var i = parseInt(bubu) + 50;
			for(;i<=2400;i+=50){
				appendOptionLast(sel_end.name,i);
			}
		}
	}


</script>

월
<select name="monday_start" onchange="bucho(this.name,this.value)">
	<option value="0">시작시각</option>
<?php
for ($count = 900; $count < 2400; $count+=50) {
	echo "<option value=\"".$count."\">";
	$temp = $count/100;
	$hour = (int) $temp;
	if ($count%100 == 0) { $minute = '00'; }
	else {$minute = '30'; }

	echo $hour.":".$minute."</option>";
}
?>
</select>
<select name="monday_end" style="display:none">
	<option value="0">종료시각</option>
<?php
for ($count = 950; $count <= 2400; $count+=50) {
	echo "<option value=\"".$count."\">";

	$temp = $count/100;
	$hour = (int) $temp;
	if ($count%100 == 0) { $minute = '00'; }
	else {$minute = '30'; }

	echo $hour.":".$minute."</option>";
}
?>
</select>
</select>
<br />

화
<select name="tuesday_start" onchange="bucho(this.name,this.value)">
	<option value="0">시작시각</option>
<?php
for ($count = 900; $count < 2400; $count+=50) {
	echo "<option value=\"".$count."\">";

	$temp = $count/100;
	$hour = (int) $temp;
	if ($count%100 == 0) { $minute = '00'; }
	else {$minute = '30'; }

	echo $hour.":".$minute."</option>";
}
?>
</select>
<select name="tuesday_end" style="display:none">
	<option value="0">종료시각</option>
<?php
for ($count = 950; $count <= 2400; $count+=50) {
	echo "<option value=\"".$count."\">";

	$temp = $count/100;
	$hour = (int) $temp;
	if ($count%100 == 0) { $minute = '00'; }
	else {$minute = '30'; }

	echo $hour.":".$minute."</option>";
}
?>
</select>
<br />

수
<select name="wednesday_start" onchange="bucho(this.name,this.value)">
	<option value="0">시작시각</option>
<?php
for ($count = 900; $count < 2400; $count+=50) {
	echo "<option value=\"".$count."\">";

	$temp = $count/100;
	$hour = (int) $temp;
	if ($count%100 == 0) { $minute = '00'; }
	else {$minute = '30'; }

	echo $hour.":".$minute."</option>";
}
?>
</select>
<select name="wednesday_end" style="display:none">
	<option value="0">종료시각</option>
<?php
for ($count = 950; $count <= 2400; $count+=50) {
	echo "<option value=\"".$count."\">";

	$temp = $count/100;
	$hour = (int) $temp;
	if ($count%100 == 0) { $minute = '00'; }
	else {$minute = '30'; }

	echo $hour.":".$minute."</option>";
}
?>
</select>
<br />

목
<select name="thursday_start" onchange="bucho(this.name,this.value)">
	<option value="0">시작시각</option>
<?php
for ($count = 900; $count < 2400; $count+=50) {
	echo "<option value=\"".$count."\">";

	$temp = $count/100;
	$hour = (int) $temp;
	if ($count%100 == 0) { $minute = '00'; }
	else {$minute = '30'; }

	echo $hour.":".$minute."</option>";
}
?>
</select>
<select name="thursday_end" style="display:none">
	<option value="0">종료시각</option>
<?php
for ($count = 950; $count <= 2400; $count+=50) {
	echo "<option value=\"".$count."\">";

	$temp = $count/100;
	$hour = (int) $temp;
	if ($count%100 == 0) { $minute = '00'; }
	else {$minute = '30'; }

	echo $hour.":".$minute."</option>";
}
?>
</select>
<br />

금
<select name="friday_start" onchange="bucho(this.name,this.value)">
	<option value="0">시작시각</option>
<?php
for ($count = 900; $count < 2400; $count+=50) {
	echo "<option value=\"".$count."\">";

	$temp = $count/100;
	$hour = (int) $temp;
	if ($count%100 == 0) { $minute = '00'; }
	else {$minute = '30'; }

	echo $hour.":".$minute."</option>";
}
?>
</select>
<select name="friday_end" style="display:none">
	<option value="0">종료시각</option>
<?php
for ($count = 950; $count <= 2400; $count+=50) {
	echo "<option value=\"".$count."\">";

	$temp = $count/100;
	$hour = (int) $temp;
	if ($count%100 == 0) { $minute = '00'; }
	else {$minute = '30'; }

	echo $hour.":".$minute."</option>";
}
?>
</select>
<br />

토
<select name="saturday_start" onchange="bucho(this.name,this.value)">
	<option value="0">시작시각</option>
<?php
for ($count = 900; $count < 2400; $count+=50) {
	echo "<option value=\"".$count."\">";

	$temp = $count/100;
	$hour = (int) $temp;
	if ($count%100 == 0) { $minute = '00'; }
	else {$minute = '30'; }

	echo $hour.":".$minute."</option>";
}
?>
</select>
<select name="saturday_end" style="display:none">
	<option value="0">종료시각</option>
<?php
for ($count = 950; $count <= 2400; $count+=50) {
	echo "<option value=\"".$count."\">";

	$temp = $count/100;
	$hour = (int) $temp;
	if ($count%100 == 0) { $minute = '00'; }
	else {$minute = '30'; }

	echo $hour.":".$minute."</option>";
}
?>
</select>
<br />

일
<select name="sunday_start" onchange="bucho(this.name,this.value)">
	<option value="0">시작시각</option>
<?php
for ($count = 900; $count < 2400; $count+=50) {
	echo "<option value=\"".$count."\">";

	$temp = $count/100;
	$hour = (int) $temp;
	if ($count%100 == 0) { $minute = '00'; }
	else {$minute = '30'; }

	echo $hour.":".$minute."</option>";
}
?>
</select>
<select name="sunday_end" style="display:none">
	<option value="0">종료시각</option>
<?php
for ($count = 950; $count <= 2400; $count+=50) {
	echo "<option value=\"".$count."\">";

	$temp = $count/100;
	$hour = (int) $temp;
	if ($count%100 == 0) { $minute = '00'; }
	else {$minute = '30'; }

	echo $hour.":".$minute."</option>";
}
?>
</select>
<br />