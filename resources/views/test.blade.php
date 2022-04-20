<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<meta name="description" content="TimeCircleのデモでーす。">
<title>TimeCircle - jQueryまとめのカルマ</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="TimeCircles.js"></script>
<link rel="stylesheet" href="TimeCircles.css" />
</head>
<body>
<h1>TimeCircleのデモでーす。</h1>
<h2>TOKYO 2020まで、あと……</h2>
<div class="someTimer" data-date="2020-07-24 00:00:00" style="width: 500px; height: 125px; padding: 0px; box-sizing: border-box; background-color: #E0E8EF"></div>
 
<script>
  $(".someTimer").TimeCircles();
</script>
 
</body>
</html>
