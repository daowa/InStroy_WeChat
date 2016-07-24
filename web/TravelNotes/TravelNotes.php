<?php
?>

<!DOCTYPE html>
<html>
<head>
	<title>游记列表</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="../../css/TravelNotes.css">
	<link rel="stylesheet" href="../../css/All.css">
	<script src="../../js/all.js"></script>
	
	<script type="text/javascript">
	function toTravelNotesDetail(){
		self.location = ADDRESS + "web/TravelNotes/TravelNotesDetail.php";
	}
	</script>
</head>

<body>
	<ul>
		<li>
			<div class="board" onclick="toTravelNotesDetail()">
				<img class="photo" src="http://sh.sinaimg.cn/2015/0127/U11428P18DT20150127121811_1.jpeg">
				<h1 class="area">日本京都红色的寺</h1>
				<h2 class="time">2016年5月18日-19日</h2>
			</div>
		</li>
	</ul>
	<ul>
		<li>
			<div class="board" onclick="toTravelNotesDetail()">
				<img class="photo" src="http://img.tuniucdn.com/icons/place_photo/2012-02-111349938391800x600.jpg">
				<h1 class="area">河北玫瑰庄园温泉</h1>
				<h2 class="time">2016年2月24日-27日</h2>
			</div>
		</li>
	</ul>
	<ul>
		<li>
			<div class="board" onclick="toTravelNotesDetail()">
				<img class="photo" src="http://img.tuniucdn.com/icons/place_photo/2012-12-311343707866800x600.jpg">
				<h1 class="area">大理南诏风情岛</h1>
				<h2 class="time">2015年7月17日</h2>
			</div>
		</li>
	</ul>
</body>

<footer>
</footer>
</html>